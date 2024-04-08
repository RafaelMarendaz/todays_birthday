<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Class block_todays_birthday
 *
 * @package    block_todays_birthday
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_todays_birthday extends \block_base // Referenciando a classe block_base com o namespace global
{
    public function __construct()
    {
        $this->title = get_string('pluginname', 'block_todays_birthday');
    }

    public function has_config()
    {
        return true;
    }

    public function get_content()
    {
        global $DB, $CFG, $PAGE, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new \stdClass; // Referenciando a classe stdClass com o namespace global

        // Recuperar aniversariantes do dia
        $today = date('m-d');
        $aniversariantes = $DB->get_records_sql("
        SELECT u.id, u.firstname, u.lastname, u.picture
        FROM {todays_birthday} tb
        JOIN {user} u ON tb.userid = u.id
        WHERE DATE_FORMAT(tb.birthday, '%m-%d') = ?
    ", array($today));

        // Definindo os dados para o template Mustache
        $template_data = array(
            'ver_todos' => get_string('viewalldays', 'block_todays_birthday'),
            'voltar_inicio' => get_string('backtohome', 'block_todays_birthday'),
            'url_todos' => $CFG->wwwroot . '/blocks/todays_birthday/allbirthdays/allbirthdays.php',
            'url_home' => $CFG->wwwroot . '/index.php'
        );

        // Verificar se há aniversariantes
        if ($aniversariantes) {
            $html = '<ul>';
            foreach ($aniversariantes as $aniversariante) {
                $nome_completo = fullname($aniversariante);

                // Usar a classe user_picture para obter a imagem do perfil
                $userpicture = new user_picture($aniversariante);

                // Obter a tag de imagem HTML completa com tamanho 50x50
                $foto_html = $userpicture->get_url($PAGE, $OUTPUT, array('size' => 50))->__toString();

                // Adicionando na variável de HTML a foto e como lista ordenada
                $html .= '<li>' . '<img src="' . $foto_html . '" alt="' . $nome_completo . '">' . ' ' . $nome_completo . '</li>';
            }
            $html .= '</ul>';
            $template_data['block_content'] = $html;
            // Renderizando o template Mustache
            $this->content->text = $OUTPUT->render_from_template('block_todays_birthday/todays_birthday', $template_data);
        } else {
            $template_data['no_aniversaries_message'] = get_string('noaniversaries', 'block_todays_birthday');
            // Renderizando o template Mustache
            $this->content->text = $OUTPUT->render_from_template('block_todays_birthday/no_aniversaries', $template_data);
        }

        return $this->content;
    }




    public function instance_allow_multiple()
    {
        return true;
    }

    public function applicable_formats()
    {
        return array(
            'all' => true,
            'course-view' => true,
            'mod' => true,
            'my' => true,
            'site' => true
        );
    }
}
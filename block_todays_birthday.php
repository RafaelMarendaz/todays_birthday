<?php
// Este arquivo faz parte do Moodle - http://moodle.org/
//
// O Moodle é um software livre: você pode redistribuí-lo e/ou
// modificá-lo conforme os termos da Licença Pública Geral GNU publicada pela
// Free Software Foundation, tanto a versão 3 da Licença como (a seu critério)
// qualquer versão posterior.
//
// O Moodle é distribuído na esperança de que seja útil,
// mas SEM NENHUMA GARANTIA; sem uma garantia implícita de
// COMERCIALIZAÇÃO ou de ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a
// Licença Pública Geral GNU para obter mais detalhes.
//
// Você deve ter recebido uma cópia da Licença Pública Geral GNU
// juntamente com o Moodle. Se não, consulte <http://www.gnu.org/licenses/>.

require_once(__DIR__ . '/../../config.php');
// require_once(__DIR__ . '/classes/todaysbirthdaymanager.php');
// require_once($CFG->dirroot . '/blocks/todays_birthday/classes/todays_birthday.php');
require (__DIR__ . '/locallib.php');

class block_todays_birthday extends block_base // Referenciando a classe block_base com o namespace global
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
        global $CFG, $PAGE, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new \stdClass; // Referenciando a classe stdClass com o namespace global

        // Recuperar aniversariantes do dia
        $aniversariantes = locallib_get_limited_todays_birthday(); // Retorna os aniversariantes do dia

        // Definindo os dados para o template Mustache
        $template_data = array(
            'ver_todos' => get_string('viewalldays', 'block_todays_birthday'),
            'voltar_inicio' => get_string('backtohome', 'block_todays_birthday'),
            'url_todos' => $CFG->wwwroot . '/blocks/todays_birthday/allbirthday.php',
            'url_home' => $CFG->wwwroot . '/index.php'
        );

        // Verificar se há aniversariantes
        if ($aniversariantes) {
            $html = '';
            foreach ($aniversariantes as $aniversariante) {
                $nome_completo = fullname($aniversariante);
        
                // Usar a classe user_picture para obter a imagem do perfil
                $userpicture = new user_picture($aniversariante);
        
                // Obter a tag de imagem HTML completa com tamanho 50x50 e forma circular
                $foto_html = $userpicture->get_url($PAGE, $OUTPUT, array('size' => 50, 'shape' => 'circle'))->__toString();
        
                // Adicionando na variável de HTML as imagens e nomes completos
                $html .= '<img src="' . $foto_html . '" alt="' . $nome_completo . '">' . ' ' . $nome_completo . '<br>';
            }
            $template_data['block_content'] = $html;
            // Renderizando o template Mustache
            $this->content->text = $OUTPUT->render_from_template('block_todays_birthday/todays_birthday', $template_data);
        }
        
         else {
            $template_data['no_aniversaries_message'] = get_string('noaniversaries', 'block_todays_birthday');
            // Renderizando o template Mustache
            $this->content->text = $OUTPUT->render_from_template('block_todays_birthday/no_aniversaries', $template_data);
        }

        return $this->content;

    }

    public function instance_allow_multiple() // O bloco pode ser exibido mais de uma vez
    {
        return false;
    }

    public function applicable_formats() // Onde pode ser exibido o bloco
    {
        return array(
            'all' => false,
            'course-view' => false,
            'mod' => false,
            'my' => true,
            'site' => true
        );
    }
}

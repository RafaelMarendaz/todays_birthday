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
 * TODO describe file allbirthday
 *
 * @package    block_todays_birthday
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require (__DIR__ . '/locallib.php');


require_login();

$url = new moodle_url('/blocks/todays_birthday/allbirthday.php', []);
$PAGE->set_url($url);


// $PAGE->set_heading($SITE->fullname);
echo $OUTPUT->header();

$allbirthdays = locallib_get_todays_birthday();
$table = new html_table();
$table->head = array(get_string('name'), ' '); // Cria a tabela e cabeçalho
$table->align = array('left', 'left');

foreach ($allbirthdays as $student) {
    $table->data[] = array(
        $value = $OUTPUT->user_picture($student) . ' ' . fullname($student) // Mostra em uma unica linha o nome e imagem
    );
}

echo $OUTPUT->heading(get_string('allbirthday', 'block_todays_birthday'));
echo html_writer::table($table);

$url_home = new moodle_url('/'); // Cria um link para a pagina inicial
$link_home = html_writer::tag('div', html_writer::link($url_home, get_string('backtohome', 'block_todays_birthday')), array('style' => 'text-align:center;margin-top:10px;'));
echo html_writer::tag('p', $link_home); // Mostra o link

echo $OUTPUT->footer();

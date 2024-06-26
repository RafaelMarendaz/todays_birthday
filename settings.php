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
 * TODO describe file settings
 *
 * @package    block_todays_birthday
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


 if ($ADMIN->fulltree) {
    // Configuração para escolher quem pode ver os aniversariantes
    $settings->add(new admin_setting_configselect(
        'block_todays_birthday_visibilidade',
        get_string('config_visibilidade', 'block_todays_birthday'),
        get_string('config_visibilidade_desc', 'block_todays_birthday'),
        'todos', // Valor padrão
        array(
            'todos' => get_string('todos', 'block_todays_birthday'),
            'estudantes' => get_string('somente_estudantes', 'block_todays_birthday')
        )
    ));
}

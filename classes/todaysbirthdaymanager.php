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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>

namespace block_todays_birthday;

require_once(__DIR__ . '/../../../blocks/moodleblock.class.php');
require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../classes/todaysbirthdaymanager.php');

/**
 * Class todaysbirthdaymanager
 *
 * @package    block_todays_birthday
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 class todaysbirthdaymanager {
    public function renderBlock() {
        // Crie uma instância da classe block_todays_birthday
        $block = new \block_todays_birthday();

        // Renderize o conteúdo do bloco
        echo $block->get_content()->text;
    }
}

// Crie uma instância da classe todaysbirthdaymanager
$manager = new \block_todays_birthday\todaysbirthdaymanager();

// Renderize o bloco
$manager->renderBlock();




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
 * TODO describe file locallib
 *
 * @package    block_todays_birthday
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


function locallib_get_todays_birthday()
{
    global $DB;
    $today = date('m-d');
    $aniversariantes = $DB->get_records_sql("
    SELECT u.id, u.firstname, u.lastname, u.picture
    FROM {todays_birthday} tb
    JOIN {user} u ON tb.userid = u.id
    WHERE DATE_FORMAT(tb.birthday, '%m-%d') = ?
    ", array($today));
    return $aniversariantes;
}

function locallib_get_limited_todays_birthday()
{
    global $DB;
    $today = date('m-d');
    $aniversariantes = $DB->get_records_sql("
    SELECT u.id, u.firstname, u.lastname, u.picture
    FROM {todays_birthday} tb
    JOIN {user} u ON tb.userid = u.id
    WHERE DATE_FORMAT(tb.birthday, '%m-%d') = ?
    ", array($today), 0, 10);
    return $aniversariantes;
}


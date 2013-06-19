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
 * Settings and Link file for skillsoft_customreportlog report
 *
 * @package    report_skillsoft_customreportlog
 * @copyright  2013 onwards Martin Holden}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
$ADMIN->add('reports', new admin_category('skillsoft_reports', get_string('skillsoft_report_menu', 'report_skillsoft_customreportlog')));
$ADMIN->add('skillsoft_reports', new admin_externalpage('report_skillsoft_customreportlog', get_string('pluginname', 'report_skillsoft_customreportlog'), "$CFG->wwwroot/report/skillsoft_customreportlog/index.php",'report/skillsoft_customreportlog:view'));

// no report settings
$settings = null;
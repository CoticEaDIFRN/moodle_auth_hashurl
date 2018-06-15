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
 * Admin settings and defaults
 *
 * @package auth_hashurl
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Introductory explanation.
    $settings->add(new admin_setting_heading('auth_hashurl/pluginname',
            new lang_string('routes_settings', 'auth_hashurl'),
            new lang_string('auth_hashurlroutesdescription', 'auth_hashurl')));

    // URLs.
    $settings->add(new admin_setting_configtext('auth_hashurl/validation_url',
        get_string('auth_hashurl_validation_url_key', 'auth_hashurl'),
        get_string('auth_hashurl_validation_url', 'auth_hashurl'), '', PARAM_RAW_TRIMMED));

    $settings->add(new admin_setting_configtext('auth_hashurl/login_url',
        get_string('auth_hashurl_login_url_key', 'auth_hashurl'),
        get_string('auth_hashurl_login_url', 'auth_hashurl'), '', PARAM_RAW_TRIMMED));

    $settings->add(new admin_setting_configtext('auth_hashurl/logout_url',
        get_string('auth_hashurl_logout_url_key', 'auth_hashurl'),
        get_string('auth_hashurl_logout_url', 'auth_hashurl'), '', PARAM_RAW_TRIMMED));

    // Display locking / mapping of profile fields.
    $authplugin = get_auth_plugin('hashurl');
    display_auth_lock_options($settings, $authplugin->authtype,
        $authplugin->userfields, get_string('auth_fieldlocks_help', 'auth'), false, false);
}

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
 * Strings for component 'auth_hashurl', language 'en'.
 *
 * @package   auth_hashurl
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'HashURL';

$string['auth_hashurlroutesdescription'] = 'This method allows users from another specific system to log in to the platform through a token sent by their source system. All accounts must be hashurlly created by the admin user.
Note: In order for the plugin to work successfully, all URLs must be configured!';
$string['routes_settings'] = 'Routes settings';
$string['auth_hashurl_routes_settings'] = 'Hashurl routes settings';

$string['auth_hashurl_validation_url'] = 'Specify the validation URL - form like \'https://hostname/validation/{transactiontoken}/\' - here, we received a validation token.';
$string['auth_hashurl_validation_url_key'] = 'Validation URL';

$string['auth_hashurl_login_url'] = 'Specify the login form URL, to which the user will be redirected if he is not authenticated - form like \'https://hostname/login/\'.';
$string['auth_hashurl_login_url_key'] = 'Login form URL';

$string['auth_hashurl_logout_url'] = 'Specify the URL to which the user will be redirected after the logout.';
$string['auth_hashurl_logout_url_key'] = 'Logout URL';

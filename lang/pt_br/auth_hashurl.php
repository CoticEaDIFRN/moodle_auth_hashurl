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
 * Strings for component 'auth_hashurl', language 'pt_br'.
 *
 * @package   auth_hashurl
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 $string['auth_hashurlroutesdescription'] = 'Esse método permite que usuários de outro sistema específico efetuem login na plataforma, desde que sejam autenticados por meio de um token enviado pelo sistema de origem. Todas as contas devem ser criadas previamente pelo usuário admin.
 Observação: Para que o plugin funcione com sucesso, é necessário que todas as URLs sejam configuradas!';
 $string['routes_settings'] = 'Configuração de rotas';
 $string['auth_hashurl_routes_settings'] = 'Hashurl routes settings';

 $string['auth_hashurl_validation_url'] = 'Especifica a URL de validação, por exemplo, \'https://hostname/validation/{transactiontoken}/\' - aqui, recebemos um token de validação.';
 $string['auth_hashurl_validation_url_key'] = 'URL de validação';

 $string['auth_hashurl_login_url'] = 'Especifica a URL de login, para onde o usário será redirecionado caso não esteja autenticado, algo como \'https://hostname/login/\'.';
 $string['auth_hashurl_login_url_key'] = 'URL de formulário de login';

 $string['auth_hashurl_logout_url'] = 'Especifica a URL para a qual o usuário será redirecionado após o logout.';
 $string['auth_hashurl_logout_url_key'] = 'URL de logout';

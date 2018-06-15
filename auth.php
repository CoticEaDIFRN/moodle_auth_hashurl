<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_hashurl extends auth_plugin_base {
    const COMPONENT_NAME = 'auth_hashurl';
    const LEGACY_COMPONENT_NAME = 'auth/hashurl';

    public function __construct() {
        $this->authtype = 'hashurl';
        $config = get_config(self::COMPONENT_NAME);
        $legacyconfig = get_config(self::LEGACY_COMPONENT_NAME);
        // não deve ter
        $this->config = (object)array_merge((array)$legacyconfig, (array)$config);
    }

    function user_login($username, $password) {
        return true;
    }

    function user_exists($username) {
        //override if needed
        return false;
    }

        function can_edit_profile() {
            //override if needed
            return false;
        }

        function is_internal() {
            //override if needed
            return false;
        }

        public function is_configured() {
            return !empty($this->config->validation_url) && !empty($this->config->login_url) && !empty($this->config->logout_url);
        }

        function password_expire($username) {
            return 100000;
        }

        function loginpage_hook() {
            global $frm;  // can be used to override submitted login form
            global $user; // can be used to replace authenticate_user_login()
            global $DB;
            $frm = data_submitted();

            if ($this->is_configured() === false) {
                debugging(get_string('auth_notconfigured', 'auth', $this->authtype));
                echo "Erro de configuração do plugin 'HashURL'. Procure o administrador do sistema";
                return false;
            }

            if (!empty($_GET['transactiontoken'])) {
              $url_validacao = substr_replace($this->config->validation_url, "{transactiontoken}", $_GET['transactiontoken']);
              $url_login = substr_replace($this->config->login_url);
              $response = file_get_contents($url_validacao);
              if (!$response) {
                redirect($url_login);
                exit();
              }
              $data = json_decode($response);

              if ($_GET['transactiontoken'] != $data->transactiontoken) {
                echo "Erro de autenticação. Tente <a href=$url_login>acessar</a> novamente.";
              }
              $cpf = preg_replace("/[^0-9]/", "", $data->cpf);
              $user = $DB->get_record('user', array('username'=>$cpf));
              $frm->username = $cpf;
            }
        }

        function pre_loginpage_hook() {
          // Override if needed.
        }

        public function pre_user_login_hook(&$user) {
            // Override if needed.
        }

        function user_authenticated_hook(&$user, $username, $password) {
            //override if needed
        }

        function prelogout_hook() {
            global $USER;
            // use $USER->auth to find the plugin used for login
            //override if needed
        }

        function logoutpage_hook() {
            global $USER;     // use $USER->auth to find the plugin used for login
            global $redirect; // can be used to override redirect after logout
            $url_logout = substr_replace($this->config->logout_url);
            //override if needed
            if (strlen($USER->username)==11) {
                $redirect = $url_logout;
            }
        }

        function ignore_timeout_hook($user, $sid, $timecreated, $timemodified) {
            return true;
        }

        function loginpage_idp_list($wantsurl) {
            return array();
        }

        public static function get_identity_providers($authsequence) {
            global $SESSION;

            $identityproviders = [];
            foreach ($authsequence as $authname) {
                $authplugin = get_auth_plugin($authname);
                $wantsurl = (isset($SESSION->wantsurl)) ? $SESSION->wantsurl : '';
                $identityproviders = array_merge($identityproviders, $authplugin->loginpage_idp_list($wantsurl));
            }
            return $identityproviders;
        }

        public static function prepare_identity_providers_for_output($identityproviders, renderer_base $output) {
            $data = [];
            foreach ($identityproviders as $idp) {
                if (!empty($idp['icon'])) {
                    // Pre-3.3 auth plugins provide icon as a pix_icon instance. New auth plugins (since 3.3) provide iconurl.
                    $idp['iconurl'] = $output->image_url($idp['icon']->pix, $idp['icon']->component);
                }
                if ($idp['iconurl'] instanceof moodle_url) {
                    $idp['iconurl'] = $idp['iconurl']->out(false);
                }
                unset($idp['icon']);
                if ($idp['url'] instanceof moodle_url) {
                    $idp['url'] = $idp['url']->out(false);
                }
                $data[] = $idp;
            }
            return $data;
        }
}

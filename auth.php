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

    public function is_configured() {
        return !empty($this->config->validation_url) && !empty($this->config->login_url) && !empty($this->config->logout_url);
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
            $url_validacao = str_replace("{transactiontoken}", $_GET['transactiontoken'], $this->config->validation_url);
            $response = file_get_contents($url_validacao);
            if (!$response) {
                redirect($this->config->login_url);
                exit();
            }
            $data = json_decode($response);
            $cpf = preg_replace("/[^0-9]/", "", $data->cpf);
            $user = $DB->get_record('user', array('username'=>$cpf));
            $frm->username = $cpf;
          }
    }

    function logoutpage_hook() {
        global $USER;     // use $USER->auth to find the plugin used for login
        global $redirect; // can be used to override redirect after logout
        if (strlen($USER->username)==11) {
            $redirect = $this->config->logout_url;
        }
    }

    function user_login($username, $password) {
        // only change default behavior
        return true;
    }

    function user_exists($username) {
        // only change default behavior
        return false;
    }

    function can_edit_profile() {
        // only change default behavior
        return false;
    }

    function is_internal() {
        // only change default behavior
        return false;
    }

    function password_expire($username) {
        // only change default behavior
        return 100000;
    }

    function ignore_timeout_hook($user, $sid, $timecreated, $timemodified) {
        // only change default behavior
        return true;
    }

    function loginpage_idp_list($wantsurl) {
        // only change default behavior
        return array();
    }
}

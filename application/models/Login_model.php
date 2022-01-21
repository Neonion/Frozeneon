<?php

namespace Model;

use App;
use Exception;
use System\Core\CI_Model;

class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public static function logout()
    {
        App::get_ci()->session->unset_userdata('id');
    }

    /**
     * @param $userEmail
     * @param $userPassword
     * @param $email
     * @param $password
     * @param $userId
     *
     * @return bool
     * @throws Exception
     */
    public static function login(string $userEmail, string $userPassword, string $email, string $password, int $userId)
    {
        if (empty($userEmail) || empty($userPassword) || empty($email) || empty($password) || empty($userId))
        {
            throw new Exception('Some of params is not provided!');
        }

        if ($userEmail == $email && $userPassword == $password) {
            self::start_session($userId);
            return true;
        } else {
            return false;
        }
    }

    public static function start_session(int $user_id)
    {
        // если перенедан пользователь
        if (empty($user_id))
        {
            throw new Exception('No id provided!');
        }

        App::get_ci()->session->set_userdata('id', $user_id);
    }
}

<?php

namespace models;

use Core\Utils;

class User
{
    protected static $tableName = 'user';
    /**
     * Додає користувача в БД з вказаними параметрами (логін, пароль, електронна пошта, прізвище, ім'я)
     */
    public static function addUser($login, $password, $lastname, $firstname)
    {
        \core\Core::getInstance()->db->insert(
            self::$tableName,
            [
                'login' => $login,
                'password' => self::hashPassword($password),
                'lastname' => $lastname,
                'firstname' => $firstname,
            ]
        );
    }

    public static function hashPassword($password) {
        return md5($password);
    }
    /**
     * Видаляє користувача з БД з вказаним id
     */
    public static function updateUser($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['lastname', 'firstname']);
        \core\Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            [
                'id' => $id
            ]
        );
    }

    /**
     * 
     */
    public static function isLoginExists($login)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login
        ]);
        return !empty($user);
    }

    public static function verifyUser($login, $password)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login,
            'password' => $password
        ]);
        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login,
            'password' => self::hashPassword($password)
        ]);
        if(!empty($user))
            return $user[0];
        return null;
    }

    public static function authenticateUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function logoutUser()
    {
        unset($_SESSION['user']);
    }

    public static function isUserAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public static function getUser()
    {
        return ['user'];
    }

    public static function getUsers()
    {
        return ['user'];
    }

    public static function getCurrentAuthenticatedUser()
    {
        return $_SESSION['user'];
    }

    public static function isAdmin()
    {
        $user = self::getCurrentAuthenticatedUser();
        return $user['access_level'] == 10;
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 06/08/2016
 * Time: 00:00
 */

use ORM\Repository\UserRepository;
use ORM\Entity\User;

/**
 * Class Treatment
 */
class Treatment
{
    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function verify($username, $password)
    {
        $username = strtolower($username);
        if (null === $user = $this->getUser($username)) {
            return false;
        }

        return $username == $user->getUsername() && password_verify($password, $user->getPassword());
    }

    /**
     * @param $username
     * @return null|User
     */
    private function getUser($username)
    {
        $repo = new UserRepository();

        return $repo->findOneBy(['username' => $username]);
    }

}
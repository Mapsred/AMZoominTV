<?php

/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 06/08/2016
 * Time: 00:00
 */

/**
 * Class Treatment
 */
class Treatment
{
    /** @var string $username */
    private $username = "Amélie";
    /** @var string $password */
    private $password = "mozart";

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function verify($username, $password)
    {
        return $username == $this->username && $password == $this->password;
    }

}
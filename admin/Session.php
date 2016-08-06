<?php

/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 06/08/2016
 * Time: 00:22
 */
class Session
{
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;
    const LIMIT = 1800;

    // The state of the session
    /** @var  Session $instance */
    private static $instance;

    // THE only instance of the class
    private $sessionState = self::SESSION_NOT_STARTED;

    /**
     * Returns THE instance of 'Session'.
     * The session is automatically initialized if it wasn't.
     * @return Session
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }


    /**
     * (Re)starts the session.
     * @return bool TRUE if the session has been initialized, else FALSE.
     */
    public function startSession()
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
            if (!self::$instance->__isset("CREATED")) {
                self::$instance->__set("CREATED", time());
            }
        }

        return $this->sessionState;
    }

    /**
     *    Gets datas from the session.
     *    Example: echo $instance->foo;
     *
     * @param    string $name Name of the datas to get.
     * @return    mixed    Datas stored in session.
     **/

    public function __get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /**
     *    Stores datas in the session.
     *    Example: $instance->foo = 'bar';
     *
     * @param    string $name of the datas.
     * @param    string $value Your datas.
     * @return    void
     **/

    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }

    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     *    Destroys the current session.
     *
     * @return    bool    TRUE is session has been deleted, else FALSE.
     **/
    public function destroy()
    {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);

            return !$this->sessionState;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function verifySession()
    {

        if (self::$instance->__isset("CREATED")&& (time() - self::$instance->__get("CREATED") > self::LIMIT)) {
           return self::$instance->destroy();
        }

        return false;
    }

    /**
     * @return string
     */
    public function getDiff()
    {
        return time() - self::$instance->__get("CREATED"). " / ".self::LIMIT;
    }

    /**
     * @param $url
     * @param $time
     * @return string
     */
    public static function redirecting($url, $time = 1)
    {
        echo sprintf(
            '<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8" />
                        <meta http-equiv="refresh" content="%s;url=%s" />
                    </head>
                    <body>
                    </body>
                </html>',$time,
            htmlspecialchars($url, $time, 'UTF-8')
        );
    }

    /**
     * @param $type
     * @param $message
     */
    public function addFlashBag($type, $message)
    {
        $_SESSION['flash'][$type] = $message;
    }

    public function getFlashBag()
    {
        $flashs = self::FlashBagAction();

        foreach ($flashs as $key => $flash) {
            echo "<div class='alert alert-$key' role='alert'>$flash</div>";
        }
    }

    /**
     * @return array
     */
    private function FlashBagAction()
    {
        $flashs = [];
        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $key => $error) {
                $flashs[$key] = $error;
            }
            unset($_SESSION['flash']);
        }

        return $flashs;
    }


}
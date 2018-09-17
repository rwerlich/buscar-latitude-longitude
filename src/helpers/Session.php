<?php

namespace App\Helpers;

class Session
{
    public function __construct()
    {
    }

    /**
     * Start Session
     */
    public function start()
    {
        session_start();
    }

    /**
     * Close Session
     */
    public function close()
    {
        session_destroy();
    }

    /**
     * Set a value to a session
     *
     * @param string $key   key to save
     * @param string $value value to save
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * get value stored in session
     *
     * @param string $key key to get
     *
     * @return mix value
     */
    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * Unset some value in session
     *
     * @param string $key key to forgot
     */
    public function forgot($key)
    {
        unset($_SESSION[$key]);
    }
}

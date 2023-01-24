<?php
class Session
{

    public static function setMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public static function hasMessage()
    {
        if (!isset($_SESSION['message'])) {
            return false;
        }

        return !is_null($_SESSION['message']);
    }

    public static function flash()
    {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 13/08/2016
 * Time: 13:51
 */

/**
 * Class Router
 */
class Router
{
    /**
     * @param array $params
     * @param string|null $path
     * @return string
     */
    public static function generate(array $params, $path = null)
    {
        $url = explode("?", !empty($path) ? $path : $_SERVER['REQUEST_URI'])[0];
        foreach ($params as $key => $param) {
            $params[$key] = sprintf("%s=%s", $key, $param);
        }

        return !empty($params) ? sprintf("%s?%s", $url, implode("&", $params)) : $url;
    }

    /**
     * @param $page
     * @return string
     */
    public static function paginator($page)
    {
        $params = array_merge($_GET, ['page' =>$page]);

        return self::generate($params);
    }

}
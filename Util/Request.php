<?php
/**
 * 请求相关数据
 *
 * @author: xudianyang
 * @version: Request.php v-1.0.0, 2015-07-09 23:23 Created
 * @copyright Copyright (c) 2015 (http://www.yafrk.com)
 */
namespace Yafrk\Util;

final class Request
{
    static function remoteAddr($strict = false)
    {
        static $remote_addr = false;

        if ($remote_addr === false) {
            $keys = array(
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            );

            foreach ($keys as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (explode(',', $_SERVER[$key]) as $ip) {
                        $ip = trim($ip);
                        $flag = $strict ? FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE : null;
                        if ($ip && filter_var($ip, FILTER_VALIDATE_IP, $flag) !== false) {
                            return $remote_addr = $ip;
                        }
                    }
                }
            }
            $remote_addr = null;
        }

        return $remote_addr;
    }
}
<?php
/**
 * Yjgo_Function
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @subpackage Aomp_Function
 * @copyright
 * @link       $Url: $
 * @author     $Author: doomsday $
 * @version    $Id: Function.php 85 2017-01-16 10:36:57Z doomsday $
 */

class Aomp_Function
{
    /**
     * 是否邮件格式
     *
     * @param string $value
     * @return boolean
     */
    public static function isEmail($value)
    {
        if (!is_string($value)) {
            return false;
        }

        $matches = array();

        // Split email address up and disallow '..'
        if ((strpos($value, '..') !== false)
            || (!preg_match('/^([\w\-\.]+)@([^@]+)$/', $value, $matches))) {
                return false;
            }

            $localPart = $matches[1];
            $hostname  = $matches[2];

            if ((strlen($localPart) > 64) || (strlen($hostname) > 255)) {
                return false;
            }

            return true;
    }

    /**
     * 是否手机号码
     *
     * @param int $value
     * @return boolean
     */
    public static function isMobile($value)
    {
        if(!is_numeric($value) || $this->strLen($value) > 11){
            return false;
        }

        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $value) ? true : false;
    }

    /**
     * 获取字符串长度，一个中文算一个字符
     *
     * @param string $string  字符串
     * @param string $charset 字符编码
     * @return int
     */
    public static function strLen($string, $charset = 'utf-8')
    {
        return mb_strlen($string, $charset);
    }

    /**
     * 获取字符串长度，一个中文算两个字符
     *
     * @param string $string
     * @return int
     */
    public static function strLenWord($string)
    {
        $i = 0;
        $count = 0;
        $len = strlen($string);
        while ($i < $len) {
            $chr = ord($string[$i]);
            $count ++;
            $i ++;
            if ($i >= $len)
                break;

            if ($chr & 0x80) {
                $chr <<= 1;
                while ($chr & 0x80) {
                    $i ++;
                    $chr <<= 1;
                }
                $count ++;
            }
        }
        return $count;
    }

    /**
     * MD5加密
     * @param string $string  字符串
     * @return string
     */
    public static function md5($string, $key = 'auto.com')
    {
        $string = $string + $key;
        return md5($string);
    }

    /**
     * Trim string
     *
     * @param mixed $str Supported array
     * @return mixed
     */
    public static function trim($str)
    {
        if (is_string($str)) {
            return trim($str);
        }
        if (is_array($str)) {
            foreach ($str as $key => $v) {
                $str[$key] = self::trim($v);
            }
            return $str;
        }
        return $str;
    }

    /**
     * 安全过滤
     * @param string $str
     * @return NULL|string
     */
    public static function replace($str)
    {
        if(empty($str)) return null;

        $str = preg_replace( "@<script(.*?)</script>@is", "", $str);
        $str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str);
        $str = preg_replace( "@<style(.*?)</style>@is", "", $str);
        $str = htmlspecialchars(preg_replace( "@<(.*?)>@is", "", $str));

        return $str;
    }


    /**
     * 获取访问者真实IP
     *
     * @return string
     */
    public static function getTrueIp()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        } else {
            $onlineip = 'unknown';
        }

        preg_match('/[\d\.]{7,15}/', $onlineip, $matches);
        $onlineip = isset($matches[0]) ? $matches[0] : 'unknown';

        return $onlineip;
    }
}
<?php
/**
 * Aomp Framework
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @package    Aomp_Application_Resource_Memcache
 * @copyright  $Copyright: $
 * @author     $Author: $
 * @version    $Id: $
 */

class Aomp_Application_Resource_Memcache
{
    /**
     * Default Values
     */
    const DEFAULT_HOST = '127.0.0.1';
    const DEFAULT_PORT =  11211;
    const DEFAULT_PERSISTENT = true;
    const DEFAULT_WEIGHT  = 1;
    const DEFAULT_TIMEOUT = 1;
    const DEFAULT_RETRY_INTERVAL = 15;
    const DEFAULT_STATUS = true;
    const DEFAULT_FAILURE_CALLBACK = null;


    private $memcache;

    public function init($options = null)
    {
        if( empty($options['host']) ) $options['host'] = self::DEFAULT_HOST;
        if( empty($options['port']) ) $options['port'] = self::DEFAULT_PORT;
        if( empty($options['persistent']) ) $options['persistent'] = self::DEFAULT_PERSISTENT;
        if( empty($options['weight']) ) $options['weight'] = self::DEFAULT_WEIGHT;
        if( empty($options['timeout']) ) $options['timeout'] = self::DEFAULT_TIMEOUT;
        if( empty($options['retry_interval']) ) $options['retry_interval'] = self::DEFAULT_RETRY_INTERVAL;
        if( empty($options['status']) ) $options['status'] = self::DEFAULT_STATUS;
        if( empty($options['failure_callback']) ) $options['failure_callback'] = self::DEFAULT_FAILURE_CALLBACK;

        $this->addServer($options);
    }

    /**
     * 设置缓存
     * @param string $key
     * @param string $value
     * @param int $time
     */
    public function add($key, $value, $flag = null, $time = 0)
    {
        return $this->memcache->add($key, $value, $flag, $time);
    }

    /**
     * 设置缓存
     * @param string $key
     * @param string $value
     * @param int $time
     */
    public function set($key, $value, $time = 604800, $flag = null)
    {
        return $this->memcache->set($key, $value, $flag, $time);
    }

    /**
     * 获取缓存
     * @param  string $key
     */
    public function get($key)
    {
        return $this->memcache->get($key);
    }

    /**
     * 清除一个缓存
     * @param  string $key
     */
    public function delete($key)
    {
        return $this->memcache->delete($key);
    }

    /**
     * 链接memcache服务器
     *
     */
    public function addServer(array $options = array())
    {
        $this->memcache = new Memcache();

        $this->memcache->addserver(
            $options['host'],
            $options['port'],
            $options['persistent'],
            $options['weight'],
            $options['timeout'],
            $options['retry_interval'],
            $options['status'],
            $options['failure_callback']
        );
    }

    /**
     * 关闭Memcache链接
     */
    public function close()
    {
        return $this->memcache->close();
    }

    /**
     * 获取Memcache的状态数据
     */
    public function getStats() {
        return $this->memcache->getStats();
    }
}
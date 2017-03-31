<?php
/**
 * Aomp
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @package    Aomp_Dao
 * @copyright  $Copyright: $
 * @link
 * @author     $Author: doomsday $
 * @version    $Id: Record.php 61 2016-11-21 17:15:27Z doomsday $
 */

class Aomp_Dao_Record
{
    const TYPE_STRING = 0;
    const TYPE_INT    = 1;
    const TYPE_FLOAT  = 2;
    const TYPE_TIME   = 3;
    const TYPE_BOOL   = 4;
    const TYPE_IP     = 5;

    /**
     * 保存字段数据
     *
     * @var array
     */
    protected $_fields = array();

    /**
     * 是否允许修改数据
     *
     * @var boolean
    */
    protected $_allowModifications;

    /**
     *
     * @param array $fields
     * @param string $allowModifications
     */
    public function __construct(array $fields = null, $allowModifications = true)
    {
        $this->_allowModifications = (boolean) $allowModifications;
        if (null == $fields) {
            $fields = get_object_vars($this);
        }
        foreach ($fields as $key => $value) {
            if ('_' != substr($key, 0, 1)) {
                $this->_fields[$key] = $value;
                unset($this->$key);
            }
        }
    }

    /**
     * Prevent any more modifications being made to this instance.
     *
     */
    public function setReadOnly()
    {
        $this->_allowModifications = false;
    }

    /**
     * 格式化字段值输出
     *
     * @param string $value
     * @param int    $type
     * @return mixed
     */
    protected function _formatField($value, $type)
    {
        if (null === $value) {
            return null;
        }

        switch ($type) {
            case self::TYPE_STRING:
                $value = (string) $value;
                break;
            case self::TYPE_INT:
                $value = (int) $value;
                break;
            case self::TYPE_FLOAT:
                $value = (float) $value;
                break;
            case self::TYPE_BOOL:
                $value = (boolean) $value;
                break;
            case self::TYPE_TIME:
                // windows下需要转换格式
                if (is_numeric($value)) {
                    $value = (int) $value;
                } elseif (is_string($value)) {
                    $value = str_replace('/', '-', $value);
                    $value = strtotime($value);
                }
                break;
            case self::TYPE_IP:
                $value = long2ip($value);
            default:
                break;
        }

        return $value;
    }

    /**
     * To integer
     *
     * @param string $value
     * @return int
     */
    protected function _toInt($value)
    {
        return $this->_formatField($value, self::TYPE_INT);
    }

    /**
     * To float
     *
     * @param string $value
     * @return float
     */
    protected function _toFloat($value)
    {
        return $this->_formatField($value, self::TYPE_FLOAT);
    }

    /**
     * To string
     *
     * @param string $value
     * @return string
     */
    protected function _toString($value)
    {
        return $this->_formatField($value, self::TYPE_STRING);
    }

    /**
     * To timestamp
     *
     * @param string $value
     * @return int
     */
    protected function _toTimestamp($value)
    {
        return $this->_formatField($value, self::TYPE_TIME);
    }

    /**
     * To boolean
     *
     * @param string $value
     * @return boolean
     */
    protected function _toBoolean($value)
    {
        return $this->_formatField($value, self::TYPE_BOOL);
    }

    /**
     * To ip
     *
     * @param int $value
     * @return string
     */
    protected function _toIp($value)
    {
        return $this->_formatField($value, self::TYPE_IP);
    }

    /**
     * To Array
     *
     * @param string $value
     * @return array
     */
    protected function _toArray($value, $delimiter = ',')
    {
        if (is_string($value) && $value !== '') {
            $value = explode($delimiter, $value);
        } elseif (!is_array($value)) {
            $value = array();
        }
        return $value;
    }

    /**
     * 设置值，内部调用，跳过$_allowModifications参数判断
     *
     * @param  string $name
     * @param  mixed  $value
     * @return Oray_Dao_Record
     */
    protected function _set($name, $value)
    {
        $this->_fields[$name] = $value;
        return $this;
    }

    /**
     * 转成数组输出，所有的字段转为小写格式
     *
     * @return array
     */
    public function toArray()
    {
        $fields = array_change_key_case($this->_fields, CASE_LOWER);
        return $fields;
    }

    /**
     * Magic function so that $obj->value will work.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_fields)) {
            return $this->_fields[$name];
        }
        return null;
    }

    /**
     * Only allow setting of a property if $allowModifications
     * was set to true on construction. Otherwise, throw an exception.
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws Oray_Dao_Exception
     * @return void
     */
    public function __set($name, $value)
    {
        if ($this->_allowModifications) {
            $this->_fields[$name] = $value;
        } else {

            /** @see Oray_Dao_Exception */
            require_once 'Aomp/Dao/Exception.php';
            throw new Aomp_Dao_Exception('Aomp_Dao_Record is read only');
        }
    }

    /**
     * __isset() - determine if a variable in this object's fields is set
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_fields[$name]);
    }
}
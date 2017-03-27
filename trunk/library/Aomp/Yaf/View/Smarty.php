<?php
/**
 * Tlfun_Framework_View_Smarty in Yaf
 * @author $Author: $
 * @version $Id: $
 */

/**
 * 自定义视图类接口,用来封装smarty共yaf全局使用
 * 必须实现接口定义的5个函数
 */
class Aomp_Yaf_View_Smarty implements Yaf_View_Interface
{
    protected $_smarty;


    protected $_options = array(
        'template_dir' => '',
        'complie_dir'  => '',
        'left_delimiter'  => '{{',
        'right_delimiter' => '}}'
    );

    public function __construct($options = array())
    {
        Yaf_Loader::import('Smarty/Smarty.class.php');

        $this->_smarty = new Smarty;

        $this->setOptions($options);
    }

    /**
     *
     * 配置项目
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        foreach ($this->_options as $k => $v) {
            if (isset($options[$k])) {
                $this->_options[$k] = $options[$k];
            }

            switch ($k) {
                case 'template_dir':
                    $this->_smarty->setTemplateDir($this->_options[$k]);
                    break;
                case 'complie_dir':
                    $this->_smarty->setCompileDir($this->_options[$k]);
                    break;
                case 'left_delimiter':
                case 'right_delimiter':
                    $this->_smarty->{$k} = $this->_options[$k];
                    break;
            }
        }



        return $this;
    }

    /**
     *
     * 渲染视图
     * @param string $template
     * @param array  $vars
     */
    public function render($template, $vars = null)
    {
        if (!empty($vars)) {
            $this->_smarty->assign($vars);
        }

        $cacheId   = isset($vars['__cacheid']) ? $vars['__cacheid'] : null;
        $complieId = isset($vars['__complieid']) ? $vars['__complieid'] : null;
        $parent    = isset($vars['__parent']) ? $vars['__parent'] : null;

        return $this->_smarty->fetch($template, $cacheId, $complieId, $parent);
    }

    /**
     *
     * 输出视图
     * @param string $template
     * @param array  $vars
     */
    public function display($template, $vars = null)
    {
        if (!empty($vars)) {
            $this->_smarty->assign($vars);
        }

        $cacheId   = isset($vars['__cacheid']) ? $vars['__cacheid'] : null;
        $complieId = isset($vars['__complieid']) ? $vars['__complieid'] : null;
        $parent    = isset($vars['__parent']) ? $vars['__parent'] : null;

        return $this->_smarty->display($template, $cacheId, $complieId, $parent);
    }

    //模版赋值
    public function assign( $name, $value = NULL )//boolean
    {
        return $this->_smarty->assign($name, $value);
    }

    /**
     *
     * 设置模板脚本目录
     *
     * @param string $directory
     */
    public function setScriptPath ($directory)
    {
        $this->_options['template_dir'] = $directory;
        $this->_smarty->setTemplateDir($directory);

        return $this;
    }

    public function getScriptPath ()
    {
        return $this->_smarty->getTemplateDir();
    }

    /**
     *
     * 获取smarty对象
     *
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->_smarty;
    }

    /**
     *
     * 通过成员访问方式注册模板变量
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->_smarty->assign($name, $value);
    }

    /**
     *
     * 通过成员访问方式获取模板变量
     *
     * @param string $name
     */
    public function __get($name)
    {
        return $this->_smarty->get_template_vars($name);
    }


}
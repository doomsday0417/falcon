<?php
/**
 * Auto_Yaf_Controller_Auto in Yaf
 * @author $Author:  $
 * @version $Id: $
 */
class Aomp_Yaf_Controller_Abstract extends Yaf_Controller_Abstract
{
    protected $session;

    protected $view;

    /**
     *
     * @var array
     */
    protected $power = array(
        'read' => 4,
        'write' => 2,
        'delete' => 1
    );

    /**
     *
     * @var int
     */
    protected $_userPower;

    /**
     *
     * @var int
     */
    protected $_userId;

    /**
     *
     * @var Aomp_User
     */
    protected $user;

    public function init()
    {
        $this->session = Yaf_Session::getInstance();

        $this->view = $this->getView();

        if(strtolower($this->_request->getControllerName()) != 'passport'){

            if(!$this->isLogin()){

                $url = urlencode('http://' . $this->_request->getServer('HTTP_HOST') . $this->_request->getServer('REQUEST_URI'));

                $this->jump('/passport/login.html?url=' . $url);
            }

            $this->user = Aomp_User::getInstance();

            if(empty($this->user->power)){
                echo '该账号没有任何操作权限，请联系管理员！';
                exit;
            }

            if(empty($this->user->power[$this->_Class])){
                foreach ($this->user->power as $v){
                    $this->jump('/' . $v['powerclass'] . '.html', '没有这个权限');
                    break;
                }
                exit;
            }

            $this->_userId = $this->user->userId;

            $this->_userPower = $this->user->power[$this->_Class];

            $this->view->assign('user', $this->user->getAttributes())
                       ->assign('classname', $this->_ClassName);
        }
    }

    /**
     *
     * @param string $name
     * @param string $default
     * @return string|Ambigous <string, unknown>
     */
    public function getParam($name, $default = null)
    {
        if(empty($name)) return $default;

        $name = $this->_request->get($name);

        $name = Aomp_Function::trim($name);

        if(empty($name) || is_array($name)) return $default;

        $name = Aomp_Function::replace($name);

        return empty($name) ? $default : $name;
    }

    /**
     *
     * @param string $url
     * @param string $msg
     */
    public function jump($url, $msg = '')
    {
        if(!empty($msg)){
            echo '<script>alert("' . $msg . '")</script>';
        }

        $url = empty($url) ? $this->_request->getServer('HTTP_REFERER') : $url;

        echo '<script>location.href="' . $url . '";</script>';
        exit;
    }

    /**
     *
     * @return boolean
     */
    public function isLogin()
    {
        return $this->session->userid > 0;
    }

    /**
     * 处理Json输出
     *
     * @param boolean $success    操作是否成功
     * @param mixed   $params     附加参数
     * @param mixed   $data       返回数据
     * @param boolean $sendHeader 是否发送json文件头
     */
    public function json($success = false, $params = null, $data = false, $sendHeader = null)
    {
        if (is_scalar($params)) {
            $params = array('message' => $params);
        }

        $json = array('success' => (boolean) $success);

        if (is_array($params)) {

            // 加上最后的参数是为了防止success被重置
            $json = array_merge($json, $params, $json);
        }

        if (false !== $data) {
            $json['data'] = $data;
        }

        $content = json_encode($json);
        if (null === $sendHeader) {
            $sendHeader = strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
        }
        if ($sendHeader) {
            header('Content-Type:application/json');
        }
        echo $content;
        exit;
    }

    /**
     * 验证用户权限
     *
     * @param string $type
     * @param string $power
     * @param string $header
     */
    protected function powerAuth($type, $header = 'get')
    {
        if( empty($this->power[$type] & $this->_userPower['power']) ){
            switch ($header) {
                case 'json':
                    $this->json(false, '没有操作权限');
                    break;
                default:
                    $this->jump('', '没有操作权限');
            }
        }
    }
}
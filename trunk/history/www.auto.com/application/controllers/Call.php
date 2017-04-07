<?php
/**
 *
 * Db in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class CallController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'call';

    public $_ClassName = '数据库';

    public function indexAction()
    {
        $this->powerAuth('read');
        echo 123;die;
    }
}
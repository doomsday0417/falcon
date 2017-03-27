<?php
/**
 * Aomp_Yaf_Plugin_System
 * @author $Author:  $
 * @version $Id: $
 */
class Aomp_Yaf_Plugin_System extends Yaf_Plugin_Abstract
{
    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $config = Yaf_Application::app()->getConfig();

        $fix = '.' .$config->application->url_suffix;

        $url = $request->getServer('REQUEST_URI');

        $url = explode('?', $url);

        $url = substr($url[0], 0, - strlen($fix));

        $uri = $url;

        $request->setRequestUri($uri);
    }
}
<?php
/**
 * Aomp_BaiduGaojing
 * @author $Author: doomsday $
 * @version $Id: Db.php 57 2016-11-20 18:00:35Z doomsday $
 */
class Aomp_BaiduGaojing
{
    private $_config = array(
        'service_id' => 8976,
        'service_key' => 'f61dc488705d8a31db5550dc77213483'
    );

    private $_url = 'http://gaojing.baidu.com';


    /**
     *
     * @param string $message
     * @param string $event
     * @param array $config
     */
    public function __construct($message, $event, $config)
    {
        $headers[] = 'servicekey:' . $this->_config['service_key'];

        $this->_config['service_id'] = $config['service_id'];
        $this->_config['service_key'] = $config['service_key'];
        $this->event($message, $headers);


    }

    private function event($message, $headers)
    {
        $url = $this->_url . '/event/create';

        $data = array(
            'service_id' => $this->_config['service_id'],
            'description' => $message,
            'event_type' => 'trigger',
        );

        return $this->curl($url, $data, $headers);


    }

    private function curl($url, $data, $headers)
    {
        $data = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }
}
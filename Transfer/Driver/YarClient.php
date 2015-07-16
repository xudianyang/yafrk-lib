<?php
/**
 *
 * @author
 * @copyright Copyright (c) Beijing Jinritemai Technology Co.,Ltd.
 */

namespace Yafrk\Transfer\Driver;

use Yar_Client;
use Yafrk\Transfer\Exception;


class YarClient extends AbstractDriver
{
    /**
     * Yar_Client实例
     *
     * @var \Yar_Client
     */
    protected $_client;

    /**
     * 打包协议
     *
     * @var string
     */
    protected $_package = 'json';

    /**
     * 接口地址
     *
     * @var string
     */
    protected $_entry;

    /**
     * 允许请求的接口列表
     *
     * @var array
     */
    protected $_allows;

    public function __construct($url, $options = null)
    {
        $this->_entry = $url;
        parent::__construct($options);
    }

    /**
     * 初始化，参数检查，URL绑定
     *
     * @throws Exception\RuntimeException
     */
    protected function init()
    {
        $this->_client = new Yar_Client($this->_entry);
        $this->_client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 2000);
        $this->_client->SetOpt(YAR_OPT_TIMEOUT, 20000);
        $this->_client->SetOpt(YAR_OPT_PACKAGER, $this->_package);
    }

    /**
     *
     *
     * @param $method
     * @param array $params
     * @return mixed|null
     * @throws Exception\RuntimeException
     */
    public function __call($method, $params = array())
    {
        $this->init();

        if (!empty($params) && count($params) > 1) {
            throw new Exception\RuntimeException("Yar Client Params Error ");
        } elseif (!empty($params)) {
            $params = array_merge((array)$this->_params, $params[0]);
        } else {
            $params = $this->_params;
        }

        $result  = call_user_func(array($this->_client, $method), $this->_module, $this->_controller, $this->_action, $params);

        if (!$result) {
            return null;
        }

        $this->_app = null;
        $result = json_decode($result, true);

        if ($result['errno']) {
            $result['errno'] = hexdec($result['errno']);
            throw new Exception\RuntimeException($result['message'], $result['errno']);
        } else {
            return $result['data'];
        }
    }
}

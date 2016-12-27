<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 27.10.16
 * Time: 11:20
 */

namespace yii2chat;

/**
 * Class Server
 *
 * @package common\components\chat
 */
class Server extends \chat\Server
{
    /**
     * @var string
     */
    private static $chatCfg = '';

    /** @inheritdoc */
    public static function getConfigClass()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['configClass']) && self::$chatCfg['configClass']) {
            return self::$chatCfg['configClass'];
        }

        return parent::getConfigClass();
    }

    public static function initChatConfig()
    {
        self::$chatCfg = \Yii::$app->getComponents()['chat'] ?? '';
    }

    /**
     * @return string
     */
    public static function getListenHost()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['listen_host']) && self::$chatCfg['listen_host']) {
            return self::$chatCfg['listen_host'];
        }

        return self::$listen_host;
    }

    /**
     * @return int
     */
    public static function getPort()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['port']) && self::$chatCfg['port']) {
            return self::$chatCfg['port'];
        }

        return self::$port;
    }

    /**
     * @return int
     */
    public static function getProxyPorty()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['proxy_port']) && self::$chatCfg['proxy_port']) {
            return self::$chatCfg['proxy_port'];
        }

        return self::$proxy_port;
    }

    /**
     * @return string
     */
    public static function getConnectionType()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['connection_type']) && self::$chatCfg['connection_type']) {
            return self::$chatCfg['connection_type'];
        }

        return self::$connection_type;
    }

    /**
     * @return string
     */
    public static function getServerHost()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['server_host']) && self::$chatCfg['server_host']) {
            return self::$chatCfg['server_host'];
        }

        return self::$listen_host;
    }

    /**
     * @return string
     */
    public static function getWssLocalCert()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['wss'], self::$chatCfg['wss']['local_cert'])
            && self::$chatCfg['wss']['local_cert']
        ) {
            return self::$chatCfg['wss']['local_cert'];
        }

        return self::$wss_local_cert;
    }

    /**
     * @return string
     */
    public static function getWssLocalPk()
    {
        self::initChatConfig();
        if (isset(self::$chatCfg['wss'], self::$chatCfg['wss']['local_pk'])
            && self::$chatCfg['wss']['local_pk']
        ) {
            return self::$chatCfg['wss']['local_pk'];
        }

        return self::$wss_local_pk;
    }

    /**
     * Server constructor.
     */
    public function __construct()
    {
        self::initChatConfig();

        self::$listen_host     = self::getListenHost();
        self::$server_host     = self::getServerHost();
        self::$port            = self::getPort();
        self::$proxy_port      = self::getProxyPorty();
        self::$connection_type = self::getConnectionType();
        self::$wss_local_cert  = self::getWssLocalCert();
        self::$wss_local_pk    = self::getWssLocalPk();

        return parent::__construct();
    }
}

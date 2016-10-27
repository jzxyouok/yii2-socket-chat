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
     * Server constructor.
     */
    public function __construct()
    {
        self::initChatConfig();

        self::$listen_host = self::getListenHost();
        self::$server_host = self::getServerHost();
        self::$port = self::getPort();

        return parent::__construct();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 27.10.16
 * Time: 13:25
 */

namespace yii2chat;

use yii\bootstrap\Widget;

/**
 * Class SocketChatWidget
 *
 * @package common\components\chat
 */
class SocketChatWidget extends Widget
{
    public $room = '';
    public $hash = '';
    public $message_area_id = '';
    public $send_on_enter = false;
    public $current_user_id = 0;
    public $recipient_id = 0;

    /**
     * @param array $options
     *
     * @return string
     */
    public static function prepareJs($options)
    {
        $js   = Server::fillJavaConstants();
        $port = Server::getProxyPort() ? Server::getProxyPort() : Server::getPort();

        $socket_url      = Server::getServerHost() . ':' . $port;
        $current_user_id = $options['current_user_id'] ?? 0;
        $room            = $options['room'] ?? '';
        $hash            = $options['hash'] ?? '';
        $send_on_enter   = $options['send_on_enter'] ?? false;
        $message_area_id = $options['message_area_id'] ?? '';
        $recipient_id    = $options['recipient_id'] ?? 0;
        $connection_type = Server::getProxyConnectionType() ?
            Server::getProxyConnectionType() : Server::getConnectionType();
        $js .= <<<JS
            socketChat.socket_url = "$socket_url";
            socketChat.current_user_id = "$current_user_id";
            socketChat.room = "$room";
            socketChat.hash = "$hash";
            socketChat.send_on_enter = $send_on_enter;
            socketChat.setMessageAreaId("$message_area_id");
            socketChat.recipient_id = $recipient_id;
            socketChat.connection_type = "$connection_type";
JS;

        return $js;
    }

    /** @inheritdoc */
    public function run()
    {
        parent::run();

        SocketChatAsset::register($this->view);

        $js = self::prepareJs([
            'room'            => $this->room,
            'hash'            => $this->hash,
            'message_area_id' => $this->message_area_id,
            'send_on_enter'   => $this->send_on_enter,
            'current_user_id' => $this->current_user_id,
            'recipient_id'    => $this->recipient_id
        ]);

        $this->view->registerJs($js);
    }
}

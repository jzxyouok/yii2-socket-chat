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
 * @package common\components\chat
 */
class SocketChatWidget extends Widget
{
    public $room = '';
    public $hash = '';
    public $message_area_id = '';

    public static function prepareJs($options)
    {
        $js = Server::fillJavaConstants();

        $room = $options['room'] ?? '';
        if ($room) {
            $js .= <<<JS
                socketChat.room = "$room";
JS;
        }

        $hash = $options['hash'] ?? '';
        if ($hash) {
            $js .= <<<JS
                socketChat.hash = "$hash";
JS;
        }

        $message_area_id = $options['message_area_id'] ?? '';
        if ($message_area_id) {
            $js .= <<<JS
                socketChat.setMessageAreaId("$message_area_id");
JS;
        }

        $send_on_enter = $options['send_on_enter'] ?? false;
        if ($send_on_enter) {
            $js .= <<<JS
                socketChat.send_on_enter = $send_on_enter;
JS;
        }

        $socket_url = Server::getServerHost() . ':' . Server::getPort();
        $js .= <<<JS
            socketChat.socket_url = "$socket_url";
JS;

        return $js;
    }

    /** @inheritdoc */
    public function run()
    {
        parent::run();

        SocketChatAsset::register($this->view);

        $js = self::prepareJs([
            'room' => $this->room,
            'hash' => $this->hash,
            'message_area_id' => $this->message_area_id
        ]);

        $this->view->registerJs($js);
    }
}

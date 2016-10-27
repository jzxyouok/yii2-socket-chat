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

    /** @inheritdoc */
    public function run()
    {
        parent::run();
        SocketChatAsset::register($this->view);

        $this->view->registerJs(
            Server::fillJavaConstants()
        );

        $js = '';
        if ($this->room) {
            $js .= <<<JS
                socketChat.room = "$this->room";
JS;
        }

        if ($this->hash) {
            $js .= <<<JS
                socketChat.hash = "$this->hash";
JS;
        }

        if ($this->message_area_id) {
            $js .= <<<JS
                socketChat.setMessageAreaId("$this->message_area_id");
JS;
        }

        $socket_url = Server::getServerHost() . ':' . Server::getPort();
        $js .= <<<JS
            socketChat.socket_url = "$socket_url";
JS;

        $this->view->registerJs($js);
    }
}

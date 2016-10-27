<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 27.10.16
 * Time: 15:08
 */

namespace yii2chat;


use yii\web\AssetBundle;

/**
 * Class SocketChatAsset
 * @package common\components\chat
 */
class SocketChatAsset extends AssetBundle
{
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );

    public $sourcePath = '@vendor/programmis/socket-chat/web/';

    public $js = [
        'js/socketChat.js'
    ];

    public $publishOptions = [
        'forceCopy' => true
    ];
}

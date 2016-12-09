**Installing**

_1) Download composer:_

<pre>
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
</pre>

_2) Install:_

<pre>
php composer.phar require programmis/yii2-socket-chat
</pre>

**In config/main.php**

```php
'components' => [
    'chat'        => [
        'class'           => '\path\to\Server',
        'configClass'     => '\path\to\Config',
        'listen_host'     => '0.0.0.0',
        'server_host'     => '127.0.0.1',
        'port'            => 1337,
        'connection_type' => 'wss',
        'wss' => [
            'local_cert' => '/path/to/cert',    //cert.pem
            'local_pk'   => '/path/to/cert.pk'  //primary key
        ]
    ],
]
```

**In php code**

```php
SocketChatWidget::widget([
    'room'              => 'my_room',
    'hash'              => 'you_hash, /* in UserProcessor->createUser */
    'message_area_id'   => 'chat_text_area',
    'send_on_enter'     => true,
    'current_user_id'   => $user->id,
    /* 'recipient_id' => $recipient_id */
]);
```

How it work see https://github.com/programmis/socket_chat

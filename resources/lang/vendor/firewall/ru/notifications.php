<?php

return [

    'mail' => [

        'subject' => '🔥 Возможная атака на :domain',
        'message' => 'Обнаружена возможная атака :middleware на :domain с :ip-адреса. Был затронут следующий URL-адрес: :url',

    ],

    'slack' => [

        'message' => 'Обнаружена возможная атака на :domain.',

    ],

];

<?php

return [
    'event_type' => [
        'channel' => [
            'subscription' => [
                'end' => '<span class="text-flamingo-500">:user_name</span> subscription ended (tier :tier)',
                'gift' => '<span class="text-flamingo-500">:user_name</span> gifted :total subscription (:cumulative_total total)',
                'message' => '<span class="text-flamingo-500">:user_name</span> subscribed with message <span class="text-sm text-gray-500 block">:message.text</span>',
            ],
            'subscribe' => '<span class="text-flamingo-500">:user_name</span> subscribed',
            'follow' => '<span class="text-flamingo-500">:user_name</span> followed',
            'raid' => '<span class="text-flamingo-500">:from_broadcaster_user_name</span> raided with :viewers viewers',
            'cheer' => '<span class="text-flamingo-500">:user_name</span> cheered :bits bits',
            'update' => 'Stream information updated',
        ],
        'stream' => [
            'offline' => 'Stream offline',
            'online' => 'Stream online',
        ],
    ]
];

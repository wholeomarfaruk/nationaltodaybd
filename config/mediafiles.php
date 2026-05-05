<?php

use App\Enums\ModelType;
use App\Models\Post;
use App\Models\User;

return [
    'sizes'=>[
    User::class=>[
        'profile'=> ['100x100','200x200']
    ],
    Post::class=>[
        'thumbnail'=>['280x400']
    ]
    ],
];

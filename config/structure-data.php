<?php

return [
    'title' => 'Post Information',
    'icon' => 'Profile',
    'actionButton' => [
        'label' => 'Edit',
        'icon' => 'EditOutline',
        'targetComponent' => 'Form',
        'placement' => 'top',
    ],
    'columns' =>  [
        [
            'label' => 'Tags',
            'type' => 'text',
            'name' => 'tag',
            'shorter' => true,
            'optionsData' => null,
            'isMultiSelect' => true,
        ],
        [
            'label' => 'Assigned To',
            'type' => 'select',
            'name' => 'assigned_to',
            'shorter' => true,
            'optionsData' => 'http://192.168.1.181:9000/module/people/post/relation/category/list',
            'isMultiSelect' => true,
        ],
        [
            'label' => 'Comments',
            'type' => 'text',
            'name' => 'comment',
        ]
    ]
];

<?php

return [

    'custom_field_data.tag' => [
        'label' => 'Tags',
        'type' => 'text',
        'sorter' => true,
        'optionsData' => null,
        'isMultiSelect' => true,
        'validation' => [
            'default' => 'required|min:12',
            'update' => ''
        ]
    ],
    'custom_field_data.assigned_to' => [
        'label' => 'Assigned To',
        'type' => 'select',
        'sorter' => true,
        'optionsData' => '',
        'isMultiSelect' => true,
        'validation' => [
            'default' => '',
            'update' => ''
        ]
    ],
    'custom_field_data.comment' => [
        'label' => 'Comments',
        'type' => 'text',
        'sorter' => true,
        'optionsData' => '',
        'isMultiSelect' => true,
        'validation' => [
            'default' => '',
            'update' => ''
        ]
    ]
];

<?php

namespace SyntheticCustomFields\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;
use SyntheticCustomFields\Trait\CustomFieldTrait;
use SyntheticCustomFields\Models\CustomField;


class Task extends Model
{
    use HasFactory, Filterable, CustomFieldTrait;
    protected   $filterFields = [];
    public function __construct()
    {
        $this->generateModelAttributes();
    }
    public  $fillable_attribute = [
        'title' => [
            'type' => self::TEXT,
            'label' => 'Title',
            'validation' => [
                "default" => "required|min:12",
                "update" => ""
            ]
        ],
        'description' => [
            'type' => self::TEXT,
            'label' => 'Title',
            'validation' => [
                "default" => "text"
            ]
        ],
        'status' => [
            'type' => self::SELECT,
            'label' => 'Status',
            'isMultiSelect' => TRUE
        ]

    ];

    public  function generateModelAttributes()
    {
        $data = CustomField::where('model', 'SyntheticCustomFields\Models\Task')->project(['customfield_structure.columns' => 1])->get();
        $transformedData = $data->flatMap(function ($item) {
            return collect($item->customfield_structure['columns'])
                ->mapWithKeys(function ($column) {
                    return [
                        'customfield_data.' . $column['name'] => [
                            'type' => $column['type'],
                            'label' => $column['label'],
                            'optionsData' => $column['optionsData'] ?? '',
                            'isMultiSelect' => $column['isMultiSelect'] ?? '',
                            // Include other attributes you need here
                        ]
                    ];
                });
        })->toArray() ?? [];
        $this->fillable_attribute = array_merge($this->fillable_attribute, $transformedData);
        $this->filterFields = array_keys($this->fillable_attribute);
    }
}

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

    public  $fillableAttributes = [
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
            'isMultiSelect' => TRUE,
            'validation' => [
                "default" => "text"
            ]
        ]

    ];
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getFilterFields()
    {
        $this->fillableAttribute = array_merge($this->fillableAttributes, $this->getCustomFields());
    }
    private function getCustomFields()
    {
        $customFieldStructure = CustomField::where('model', get_class($this))->first();
        return $customFieldStructure ? $customFieldStructure->toArray()['custom_field_structure'] ?? [] : [];
    }
}

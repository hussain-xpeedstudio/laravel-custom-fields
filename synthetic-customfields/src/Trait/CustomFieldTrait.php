<?php

namespace SyntheticCustomFields\Trait;

use  SyntheticCustomFields\Trait\AttributeType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use SyntheticCustomFields\Models\CustomField;

trait CustomFieldTrait
{
    use AttributeType;
    protected $tableName = '';
    protected $className = '';
    public function setupTable()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->id();
                $table->string('model');
                $table->string('entity');
                $table->string('entity_id');
                $table->string('field_structure');
                $table->timestamps();
            });
        }
    }

    public function storeStructure()
    {
        // $this->className=class_basename($data['resource'])!=''?class_basename($data['resource']):class_basename(get_class($this));
        $this->tableName = 'customfield_people';
        $this->setupTable();
        $data = new CustomField();
        $data->setTable($this->tableName);
        $data->model = 'App\Models\People';
        $data->entity = 'XpeedStudio';
        $data->entity_id = 'xp-001';
        $data->customfield_structure = Config('structure-data');
        $data->save();
        return $data;
    }
    public function getCustomFieldStructureData()
    {
        //dd($this);
        $data = CustomField::where('model', 'SyntheticCustomFields\Models\Task')->project(['customfield_structure.columns' => 1])->get();
        return $transformedData = $data->flatMap(function ($item) {
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
    }


    protected function getCommentTableName()
    {
        $prefix = Config::get('synthetic-comments.table_prefix', 'synthetic');
        $modelClassName = Str::snake(Str::plural($this->className));
        return $prefix . '_' . $modelClassName;
    }
    public function baseComment()
    {
        return $this->hasMany(Comment::class, 'resource_id', 'id')->from(config('synthetic-comments.table_prefix') . '_' . $this->table)->SetDatabase();
    }

    public function comments()
    {
        return $this->baseComment()->with('replies')->get();
    }
    public function scopeRepliesOf($query, $id)
    {
        return $query->where('parent_comment_id', $id)->get();
    }
}

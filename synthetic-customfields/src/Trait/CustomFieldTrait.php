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
                $table->string('custom_field_structure');
                $table->timestamps();
            });
        }
    }

    public function storeStructure()
    {
        // $this->className=class_basename($data['resource'])!=''?class_basename($data['resource']):class_basename(get_class($this));
        $this->tableName = 'custom_field_people';
        $this->setupTable();
        $data = new CustomField();
        $data->setTable($this->tableName);
        $data->model = 'App\Models\People';
        $data->entity = 'XpeedStudio';
        $data->entity_id = 'xp-001';
        $data->custom_field_structure = Config('structure-data');
        $data->save();
        return $data;
    }

}

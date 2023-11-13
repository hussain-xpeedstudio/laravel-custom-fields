<?php

namespace SyntheticCustomFields\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SyntheticCustomFields\Models\Task;
use SyntheticCustomFields\Models\CustomField;

class CustomFieldController extends Controller
{
    public function index()
    {

        return Config('synthetic-customfields.table_prefix');
    }
    public function feedData()
    {
        // $data = new CustomField();
        // $data->storeStructure();
        $data = new Task();
        $data->title = 'Laravel';
        $data->description = 'Laravel desc';
        $data->status = 'Reject';
        $data->customfield_data = Config('result');
        $data->save();
        return $data;
    }
    public function getTaskData()
    {
        return Task::filter()->get();
    }
    public function generateFilterFields()
    {
        // $data = new Task();
        // $data = new Task();
        //dd(Task::$filterFields);
        //return Task::filter()->get();
        // $filterFields = array_merge(empty($data->fillable_attribute) ? [] : array_keys($data->fillable_attribute), array_keys($data->getCustomFieldStructureData()) ?? []);
        // return Task::filterFields($filterFields)->get();
        $data = new Task();
        return $data->fillable_attribute;
    }
}

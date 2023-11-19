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
        $data = new CustomField();
        $data->storeStructure();
        $data = new Task();
        $data->title = 'Laravel';
        $data->description = 'Laravel desc';
        $data->status = 'Reject';
        $data->custom_field_data = Config('result');
        $data->save();
        return $data;
    }
    public function getTaskData()
    {
        return Task::filter()->get();
    }
    // public function generateFilterFields()
    // {
    //     return Task::filter()->get();
    // }
    public function dumpData()
    {
       // $task = new Task();
        // dd($task->getCustomFields());
        // return Task::filterFields($task->getFilterFields_WithCustomFields())->get();
        // return Task::filterFields(['title', 'description', 'status', 'custom_field_data.tag'])->filter()->get();
        
        return Task::filter()->get();
       // dd($task->getFilterFields());
    }
}

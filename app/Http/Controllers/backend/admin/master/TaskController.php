<?php

namespace App\Http\Controllers\backend\admin\master;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use App\Models\Task;
use App\Models\TaskCustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){
        $custom_field = CustomField::where('status',1)->get();
        return view('backend.admin.modules.master.task',compact('custom_field'));
    }
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'task_type' => 'required',
            'task_priority' => 'required',
            'task_details' => 'required',
            'task_label' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error_validation'=>$validator->errors()->all(),],422);
        }
        $task = new Task();
        $task->task_type = $request->task_type;
        $task->priority = $request->task_priority;
        $task->details = $request->task_details;
        $task->label = $request->task_label;
        if($task->save()){
            
        // Save custom fields
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $field_key => $value) {
                // Assuming you have a model TaskCustomField or similar
                $customField = new TaskCustomField();
                $customField->task_id = $task->id;
                $customField->field_key = $field_key;
                $customField->field_value = $value;
                $customField->save();

            }
        }
            return response()->json(['success'=>'Task submitted succesfully'],200);
        }else{
            return response()->json(['error_success'=>'Task not submitted']);

        }
    }
}

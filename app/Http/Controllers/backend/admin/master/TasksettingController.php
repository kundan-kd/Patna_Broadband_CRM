<?php

namespace App\Http\Controllers\backend\admin\master;

use App\Http\Controllers\Controller;
use App\Models\TaskLabel;
use App\Models\TaskPriority;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TasksettingController extends Controller
{
    public function taskSetting(){
        return view('backend.admin.modules.master.task-settings');
    }
    public function taskLabelView(Request $request){
        if($request->ajax()){
            $TaskLabel = TaskLabel::orderBy('position', 'asc')->get();
            return DataTables::of($TaskLabel)
            ->addIndexColumn()
            ->addColumn('name',function($row){
                return $row->name;
            })
            ->addColumn('color', function($row) {
                return '<span class="badge text-white" style="background:' . $row->color . ';">' . $row->color . '</span>';
            })
            ->addColumn('status',function($row){
                $checked = $row->status =='1' ? 'checked' : ''; // check if status is active then checked
                 return '<div class="flex-grow-1 icon-state switch-outline">
                      <label class="switch mb-0" onchange="taskSwitch('.$row->id.')">
                      <input type="checkbox" '.$checked.'><span class="switch-state bg-success"></span>
                      </label>
                    </div>';
            })
            ->addColumn('action',function($row){
                return '<ul class="action"> 
                        <li class="edit"> <a href="#"><i class="icon-pencil-alt" onclick="taskEdit('.$row->id.')"></i></a></li>
                        <li class="delete ms-1"><a href="#"><i class="icon-trash" onclick="taskDelete('.$row->id.')"></i></a></li>
                        </ul>';
            })
            ->rawColumns(['color','status','action'])
            ->make(true);
        }
    }
    public function taskLabelAdd(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'color' => 'nullable'
        ]);
        if($validator->fails()){
            return response()->json(['error_validation'=> $validator->errors()->all(),],422);
        }

        $TaskLabel = new TaskLabel();
        $TaskLabel->name = $request->name;
        $TaskLabel->color = $request->color;
        if($TaskLabel->save()){
            return response()->json(['success' => 'Task Label addedd successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task Label not added']);
        }
    }

    public function taskLabelPositionUpdate(Request $request){
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = TaskLabel::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }
        return $response;
    }

    public function switch(Request $request){
        $sstatus = TaskLabel::where('id',$request->id)->get(['status']);
        $status = $sstatus[0]->status;
        if($status == 1){
            $new_status = 0;
        }
        else{
            $new_status = 1;
        }
        TaskLabel::where('id',$request->id)->update([
            'status' => $new_status
        ]);
        return response()->json(['success' => 'Status Updated Successfully'],200);
    }

    public function getDetails(Request $request){
        $getData = TaskLabel::where('id',$request->id)->get(['id','name','color']);
        return response()->json(['success' => 'Data Fetched Successfully','getData'=>$getData],200);
    }

    public function update(Request $request){
        $update = TaskLabel::where('id',$request->id)->update([
            'name' => $request->name,
            'color' => $request->color
        ]);
        if($update){
            return response()->json(['success' => 'Task Label updated successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task Label not updated']);
        }
    }
    public function delete(Request $request){
        $delete = TaskLabel::where('id',$request->id)->delete();
        if($delete){
            return response()->json(['success' => 'Task Label deleted successfully'],200);
        }else{
             return response()->json(['error_success' => 'Task Label not deleted']);
        }
    }


    public function taskStatusView(Request $request){
        if($request->ajax()){
            $taskStatus = TaskStatus::orderBy('position', 'asc')->get();
            return DataTables::of($taskStatus)
            ->addIndexColumn()
            ->addColumn('name',function($row){
                return $row->name;
            })
            ->addColumn('color', function($row) {
                return '<span class="badge text-white" style="background:' . $row->color . ';">' . $row->color . '</span>';
            })
            ->addColumn('status',function($row){
                $checked = $row->status =='1' ? 'checked' : ''; // check if status is active then checked
                 return '<div class="flex-grow-1 icon-state switch-outline">
                      <label class="switch mb-0" onchange="taskStatusSwitch('.$row->id.')">
                      <input type="checkbox" '.$checked.'><span class="switch-state bg-success"></span>
                      </label>
                    </div>';
            })
            ->addColumn('action',function($row){
                return '<ul class="action"> 
                        <li class="edit"> <a href="#"><i class="icon-pencil-alt" onclick="taskStatusEdit('.$row->id.')"></i></a></li>
                        <li class="delete ms-1"><a href="#"><i class="icon-trash" onclick="deleteTaskStatus('.$row->id.')"></i></a></li>
                        </ul>';
            })
            ->rawColumns(['color','status','action'])
            ->make(true);
        }
    }


    public function taskStatusAdd(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'color' => 'nullable'
        ]);
        if($validator->fails()){
            return response()->json(['error_validation'=> $validator->errors()->all(),],422);
        }

        $TaskLabel = new TaskStatus();
        $TaskLabel->name = $request->name;
        $TaskLabel->color = $request->color;
        if($TaskLabel->save()){
            return response()->json(['success' => 'Task Status addedd successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task not added']);
        }
    }

    public function taskStatusPositionUpdate(Request $request){
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = TaskStatus::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }
        return $response;
    }

    public function taskStatusSwitch(Request $request){
        $sstatus = TaskStatus::where('id',$request->id)->get(['status']);
        $status = $sstatus[0]->status;
        if($status == 1){
            $new_status = 0;
        }
        else{
            $new_status = 1;
        }
        TaskStatus::where('id',$request->id)->update([
            'status' => $new_status
        ]);
        return response()->json(['success' => 'Status Updated Successfully'],200);
    }

    public function taskStatusGetDetails(Request $request){
        $getData = TaskStatus::where('id',$request->id)->get(['id','name','color']);
        return response()->json(['success' => 'Data Fetched Successfully','getData'=>$getData],200);
    }

    public function taskStatusUpdate(Request $request){
        $update = TaskStatus::where('id',$request->id)->update([
            'name' => $request->name,
            'color' => $request->color
        ]);
        if($update){
            return response()->json(['success' => 'Task Status updated successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task Status not updated']);
        }
    }
    public function taskStatusDelete(Request $request){
        $delete = TaskStatus::where('id',$request->id)->delete();
        if($delete){
            return response()->json(['success' => 'Task Status deleted successfully'],200);
        }else{
             return response()->json(['error_success' => 'Task Status not deleted']);
        }
    }





    public function taskPriorityView(Request $request){
        if($request->ajax()){
            $taskPriority = TaskPriority::orderBy('position', 'asc')->get();
            return DataTables::of($taskPriority)
            ->addIndexColumn()
            ->addColumn('name',function($row){
                return $row->name;
            })
            ->addColumn('color', function($row) {
                return '<span class="badge text-white" style="background:' . $row->color . ';">' . $row->color . '</span>';
            })
            ->addColumn('status',function($row){
                $checked = $row->status =='1' ? 'checked' : ''; // check if status is active then checked
                 return '<div class="flex-grow-1 icon-state switch-outline">
                      <label class="switch mb-0" onchange="taskPrioritySwitch('.$row->id.')">
                      <input type="checkbox" '.$checked.'><span class="switch-state bg-success"></span>
                      </label>
                    </div>';
            })
            ->addColumn('action',function($row){
                return '<ul class="action"> 
                        <li class="edit"> <a href="#"><i class="icon-pencil-alt" onclick="taskPriorityEdit('.$row->id.')"></i></a></li>
                        <li class="delete ms-1"><a href="#"><i class="icon-trash" onclick="deleteTaskPriority('.$row->id.')"></i></a></li>
                        </ul>';
            })
            ->rawColumns(['color','status','action'])
            ->make(true);
        }
    }


    public function taskPriorityAdd(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'color' => 'nullable'
        ]);
        if($validator->fails()){
            return response()->json(['error_validation'=> $validator->errors()->all(),],422);
        }

        $TaskLabel = new TaskPriority();
        $TaskLabel->name = $request->name;
        $TaskLabel->color = $request->color;
        if($TaskLabel->save()){
            return response()->json(['success' => 'Task Priority addedd successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task Priority not added']);
        }
    }

    public function taskPriorityPositionUpdate(Request $request){
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = TaskPriority::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }
        return $response;
    }

    public function taskPrioritySwitch(Request $request){
        $sstatus = TaskPriority::where('id',$request->id)->get(['status']);
        $status = $sstatus[0]->status;
        if($status == 1){
            $new_status = 0;
        }
        else{
            $new_status = 1;
        }
        TaskPriority::where('id',$request->id)->update([
            'status' => $new_status
        ]);
        return response()->json(['success' => 'Status Updated Successfully'],200);
    }

    public function taskPriorityGetDetails(Request $request){
        $getData = TaskPriority::where('id',$request->id)->get(['id','name','color']);
        return response()->json(['success' => 'Data Fetched Successfully','getData'=>$getData],200);
    }

    public function taskPriorityUpdate(Request $request){
        $update = TaskPriority::where('id',$request->id)->update([
            'name' => $request->name,
            'color' => $request->color
        ]);
        if($update){
            return response()->json(['success' => 'Task Priority updated successfully'],200);
        }else{
            return response()->json(['error_success' => 'Task Priority not updated']);
        }
    }
      public function taskPriorityDelete(Request $request){
        $delete = TaskPriority::where('id',$request->id)->delete();
        if($delete){
            return response()->json(['success' => 'Task Priority deleted successfully'],200);
        }else{
             return response()->json(['error_success' => 'Task Priority not deleted']);
        }
    }
}
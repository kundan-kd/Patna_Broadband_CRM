<?php

namespace App\Http\Controllers\backend\admin\master;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomfieldController extends Controller
{
    public function index(){
        $users = User::where('status',1)->get();
        return view('backend.admin.modules.master.custom-field',compact('users'));
    }

    public function view(Request $request)
{
    if ($request->ajax()) {
        $customFields = CustomField::orderBy('position', 'asc')->get();

        return DataTables::of($customFields)
            ->addIndexColumn()

            // Display name
            ->addColumn('name', function ($row) {
                return $row->name;
            })

            // Display placeholder
            ->addColumn('placeholder', function ($row) {
                return $row->placeholder;
            })

            // Display type with badge
            ->addColumn('type', function ($row) {
                return $row->type;
            })

            // Display location
            ->addColumn('location', function ($row) {
                return $row->location;
            })

            // Display category
            ->addColumn('category', function ($row) {
                return $row->category;
            })

           
            ->addColumn('is_required', function ($row) {
                if ($row->is_required == 1) {
                return '<span style="color: red;">Yes</span>';
                } else {
                    return '<span style="color: green;">No</span>';
                }
            })

            // Display is_required as switch
            ->addColumn('status', function ($row) {
                $checked = $row->status == 1 ? 'checked' : '';
                return '<div class="flex-grow-1 icon-state switch-outline">
                        <label class="switch mb-0" onchange="switchCustomField(' . $row->id . ')">
                            <input type="checkbox" ' . $checked . '>
                            <span class="switch-state bg-success"></span>
                        </label>
                        </div>';
            })

            // Action buttons
            ->addColumn('action', function ($row) {
                return '<ul class="action">
                          <li class="edit">
                            <a href="#"><i class="icon-pencil-alt" onclick="editCustomField(' . $row->id . ')"></i></a>
                          </li>
                          <li class="delete ms-1">
                            <a href="#"><i class="icon-trash" onclick="deleteCustomField(' . $row->id . ')"></i></a>
                          </li>
                        </ul>';
            })

            ->rawColumns(['placeholder','is_required','type', 'status', 'action'])
            ->make(true);
    }

}


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'placeholder' => 'nullable',
            'custom_field' => 'required',
            'type' => 'required',
            'location' => 'required',
            'category' => 'required',
            'class' => 'nullable',
            'is_required' => 'nullable|boolean',
        ]);
        $exists = CustomField::where('name', $request->name)->exists();
        if ($exists) {
            return response()->json(['already_found' => 'This custom field name already exists.']);
        }
        $customField = new CustomField();
        $customField->name = $request->name;
        $customField->name_slug = Str::slug($request->name,'_');
        $customField->placeholder = $request->placeholder;
        $customField->custom_field = $request->custom_field;
        $customField->type = $request->type;
        if(!empty($request->field_option)){
            $customField->type_option = implode(", ", $request->field_option); // array to string
        }
        $customField->location = $request->location;
        $customField->category = $request->category;
        $customField->class = $request->class;
        $customField->is_required = $request->is_required ?? 0;
        if($customField->save()){
            return response()->json(['success' => 'Custom field created successfully.' ],200);
        }else{
            return response()->json(['error_success' => 'Custom field not created' ]);
        }
    }

    public function positionUpdate(Request $request){
        $prePosition = CustomField::orderBy('id', 'asc')->pluck('position', 'id')->toArray();
        session(['previous_custom_field_positions' => $prePosition]); // ✅ Store in session

        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = CustomField::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if($update) {
            return response()->json(['success' => 'Position updated successfully']);
        } else {
            return response()->json(['error_success' => 'Position not updated']);
        }
    }

    public function undoPosition(Request $request){
        $previous = session('previous_custom_field_positions');
        if ($previous && is_array($previous)) {
            foreach ($previous as $id => $position) {
                CustomField::where('id', $id)->update(['position' => $position]);
            }
            return response()->json(['success' => 'Undo successful']);
        }
        return response()->json(['error_success' => 'No previous position found']);
    }

    public function switch(Request $request){
        $sstatus = CustomField::where('id',$request->id)->get(['status']);
        $status = $sstatus[0]->status;
        if($status == 1){
            $new_status = 0;
        }
        else{
            $new_status = 1;
        }
        CustomField::where('id',$request->id)->update([
            'status' => $new_status
        ]);
        return response()->json(['success' => 'Status Updated Successfully'],200);
    }

    public function getDetails(Request $request){
        $getData = CustomField::where('id',$request->id)->get();
        return response()->json(['success' => 'Data Fetched Successfully','getData'=>$getData],200);
    }

   public function update(Request $request){
    // Check for duplicate name (excluding current record)
    $exists = CustomField::where('name', $request->name)
        ->where('id', '!=', $request->id)
        ->exists();

    if ($exists) {
        return response()->json(['already_found' => 'This custom field name already exists.']);
    }

    // Find the record
    $field = CustomField::find($request->id);
    if (!$field) {
        return response()->json(['error' => 'Custom field not found.'], 404);
    }

    // Update fields
    $field->name = $request->name;
    $field->name_slug = Str::slug($request->name,'_');
    $field->placeholder = $request->placeholder;
    $field->type = $request->type;
     if(!empty($request->field_option)){
            $field->type_option = implode(", ", $request->field_option); // array to string
        }
    $field->location = $request->location;
    $field->category = $request->category;
    $field->class = $request->class;
    $field->is_required = $request->is_required ?? 0;

    // Save and respond
    if ($field->save()) {
        return response()->json(['success' => 'Custom field updated successfully'], 200);
    }

    return response()->json(['error_success' => 'Custom field not updated']);
}

 public function delete(Request $request){
        $delete = CustomField::where('id',$request->id)->delete();
        if($delete){
            return response()->json(['success' => 'Custom Field deleted successfully'],200);
        }else{
             return response()->json(['error_success' => 'Custom Field not deleted']);
        }
    }


}

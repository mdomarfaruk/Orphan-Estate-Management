<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff_info;
use Validator;


class StaffCtrl extends Controller
{
    public function getInfo(){
        $staffInfo = DB::table('staff_infos')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'staff_infos.designation_id')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'staff_infos.department_id')
            ->where('staff_infos.is_active',1)
            ->orderBy('staff_infos.id','DESC')
            ->select('staff_infos.*', 'designation.title as designation_title','department.title as department_title')
            ->paginate(10);

        $designation = DB::table("all_sttings")
            ->where('type','=',1)
            ->where('is_active','=',1)
            ->orderBy('id',"DESC")
            ->pluck("title","id");

        $department = DB::table("all_sttings")
            ->where('type','=',2)
            ->where('is_active','=',1)
            ->orderBy('id',"DESC")
            ->pluck("title","id");


        return view('staff_info.view_info',['staff_data' => $staffInfo,'designation_info'=>$designation,'department_info'=>$department]);
    }


    public function save(request $request){

        $validator = Validator::make($request->all(), [
            'name_eng' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        $destinationPath = 'images/staff_image';
        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $file_name = time() . "." . $extension;
            $image->move($destinationPath, $file_name);
        }elseif($request->old_image !=''){
            $file_name=$request->old_image;
        }else{
            $file_name='';
        }

        if(empty($request->setting_id)) {
            $staff_entry = new Staff_info();
         }else{
            $staff_entry = Staff_info::find($request->setting_id);
         }
        $staff_entry->staff_id = "STUFF-".time();
        $staff_entry->name_eng = $request->name_eng;
        $staff_entry->name_bng = $request->name_bng;
        $staff_entry->father_name = $request->father_name;
        $staff_entry->mother_name = $request->mother_name;
        $staff_entry->mobile_no = $request->mobile_no;
        $staff_entry->address = $request->address;

        $staff_entry->designation_id = $request->designation;
//        $orphan_entry->role_id = $request->role_id;
        $staff_entry->department_id = $request->department;
        $staff_entry->	salary = $request->monthly_salary;
        $staff_entry->birth_date = date('Y-m-d H:i:s',strtotime($request->bith_date));
        $staff_entry->join_date = date('Y-m-d H:i:s',strtotime($request->join_date));
        $staff_entry->photo =$file_name;
        $staff_entry->save();
        return redirect('/staff_info/list')->with('message','Successfully add Information');
    }

    public function get_single_staff_info(request $request){
            $staff_entry = Staff_info::where('id',$request->title)->first();
       return json_encode($staff_entry);
    }

    public function delete_staff_info($id){

        $staff_entry = Staff_info::find($id);
        $staff_entry->is_active=2;
        $staff_entry->save();
        return redirect('/staff_info/list')->with('message','Successfully delete Information');
    }
}

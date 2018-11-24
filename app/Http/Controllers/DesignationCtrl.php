<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\All_stting;
use Validator;

class DesignationCtrl extends Controller
{
    public function data_list(){
        $designationInfo = DB::table('all_sttings')->where(['is_active'=>1,'type'=>1])->orderBy('id','DESC')->paginate(10);
        return view('setting.designation_list',['designationInfo' => $designationInfo]);
    }

    public function save(request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if(empty($request->setting_id)) {
            $setting_entry = new All_stting();
        }else {
            $setting_entry = All_stting::find($request->setting_id);
        }
        $setting_entry->type = 1;
        $setting_entry->title = $request->title;
        $setting_entry->is_active = 1;
        $setting_entry->save();
        if(empty($request->setting_id)) {
            return redirect('designation/List')->with('message', 'Successfully add Information');
        }else{
            return redirect('designation/List')->with('message', 'Successfully update Information');
        }
    }

    public function delete_designation($id){
        $orphan_entry = All_stting::find($id);
        $orphan_entry->is_active=2;
        $orphan_entry->save();
        return redirect('/designation/List')->with('message','Successfully delete Information');
    }

//    department lsit
    public function department_list(){
        $departmentInfo = DB::table('all_sttings')->where(['is_active'=>1,'type'=>2])->orderBy('id','DESC')->paginate(10);
        return view('setting.department_list',['department' => $departmentInfo]);
    }
    public function department_save(request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if(empty($request->setting_id)) {
            $setting_entry = new All_stting();
        }else {
            $setting_entry = All_stting::find($request->setting_id);
        }
        $setting_entry->type = 2;
        $setting_entry->title = $request->title;
        $setting_entry->is_active = 1;
        $setting_entry->save();
        if(empty($request->setting_id)) {
            return redirect('department/list')->with('message', 'Successfully add Information');
        }else{
            return redirect('department/list')->with('message', 'Successfully update Information');
        }
    }
    public function delete_department($id){
        $orphan_entry = All_stting::find($id);
        $orphan_entry->is_active=2;
        $orphan_entry->save();
        return redirect('/department/list')->with('message','Successfully delete Information');
    }

    //    user access lsit user type
    public function user_role_list(){
        $userAccessInfo = DB::table('all_sttings')->where(['is_active'=>1,'type'=>3])->orderBy('id','DESC')->paginate(10);
        return view('setting.user_access_list',['userAccessInfo' => $userAccessInfo]);
    }
    public function user_role_save(request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if(empty($request->setting_id)) {
            $setting_entry = new All_stting();
        }else {
            $setting_entry = All_stting::find($request->setting_id);
        }
        $setting_entry->type = 3;
        $setting_entry->title = $request->title;
        $setting_entry->is_active = 1;
        $setting_entry->save();
        if(empty($request->setting_id)) {
            return redirect('/user_role/list')->with('message', 'Successfully add Information');
        }else{
            return redirect('/user_role/list')->with('message', 'Successfully update Information');
        }
    }
    public function delete_user_role($id){
        $orphan_entry = All_stting::find($id);
        $orphan_entry->is_active=2;
        $orphan_entry->save();
        return redirect('/user_role/list')->with('message','Successfully delete Information');
    }

}

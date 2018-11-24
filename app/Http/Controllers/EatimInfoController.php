<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Orphan_info;
use Validator;

class EatimInfoController extends Controller
{
    public function index(){
        return view('eatim_info.add_info');
    }
    public function edit($id){
        $etimInfo = Orphan_info::where('id',$id)->first();
        return view('eatim_info.edit',['signleOrphanInfo'=>$etimInfo]);

    }

    public function save(request $request){
        $validator = Validator::make($request->all(), [
            'name_eng' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        $destinationPath = 'images/orphan_image';
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

        $orphan_entry = new Orphan_info();
        $orphan_entry->orphan_id = time();
        $orphan_entry->name_eng = $request->name_eng;
        $orphan_entry->name_bng = $request->name_bng;
        $orphan_entry->father_name = $request->father_name;
        $orphan_entry->mother_name = $request->mother_name;
        $orphan_entry->gardian_name = $request->guardian_name;
        $orphan_entry->mobile_no = $request->mobile_no;
        $orphan_entry->address = $request->address;
        $orphan_entry->birth_date = date('Y-m-d H:i:s',strtotime($request->bith_date));
        $orphan_entry->admission_date = date('Y-m-d H:i:s',strtotime($request->admission_date));
        $orphan_entry->photo =$file_name;
        $orphan_entry->save();
        return redirect('get_eatim_information')->with('message','Successfully add Information');
    }


    public function getInfo(){
        $etimInfo = DB::table('orphan_infos')->where('is_active',1)->orderBy('id','DESC')->paginate(5);
        return view('eatim_info.view_info',['etim_data' => $etimInfo]);
    }


    public function update(request $request){
        $validator = Validator::make($request->all(), [
            'name_eng' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $destinationPath = 'images/orphan_image';

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


        $orphan_entry = Orphan_info::find($request->orphan_id);
        $orphan_entry->name_eng = $request->name_eng;
        $orphan_entry->name_bng = $request->name_bng;
        $orphan_entry->father_name = $request->father_name;
        $orphan_entry->mother_name = $request->mother_name;
        $orphan_entry->gardian_name = $request->guardian_name;
        $orphan_entry->mobile_no = $request->mobile_no;
        $orphan_entry->address = $request->address;
        $orphan_entry->birth_date = date('Y-m-d H:i:s',strtotime($request->bith_date));
        $orphan_entry->admission_date = date('Y-m-d H:i:s',strtotime($request->admission_date));
        $orphan_entry->photo = $file_name;

        $orphan_entry->save();
        return redirect('get_eatim_information')->with('message','Successfully update Information');


    }
    public function delete($id){
        $orphan_entry = Orphan_info::find($id);
        $orphan_entry->is_active=2;
        $orphan_entry->save();
        return redirect('get_eatim_information')->with('message','Successfully delete Information');
    }

}

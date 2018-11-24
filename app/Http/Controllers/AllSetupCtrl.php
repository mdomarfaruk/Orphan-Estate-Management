<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Bank_info;
use App\Donar_info;
use App\Donation_box;
use App\Acc_chart_of_account;
use App\Monthly_opening;
use Validator;

class AllSetupCtrl extends Controller
{
    /*
  |-------------------------------------------------------|
  |                Bank information                       |
  |-------------------------------------------------------|
  */
   public function bank_info_list(){
      $bank_info = DB::table('bank_infos')
          ->leftJoin("acc_chart_of_accounts","acc_chart_of_accounts.id","=","bank_infos.acc_chart_of_account_id")
          ->where('bank_infos.is_active',1)
          ->orderBy('bank_infos.id','DESC')
          ->select("acc_chart_of_accounts.name as name","bank_infos.*")
          ->paginate(10);
       return view('setting.bank_info',['bank_data' => $bank_info]);
   }
    public function bank_save(request $request){

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }



        if(empty($request->setting_id)) {
            $bank_data = new Bank_info();
            $chart_of_acc_data = new Acc_chart_of_account();

            // chart off acc_data insert
            $chart_of_acc_data->name = $request->bank_name;
            $chart_of_acc_data->parent_id = 4; // for donation box group  id
            $chart_of_acc_data->details = "Bank Group";
            $chart_of_acc_data->code = $this->calculation_chart_off_acc_code('10101000',4);
            $chart_of_acc_data->type_id = 1;
            $chart_of_acc_data->head_type = 2;
            $chart_of_acc_data->opt_type = 1;
            $chart_of_acc_data->created_time = date('Y-m-d H:i:s');

            $chart_of_acc_data->save();
            $chartOfAccId = $chart_of_acc_data->id;


            $bank_data->acc_chart_of_account_id = $chartOfAccId;
            $bank_data->account_no = $request->acc_no;
            $bank_data->bank_address = $request->bank_address;
            $bank_data->author_name = $request->author_name;
            $bank_data->author_address = $request->author_address;
            $bank_data->author_telephone = $request->author_telphone;
            $bank_data->save();
            return redirect('/bank_info/list')->with('message','Successfully add Information');
        }else{
            $bank_data = Bank_info::find($request->setting_id);
            $chart_of_acc_data = Acc_chart_of_account::find($request->chart_of_acc_id);

            $chart_of_acc_data->name = $request->bank_name;
            $chart_of_acc_data->save();

            $bank_data->account_no = $request->acc_no;
            $bank_data->bank_address = $request->bank_address;
            $bank_data->author_name = $request->author_name;
            $bank_data->author_address = $request->author_address;
            $bank_data->author_telephone = $request->author_telphone;
            $bank_data->save();
            return redirect('/bank_info/list')->with('message','Successfully Update Information');
        }


    }

    public function delete_bank_info($id){

        $bank_data = Bank_info::find($id);
        $bank_data->is_active=0;
        $bank_data->save();
        return redirect('/bank_info/list')->with('message','Successfully delete Information');
    }

    /*
    |-------------------------------------------------------|
    |                Donar information                      |
    |-------------------------------------------------------|
    */


   public function donar_info_list(){
      $donar_info = DB::table('donar_infos')
          ->where('donar_infos.is_active',1)
          ->orderBy('donar_infos.id','DESC')
          ->paginate(10);
       return view('setting.donar_info',['donar_data' => $donar_info]);
   }


    public function donar_save(request $request){
       $validator = Validator::make($request->all(), [
            'donar_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        if(empty($request->setting_id)) {
            $donar_info_data = new Donar_info();
        }else{
            $donar_info_data = Donar_info::find($request->setting_id);
        }

        $donar_info_data->name = $request->donar_name;
        $donar_info_data->address = $request->donar_address;
        $donar_info_data->email = $request->donar_email;
        $donar_info_data->mobile = $request->donar_mobile;
        $donar_info_data->note = $request->about_note_donar;
        $donar_info_data->save();
        if(empty($request->setting_id)) {
            return redirect('/donar/list')->with('message', 'Successfully Add Information');
        }else{
            return redirect('/donar/list')->with('message', 'Successfully Update Information');
        }
    }
    public function delete_donar_info($id){

        $bank_data = Donar_info::find($id);
        $bank_data->is_active=0;
        $bank_data->save();
        return redirect('/donar/list')->with('message','Successfully delete Information');
    }

    /*
   |-------------------------------------------------------|
   |                Donar information                      |
   |-------------------------------------------------------|
   */

    public function donation_box_list(){
        $donar_info = DB::table('donation_boxes')
            ->leftJoin("acc_chart_of_accounts","acc_chart_of_accounts.id","=","donation_boxes.acc_chart_of_account_id")
            ->where('donation_boxes.is_active',1)
            ->orderBy('donation_boxes.id','DESC')
            ->select("acc_chart_of_accounts.name as box_no","donation_boxes.*")
            ->paginate(10);
        return view('setting.donation_box_info',['donar_data' => $donar_info]);
    }
    public function donation_box_save(request $request){

        $validator = Validator::make($request->all(), [
            'donar_box_no' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        if(empty($request->setting_id)) {
            $donation_box_data = new Donation_box();
            $chart_of_acc_data = new Acc_chart_of_account();

            // chart off acc_data insert
            $chart_of_acc_data->name = $request->donar_box_no;
            $chart_of_acc_data->parent_id = 14; // for donation box group  id
            $chart_of_acc_data->details = "Donation Box Group";
            $chart_of_acc_data->code = $this->calculation_chart_off_acc_code('30103000',14);
            $chart_of_acc_data->type_id = 3;
            $chart_of_acc_data->head_type = 2;
            $chart_of_acc_data->opt_type = 1;
            $chart_of_acc_data->created_time = date('Y-m-d H:i:s');

            $chart_of_acc_data->save();
            $chartOfAccId = $chart_of_acc_data->id;


            $donation_box_data->box_type = $request->donar_box_type;
            $donation_box_data->acc_chart_of_account_id	 = $chartOfAccId;
            $donation_box_data->box_location = $request->donar_box_location;
            $donation_box_data->box_location = $request->donar_box_location;
            $donation_box_data->custodian_name = $request->custodian;
            $donation_box_data->established_date = date('Y-m-d',strtotime($request->estabilshDate));
            $donation_box_data->note = $request->about_note_donation_box;
            $donation_box_data->save();
        }else{
            $donation_box_data = Donation_box::find($request->setting_id);
            $chart_of_acc_data = Acc_chart_of_account::find($request->chart_of_acc);

            $chart_of_acc_data->name = $request->donar_box_no;
            $chart_of_acc_data->save();

            $donation_box_data->box_type = $request->donar_box_type;
            $donation_box_data->box_location = $request->donar_box_location;
            $donation_box_data->custodian_name = $request->custodian;
            $donation_box_data->established_date = date('Y-m-d',strtotime($request->estabilshDate));
            $donation_box_data->note = $request->about_note_donation_box;
            $donation_box_data->save();
        }


        if(empty($request->setting_id)) {
            return redirect('/donation_box/list')->with('message', 'Successfully Add Information');
        }else{
            return redirect('/donation_box/list')->with('message', 'Successfully Update Information');
        }
    }
    public function delete_donation_box($id){

        $donation_box_data = Donation_box::find($id);
        $donation_box_data->is_active=0;
        $donation_box_data->save();
        return redirect('/donation_box/list')->with('message','Successfully delete Information');
    }

    public function get_single_box_info(request $request){
        $box_info = Donation_box::where('id',$request->id)->first();
        return json_encode($box_info);
    }

    public function calculation_chart_off_acc_code($parent_code,$parent_id){
        $query = DB::table('acc_chart_of_accounts')
            ->select('acc_chart_of_accounts.id')
            ->where('is_active', '=', 1)
            ->where('parent_id', '=', $parent_id)
            ->get();
        return $parent_code + (count($query)+1);
    }
    public function get_montly_open(){
        $monthly_info = DB::table('monthly_openings')
            ->where('monthly_openings.status','!=',0)
            ->orderBy('status',"ASC")
            ->orderBy('sorting',"DESC")
            ->select("monthly_openings.*")
            ->paginate(10);

        return view('setting.get_montly_open',['monthly_data' => $monthly_info]);
    }

    public function save_montly_open(request $request){

//        $validator = Validator::make($request->all(), [
//            'title' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
//        }
//        $request=$_POST;
//        echo $request->start_date;
//        echo "<pre>";
//        print_r($_POST);
//        exit;


        if(empty($request->setting_id)) {
            $montly_entry = new Monthly_opening();
        }else{
            $montly_entry = Monthly_opening::find($request->setting_id);
        }

        $montly_entry->title = $request->title;
        $montly_entry->start_date = isset($request->start_date)? date('Y-m-d',strtotime($request->start_date)):NULL;
        $montly_entry->end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):NULL;
        $montly_entry->modify_last_date =isset($request->end_date)?date('Y-m-d',strtotime( $request->changeLastDate)):NULL;
        $montly_entry->status = $request->status;
        $montly_entry->sorting = $request->position;
        $montly_entry->created_by = (!empty(Auth::user()->id)?Auth::user()->id:NULL);
        $montly_entry->created_at = date('Y-m-d H:i:s');
        $montly_entry->created_ip = $request->ip();

        $montly_entry->save();
        return redirect('/get_montly_open')->with('message','Successfully add Information');
    }
    public function delete_montly_open($id){

        $bank_data = Monthly_opening::find($id);
        $bank_data->status=0;
        $bank_data->save();
        return redirect('/get_montly_open')->with('message','Successfully delete Information');
    }


}

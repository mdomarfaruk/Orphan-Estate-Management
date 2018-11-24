<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Datatables;


class CashReceipt extends Controller
{
    public function money_receipt_donar(){

        $all_donar_info = DB::table("donar_infos")
            ->where('is_active','=',1)
            ->orderBy('id',"DESC")
            ->pluck("name","id");

            $all_donar_head_info = DB::table("acc_chart_of_accounts")
            ->where('is_active','=',1)
            ->where('type_id','=',3)
            ->where('head_type','=',2)
            ->where('parent_id','=',13)
            ->orderBy('id',"ASC")
            ->pluck("name","id");

        return view('cash_receipt.money_receipt_donar',['donar_info' =>$all_donar_info,'donar_head_info'=>$all_donar_head_info ]);
    }

    public function save_money_receipt_donar(request $request){


        $invoice_data = [
            'record_type' =>1,
            'record_date' => date('Y-m-d',strtotime($request['receipt_date'])),
            'inv_amount' => $request['subtotal'],
            'net_amount' => $request['subtotal'],
            'received_by' =>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'transaction_id' => date('ymdhis').$this->generateCode(2),
            'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'created_time' => date('Y-m-d H:i:s'),
            'created_ip' => $request->ip(),
        ];

        DB::table('acc_invoices')->insert($invoice_data);
        $last_id = DB::getPdo()->lastInsertId();

        $invoice_details=array();
        $transaction_info=array();
        foreach ($request->book_no as $key=>$value)
        {
            $invoice_details[] = [
                'invoice_id' => $last_id,
                'book_no' => $request->book_no[$key],
                'receipt_no' => $request->receipt_no[$key],
                'acc_chart_of_account_id' => 6, //hard code for cash debit
                'credited_chart_of_acc' => $request->donar_chart_off_acc[$key], // credit chart off acc
                'note' => $request->note[$key],
                'amount' => $request->amount[$key],
                'donar_name_id' => $request->donar_name[$key],
                'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' =>  $request->ip(),
            ];

            // todo:transaction information update
            $transaction_info[]=[
              'invoice_id'=>$last_id,
              'amount'=>$request->amount[$key],
              'debit_id'=>6, // main cash hard code 6
              'credit_id'=> $request->donar_chart_off_acc[$key],
              'transaction_date'=>date('Y-m-d',strtotime($request['receipt_date'])),
              'created_by'=>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
              'created_by_ip'=>$request->ip(),
              'created_time'=>date('Y-m-d H:i:s'),
              'comments'=>$request->note[$key],
            ];
        }

        DB::table('acc_invoices_details')->insert($invoice_details);
        DB::table('acc_transaction')->insert($transaction_info);





        return redirect('/get_money_receipt_donar')->with('message','Successfully add Information');
    }
    public function get_money_receipt_donar(){

        $getCashReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices.record_type',1)
            ->where('acc_invoices.is_active',1)
            ->orderBy('acc_invoices.id','DESC')
            ->select('acc_invoices.*','users.name as receipt_name')
            ->paginate(10);

        return view('cash_receipt.get_money_receipt_donar',['cash_receipt_info' =>$getCashReceiptInfo ]);
    }

    public function  generateCode($limit){
        $code = 0;
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
         return (int)$code;
    }
    public function single_receipt_view($id){
        $receipt_info = DB::table('acc_invoices')
            ->leftJoin('acc_invoices_details', 'acc_invoices_details.invoice_id', '=', 'acc_invoices.id')
            ->leftJoin('donar_infos', 'donar_infos.id', '=', 'acc_invoices_details.donar_name_id')
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'acc_invoices_details.credited_chart_of_acc')
            ->leftJoin('acc_chart_of_accounts as expense_chart_off_acc', 'expense_chart_off_acc.id', '=', 'acc_invoices_details.acc_chart_of_account_id')

            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->leftJoin('collector_withness_info as collected',  'acc_invoices_details.collected_by_id', '=','collected.id')
            ->leftJoin('collector_withness_info as payeeInfo',  'acc_invoices_details.payee_id', '=','payeeInfo.id')
            ->leftJoin('collector_withness_info as withNess',  'acc_invoices_details.withness_id', '=','withNess.id')
            ->leftJoin('bank_infos',  'bank_infos.acc_chart_of_account_id', '=','acc_chart_of_accounts.id')
//            ->leftJoin('acc_chart_of_accounts as bank_info_data', 'bank_info_data.id', '=', 'acc_invoices_details.bank_id')
            ->where('acc_invoices.id',$id)
            ->orderBy('acc_invoices_details.id','ASC')
            ->select('acc_invoices.id','acc_invoices.record_date','acc_invoices.record_type','acc_invoices.net_amount','acc_invoices.transaction_id','acc_invoices_details.invoice_id','acc_invoices_details.book_no','acc_invoices_details.receipt_no','acc_invoices_details.acc_chart_of_account_id','acc_invoices_details.donar_name_id','acc_invoices_details.amount','acc_invoices_details.note', 'donar_infos.name','donar_infos.mobile','donar_infos.address','acc_chart_of_accounts.name as chart_of_acc_name','users.name as received_by',"collected.title as collector_name","withNess.title as withness_name","acc_invoices_details.cheque_no as cheque_no","bank_infos.account_no","acc_invoices_details.vouchar_no","payeeInfo.title as payeeName","acc_invoices_details.bank_id as bank_name","expense_chart_off_acc.name as expense_chart_of_acc_name")->get();
        return view('cash_receipt.single_receipt_view',['receipt_info' =>$receipt_info]);
    }

    public function delete_money_receipt_donar($id){
        $update_data=[
            'is_active' => 0,
            'updated_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_ip' => request()->ip(),
        ];
//   todo:: for invoice delete
        $invoice = DB::table('acc_invoices')
            ->where('id', $id)
            ->update($update_data);
//   todo:: for invoice details delete
        $invoice_details = DB::table('acc_invoices_details')
            ->where('invoice_id', $id)
            ->update($update_data);
//   todo:: for invoice  transaction delete
        $transaction = DB::table('acc_transaction')
            ->where('invoice_id', $id)
            ->update($update_data);

        if($invoice==1 && $invoice_details==1 && $transaction==1  ) {
            return redirect('/get_money_receipt_donar')->with('message', 'Successfully delete Information');
        }else{
            return redirect('/get_money_receipt_donar')->with('message', 'Failed! delete Information');
        }
    }


    //donation box
    public function get_donation_box_receipt(){
        return view('donation_box_receipt.get_donation_box_receipt');
    }

    public function get_donation_box_receipt_ajax(){

        $getDonationBoxReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices.record_type',2)
            ->where('acc_invoices.is_active',1)
            ->orderBy('acc_invoices.id','DESC')
            ->select('acc_invoices.*','users.name as receipt_name','acc_invoices.id as invoice_id');
            return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
                return '<a href="'. url('single_receipt_view/'.$getDonationBoxReceiptInfo->invoice_id ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-share-alt"></i> </a> <a href="'. url('delete_money_receipt_donar/'.$getDonationBoxReceiptInfo->invoice_id ).'" class="btn btn-xs btn-danger"  title="Delete" onclick="return confirm(\'Are you want to delete this record\')"><i class="glyphicon glyphicon-trash"></i></a>';
            })->make(true);
    }

    public function donation_box_receipt(){
        $all_donation_box_head_info = DB::table("acc_chart_of_accounts")
            ->leftJoin("donation_boxes","donation_boxes.acc_chart_of_account_id","=","acc_chart_of_accounts.id")
            ->where('acc_chart_of_accounts.is_active','=',1)
            ->where('type_id','=',3)
            ->where('head_type','=',2)
            ->where('parent_id','=',14)
            ->orderBy('id',"ASC")
            ->pluck("acc_chart_of_accounts.name","acc_chart_of_accounts.id");

        return view('donation_box_receipt.donation_box_receipt',['head_info'=>$all_donation_box_head_info ]);
    }

    public function save_donation_box_receipt(request $request){



        $invoice_data = [
            'record_type' =>2,
            'record_date' => date('Y-m-d',strtotime($request['receipt_date'])),
            'inv_amount' => $request['subtotal'],
            'net_amount' => $request['subtotal'],
            'received_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'transaction_id' => date('ymdhis').$this->generateCode(2),
            'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'created_time' => date('Y-m-d H:i:s'),
            'created_ip' => $request->ip(),
        ];


        DB::table('acc_invoices')->insert($invoice_data);
        $last_id = DB::getPdo()->lastInsertId();

        $invoice_details=array();
        $transaction_info=array();
        foreach ($request->chart_off_acc as $key=>$value)
        {
            $invoice_details[] = [
                'invoice_id' => $last_id,
                'collected_by_id' => $this->saveNameReturnId($request->collected_by[$key],1),
                'withness_id' => $this->saveNameReturnId($request->withness[$key],2),
                'acc_chart_of_account_id' => 6, // debit id hard code main cash 6
                'credited_chart_of_acc' => $request->chart_off_acc[$key],

                'note' => $request->note[$key],
                'amount' => $request->amount[$key],
                'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' =>  $request->ip(),
            ];

            // todo:transaction information update
            $transaction_info[]=[
                'invoice_id'=>$last_id,
                'amount'=> $request->amount[$key],
                'debit_id'=>6, // main cash hard code 6
                'credit_id'=> $request->chart_off_acc[$key],
                'transaction_date'=>date('Y-m-d',strtotime($request['receipt_date'])),
                'created_by'=>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_by_ip'=>$request->ip(),
                'created_time'=>date('Y-m-d H:i:s'),
                'comments'=>$request->note[$key],
            ];
        }
        DB::table('acc_invoices_details')->insert($invoice_details);
        DB::table('acc_transaction')->insert($transaction_info);





        return redirect('/get_donation_box_receipt')->with('message','Successfully add Information');
    }

//    todo:: this function  using for duplicate value not store
    public function saveNameReturnId($title,$type){
        $all_donation_box_head_info = DB::table("collector_withness_info")
            ->where("type","=",$type)
            ->where("title","=",$title)
            ->select("id")
            ->get();
        if(count($all_donation_box_head_info)>0){
            return $all_donation_box_head_info[0]->id;
        }else {
            $data = [
                'type' => $type,
                'title' => $title,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' => request()->ip(),
            ];
            DB::table('collector_withness_info')->insert($data);
            return DB::getPdo()->lastInsertId();
        }
    }


//    todo:: money receipt from bank
    public function get_money_receipt_bank(){

        $getReceiptFromBank = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices.record_type',3)
            ->where('acc_invoices.is_active',1)
            ->orderBy('acc_invoices.id','DESC')
            ->select('acc_invoices.*','users.name as receipt_name')
            ->paginate(10);

        return view('receipt_from_bank.get_money_receipt_bank',['cash_receipt_info' =>$getReceiptFromBank ]);
    }


    public function money_receipt_bank(){
        $bank_group_info = DB::table("acc_chart_of_accounts")
            ->where('is_active','=',1)
            ->where('type_id','=',1)
            ->where('head_type','=',2)
            ->where('parent_id','=',4) //bank group parent id 4
            ->orderBy('id',"ASC")
            ->pluck("name","id");

        return view('receipt_from_bank.money_receipt_bank',['bank_head_info'=>$bank_group_info ]);
    }

    public function save_money_receipt_bank(request $request){
        $invoice_data = [
            'record_type' =>3,
            'record_date' => date('Y-m-d',strtotime($request['receipt_date'])),
            'inv_amount' => $request['subtotal'],
            'net_amount' => $request['subtotal'],
            'received_by' =>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'transaction_id' => date('ymdhis').$this->generateCode(2),
            'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'created_time' => date('Y-m-d H:i:s'),
            'created_ip' => $request->ip(),
        ];

        DB::table('acc_invoices')->insert($invoice_data);
        $last_id = DB::getPdo()->lastInsertId();

        $invoice_details=array();
        $transaction_info=array();
        foreach ($request->chart_off_acc as $key=>$value)
        {
            $invoice_details[] = [
                'invoice_id' => $last_id,
                'acc_chart_of_account_id' => 6,  //hard code for cash account
                'credited_chart_of_acc' => $request->chart_off_acc[$key],
                'cheque_no' => $request->check_no[$key],
                'note' => $request->note[$key],
                'amount' => $request->amount[$key],
                'created_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' =>  $request->ip(),
            ];

            // todo:transaction information update
            $transaction_info[]=[
                'invoice_id'=>$last_id,
                'amount'=>$request->amount[$key],
                'debit_id'=>6, // main cash hard code 6
                'credit_id'=> $request->chart_off_acc[$key], //bank_id
                'transaction_date'=>date('Y-m-d',strtotime($request['receipt_date'])),
                'created_by'=>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_by_ip'=>$request->ip(),
                'created_time'=>date('Y-m-d H:i:s'),
                'comments'=>$request->note[$key],
            ];
        }
        DB::table('acc_invoices_details')->insert($invoice_details);
        DB::table('acc_transaction')->insert($transaction_info);
        return redirect('/get_money_receipt_bank')->with('message','Successfully add Information');
    }

    public function delete_money_receipt_bank($id){
        $update_data=[
            'is_active' => 0,
            'updated_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_ip' => request()->ip(),
        ];
//   todo:: for invoice delete
        $invoice = DB::table('acc_invoices')
            ->where('id', $id)
            ->update($update_data);
//   todo:: for invoice details delete
        $invoice_details = DB::table('acc_invoices_details')
            ->where('invoice_id', $id)
            ->update($update_data);
//   todo:: for invoice  transaction delete
        $transaction = DB::table('acc_transaction')
            ->where('invoice_id', $id)
            ->update($update_data);

        if($invoice==1 && $invoice_details==1 && $transaction==1  ) {
            return redirect('/get_money_receipt_bank')->with('message', 'Successfully delete Information');
        }else{
            return redirect('/get_money_receipt_bank')->with('message', 'Failed! delete Information');
        }
    }





}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentCtrl extends Controller
{
    public function get_payment_cash(){

        $getCashPaymentInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices.record_type',5)
            ->where('acc_invoices.is_active',1)
            ->orderBy('acc_invoices.id','DESC')
            ->select('acc_invoices.*','users.name as receipt_name')
            ->paginate(10);

        return view('payment.get_payment_cash',['payment_info' =>$getCashPaymentInfo ]);
    }
    public function payment_cash(){

        // all expense chart of acc
        $expense_head = DB::table("acc_chart_of_accounts")
            ->where('is_active','=',1)
            ->where('type_id','=',4)
            ->where('head_type','=',2)
//            ->where('parent_id','=',13)
            ->orderBy('id',"ASC")
            ->pluck("name","id");

        return view('payment.payment_cash',['expense_head_info' =>$expense_head]);
    }
    public function save_payment_cash(request $request){
        $invoice_data = [
            'record_type' =>5,
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
                'vouchar_no' => $request->vouchar_no[$key],
                'payee_id' =>$this->saveNameReturnId($request->payee_name[$key],3) ,
                'acc_chart_of_account_id' => $request->chart_off_acc[$key],
                'credited_chart_of_acc' => 6,
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
                'debit_id'=> $request->chart_off_acc[$key], //bank chart id
                'credit_id'=>6, // main cash hard code 6
                'transaction_date'=>date('Y-m-d',strtotime($request['receipt_date'])),
                'created_by'=>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_by_ip'=>$request->ip(),
                'created_time'=>date('Y-m-d H:i:s'),
                'comments'=>$request->note[$key],
            ];
        }

        DB::table('acc_invoices_details')->insert($invoice_details);
        DB::table('acc_transaction')->insert($transaction_info);

        return redirect('/get_payment_cash')->with('message','Successfully add Information');
    }
    public function delete_payment_cash($id){
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
            return redirect('/get_payment_cash')->with('message', 'Successfully delete Information');
        }else{
            return redirect('/get_payment_cash')->with('message', 'Failed! delete Information');
        }
    }


//    todo::for bank payment duduct from cash

    public function get_payment_bank(){

        $getReceiptFromBank = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices.record_type',6)
            ->where('acc_invoices.is_active',1)
            ->orderBy('acc_invoices.id','DESC')
            ->select('acc_invoices.*','users.name as receipt_name')
            ->paginate(10);

        return view('payment.get_payment_bank',['cash_payment_bank_info' =>$getReceiptFromBank ]);
    }

    public function payment_bank(){
        $bank_group_info = DB::table("acc_chart_of_accounts")
            ->where('is_active','=',1)
            ->where('type_id','=',1)
            ->where('head_type','=',2)
            ->where('parent_id','=',4) //bank group parent id 4
            ->orderBy('id',"ASC")
            ->pluck("name","id");

        //expense head
        $expense_head = DB::table("acc_chart_of_accounts")
            ->where('is_active','=',1)
            ->where('type_id','=',4)
            ->where('head_type','=',2)
//            ->where('parent_id','=',13)
            ->orderBy('id',"ASC")
            ->pluck("name","id");

        return view('payment.payment_bank',['bank_head_info'=>$bank_group_info,'expense_head_info' =>$expense_head ]);
    }

    public function save_payment_bank(request $request){

        $invoice_data = [
            'record_type' =>6,
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
                'vouchar_no' => $request->vouchar_no[$key],
                'bank_id' => $request->bank_id[$key],
                'payee_id' =>$this->saveNameReturnId($request->payee_by[$key],3) ,
                'acc_chart_of_account_id' => $request->chart_off_acc[$key],
                'credited_chart_of_acc' => $request->bank_id[$key],
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
                'debit_id'=> $request->chart_off_acc[$key], //bank chart id
                'credit_id'=>$request->bank_id[$key], // individual bank id
                'transaction_date'=>date('Y-m-d',strtotime($request['receipt_date'])),
                'created_by'=>(!empty(Auth::user()->id)?Auth::user()->id:NULL),
                'created_by_ip'=>$request->ip(),
                'created_time'=>date('Y-m-d H:i:s'),
                'comments'=>$request->note[$key],
            ];
        }

        DB::table('acc_invoices_details')->insert($invoice_details);
        DB::table('acc_transaction')->insert($transaction_info);

        return redirect('/get_payment_bank')->with('message','Successfully add Information');
    }

    public function delete_payment_bank($id){
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
            return redirect('/get_payment_bank')->with('message', 'Successfully delete Information');
        }else{
            return redirect('/get_payment_bank')->with('message', 'Failed! delete Information');
        }
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
    public function  generateCode($limit){
        $code = 0;
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
        return (int)$code;
    }
}

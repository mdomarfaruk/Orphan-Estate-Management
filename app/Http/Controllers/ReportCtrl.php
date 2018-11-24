<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Monthly_opening;
use PDF;

class ReportCtrl extends Controller
{
    public function get_all_expense_report(){

        $monthly_opening = DB::table("monthly_openings")
            ->whereIn('status',['1','2'])
            ->where('status','!=',0)
            ->orderBy('status',"ASC")
            ->orderBy('sorting',"DESC")
            ->pluck("title","id");
        return view('report.get_all_expense_report',['monthly_opening'=>$monthly_opening]);

    }
    public function sarching_expense_month(request $request){
         $month_id=$request->month_info;
         if(isset($month_id)&& ($month_id!='')) {
             $month_info = Monthly_opening::where('id', $month_id)->first();
             $start_date = $month_info->start_date;
             $end_date = $month_info->end_date;

             $expense_head = DB::table("acc_chart_of_accounts")
                 ->where('is_active', '=', 1)
                 ->where('type_id', '=', 4)
                 ->where('head_type', '=', 2)
                 ->orderBy('id', "ASC")
                 ->select("id")->get();
             $all_data = array();
             foreach ($expense_head as $head) {
                 $all_data[] = $head->id;
             }

             $expense_info = DB::table('acc_invoices_details')
                 ->join('acc_invoices', function ($join) {
                     $join->on('acc_invoices_details.invoice_id', '=', 'acc_invoices.id');
                 })
                 ->leftJoin('collector_withness_info as payeeInfo', 'acc_invoices_details.payee_id', '=', 'payeeInfo.id')
                 ->join('acc_chart_of_accounts as debit_acc_info', 'debit_acc_info.id', '=', 'acc_invoices_details.acc_chart_of_account_id')
                 ->join('acc_chart_of_accounts as credit_acc_info', 'credit_acc_info.id', '=', 'acc_invoices_details.credited_chart_of_acc')
                 ->orderBy('acc_invoices.id', 'DESC')
                 ->whereIn('acc_invoices.record_type', ['5', '6'])
                 ->whereIn('acc_invoices_details.acc_chart_of_account_id', $all_data)
                 ->where('acc_invoices_details.is_active', 1)
                 ->where('acc_invoices.record_date', ">=", $start_date)
                 ->where('acc_invoices.record_date', "<=", $end_date)
                 ->select("acc_invoices.record_type", "acc_invoices.record_date", "acc_invoices_details.vouchar_no", "payeeInfo.title as payeeName", "debit_acc_info.name  as debit_account_name", "credit_acc_info.name  as credit_account_name", "acc_invoices.transaction_id", "acc_invoices_details.note as comments", "acc_invoices_details.amount")->get();

             if (count($expense_info) > 0) {
                 $data = ['status' => 'success', 'message' => 'Successfully data found', 'data' => $expense_info];
             } else {
                 $data = ['status' => 'error', 'message' => 'Sorry no data found.', 'data' => ''];
             }
             if (isset($request->download_pdf) && $request->download_pdf == 'pdf') {
                 PDF::setOptions(['dpi' => 150, 'defaultFont' => 'SolaimanLipi']);
                 $pdf = PDF::loadView('report.search_get_all_expense_report',['expense_info' => $data]);
                 return $pdf->download('invoice.pdf');
             }else{
                return view('report.search_get_all_expense_report', ['expense_info' => $data]);
            }
        }else{
            return ['status'=>'error','message'=>'Sorry no month select','data'=>''];
        }

    }


    public function get_all_collection_report(){

        $monthly_opening = DB::table("monthly_openings")
            ->whereIn('status',['1','2'])
            ->where('status','!=',0)
            ->orderBy('status',"ASC")
            ->orderBy('sorting',"DESC")
            ->pluck("title","id");
        return view('report.get_all_collection_report',['monthly_opening'=>$monthly_opening]);



    }
    public  function sarching_get_all_collection_report(request $request){
        $month_id=$request->monthId;
        if(isset($month_id)&& ($month_id!='')) {
            $month_info = Monthly_opening::where('id', $month_id)->first();
            $start_date = $month_info->start_date;
            $end_date = $month_info->end_date;
            $collection_head = DB::table("acc_chart_of_accounts")
                ->where('is_active','=',1)
                ->where('type_id','=',1)
                ->where('head_type','=',2)
                ->orderBy('id',"ASC")
                ->select("id")->get();
            $all_data=array();
            foreach ($collection_head as $head){
                $all_data[]=$head->id;
            }

            $collection_info = DB::table('acc_invoices_details')
                ->join('acc_invoices', function ($join) {
                    $join->on('acc_invoices_details.invoice_id', '=', 'acc_invoices.id');
                })
                ->leftJoin('collector_withness_info as withnessInfo',  'acc_invoices_details.withness_id', '=','withnessInfo.id')
                ->join('acc_chart_of_accounts as debit_acc_info', 'debit_acc_info.id', '=', 'acc_invoices_details.acc_chart_of_account_id')
                ->join('acc_chart_of_accounts as credit_acc_info', 'credit_acc_info.id', '=', 'acc_invoices_details.credited_chart_of_acc')
                ->orderBy('acc_invoices.id','DESC')

                ->whereIn('acc_invoices.record_type',['1','2','3','4'])
                ->whereIn('acc_invoices_details.acc_chart_of_account_id',$all_data)
                ->where('acc_invoices_details.is_active', 1)
                ->where('acc_invoices.record_date',">=", $start_date)
                ->where('acc_invoices.record_date',"<=", $end_date)
                ->select("acc_invoices.record_type","acc_invoices.record_date","withnessInfo.title as withnessName","debit_acc_info.name  as debit_account_name","credit_acc_info.name  as credit_account_name","acc_invoices_details.cheque_no","acc_invoices_details.receipt_no","acc_invoices_details.note as comments","acc_invoices_details.amount")->get();
            if(count($collection_info)>0){
                $data = ['status'=>'success','message'=>'Successfully data found','data'=>$collection_info];
            }else{
                $data = ['status'=>'error','message'=>'Sorry no data found.','data'=>''];
            }
            return view('report.sarching_get_all_collection_report',['collection_info' =>$data]);
        }else{
            return ['status'=>'error','message'=>'Sorry no month select','data'=>''];
        }

    }


}

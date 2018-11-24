<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Company_info;

class TemplateController extends Controller
{
    public function __construct()
    {
        if(!isset( Auth::user()->id)&&(empty(Auth::user()->id))) {
            return redirect('/login');
        }
    }

    public function index(){
        if(!isset( Auth::user()->id)&&(empty(Auth::user()->id))) {
            return redirect('/login');
        }else {
            $company_info = Company_info::find(6); // company id = 6
            $cash_amount=$this->getAmount(6); // cash account chart of id=6

            $bank_group_info = DB::table("acc_chart_of_accounts")
                ->where('is_active','=',1)
                ->where('type_id','=',1)
                ->where('head_type','=',2)
                ->where('parent_id','=',4) //bank group parent id 4
                ->orderBy('id',"ASC")
                ->select("name","id")->get();
            if(!empty($bank_group_info)) {
                foreach ($bank_group_info as $bank_data) {
                    $bank_balance[] = [
                        'name' => $bank_data->name,
                        'amount' => $this->getAmount($bank_data->id)
                    ];
                }
                $bank_account_info=$bank_balance;
            }else{
                $bank_account_info='';
            }

            return view('template.font_content',['company_info'=>$company_info,'cash_amount'=>$cash_amount,'bank_amount'=>$bank_account_info]);
        }
    }
    public function getAmount($where_id){
             $debit_amount = DB::table('acc_transaction')
            ->where("debit_id", '=', $where_id)
            ->sum('acc_transaction.amount');

            $credit_amount = DB::table('acc_transaction')
            ->where("credit_id", '=', $where_id)
            ->sum('acc_transaction.amount');
            $amount= $debit_amount-$credit_amount;
            return (isset($amount)&&($amount>0))?number_format($amount,2,'.',''):"0.00";


    }
}

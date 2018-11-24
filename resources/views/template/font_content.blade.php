@extends("master")
@section('title_area')
    হোম পেইজ
@endsection
@section('main_content_area')
    <article>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-6" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
            <h2>বর্তমান সম্পত্তির তখ্য</h2>

        </header>
        <div>
            <div class="widget-body no-padding" >
                <div class="col-sm-7" style="margin-top:10px;" >
                    <table class="table table-striped table-hover table-bordered" >
                        <thead>
                        <tr>
                            <th>ক্যাশ</th>
                            <th class="text-align-right">{{ $cash_amount }}</th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>

                        <tr>
                            <th colspan="3">ব্যাংক টাকার হিসাব</th>
                        </tr>

                        <tr>
                            <th>#</th>
                            <th>ব্যাংকের নাম</th>
                            <th class="text-align-right">টাকা</th>
                        </tr>

                        </thead>
                        <tbody>
                        @php( $i=1)
                        @php($total_amount='0.00')
                        @if(!empty($bank_amount))
                            @foreach($bank_amount as $value)
                            <tr>
                                <td style="width:10px;">{{ $i++ }}</td>
                                <td>{{ $value['name'] }}</td>
                                <td class="text-align-right">{{ $value['amount'] }}</td>
                            </tr>
                            @php($total_amount+=$value['amount'])
                            @endforeach
                         @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-align-right">মোট টাকার পরিমান</th>
                                <th class="text-align-right" >{{ $total_bank_amount=(isset($total_amount)&&($total_amount>0))?number_format($total_amount,2,'.',''):'0.00' }}</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                <div class="col-sm-5" style="margin-top:10px;">
                    <table class="table table-striped table-hover table-bordered" >
                        <thead>
                        <tr>
                            <th colspan="2">সংক্ষেপে টাকার পরিমান</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ক্যাশ  টাকা</td>
                                <td class="text-right">{{ $cash_amount }}</td>
                            </tr>
                            <tr>
                                <td>ব্যাংকে টাকা</td>
                                <td class="text-right">{{ $total_bank_amount }}</td>
                            </tr>
                            <tr>
                                <th>মোট টাকার পরিমান</th>
                                <th class="text-right">{{  number_format($cash_amount+$total_bank_amount,2,'.','') }}</th>
                            </tr>


                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="jarviswidget col-sm-12 col-md-12 col-lg-5 " id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" style="float: right;">
    <header>
        <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
        <h2>প্রতিষ্টানের তথ্য </h2>

    </header>
    <div>
        <div class="widget-body no-padding" >
            <div class="col-sm-12">
                <table class="table table-striped table-hover " style="border:1px solid #d0d0d0;margin-top:10px" >
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">
                                <img src="{{ url($company_info->company_logo) }}" class="img-thumbnail" style="height: 100px;">
                            </th>
                        </tr>
                        <tr>
                            <th>প্রতিষ্ঠানের নাম</th>
                            <th>:   {{ $company_info->com_name }}</th>
                        </tr>

                        <tr>
                            <th>ঠিকানা</th>
                            <th>: {{ $company_info->address }}</th>
                        </tr>
                        <tr>
                            <th>মোবাইল</th>
                            <th>: {{ $company_info->mobile }}</th>
                        </tr>
                        <tr>
                            <th>ই-মেল</th>
                            <th>: {{ $company_info->email }}</th>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>



    </article>
    <article>
        <!-- new widget -->
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> ক্যাশ রিসিপ্ট </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-3 widget-box-header orange"   >
                            <a href="<?php echo url('/get_donation_box_receipt'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-usd icon-size"style=""></i> <span class="widget-box-text">দান বাক্স হতে আদায়</span>
                            </a>
                        </div>
                         <div class="col-sm-3 widget-box-header blue"  >
                            <a href="<?php echo url('/get_money_receipt_donar'); ?>">
                                <i class="glyphicon glyphicon-user icon-size"style=""></i> <span class="widget-box-text">মানি রিসিপ্ট(ডোনার)</span>
                            </a>
                        </div>
                         <div class="col-sm-3 widget-box-header green"  >
                            <a href="<?php echo url('/get_money_receipt_bank'); ?>">
                                <i class="glyphicon glyphicon-book icon-size"style=""></i> <span class="widget-box-text">ব্যাংক রিসিপ্ট</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> ক্যাশ/ব্যাংক প্রদান</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header darkred"  >
                            <a href="<?php echo url('/get_payment_cash'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-open icon-size"style=""></i> <span class="widget-box-text">ক্যাশ হতে প্রদান</span>
                            </a>
                        </div>
                         <div class="col-sm-2 widget-box-header orange"  >
                            <a href="<?php echo url('/get_payment_bank'); ?>">
                                <i class="glyphicon glyphicon-open icon-size"style=""></i> <span class="widget-box-text">ব্যাংক হতে প্রদান</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> তথ্য সমূহ</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header orange"  >
                            <a href="<?php echo url('/get_eatim_information'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-th-large icon-size"style=""></i> <span class="widget-box-text">এতিমের তথ্য</span>
                            </a>
                        </div>
                         <div class="col-sm-2 widget-box-header blue"  >
                            <a href="<?php echo url('/staff_info/list'); ?>">
                                <i class="glyphicon glyphicon-th icon-size"style=""></i> <span class="widget-box-text">কর্মচারীর তথ্য</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/bank_info/list'); ?>">
                                <i class="glyphicon glyphicon-user icon-size"style=""></i> <span class="widget-box-text">ডোনারের তথ্য</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header darkred"  >
                            <a href="<?php echo url('/donar/list'); ?>">
                                <i class="glyphicon glyphicon-book icon-size"style=""></i> <span class="widget-box-text">দান বাক্সের তথ্য</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-folder-open txt-color-white"></i> </span>
                <h2> রিপোর্ট সমূহ</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/get_all_collection_report'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-plus icon-size"style=""></i> <span class="widget-box-text">কালেকশন রিপোর্ট</span>
                            </a>
                        </div>
                         <div class="col-sm-3 widget-box-header darkred"  >
                            <a href="<?php echo url('/get_all_expense_report'); ?>">
                                <i class="glyphicon glyphicon-minus icon-size"style=""></i> <span class="widget-box-text">পেমেন্ট/প্রদান রিপোর্ট</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jarviswidget jarviswidget-color-blue col-sm-12 col-md-12 col-lg-12" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">
            <header>

                <span class="widget-icon"> <i class="fa fa-wrench txt-color-white"></i> </span>
                <h2> সেটিংস সমূহ</h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body  smart-form" style="margin-bottom:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-2 widget-box-header orange"  >
                            <a href="<?php echo url('/designation/List'); ?>" style="margin-top:50px;">
                                <i class="glyphicon glyphicon-align-justify icon-size"style=""></i> <span class="widget-box-text">ডেজিগনেশন</span>
                            </a>
                        </div>
                         <div class="col-sm-2 widget-box-header blue"  >
                            <a href="<?php echo url('/department/list'); ?>">
                                <i class="glyphicon glyphicon-list icon-size"style=""></i> <span class="widget-box-text">ডিপার্টমেন্ট</span>
                            </a>
                        </div>
                        <div class="col-sm-2 widget-box-header green"  >
                            <a href="<?php echo url('/get_montly_open'); ?>">
                                <i class="glyphicon glyphicon-plus-sign icon-size"style=""></i> <span class="widget-box-text">নতুন মাস এন্টি</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </article>
    <div class="col-sm-12" style="height: 50px;"></div>
    <style>
        .widget-box-header{
            background: #eee;padding:20px !important;border-radius:5px;margin-left:5px;

        }
        .widget-box-header>a{
            color:white;
        }
        .widget-box-header:hover{
            -webkit-box-shadow: 3px 3px 3px 3px #333;
            -moz-box-shadow:    3px 3px 3px 3px #333;
            box-shadow:         3px 3px 3px 3px #333;
        }

        .icon-size{
            font-size: 50px;
        }
        .widget-box-text{
           font-size:14px;font-weight: bolder;vertical-align:top;padding-left:10px !important;
        }
        .orange{
            background: orange;
        }
        .blue{
            background: #00add7;
        }.green{
            background: #00A65A;
        }.darkred{
            background: #F56954;
        }
    </style>
@endsection
@extends("master")
@section('title_area')
    ::  মানি রিসিপ্ট(ডোনার) তথ্য ::

@endsection
@section('show_message')
    {{ Session::get('message') }}
@endsection
@section('main_content_area')
    <div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> রিসিপ্ট</h2>
                <button onclick="window.history.back()"  class="btn btn-danger btn-xs header-button"  ><i class="glyphicon glyphicon-backward"></i>
                    Back
                </button>
                {{--<button type='button'  class="btn btn-primary btn-xs header-button"  onclick="print_current_page()"><i class="glyphicon glyphicon-print" ></i> Print</button>--}}
            </header>

            <!-- widget div-->
            <div class="printable">
                <div class="widget-body no-padding">
                    <div class="col-sm-12" style="min-height:500px;">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col-sm-4">
                                <h4 class="semi-bold"> চাঁনখোলা দরবেশ সাহেব ওয়াকফ স্টেট</h4>
                                <address>
                                    <strong>কবির হাঠ, নোয়াখালি, বাংলাদেশ</strong>
                                    <br>
                                    ব্যাংক মার্কেট
                                    <br>
                                    <span>মোবাইল: ০১৮৩০০০০০,ইমেল: info@cdswe.com</span>
                                </address>
                            </div>


                            <div class="col-sm-3" style="padding-top:30px;">
                                <div class="well well-sm  bg-color-darken txt-color-white no-border" style="border-radius:10px;padding-top:12px;padding-bottom:10px;width:80%;">
                                    <div class="fa-lg text-center">
                                        <?php
                                        if($receipt_info[0]->record_type==1){
                                            echo "রশিদের মাধ্যমে আদায়";
                                        }elseif($receipt_info[0]->record_type==2){
                                            echo "দান বাক্স হতে আদায়";
                                        }elseif($receipt_info[0]->record_type==3){
                                            echo "ব্যাংক হতে আদায়";
                                        }elseif($receipt_info[0]->record_type==4){
                                            echo "অন্যান্য মাধ্যমে আদায়";
                                        }
                                        elseif($receipt_info[0]->record_type==5){
                                            echo "ক্যাশ হতে প্রদান";
                                        }
                                        elseif($receipt_info[0]->record_type==6){
                                            echo "ব্যাংকের মাধ্যমে প্রদান";
                                        }

                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-offset-1 col-sm-4">
                                <div>
                                    <div class="col-sm-6 text-right"  ><strong>রিসিপ্ট নং :</strong></div>
                                <div class="col-sm-6" ><span class="pull-right"> <?php echo $receipt_info[0]->transaction_id  ?></span></div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="font-md" style="background-color: green;">
                                    <div class="col-sm-6 text-right"  ><strong>রিসিপ্ট তারিখ :</strong></div>
                                    <div class="col-sm-6 "  >
                                        <span class="pull-right">  <?php echo date('d-m-Y',strtotime($receipt_info[0]->record_date));  ?> </span>
                                    </div>
                                </div>
                                 <div class="font-md" style="background-color: green;">
                                    <div class="col-sm-6 text-right"  ><strong>রিসিপ্টকারী :</strong></div>
                                    <div class="col-sm-6 "  >
                                        <span class="pull-right">  <?php echo $receipt_info[0]->received_by;  ?> </span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br>
                                <div class="well well-sm  bg-color-darken txt-color-white no-border">
                                    <div class="fa-lg">
                                        মোট টাকার পরিমান :
                                        <span class="pull-right"> <?php echo $receipt_info[0]->net_amount  ?> </span>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class=" col-sm-offset-4  col-sm-3">

                        </div>
                        <table id="dt_basic" class="table  table-bordered table-hover" width="100%">
                            {{--রশিদের মাধ্যমে আদায় ডোনারের--}}

                            <tr>
                                <th style="width:10px;">#</th>
                                <?php
                                if($receipt_info[0]->record_type==1){
                                ?>
                                    <th style="width:80px;">বই নং</th>
                                    <th style="width:80px;">রিসিপ্ট নং</th>
                                    <th style="width:150px;">ডোনারের নাম</th>
                                    <th style="width:150px;">খাত</th>
                                <?php }else  if($receipt_info[0]->record_type==2){ ?>
                                    <th  style="width:150px;">বাক্স নং</th>
                                    <th  style="width:150px;">কালেকটেট</th>
                                    <th  style="width:150px;">সাক্ষী</th>
                                 <?php }else  if($receipt_info[0]->record_type==3){ ?>
                                    <th  style="width:150px;">ব্যাংক</th>
                                    <th  style="width:150px;">একাউন্ট নং</th>
                                    <th  style="width:150px;">চেক নং</th>
                                <?php }else  if($receipt_info[0]->record_type==5){ ?>
                                    <th  style="width:150px;">ভাউচার নং</th>
                                    <th  style="width:150px;">গ্রহনকারী নাম</th>
                                    <th  style="width:150px;">খাত</th>
                              <?php }else  if($receipt_info[0]->record_type==6){ ?>
                                    <th  style="width:150px;">ব্যাংক</th>
                                    <th  style="width:150px;">ভাউচার নং</th>
                                    <th  style="width:150px;">গ্রহনকারী নাম</th>
                                    <th  style="width:150px;">খাত</th>
                                <?php } ?>


                                <th style="width:100px;">নোট</th>
                                <th class="text-right" style="width:90px;">টাকার পরিমান</th>

                            </tr>
                            {{--{{ $receipt_info }}--}}
                            @foreach($receipt_info as $key=>$singleData)
                                <tr>
                                    <td> {{ $key+1 }}</td>
                                    <?php
                                    if($receipt_info[0]->record_type==1){
                                    ?>
                                    {{-- todo: money receipt Donar--}}
                                        <td> {{ $singleData->book_no }}</td>
                                        <td> {{ $singleData->receipt_no }}</td>
                                        <td> {{ $singleData->name }}</td>
                                        <td> {{ $singleData->chart_of_acc_name }}</td>
                                    <?php }else  if($receipt_info[0]->record_type==2){ ?> {{-- todo: Donation Box--}}
                                    <td > {{ $singleData->chart_of_acc_name }}</td>
                                    <td > {{ $singleData->collector_name }}</td>
                                    <td > {{ $singleData->withness_name }}</td>
                                     <?php }else  if($receipt_info[0]->record_type==3){ ?> {{-- todo: bank receipt --}}
                                    <td > {{ $singleData->chart_of_acc_name }}</td>
                                    <td > {{ $singleData->account_no }}</td>
                                    <td > {{ $singleData->cheque_no }}</td>

                                    <?php }else  if($receipt_info[0]->record_type==5){ ?> {{-- todo: bank receipt --}}

                                    <td > {{ $singleData->vouchar_no }}</td>
                                    <td > {{ $singleData->payeeName }}</td>
                                    <td > {{ $singleData->expense_chart_of_acc_name }}</td>

                                    <?php }else  if($receipt_info[0]->record_type==6){ ?> {{-- todo: bank receipt --}}

                                    <td > {{ $singleData->bank_name }}</td>
                                    <td > {{ $singleData->vouchar_no }}</td>
                                    <td > {{ $singleData->payeeName }}</td>
                                    <td > {{ $singleData->expense_chart_of_acc_name }}</td>

                                    <?php } ?>


                                    <td> {{ $singleData->note }}</td>
                                    <td class="text-right"> {{ $singleData->amount }}</td>
                                </tr>

                            @endforeach



                            <tr>
                                <th <?php  if($receipt_info[0]->record_type==1 || $receipt_info[0]->record_type==6){ ?> colspan="6" <?php }else{ ?> colspan="5" <?php } ?> class="text-right">মোট টাকার পরিমান</th>
                                <th class="text-right" ><?php echo $receipt_info[0]->net_amount  ?></th>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>

    </div>
    <script>
        function print_current_page()
        {
            window.print();

        }
    </script>
    <style>
        @media print {
            body * {
                display:none;
            }

            .printable {
                display:block !important;
            }
        }
    </style>

@endsection
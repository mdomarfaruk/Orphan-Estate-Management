@extends("master")
@section('title_area')
    ::   মানি রিসিপ্ট (দান বাক্স) তথ্য ::

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
                    <h2>মানি রিসিপ্ট (দান বাক্স) তথ্য</h2>
                    <a href="<?php echo asset('/donation_box_receipt') ?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                        নতুন যোগ করুন
                    </a>
                </header>


                <div>
                    <div class="widget-body no-padding">

                        <div class="col-sm-12">
                            <div class="col-sm-12" style="margin-top:10px;"></div>

                            <table id="student_data" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th data-class="expand"> তারিখ</th>
                                    <th data-class="expand"> রিসিপ্ট নং</th>
                                    <th data-class="expand"> রিসিপ্টকারী</th>
                                    <th data-class="expand"> টাকার পরিমান</th>
                                    <th data-hide="phone,tablet" style="width:80px;"> #</th>

                                </tr>
                                </thead>
                                <tbody>


                                                      <!-- table body -->
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            var dtTable = $("#student_data").DataTable({
                "processing": true,
                "serverSide": true,
                "dataType": 'json',
                "ajax": "{{ route('ajaxdata.getdata') }}",
                "columns":[
                    { "data": "record_date" },
                    { "data": "transaction_id" },
                    { "data": 'receipt_name',name:'users.name' },
                    { "data": "net_amount" },
                    { "data": "action", orderable:false, searchable: false}
                ],
                responsive: true
            });
        });

    </script>
    <!-- Modal -->

@endsection
@extends("master")
@section('title_area')
    :: ব্যাংকে তথ্য   ::

@endsection
@section('show_message')
    {{ Session::get('message') }}
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>ব্যাংকে তথ্য  </h2>

                <button type="button"data-toggle="modal" onclick="addData()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    নতুন যোগ করুন
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>


                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> নাম</th>
                                <th> একাউন্ট নং</th>
                                <th> ব্যাক ঠিকানা</th>
                                <th> স্বাক্ষরকারীর নাম</th>
                                <th> স্বাক্ষরকারীর ঠিকানা</th>
                                <th> স্বাক্ষরকারীর টেলিফোন</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                                $i=1;
//                                echo "<pre>";
//                                print_r($bank_data);
                            ?>
                            @foreach($bank_data as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ $singleData->name  }}</td>
                                    <td>  {{ $singleData->account_no  }}</td>
                                    <td>  {{ $singleData->bank_address  }}</td>
                                    <td>  {{ $singleData->author_name  }}</td>
                                    <td>  {{ $singleData->author_address  }}</td>
                                    <td>  {{ $singleData->author_telephone  }}</td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateData('{{ $singleData->id }}','{{ $singleData->name }}','{{ $singleData->account_no }}','{{ $singleData->bank_address }}','{{ $singleData->author_name }}','{{ $singleData->author_address }}','{{ $singleData->author_telephone }}','{{ $singleData->acc_chart_of_account_id }}')" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="{{ url('/bank_info/delete_bank_info/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                    {{ $bank_data->links() }}
                                </td>
                                <td colspan="3" style="text-align:right;">
                                    Showing {{ $bank_data->firstItem() }}- {{ $bank_data->lastItem() }} from {{ $bank_data->count() }} Item
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>

        function addData() {

            $("#bank_name").val('');
            $("#acc_no").val('');
            $("#bank_address").val('');
            $("#author_name").val('');
            $("#author_address").val('');
            $("#author_telphone").val('');
            $("#setting_id").val('');
        }
        function updateData(id,name,account_no,address,author_name,author_address,author_mobile,chart_of_acc_id) {

            $("#bank_name").val(name);
            $("#acc_no").val(account_no);
            $("#bank_address").val(address);
            $("#author_name").val(author_name);
            $("#author_address").val(author_address);
            $("#author_telphone").val(author_mobile);
            $("#setting_id").val(id);
            $("#chart_of_acc_id").val(chart_of_acc_id);
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ডিপার্টমেন্টের  তথ্য</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '/bank_info/bank_save', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">ব্যাংক নাম</label>
                            <div class="col-md-10">
                                <input type="text"  id="bank_name" class="form-control" placeholder="ব্যাংক নাম" required value="" name="bank_name"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">একাউন্‌ট নং</label>
                            <div class="col-md-10">
                                <input type="text"  id="acc_no" class="form-control" placeholder="একাউন্‌ট নং" required value="" name="acc_no"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-10">
                                <textarea  id="bank_address" class="form-control" placeholder="ঠিকানা" required value="" name="bank_address"></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">স্বাক্ষরকারীর তথ্য</div>

                        </div>

                         <div class="form-group">
                            <label class="col-md-2 control-label">নাম</label>
                            <div class="col-md-10">
                                <input type="text"  id="author_name" class="form-control" placeholder="নাম" required value="" name="author_name"/>

                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-10">
                                <textarea  id="author_address" class="form-control" placeholder="ঠিকানা" required value="" name="author_address"></textarea>

                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">টেলিফোন </label>
                            <div class="col-md-10">
                                <input type="text"  id="author_telphone" class="form-control" placeholder="টেলিফোন" required value="" name="author_telphone"/>

                            </div>
                        </div>






                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <input type="hidden" name="setting_id" id="setting_id">
                    <input type="hidden" name="chart_of_acc_id" id="chart_of_acc_id">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


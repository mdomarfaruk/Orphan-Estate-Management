@extends("master")
@section('title_area')
    :: ডোনেশান বাক্স তথ্য  ::

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
                <h2>ডোনেশান বাক্স তথ্য </h2>

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
                                <th> বাক্স টাইপ</th>
                                <th> বাক্স নং</th>
                                <th> বাক্স ঠিকানা</th>
                                <th> তত্ত্বাবধায়ক</th>
                                <th> সংস্থাপন তারিখ</th>
                                <th> নোট</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
                            ?>
                            @foreach($donar_data as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ ($singleData->box_type==1)?"বড় দান বাক্স":"ছোট দান বাক্স"  }}</td>
                                    <td>  {{ $singleData->box_no  }}</td>
                                    <td>  {{ $singleData->box_location  }}</td>
                                    <td>  {{ $singleData->custodian_name  }}</td>
                                    <td>  {{ $singleData->established_date  }}</td>
                                    <td>  {{ $singleData->note  }}</td>

                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick='updateData("{{ $singleData->id }}","{{ $singleData->box_no }}","{{ $singleData->established_date }}","{{ $singleData->box_type }}"," {{ $singleData->acc_chart_of_account_id }}" )' class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="{{ url('/delete_donation_box/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                    {{ $donar_data->links() }}
                                </td>
                                <td colspan="2" style="text-align:right;">
                                    Showing {{ $donar_data->firstItem() }}- {{ $donar_data->lastItem() }} from {{ $donar_data->count() }} Item
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
            $("#donar_box_type").val('');
            $("#donar_box_no").val('');
            $("#donar_box_location").val('');
            $("#custodian").val('');
            $("#estabilshDate").val('');
            $("#about_note_donation_box").val('');
            $("#setting_id").val('');
            $("#updateBtn").hide();
            $("#saveBtn").show();
        }
        function updateData(id,box_no,estabishDate,box_type,chart_of_acc) {

            $("#donar_box_type").val(box_type);
            $("#donar_box_no").val(box_no);
            $("#estabilshDate").val(estabishDate);
            $("#chart_of_acc").val(chart_of_acc);
            $("#setting_id").val(id);

            $.ajax({
                type: "POST",
                url: "<?php  echo url('/get_single_box_info');?>",
                data: {id: id},
                'dataType' : 'json',
                success: function(response) {
                    $("#about_note_donation_box").val(response.note);
                    $("#donar_box_location").val(response.box_location);
                    $("#custodian").val(response.custodian_name);
                }
            });

            $("#updateBtn").show();
            $("#saveBtn").hide();
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ডোনেশান বাক্স  তথ্য</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '/donation_box/donation_box_save', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label"> বাক্স টাইপ</label>
                            <div class="col-md-10">
                                <select type="text"  id="donar_box_type" class="form-control" required name="donar_box_type">
                                    <option value="">চিহ্নিত করুন</option>
                                    <option value="1">বড় দান বাক্স</option>
                                    <option value="2">ছোট দান বাক্স</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"> বাক্স নং</label>
                            <div class="col-md-10">
                                <input type="text"  id="donar_box_no" class="form-control" placeholder="ডোনেশান বাক্স নং" required value="" name="donar_box_no"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"> বাক্স ঠিকানা</label>
                            <div class="col-md-10">
                                <textarea  id="donar_box_location" class="form-control" placeholder="ডোনেশান বাক্স ঠিকানা" required value="" name="donar_box_location"></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">তত্ত্বাবধায়ক </label>
                            <div class="col-md-10">
                                <input type="text"  id="custodian" class="form-control" placeholder="তত্ত্বাবধায়ক" required value="" name="custodian"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">সংস্থাপন তারিখ
                            </label>
                            <div class="col-md-10">
                                <input type="text"  id="estabilshDate" class="form-control datepickerLong" placeholder="সংস্থাপন তারিখ" readonly required value="" name="estabilshDate"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">নোট</label>
                            <div class="col-md-10">
                                <textarea  id="about_note_donation_box" class="form-control" placeholder="নোট"  value="" name="about_note_donation_box"></textarea>

                            </div>
                        </div>







                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">

                    <button type="submit" name="saveBtn" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save </button>
                    <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">
                    <input type="hidden" name="chart_of_acc" id="chart_of_acc">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('fontView') }}/assets/js/jquery-1.12.4.js"></script>
    <script>
        $( function() {
            $('.datepickerLong').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
            }).val();
            $('.datepicker').datepicker({
                dateFormat: 'dd-mm-yy',

            }).val();

        } );
    </script>
@endsection


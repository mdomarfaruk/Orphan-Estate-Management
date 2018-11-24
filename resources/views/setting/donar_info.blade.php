@extends("master")
@section('title_area')
    :: ডোনারের তথ্য  ::

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
                <h2>ডোনারের তথ্য </h2>

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
                                <th> মোবাইল</th>
                                <th> ই-মেইল</th>
                                <th> ঠিকানা</th>
                                <th> নোট</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($donar_data as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ $singleData->name  }}</td>
                                    <td>  {{ $singleData->mobile  }}</td>
                                    <td>  {{ $singleData->email  }}</td>
                                    <td>  {{ $singleData->address  }}</td>
                                    <td>  {{ $singleData->note  }}</td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateData('{{ $singleData->id }}','{{ $singleData->name }}','{{ $singleData->mobile }}','{{ $singleData->email }}','{{ $singleData->address }}','{{ $singleData->note }}')" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="{{ url('/donar/delete_donar/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
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
            $("#title").val('');
            $("#setting_id").val('');
            $("#updateBtn").hide();
            $("#saveBtn").show();
        }
        function updateData(id,name,mobile,email,address,note) {
            $("#donar_name").val(name);
            $("#donar_address").val(address);
            $("#donar_email").val(email);
            $("#donar_mobile").val(mobile);
            $("#about_note_donar").val(note);
            $("#setting_id").val(id);

            $("#updateBtn").show();
            $("#saveBtn").hide();
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ডোনারের  তথ্য</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '/donar/donar_save/', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">নাম</label>
                            <div class="col-md-10">
                                <input type="text"  id="donar_name" class="form-control" placeholder="নাম" required value="" name="donar_name"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-10">
                                <textarea  id="donar_address" class="form-control" placeholder="ঠিকানা" required value="" name="donar_address"></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">মোবাইল </label>
                            <div class="col-md-10">
                                <input type="text"  id="donar_mobile" class="form-control" placeholder="মোবাইল" required value="" name="donar_mobile"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ই-মেল </label>
                            <div class="col-md-10">
                                <input type="text"  id="donar_email" class="form-control" placeholder="ই-মেল" required value="" name="donar_email"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">নোট</label>
                            <div class="col-md-10">
                                <textarea  id="about_note_donar" class="form-control" placeholder="নোট" required value="" name="about_note_donar"></textarea>

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
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


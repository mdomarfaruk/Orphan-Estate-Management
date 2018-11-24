@extends("master")
@section('title_area')
    ::  কর্মচারীর তথ্য ::

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
                <h2>কর্মচারীর তথ্য</h2>
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
                                <th data-hide="phone">SL</th>
                                <th data-hide="phone">ছবি</th>
                                <th data-class="expand"> আই ডি নং</th>
                                <th data-class="expand"> নাম ইংরেজী</th>
                                <th data-class="expand"> নাম বাংলা</th>
                                <th data-class="expand">ডেজিগনেশন</th>
                                <th data-class="expand"> ডিপার্টমেন্ট</th>
                                <th data-class="expand"> মাসিক বেতন</th>
                                <th data-class="expand"> যোগদান</th>

                                <th data-hide="phone,tablet"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($staff_data as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>
                                        @if(file_exists( public_path().'/images/staff_image/'.$singleData->photo ) && $singleData->photo!='' )
                                            <img src=" {{ url('images/staff_image/'.$singleData->photo)   }}" style="height: 50px;width:50px;">
                                        @else
                                            <img src=" {{ url('images/default/default-avatar.png')   }}" style="height: 50px;width:50px;">
                                        @endif
                                    </td>
                                    <td>  {{ $singleData->staff_id  }}</td>
                                    <td>  {{ $singleData->name_eng  }}</td>
                                    <td>  {{ $singleData->name_bng  }}</td>
                                    <td>  {{ $singleData->designation_title  }}</td>
                                    <td>  {{ $singleData->department_title  }}</td>
                                    <td>  {{ $singleData->salary  }}</td>
                                    <td>  {{ $singleData->join_date  }}</td>
                                    <td>
                                        <button type="button"data-toggle="modal" onclick="updateData('{{ $singleData->id  }}')" title="Edit" data-target="#exampleModal" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-pencil"></i> </button>
                                        <a href="{{ url('/staff_info/delete_staff_info/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                    {{ $staff_data->links() }}
                                </td>
                                <td colspan="4" style="text-align:right;">
                                    Showing {{ $staff_data->firstItem() }}- {{ $staff_data->lastItem() }} from {{ $staff_data->count() }} Item
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
            $("#setting_id").val('');
            $("#name_eng").val('');
            $("#name_bng").val('');
            $("#father_name").val('');
            $("#mother_name").val('');
            $("#mobile_no").val('');
            $("#join_date").val('');
            $("#bith_date").val('');
            $("#address").val('');
            $("#department").val('');
            $("#designation").val('');
            $("#old_image").val('');
            $("#monthly_salary").val('');
        }
        function updateData(id) {
            $("#setting_id").val(id);
            $.ajax({
                type: "POST",
                url: "<?php  echo url('/staff_info/get_single_staff_info/');?>",
                data: {title: id},
                'dataType' : 'json',
                success: function(response) {
                    $("#name_eng").val(response.name_eng);
                    $("#name_bng").val(response.name_bng);
                    $("#father_name").val(response.father_name);
                    $("#mother_name").val(response.mother_name);
                    $("#mobile_no").val(response.mobile_no);
                    $("#join_date").val(response.join_date);
                    $("#bith_date").val(response.birth_date);
                    $("#address").val(response.address);
                    $("#department").val(response.department_id);
                    $("#designation").val(response.designation_id);
                    $("#old_image").val(response.photo);
                    $("#monthly_salary").val(response.salary);
                }
            });

        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-11">
                        <h5 class="modal-title" id="exampleModalLabel">কর্মচারীর তথ্য</h5>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {!! Form::open(['url' => '/staff_info/save', 'method' => 'post','class'=>'form-horizontal','files' => true,'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">
                        <div class="form-group">
                        <label class="col-md-2 control-label">নাম (ইংরেজী) </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="নাম (ইংরেজী) " required id="name_eng"  name="name_eng"/>
                        </div>
                        <label class="col-md-2 control-label">নাম (বাংলা) </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="নাম (বাংলা) " required id="name_bng"  name="name_bng"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">বাবার নাম</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="বাবার নাম " required value="" id="father_name" name="father_name"/>
                        </div>
                        <label class="col-md-2 control-label">মায়ের নাম </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="মায়ের নাম " required value="" id="mother_name" name="mother_name"/>
                        </div>
                    </div>

                    <div class="form-group">


                        <label class="col-md-2 control-label">মোবাইল নং </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="মোবাইল নং " required value="" id="mobile_no" name="mobile_no"/>
                        </div>
                        <label class="col-md-2 control-label">যোগদানের তারিখ </label>
                        <div class="col-md-4">
                            <input type="text" readonly class="form-control datepickerLong" placeholder="চাকুরীতে যোগদানের তারিখ " required value="" id="join_date" name="join_date"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">ঠিকানা</label>
                        <div class="col-md-4">
                            <textarea class="form-control" placeholder="ঠিকানা" required value="" id="address" name="address"></textarea>
                        </div>
                        <label class="col-md-2 control-label">জম্ম তারিখ</label>
                        <div class="col-md-4">
                            <input type="text" readonly class="form-control datepickerLong" placeholder="জম্ম তারিখ"  id="bith_date"required value="" name="bith_date"/>

                        </div>

                    </div>
                        <div class="form-group">
                        <label class="col-md-2 control-label">ডিপার্টমেন্ট</label>
                        <div class="col-md-4">
                           <select name="department" id="department" class="form-control">
                               <option value="">চিহ্নিত করুন</option>
                               @if(!empty($department_info))
                                   @foreach ($department_info as $key => $value)
                                       <option value="{{ $key }}">{{ $value }}</option>
                                   @endforeach
                               @endif
                           </select>
                        </div>
                        <label class="col-md-2 control-label">ডেজিগনেশন</label>
                        <div class="col-md-4">
                            {{--{{ $designation_info }}--}}

                            <select name="designation" id="designation" class="form-control">
                                <option value="">চিহ্নিত করুন</option>
                                @if(!empty($designation_info))
                                    @foreach ($designation_info as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">ছবি</label>
                        <div class="col-md-4">
                            <input type="file" class="form-control"  value="" name="image"/>
                            <input type="hidden" id="old_image" name="old_image">
                        </div>
                        <label class="col-md-2 control-label">মাসিক বেতন</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="মাসিক বেতন " required value="" id="monthly_salary" name="monthly_salary"/>
                        </div>

                    </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-send"></i> Save</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>  Close</button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
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
@extends("master")
@section('title_area')
:: ইতেমের তথ্য এন্টি ::
@endsection
@section('main_content_area')
<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2>এতিমের তথ্য এন্টি</h2>
            <a href=" <?php  echo asset('/get_eatim_information');?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> এতিমের তথ্য</a>

        </header>

        <!-- widget div-->
        <div>
            <div class="widget-body no-padding">
                <div class="col-sm-12">
                    <div class="col-sm-12" style="margin-top:10px;"></div>
                    {{--<form class="form-horizontal">--}}
                        {!! Form::open(['url' => '/eatim_information/save', 'method' => 'post','class'=>'form-horizontal','files' => true,'enctype' => 'multipart/form-data']) !!}
                        {{--<header>Success states for elements</header>--}}
                        <div class="form-group">
                            <label class="col-md-2 control-label">নাম (ইংরেজী) </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="নাম (ইংরেজী) " required  name="name_eng"/>
                            </div>
                            <label class="col-md-2 control-label">নাম (বাংলা) </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="নাম (বাংলা) " required  name="name_bng"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">বাবার নাম</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="বাবার নাম " required value="" name="father_name"/>
                            </div>
                            <label class="col-md-2 control-label">মায়ের নাম </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="মায়ের নাম " required value="" name="mother_name"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">অভিবাবকের নাম</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="অভিবাবকের নাম " required value="" name="guardian_name"/>
                            </div>
                            <label class="col-md-2 control-label">মোবাইল নং </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="মোবাইল নং " required value="" name="mobile_no"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ঠিকানা</label>
                            <div class="col-md-4">
                                <textarea class="form-control" placeholder="ঠিকানা" required value="" name="address"></textarea>
                            </div>
                            <label class="col-md-2 control-label">জম্ম তারিখ</label>
                            <div class="col-md-4">
                                <input type="text"  class="form-control datepickerLong" placeholder="জম্ম তারিখ" required value="" name="bith_date"/>

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ছবি</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control"  value="" name="image"/>
                            </div>
                            <label class="col-md-2 control-label">ভর্তির তারিখ </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepickerLong" placeholder="ভর্তির তারিখ" required value="" name="admission_date"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-send"></i> Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.history.back();"><i class="glyphicon glyphicon-remove"></i>Clear</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</article>
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


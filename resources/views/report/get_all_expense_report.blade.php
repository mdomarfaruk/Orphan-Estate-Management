@extends("master")
@section('title_area')
    :: পেমেন্ট প্রদানের(খরচ) রিপোর্ট ::
@endsection
@section('main_content_area')
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                    <h2>পেমেন্ট প্রদানের(খরচ) রিপোর্ট</h2>
                </header>

                <!-- widget div-->
                <div>

                    <div id='loadingmessage' style='display:none;position: absolute;left:50%;top:-20px;'>
                        <img src='images/default/load-dribbble.gif' style="width: 100px !important;"/>
                    </div>

                    <div class="widget-body no-padding">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="margin-top:10px;"></div>
                            <div class="col-sm-12">
                                <div class="row">
                                    {!! Form::open(['url' => '/sarching_expense_month', 'method' => 'post','class'=>'form-horizontal']) !!}

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <select onchange="changeMonthRange()" required  name="month_info" id="month_info" class="form-control">
                                                <option value="">মাস চিহ্নিত  করুন</option>
                                                @if(!empty($monthly_opening))
                                                    @foreach ($monthly_opening as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="col-sm-offset-8 col-sm-1">
                                            <button type="submit" name="download_pdf" id="download_pdf" value="pdf" title="Dashboard" class="btn btn-primary btn-sm" style="display:none;"><i class="fa fa-lg fa-fw fa-download"></i> PDF</button>

                                        </div>
                                    </div>

                                    {!! Form::close() !!}
                                    <div id="show_response_info"></div>

                                </div>
                            </div>

                            <div class="clearfix"></div>



                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <script>
        function changeMonthRange() {
            $('#loadingmessage').show();
            $('#download_pdf').show();
            var monthId=$("#month_info").val();
            $.ajax({
                type: "POST",
                url: "<?php  echo url('/sarching_expense_month');?>",
                data: {month_info: monthId},
                success: function (response) {
                    $("#show_response_info").html(response);
                    $('#loadingmessage').hide();
                }
            });
        }
    </script>

@endsection


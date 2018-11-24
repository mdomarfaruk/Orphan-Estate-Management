@extends("master")
@section('title_area')
:: মানি রিসিপ্ট (দান বাক্স) এন্টি ::
@endsection
@section('main_content_area')
    <style>
        #default_table{
            display:none;
        }

    </style>
<div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>মানি রিসিপ্ট (দান বাক্স) এন্টি</h2>
                <a href=" <?php  echo asset('/get_money_receipt_donar');?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> মানি রিসিপ্ট (দান বাক্স) তথ্য</a>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-bordered" id="default_table">
                            <tr>
                                <td style="width:150px;">
                                    <select  type="text" placeholder="খাত" name="chart_off_acc[]" id="chart_off_acc"  style="width:150px;">
                                        <option value="">চিহ্নিত করুন</option>
                                        @if(!empty($head_info))
                                            @foreach ($head_info as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td><input type="text"  placeholder="কালেকট্টার" name="collected_by[]" id="collected_by" class="form-control"> </td>
                                <td><input type="text" placeholder="সাক্ষী"  name="withness[]" id="withness" class="form-control"> </td>

                                <td><textarea  placeholder="নোট"  name="note[]" class="form-control"></textarea>
                                </td>
                                <td><input type="text" placeholder="টাকার পরিমান"  id="totalprice"   onkeyup="findTotals()"   name="amount[]" class="form-control totalprice onlyNumber"> </td>
                                <td>
                                    <button type="button" name="addBtn"  onclick="addPackageService()" class="btn btn-primary btn-sm add_btn"  title="Add"><i class="glyphicon glyphicon-plus"></i> </button>

                                    <button type="button" onclick="remove_service_package(this);"
                                            class="btn btn-danger btn-sm drop_btn"><i class="fa fa-minus"></i>
                                    </button>
                                </td>

                            </tr>
                        </table>
                            {!! Form::open(['url' => '/save_donation_box_receipt', 'method' => 'post','class'=>'form-horizontal']) !!}

                            <div class="form-group">
                                <div class="col-md-7"></div>
                                <label class="col-md-2 control-label">রিসিপ্ট তারিখ</label>
                                <div class="col-md-3">
                                    <input type="text"  class="form-control datepickerLong" placeholder="রিসিপ্ট তারিখ" id="receipt_date" value="<?php echo date('d-m-Y'); ?>" readonly required value="" name="receipt_date"/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">

                                    <table class="table table-bordered">
                                        <tr>
                                        <td style="width:150px;">বাক্স নং</td>
                                        <td style="width:150px;">কালেকটেট</td>
                                        <td style="width:150px;">সাক্ষী</td>
                                        <td style="width:150px;">নোট</td>
                                        <td style="width:150px;">টাকার পরিমান</td>
                                        <td style="width:80px;">#</td>

                                        </tr>
                                        <tbody id="tableDynamic">
                                        <tr>
                                            <td style="width:150px;">
                                                <select  type="text" placeholder="খাত" name="chart_off_acc[]" id="chart_off_acc"  class="select2" >
                                                    <option value="">চিহ্নিত করুন</option>
                                                    @if(!empty($head_info))
                                                        @foreach ($head_info as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td><input type="text"  placeholder="কালেকট্টার" name="collected_by[]" id="collected_by" class="form-control"> </td>
                                            <td><input type="text" placeholder="সাক্ষী"  name="withness[]" id="withness" class="form-control"> </td>

                                            <td><textarea  placeholder="নোট"  name="note[]" class="form-control"></textarea>
                                            </td>
                                            <td><input type="text" placeholder="টাকার পরিমান"  id="totalprice"   onkeyup="findTotals()"   name="amount[]" class="form-control totalprice onlyNumber"> </td>
                                            <td>
                                                <button type="button" name="addBtn"  onclick="addPackageService()" class="btn btn-primary btn-sm add_btn"  title="Add"><i class="glyphicon glyphicon-plus"></i> </button>

                                                <button type="button" onclick="remove_service_package(this);"
                                                        class="btn btn-danger btn-sm drop_btn"><i class="fa fa-minus"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        </tbody>


                                    </table>
                                    <div class="col-sm-9 text-right" style="font-weight:bold;padding-top:5px;">
                                        মোট টাকার পরিমান
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <input type="text" placeholder="মোট টাকার পরিমান" readonly name="subtotal" id="subtotal" class="form-control" style="width:100%;float:right">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" >
                                <div class="col-sm-offset-4 col-sm-8 text-right" style="margin-top:20px;">
                                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-send"></i> Save</button>
                                    <button type="reset" class="btn btn-danger" ><i class="glyphicon glyphicon-remove"></i>Clear</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
<script src="{{ asset('fontView') }}/assets/js/jquery-1.12.4.js"></script>
<script>
    $( function() {
        $('.datepickerLong').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        }).val();
    });

    function addPackageService() {
        var $tr = $("#default_table tr").eq(0),
            $new_tr = $tr.show().clone(),defaultDropdown = $("#default_table").html();
        $tr.hide();

        $new_tr.appendTo("#tableDynamic");
        $("table tr:last").prev().find("td:last-child>.add_btn").hide();
        $("table tr:last").prev().find("td:last-child>.drop_btn").show();
        $("select").addClass("select2");
        runAllForms(); // initialize select2
        $("#default_table").html(defaultDropdown); // restore default drop down

    }
    function remove_service_package(element) {
        element.parentNode.parentNode.remove();
        $("table tr:last").find("td:last-child>.add_btn").show();
        var rowCount = $('#tableDynamic tr').length;
        if(rowCount>1) {
            $("table tr:last").prev().find("td:last-child>.drop_btn").show();}
        else {
            $("table tr:last").find("td:last-child>.drop_btn").hide();
        }

    }

    function findTotals() {
        $("#tableDynamic tr").each(function () {
            row_total = 0;
            $("td .totalprice").each(function () {
                row_total += Number($(this).val());
            });
            var totalRow=row_total.toFixed(2);
            $("#subtotal").append().val(totalRow);
        });
    }





</script>
@endsection


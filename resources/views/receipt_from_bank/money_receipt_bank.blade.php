@extends("master")
@section('title_area')
    :: মানি রিসিপ্ট(ব্যাংক) এন্টি ::
@endsection
@section('main_content_area')
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                    <h2>মানি রিসিপ্ট(ব্যাংক) এন্টি</h2>
                    <a href=" <?php  echo asset('/get_money_receipt_donar');?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> মানি রিসিপ্ট(ব্যাংক) তথ্য</a>

                </header>

                <!-- widget div-->
                <div>
                    <div class="widget-body no-padding">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="margin-top:10px;"></div>
                            {{--<form class="form-horizontal">--}}
                            {!! Form::open(['url' => '/save_money_receipt_bank', 'method' => 'post','class'=>'form-horizontal']) !!}

                            <div class="form-group">
                                <div class="col-md-7"></div>
                                <label class="col-md-2 control-label">রিসিপ্ট তারিখ</label>
                                <div class="col-md-3">
                                    <input type="text"  class="form-control datepickerLong" placeholder="রিসিপ্ট তারিখ" id="receipt_date" value="<?php echo date('d-m-Y'); ?>" readonly required value="" name="receipt_date"/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <table class="table table-bordered" id="default_table">
                                        <thead>
                                        <tr>
                                            <th style="width:150px;">ব্যাংক </th>
                                            <th style="width:150px;">চেক নং</th>
                                            <th style="width:150px;">খাত/নোট</th>
                                            <th style="width:150px;">টাকার পরিমান</th>
                                            <th style="width:50px;">#</th>

                                        </tr>
                                        </thead>
                                        <tbody id="tableDynamic">
                                        <tr>
                                            <td>
                                                <select required  name="chart_off_acc[]"  id="chart_off_acc_1" class="form-control">
                                                    <option value="">চিহ্নিত করুন</option>
                                                    @if(!empty($bank_head_info))
                                                        @foreach ($bank_head_info as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td><input type="text" placeholder="চেক নং" id="check_no_1" required name="check_no[]" class="form-control"> </td>


                                            <td><textarea  placeholder="নোট"  name="note[]" class="form-control"></textarea>
                                            </td>
                                            <td><input type="text" placeholder="টাকার পরিমান" id="totalprice_1"  required onkeyup="findTotals()"   name="amount[]" class="form-control totalprice onlyNumber"> </td>
                                            <td>


                                            </td>

                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <button type="button" name="addBtn" id="addRow" class="btn btn-primary btn-sm add_btn"  title="Add"><i class="glyphicon glyphicon-plus"></i> Add </button>
                                            </td>
                                            <th colspan="2" style="text-align:right;">মোট টাকার পরিমান</th>
                                            <td colspan="2"><input type="text" placeholder="মোট টাকার পরিমান" readonly name="subtotal" id="subtotal" class="form-control"></td>
                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
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

        var scntDiv = $('#tableDynamic');
        var i = $('#tableDynamic tr').size() + 1;

        $('#addRow').on('click', function () {
            $('<tr><td><select required  name="chart_off_acc[]"  id="chart_off_acc_'+i+'" class="form-control">\n' +
                '                                                    <option value="">চিহ্নিত করুন</option>\n' +
                '                                                    @if(!empty($bank_head_info))\n' +
                '                                                        @foreach ($bank_head_info as $key => $value)\n' +
                '                                                            <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                                        @endforeach\n' +
                '                                                    @endif\n' +
                '                                                </select></td><td><input type="text" placeholder="চেক নং" id="check_no_'+ i +'" required name="check_no[]" class="form-control"></td><td><textarea placeholder="নোট"  name="note[]" class="form-control"></textarea></td><td><input type="text" placeholder="টাকার পরিমান"  name="amount[]" required  id="totalprice_'+ i +'"  class="form-control totalprice " keydown="onlyNumberFun(event)" onkeyup="findTotals()"> </td><td><a href="javascript:void(0);"  id="deleteRow_' + i + '"  class="deleteRow btn btn-danger btn-flat btn-sm"><i class="glyphicon glyphicon-trash"></i> </a></td></tr>').appendTo(scntDiv);
            i++;
            findTotals();
            return false;
        });

        $(document).on("click", ".deleteRow", function (e) {
            if ($('#tableDynamic tr').size() > 1) {
                var target = e.target;

                var id_arr = $(this).attr('id');
                var id = id_arr.split("_");
                var element_id = id[id.length - 1];
                var totalprice = parseFloat($("#totalprice_" + element_id).val());
                var subtotal = parseFloat($("#subtotal").val());

                if (!isNaN(totalprice)) {
                    var subToal=(subtotal - totalprice).toFixed(2);
                    $("#subtotal").val(subToal);

                }

                $(target).closest('tr').remove();
            }else{
                //alert('One row should be present in table');
            }
        });
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


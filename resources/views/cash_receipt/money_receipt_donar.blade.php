@extends("master")
@section('title_area')
    :: মানি রিসিপ্ট(ডোনার) এন্টি ::
@endsection
@section('main_content_area')
    <div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>মানি রিসিপ্ট(ডোনার) এন্টি</h2>
                <a href=" <?php  echo asset('/get_money_receipt_donar');?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> মানি রিসিপ্ট(ডোনার) তথ্য</a>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {{--<form class="form-horizontal">--}}
                        {!! Form::open(['url' => '/save_money_receipt_donar', 'method' => 'post','class'=>'form-horizontal']) !!}

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
                                        <td style="width:150px;">বই নং</td>
                                        <td style="width:150px;">রিসিপ্ট নং</td>
                                        <td style="width:150px;">ডোনারের নাম</td>
                                        <td style="width:150px;">খাত</td>
                                        <td style="width:150px;">নোট</td>
                                        <td style="width:150px;">টাকার পরিমান</td>
                                        <td style="width:50px;">#</td>

                                    </tr>
                                    </thead>
                                    <tbody id="tableDynamic">
                                    <tr>
                                        <td><input type="text" required placeholder="বই নং" name="book_no[]" id="book_no_1" class="form-control"> </td>
                                        <td><input type="text" placeholder="রিসিপ্ট নং" required name="receipt_no[]" class="form-control"> </td>
                                        <td>
                                            <select required placeholder="ডোনারের নাম" name="donar_name[]" class="form-control">
                                                <option value="">চিহ্নিত করুন</option>
                                                @if(!empty($donar_info))
                                                    @foreach ($donar_info as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </td>
                                        <td>
                                            <select required type="text" placeholder="খাত" name="donar_chart_off_acc[]"  class="form-control">
                                                <option value="">চিহ্নিত করুন</option>
                                                @if(!empty($donar_head_info))
                                                    @foreach ($donar_head_info as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td><textarea  placeholder="নোট"  name="note[]" class="form-control"></textarea>
                                        </td>
                                        <td><input type="text" placeholder="টাকার পরিমান" id="totalprice_1"  required onkeyup="findTotals()"   name="amount[]" class="form-control totalprice onlyNumber"> </td>
                                        <td>
                                            <button type="button" name="addBtn" id="addRow" class="btn btn-primary btn-sm add_btn"  title="Add"><i class="glyphicon glyphicon-plus"></i> </button>

                                        </td>

                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right;">মোট টাকার পরিমান</th>
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
            $('<tr><td><input type="text" required placeholder="বই নং" name="book_no[]" id="book_no_'+ i +'" class="form-control"></td><td><input type="text" placeholder="রিসিপ্ট নং" required name="receipt_no[]" class="form-control"></td><td><select placeholder="ডোনারের নাম" name="donar_name[]" required class="form-control">\n' +
                '                                                <option value="">চিহ্নিত করুন</option>\n' +
                '                                                @if(!empty($donar_info))\n' +
                '                                                    @foreach ($donar_info as $key => $value)\n' +
                '                                                        <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                                    @endforeach\n' +
                '                                                @endif\n' +
                '\n' +
                '                                            </select></td><td><select type="text" placeholder="খাত" name="donar_chart_off_acc[]" required class="form-control">\n' +
                '                                                <option value="">চিহ্নিত করুন</option>\n' +
                '                                                @if(!empty($donar_head_info))\n' +
                '                                                    @foreach ($donar_head_info as $key => $value)\n' +
                '                                                        <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                                    @endforeach\n' +
                '                                                @endif\n' +
                '                                            </select></td><td><textarea placeholder="নোট"  name="note[]" class="form-control"></textarea></td><td><input type="text" placeholder="টাকার পরিমান"  name="amount[]" required  id="totalprice_'+ i +'"  class="form-control totalprice " keydown="onlyNumberFun(event)" onkeyup="findTotals()"> </td><td><a href="javascript:void(0);"  id="deleteRow_' + i + '"  class="deleteRow btn btn-danger btn-flat btn-sm"><i class="glyphicon glyphicon-trash"></i> </a></td></tr>').appendTo(scntDiv);
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

        //
        // // add
        // function addPackageService() { // service item add operation
        //
        //     var $tr = $("#default_table tr").eq(0),
        //         $new_tr = $tr.show().clone(),defaultDropdown = $("#default_table").html();
        //     $tr.hide();
        //
        //     $new_tr.appendTo("#tableDynamic");
        //
        //     $("table tr:last").prev().find("td:last-child>.add_btn").hide();
        //     $("table tr:last").prev().find("td:last-child>.drop_btn").show();
        //     // $("select").addClass("select2");
        //     runAllForms(); // initialize select2
        //     $("#default_table").html(defaultDropdown); // restore default drop down
        //
        // }
        //
        // //remove
        //
        // function remove_service_package(element) {
        //
        //     element.parentNode.parentNode.remove(); // remove clicked row
        //
        //     $("table tr:last").find("td:last-child>.add_btn").show(); // show add button inside the last row after remove
        //
        //     var rowCount = $('#service_div tr').length;
        //
        //     if(rowCount>1) {
        //         $("table tr:last").prev().find("td:last-child>.drop_btn").show(); // show  all remove button before the last row
        //     }
        //     else {
        //         $("table tr:last").find("td:last-child>.drop_btn").hide(); // hide remove button inside the first row when row is single
        //     }
        //
        // }


    </script>
@endsection


@extends("master")
@section('title_area')
    :: পেমেন্ট(ক্যাশ পেমেন্ট) এন্টি ::
@endsection
@section('main_content_area')
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                    <h2>পেমেন্ট(ক্যাশ পেমেন্ট) এন্টি</h2>
                    <a href=" <?php  echo asset('/get_payment_cash');?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> পেমেন্ট(ক্যাশ পেমেন্ট) তথ্য</a>

                </header>

                <!-- widget div-->
                <div>
                    <div class="widget-body no-padding">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="margin-top:10px;"></div>
                            {!! Form::open(['url' => '/save_payment_cash', 'method' => 'post','class'=>'form-horizontal']) !!}

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
                                            <th style="width:150px;">ভাউচার নং</th>
                                            <th style="width:150px;">গ্রহনকারী নাম</th>
                                            <th style="width:150px;">খাত</th>
                                            <th style="width:150px;">নোট</th>
                                            <th style="width:150px;">টাকার পরিমান</th>
                                            <th style="width:50px;">#</th>

                                        </tr>
                                        </thead>
                                        <tbody id="tableDynamic">
                                        <tr>

                                            <td><input type="text" placeholder="ভাউচার নং" required name="vouchar_no[]" id="vouchar_no_1" class="form-control"> </td>
                                            <td>
                                                <input type="text" required placeholder="গ্রহনকারী নাম" id="payee_name_1" name="payee_name[]" class="form-control">

                                            </td>
                                            <td>
                                                <select required type="text" placeholder="খাত" name="chart_off_acc[]"  class="form-control">
                                                    <option value="">চিহ্নিত করুন</option>
                                                    @if(!empty($expense_head_info))
                                                        @foreach ($expense_head_info as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td><textarea  placeholder="নোট"  name="note[]" class="form-control"></textarea>
                                            </td>
                                            <td><input type="text" placeholder="টাকার পরিমান" id="totalprice_1"  required onkeyup="findTotals()"   name="amount[]" class="form-control totalprice onlyNumber"> </td>
                                            <td>


                                            </td>

                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th> <button type="button" name="addBtn" id="addRow" class="btn btn-primary btn-sm add_btn"  title="Add"><i class="glyphicon glyphicon-plus"></i> Add</button></th>
                                            <th colspan="3" style="text-align:right;">মোট টাকার পরিমান</th>
                                            <td colspan="2"><input type="text" placeholder="মোট টাকার পরিমান" readonly name="subtotal" id="subtotal" class="form-control"></td>
                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class=" col-sm-12 text-right">
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
            $('<tr><td><input type="text" required placeholder="ভাউচার নং" name="vouchar_no[]" id="vouchar_no_'+ i +'" class="form-control"></td><td><input type="text" required placeholder="গ্রহনকারী নাম" id="payee_name_'+ i + '" name="payee_name[]" class="form-control"></td><td><select required type="text" placeholder="খাত" name="chart_off_acc[]"  class="form-control">\n' +
                '                                                    <option value="">চিহ্নিত করুন</option>\n' +
                '                                                    @if(!empty($expense_head_info))\n' +
                '                                                        @foreach ($expense_head_info as $key => $value)\n' +
                '                                                            <option value="{{ $key }}">{{ $value }}</option>\n' +
                '                                                        @endforeach\n' +
                '                                                    @endif\n' +
                '                                                </select></td><td><textarea placeholder="নোট"  name="note[]" class="form-control"></textarea></td><td><input type="text" placeholder="টাকার পরিমান"  name="amount[]" required  id="totalprice_'+ i +'"  class="form-control totalprice " keydown="onlyNumberFun(event)" onkeyup="findTotals()"> </td><td><a href="javascript:void(0);"  id="deleteRow_' + i + '"  class="deleteRow btn btn-danger btn-flat btn-sm"><i class="glyphicon glyphicon-trash"></i> </a></td></tr>').appendTo(scntDiv);
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


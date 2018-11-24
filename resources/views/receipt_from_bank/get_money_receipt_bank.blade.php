@extends("master")
@section('title_area')
    ::  মানি রিসিপ্ট(ব্যাংক) তথ্য ::

@endsection
@section('show_message')
    {{ Session::get('message') }}
@endsection
@section('main_content_area')
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                    <h2>মানি রিসিপ্ট(ব্যাংক) তথ্য</h2>
                    <a href="<?php echo asset('/money_receipt_bank') ?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                        নতুন যোগ করুন
                    </a>
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
                                    <th data-class="expand"> তারিখ</th>
                                    <th data-class="expand"> রিসিপ্ট নং</th>
                                    <th data-class="expand"> রিসিপ্টকারী</th>
                                    <th data-class="expand"> টাকার পরিমান</th>
                                    <th data-hide="phone,tablet" style="width:80px;"> #</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($cash_receipt_info as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ date('d-m-Y', strtotime($singleData->record_date))   }}</td>
                                        <td>  {{ $singleData->transaction_id  }}</td>

                                        <td>  {{ $singleData->receipt_name  }}</td>
                                        <td>  {{ $singleData->net_amount  }}</td>
                                        <td>
                                            <a href="<?php echo url('single_receipt_view/'.$singleData->id ); ?>"  title="View" data-target="#exampleModal" class="btn btn-info btn-xs" ><i class="glyphicon glyphicon-share-alt"></i> </a>
                                            {{--<button type="button"data-toggle="modal" onclick="updateData('{{ $singleData->id  }}')" title="Edit" data-target="#exampleModal" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-pencil"></i> </button>--}}
                                            <a href="{{ url('/delete_money_receipt_bank/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                        {{ $cash_receipt_info->links() }}
                                    </td>
                                    <td colspan="2" style="text-align:right;">
                                        Showing {{ $cash_receipt_info->firstItem() }}- {{ $cash_receipt_info->lastItem() }} from {{ $cash_receipt_info->total() }} Item
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>


    <!-- Modal -->

@endsection
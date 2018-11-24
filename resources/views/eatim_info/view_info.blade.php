@extends("master")
@section('title_area')
    :: এতিমের তথ্য ::

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
                <h2>এতিমের তথ্য </h2>
                <a href="<?php echo asset('add_eatim_information') ?>" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i> নতুন এতিমের তথ্য এন্টি</a>

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
                            <th data-class="expand"> বাবার নাম</th>
                            <th data-class="expand"> মায়ের নাম</th>
                            <th data-class="expand"> অভিবাভকের নাম</th>
                            <th data-class="expand"> জম্ম তারিখ</th>
                            <th data-class="expand"> ভর্তির তারিখ</th>

                            <th data-hide="phone,tablet"> #</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($etim_data as $singleData)
                        <tr>
                            <td>  {{ $i++  }}</td>
                            <td>

                                @if(file_exists( public_path().'/images/orphan_image/'.$singleData->photo ) && $singleData->photo!='')
                                    <img src=" {{ url('images/orphan_image/'.$singleData->photo)   }}" style="height: 50px;width:50px;">
                                @else
                                    <img src=" {{ url('images/default/default-avatar.png')   }}" style="height: 50px;width:50px;">
                                @endif

                            </td>
                            <td>  {{ $singleData->orphan_id  }}</td>
                            <td>  {{ $singleData->name_eng  }}</td>
                            <td>  {{ $singleData->name_bng  }}</td>
                            <td>  {{ $singleData->father_name  }}</td>
                            <td>  {{ $singleData->mother_name  }}</td>
                            <td>  {{ $singleData->gardian_name  }}</td>
                            <td>  {{ $singleData->birth_date  }}</td>
                            <td>  {{ $singleData->admission_date  }}</td>
                            <td>
                                <a href="{{ url('eatim_information/edit/'. $singleData->id  ) }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i> </a>
                                <a href="{{ url('eatim_information/delete/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                    {{ $etim_data->links() }}
                                </td>
                                <td colspan="3" style="text-align:right;">
                                    Showing {{ $etim_data->firstItem() }}- {{ $etim_data->lastItem() }} from {{ $etim_data->count() }} Item
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@extends("master")
@section('title_area')
    :: ডিপার্টমেনট তথ্য  ::

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
                <h2>ডিপার্টমেনট তথ্য </h2>

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
                                <th> টাইটেল</th>
                                <th style="width: 20%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($department as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ $singleData->title  }}</td>
                                    <td>
                                        {{--<a href="{{ url('eatim_information/edit/'. $singleData->id  ) }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i> </a>--}}
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateData('{{ $singleData->id }}','{{ $singleData->title }}')" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="{{ url('/designation/delete_department/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" style="padding-top:0px !important;padding-bottom:0px !important;border-right:1px solid #fff;">
                                    {{ $department->links() }}
                                </td>
                                <td colspan="2" style="text-align:right;">
                                    Showing {{ $department->firstItem() }}- {{ $department->lastItem() }} from {{ $department->count() }} Item
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
        }
        function updateData(id,title) {
            $("#title").val(title);
            $("#setting_id").val(id);
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ডিপার্টমেন্টের  তথ্য</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '/department/information', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">টাইটেল</label>
                            <div class="col-md-10">
                                <input type="text"  id="title" class="form-control" placeholder="টাইটেল" required value="" name="title"/>

                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <input type="hidden" name="setting_id" id="setting_id">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


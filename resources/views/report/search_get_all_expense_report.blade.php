<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    /*body {*/
        /*font-family: 'SolaimanLipi', Arial, sans-serif !important;*/
    /*}*/
    body { font-family: DejaVu Sans, sans-serif; }
    .table-style td{
        border:1px solid #d0d0d0;
        font-size:12px;
    }
    /*html { direction:rtl;*/
        /*font-family:"Droid Arabic Kufi", "Droid Sans", sans-serif;*/
        /*font-size:14px;*/
     /*}*/
</style>
<table class="table table-bordered table-style"  rules="all" style="border:1px solid #d0d0d0;" id="default_table">
    <thead>
    <tr>
        <td style="">#</td>
        <td style="">ভাউচার নং</td>
        <td >شوهاغ</td>
        <td style="">গ্রহনকারী নাম</td>
        <td style="">খাত</td>
        <td style="">নোট</td>
        <td style="">ক্যাশ/ব্যাংক </td>
        <td style="">টাকার পরিমান</td>

    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    $total = '0.00';
    ?>

    @if($expense_info['status']=='success')
    @foreach($expense_info['data'] as $singleData)
        <tr>
            <td>  {{ $i++  }}</td>
            <td>  {{ $singleData->vouchar_no   }}</td>
            <td>  {{ date('d-m-Y', strtotime($singleData->record_date))   }}</td>
            <td>  {{ $singleData->payeeName   }}</td>
            <td>  {{ $singleData->debit_account_name   }}</td>

            <td>  {{ $singleData->comments   }}</td>
            <td>  {{ $singleData->credit_account_name   }}</td>
            <td class="text-right">  {{ $singleData->amount  }}</td>
            @php($total += $singleData->amount  )


        </tr>

    @endforeach
    <tr>
        <td class="text-right" colspan="7">মোট টাকার পরিমান</td>
        <td class="text-right"> {{ number_format($total,2,'.','') }}</td>
    </tr>

        @else
    <tr>
        <td colspan="8" style="text-align:center;">{{ $expense_info['message'] }}</td>
    </tr>


    @endif

    </tbody>

</table>
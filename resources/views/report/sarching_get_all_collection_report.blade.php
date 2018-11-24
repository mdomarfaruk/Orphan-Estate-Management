<table class="table table-bordered" id="default_table">
    <thead>
    <tr>
        <th style="width:40px;">#</th>
        <th style="width:250px;">রিসিপ্ট নং/চেক নং/সাক্ষী </th>

        <th style="width:120px;">তারিখ</th>

        <th style="width:180px;">ক্যাশ/ব্যাংক</th>
        <th style="width:150px;">নোট</th>
        <th style="width:150px;">আয়ের খাত</th>
        <th style="width:125px;">টাকার পরিমান</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    $total = '0.00';
    ?>
    @if($collection_info['status']=='success')
        @foreach($collection_info['data'] as $singleData)
        <tr>
            <td>  {{ $i++  }}</td>
            <td>
                {{ (!empty($singleData->receipt_no)?"রিসিপ্ট নং-".$singleData->receipt_no:"")   }}
                {{ (!empty($singleData->cheque_no)?"চেক নং-".$singleData->cheque_no:"")   }}
                {{ (!empty($singleData->withnessName)?"সাক্ষী নাম-".$singleData->withnessName:"")   }}

            </td>

            <td>  {{ date('d-m-Y', strtotime($singleData->record_date))   }}</td>

            <td>  {{ $singleData->debit_account_name   }}</td>

            <td>  {{ $singleData->comments   }}</td>
            <td>  {{ $singleData->credit_account_name   }}</td>
            <td class="text-right">  {{ $singleData->amount  }}</td>
            @php($total += $singleData->amount  )


        </tr>
        @endforeach
        <tr>
            <th class="text-right" colspan="6">মোট টাকার পরিমান</th>
            <th class="text-right"> {{ number_format($total,2,'.','') }}</th>
        </tr>
    @else
        <tr>
            <td colspan="7" style="text-align:center;">{{ $collection_info['message'] }}</td>
        </tr>


    @endif
    </tbody>

</table>
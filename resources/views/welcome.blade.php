<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Profit loss</h2>

<table>
    <thead>
    <tr>
        <th rowspan="2">Month-Year</th>
        <th colspan="3">Buy</th>
        <th colspan="3">Sell</th>
        <th rowspan="2">Remain Stock</th>
        <th rowspan="2">Profit/Loss</th>
    </tr>
  <tr>
    <td>Qty</td>
    <td>Rate</td>
    <td>Total</td>
    <td>Qty</td>
    <td>Rate</td>
    <td>Total</td>
  </tr>
</thead>

<tbody>
    @if(!empty($finalArray))
        @foreach($finalArray as $key=>$finalArrayRow)
        @if(isset($finalArrayRow[0]) && isset($finalArrayRow[1]))
            <tr>
                <td>{{ $key }}</td>
                @if($finalArrayRow[0][4]==1)
                @php
                    $remaningStock = 0;
                    $remaningStock = $finalArrayRow[0][1] - $finalArrayRow[1][1];
                    $profitLoss = 0;
                    $profitLoss = $finalArrayRow[1][2] - $finalArrayRow[0][2];    
                    
                @endphp
                    <td>{{ $finalArrayRow[0][1] }}</td>
                    <td>{{ $finalArrayRow[0][3] }}</td>
                    <td>{{ $finalArrayRow[0][2] }}</td>
                    <td>{{ $finalArrayRow[1][1] }}</td>
                    <td>{{ $finalArrayRow[1][3] }}</td>
                    <td>{{ $finalArrayRow[1][2] }}</td>
                    <td>{{ $remaningStock }}</td>
                    <td>{{ $profitLoss }}</td>
                @else
                @php
                    $remaningStock = 0;
                    $remaningStock = $finalArrayRow[1][1] - $finalArrayRow[0][1];
                    $profitLoss = 0;
                    $profitLoss = $finalArrayRow[0][2] - $finalArrayRow[1][2];    
                @endphp
                    <td>{{ $finalArrayRow[1][1] }}</td>
                    <td>{{ $finalArrayRow[1][3] }}</td>
                    <td>{{ $finalArrayRow[1][2] }}</td>
                    <td>{{ $finalArrayRow[0][1] }}</td>
                    <td>{{ $finalArrayRow[0][3] }}</td>
                    <td>{{ $finalArrayRow[0][2] }}</td>
                    <td>{{ $remaningStock }}</td>
                    <td>{{ $profitLoss }}</td>
                   
                @endif
            </tr>
            @endif
        @endforeach
    @endif
</tbody>

</table>

</body>
</html>

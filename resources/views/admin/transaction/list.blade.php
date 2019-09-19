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
<h2>Job Explorer - Sales Report</h2>
<hr>
<br>
<p>From Date : {{ $begin_date }}</p>
<p>To Date : {{ $end_date }}</p>
<br>
<h3>REPORT</h3>
<table>
    <tr>
        <th>SubTotal</th>
        <th>Discount</th>
        <th>TPS</th>
        <th>TVQ</th>
        <th>TOTAL</th>
    </tr>
    <tr>
        <td>$ {{ $mount }}</td>
        <td>$ 0.00</td>
        <td>$ {{ $tps }}</td>
        <td>$ {{ $tvq }}</td>
        <td>$ {{ $grandTotal }}</td>
    </tr>

</table>
<br>
</body>
</html>

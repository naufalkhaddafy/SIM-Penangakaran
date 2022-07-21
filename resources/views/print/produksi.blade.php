<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        h1 {
            text-align: center;
        }

        .header {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Produksi Penangkaran </h1>
        <b>From Date</b> <b>To Date</b>
    </div>

    <table id="customers">
        <tr>
            <th>No</th>
            <th>Penangkaran</th>
            <th>Tanggal Bertelur</th>
            <th>Tanggal Menetas</th>
            <th>Indukan</th>
            <th>Kode Ring</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Penangkaran1</td>
            <td>date</td>
            <td>date</td>
            <td>RIng</td>
            <td>KOde RIng</td>
            <td>Status</td>
            <td>Keterangan</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Penangkaran1</td>
            <td>date</td>
            <td>date</td>
            <td>RIng</td>
            <td>KOde RIng</td>
            <td>Status</td>
            <td>Keterangan</td>
        </tr>

    </table>

</body>

</html>

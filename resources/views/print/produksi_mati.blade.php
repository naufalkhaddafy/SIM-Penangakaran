<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: 5px;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        } */

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .header {
            text-align: center;
            background-color: white;
            padding: 0px;
            margin: 0px;
            padding-bottom: 5px;
        }

        .header h2 {
            margin: 0px;
            padding: 0px;
        }

        .header h1 {
            margin: 5px;
        }

        .header h3 {
            padding: 0px;
            margin: 5px;
        }

        .header b {
            padding: 0px;
            margin: 0px;

        }
    </style>
</head>

<body onload="window.print()" onfocus="window.close()">
    <div class="header">
        <h2>Laporan Produksi Mati Penangkaran</h2>
        <h1>SGT Bird Farm</h1>
        <H3>Lokasi : {{ $penangkarans->lokasi_penangkaran ?? 'Seluruh Penangkaran' }}
            ({{ $penangkarans->kode_penangkaran ?? '' }})</H3>
        <b>Tanggal : {{ $startDate }} sampai {{ $endDate }}</b>
    </div>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Penangkaran</th>
            <th>Kandang </th>
            <th>Tanggal Bertelur</th>
            <th>Tanggal Menetas</th>
            <th>Status Telur</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($data as $produksi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $produksi->kandang->penangkaran->kode_penangkaran }} </td>
                <td>{{ $produksi->kandang->nama_kandang }} ({{ $produksi->indukan }})</td>
                <td>{{ $produksi->tgl_bertelur }}</td>
                <td>{{ $produksi->tgl_menetas ?? '-' }}</td>
                <td>{{ $produksi->status_telur }}</td>
                <td>{{ $produksi->keterangan }}</td>
                <td>{{ $produksi->status_produksi }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
{{-- <script>
    onload = function() {
        window.print();
        setTimeout(window.close, 1000);
    }
</script> --}}

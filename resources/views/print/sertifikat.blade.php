<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            margin: auto;
            max-width: 968px;
            /* width: 100vw; */
            /* background-image: url('{{ asset('sertif/bg.png') }}'); */
        }

        img {
            width: 100%;
        }

        .sertifikat {
            position: relative;
        }

        .jenis-burung p {
            position: absolute;
            top: 34%;
            left: 42%;
            font-weight: bold;
            font-size: 24px;
            font-family: 'open sans';
        }

        .kode-ring p {
            position: absolute;
            top: 41%;
            left: 42%;
            font-weight: bold;
            font-size: 24px;
            font-family: 'open sans';
        }

        .indukan p {
            position: absolute;
            top: 47.5%;
            left: 42%;
            font-weight: bold;
            font-size: 24px;
            font-family: 'open sans';
        }

        .tgl-menetas p {
            position: absolute;
            top: 54%;
            left: 42%;
            font-weight: bold;
            font-size: 24px;
            font-family: 'open sans';
        }

        .jk p {
            position: absolute;
            top: 61%;
            left: 42%;
            font-weight: bold;
            font-size: 24px;
            color: red;
            font-family: 'open sans';
        }

        .ttd p {
            position: absolute;
            top: 74%;
            left: 68%;
        }
    </style>
</head>

<body onload="window.print()" onfocus="window.close()">
    <div class="container">
        <div class="sertifikat">
            <img src="{{ asset('sertif/bg.png') }}" alt="">
            <div class="jenis-burung">
                <p>Cucak Rowo</p>
            </div>
            <div class="kode-ring">
                <p>{{ $data->kode_ring ?? '-' }}</p>
            </div>
            <div class="indukan">
                <p>{{ $data->indukan ?? '-' }}</p>
            </div>
            <div class="tgl-menetas">
                <p>{{ $data->tgl_menetas ? date('d F Y', strtotime($data->tgl_menetas)) : '-' }}</p>
                </p>
            </div>
            <div class="jk">
                <p>{{ $data->jenis_kelamin ?? '-' }}</p>
            </div>
            <div class="ttd">
                <p>TTD</p>
            </div>
        </div>
    </div>
</body>

</html>

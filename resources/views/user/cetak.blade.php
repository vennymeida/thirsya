<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nota Pesanan</title>

    <style>
        .invoice-box {
            width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        /* .invoice-box table tr td:nth-child(2) {
            text-align: right;
        } */

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.heading td {
            background: rgb(21, 174, 221);
            color: white;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="5" style="text-align: center">
                    <h1>Nota Penjualan</h1>
                    <h2>WaroenkQu <span style="color: rgb(21, 174, 221);"></span></h2>
                    <hr>
                </td>
            </tr>
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                Created: {{ date("d.m.Y H:i:s A", strtotime(now()))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td><b>Data Pemesan</td></tr>
            <tr class="heading">
                <td>Nama Pemesan</td>
                <td>Email Pemesan</td>

            </tr>

            <tr class="invoice">
                <td>{{ $data->user->name}}</td>
                <td>{{ $data->user->email}}</td>
               
            </tr>

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td><b>Data Barang</td></tr>
            <td>No Invoice</td>
            <td><span style="font-weight: bold;">#{{$data->id_pesanans}}</span></td>
            <tr class="heading">
            
									<td>Nama Barang</td>
                                    <td>Harga Satuan</td>
									<td>Quantitas</td>
                                    <td>Harga Total</td>
            </tr>

           

            <tr class="invoice">
            
                
                @foreach($barangs as $dt)
                <td>{{ $dt->barang->nama_barang }}</td>
                <td>Rp {{ number_format($dt->barang->harga) }}</td>
                <td>{{ $dt->jumlah }}</td>
                <td>Rp. {{ number_format($dt->jumlah_harga) }}</td>
            </tr>
            @endforeach
            @php
            
            @endphp

            <tr class="total heading">
            <td style="font-weight: bold">TOTAL</td>
                <td></td>
                <td></td>
                
                
                <td style="font-weight: bold">Rp. {{ number_format($data->jumlah_harga, 0, ',', '.')}}</td>
            </tr>

            <tr><td><b>Data Alamat</td></tr>
            <tr>
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                   
                                    
                                
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">
                                                {{$data->alamat_pengiriman->nama_penerima}}
                                            </span>
                                            <br>
                                            <span>No. HP :
                                                {{$data->alamat_pengiriman->no_tlp}}
                                            </span>
                                        </td>
                                        <td>
                                            {{$data->alamat_pengiriman->alamat}},
                                            <br>
                                            {{$data->alamat_pengiriman->kelurahan}} - {{$data->alamat_pengiriman->kecamatan}} - {{$data->alamat_pengiriman->kota}} - {{$data->alamat_pengiriman->provinsi}}
                                            <br>
                                            <span>
                                                Kodepos :
                                                {{$data->alamat_pengiriman->kodepos}}
                                            </span>
                                        </td>
                                        <td>
                                        {{$data->alamat_pengiriman->status}}
                                          
                                        </td>
                                        
                                    </tr>
                                   
                                  
        </table>
    </div>
</body>
</html>

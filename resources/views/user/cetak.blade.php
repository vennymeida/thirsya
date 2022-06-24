<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nota Pesanan</title>

    <style>
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: rgb(21, 174, 221);
            color: white;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

    </style>
</head>

<body style="margin-left: 60px">
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
            <tr><td></td></tr><br><br>
            <tr><td><b>Data Barang</td></tr>
            <td>No Invoice</td>
            <td><span style="font-weight: bold;">#{{$data->kode}}</span></td>
            <tr class="heading">
            
									<td>Nama Barang</td>
                                    <td>Harga Satuan</td>
									<td>Qty</td>
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

            <tr style="font-weight: bold; background-color:#ffcccc;">
            <td>TOTAL</td>
                <td></td>
                <td></td>
                
                
                <td style="font-weight: bold">Rp. {{ number_format($data->jumlah_harga, 0, ',', '.')}}</td>
            </tr>
            <br><br>
            <tr><td><b>Data Alamat</td></tr>
            <tr style="background-color:rgb(21, 174, 221); color:white;">
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
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

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
                <td>Kontak</td>
                <td>Alamat</td>
                <td>Status Pembayaran</td>
            </tr>

            <tr class="invoice">
                <td>
                {{ $data->user->name}}
                </td>
                <td>{{ $data->user->email}}</td>
               
            </tr>

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td><b>Data Barang</td></tr>
            <tr class="heading">
            <th class="product-image">Product Image</th>
									<th class="product-name">Nama Barang</th>
                                    <th class="product-name">Harga Satuan</th>
									<th class="product-price">Quantitas</th>
                                    <th class="product-total">Harga Total</th>
            </tr>

           

            <tr class="invoice">
                <td>
                    <span style="font-weight: bold;">#{{$data->id_pesanans}}</span>
                    
                   
                </td>
                <td>
                <img src="{{asset('storage/'.$data->cart[0]->barang->foto)}}" width="100" height="65" alt="...">
                </td>
                <td>{{ $data->cart[0]->barang->nama_barang }}</td>
                <td>Rp {{ number_format($data->cart[0]->Barang->harga) }}</td>
                <td>{{ $data->cart[0]->jumlah }}</td>
                <td>Rp. {{ number_format($data->cart[0]->jumlah_harga) }}</td>
            </tr>
            @php
           
            @endphp

            <tr class="total heading">
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold">TOTAL</td>
                <td style="font-weight: bold"></td>
            </tr>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>DATA TRANSAKSI</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
        </style>
        <style>
.page-break {
    page-break-after: always;
}
</style>
    </head>
    <body style="margin : 30px; font-family: Times New Roman, Times, serif; font-style: normal; font-size: 14px;">
        @foreach($orders as $order)
        <center>
            <h3 class="text-center mb-5">WAROENKQU</h3>
        </center>
        <div class="container">
            <p><b>Invoce : {{$order->kode}}</b></p>
            <p><b>Nama Akun : {{$order->user->username}} </b> </p>
            <p><b>Nama Pembeli : {{$order->user->name}}</b> </p>
            <p><b>Email : {{$order->user->email}}</b> </p>
        <table class="table table-bordered" style="width:100%; border:0px;">
        <tr style="background-color:rgb(21, 174, 221);">
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
        @foreach(App\Models\Cart::where(array('pesanan_id' => $order->id_pesanans))->get() as $dt)
                <tr>
               
                    <td>{{ $dt->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($dt->barang->harga, 0, ',', '.')." * ".$dt->jumlah}}</td>
                    <td>Rp {{ number_format($dt->jumlah_harga, 0, ',', '.')}}</td>
                    
                </tr>
            @endforeach
            <tr class="total heading" style="background-color:#ffcccc;">
                <td style="font-weight: bold">TOTAL</td>
                <td></td>
                <!-- <td></td> -->
                <td style="font-weight: bold">Rp. {{ number_format($order->jumlah_harga, 0, ',', '.')}}</td>
            </tr><br><br>
            <tr style="background-color:#fff8cc;">
                <td colspan='3'><b>Data Alamat</td>
            </tr>
            <tr style="background-color:rgb(21, 174, 221);">
                <th>Nama Penerima</th>
                <th>Alamat</th>
                <th>Status</th>
                <!-- <th>Aksi</th> -->
            </tr>
            <tr>
                <td>
                    <span class="font-weight-bold">
                        {{$order->alamat_pengiriman->nama_penerima}}
                    </span>
                    <br>
                    <span>No. HP :
                        {{$order->alamat_pengiriman->no_tlp}}
                    </span>
                </td>
                <td>
                    {{$order->alamat_pengiriman->alamat}},
                    <br>
                    {{$order->alamat_pengiriman->kelurahan}} - {{$order->alamat_pengiriman->kecamatan}} - {{$order->alamat_pengiriman->kota}} - {{$order->alamat_pengiriman->provinsi}}
                    <br>
                    <span>
                        Kodepos :
                        {{$order->alamat_pengiriman->kodepos}}
                    </span>
                </td>
                <td>
                {{$order->status_cart}}
                </td>
                
            </tr>
        </table>
      
        <div class="page-break"></div>
        @endforeach
</body>
</html> 
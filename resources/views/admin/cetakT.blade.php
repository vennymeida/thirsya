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
    </head>
    @foreach($barangs as $datas)
    <body>
        <center>
            <h3 class="text-center mb-5">WAROENKQU</h3>
        </center>
        
        <div class="container">
            <p><b>Invoce : </b> {{ $datas->kode}}</p>
            <p><b>Nama Akun : </b> {{ $data->user->username }}</p>
            <p><b>Nama Pembeli : </b> {{ $data->user->name }}</p>
            <p><b>Email : </b> {{ $data->user->email }}</p>
        <table class="table table-bordered" style="width:95%;margin:0 auto;">
        <tr>
            
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            
        </tr>
        
                <tr>
                @foreach($barangs as $dt)
                    <td>{{ $dt->barang->nama_barang }}</td>&emsp
                    <td>Rp {{ number_format($dt->barang->harga)}}</td>&emsp
                    <td>{{ $dt->jumlah }}</td>&emsp
                    
                </tr>
            @endforeach
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
        
</body>
@endforeach
</html> 
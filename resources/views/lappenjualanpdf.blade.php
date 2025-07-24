
<table>
    <tr>
        <td style="width:150px;"><img src="{{ public_path('eshop/images/logo.jpeg') }}" style="width: 80px; height: 60px;"></td>
        <td><h3 style="text-align: center;">Laporan Penjualan</h3></td>
    </tr>
  </table>
<hr>

<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama Penerima</th>
    <th>Nama Produk</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Sub Total</th>
  </tr>
  @php($i = 1)
  @foreach($pesanans as $pesan)
  <tr>
    <td>{{ $i++ }}</td>
    <td>{{$pesan->tgl_pemesanan}}</td>
    <td>{{$pesan->name}}</td>
    <td>{{$pesan->nama_produk}}</td>
    <td>{{$pesan->qty}}</td>
    <td>Rp. {{$pesan->harga_bayar}}</td>
    <td>Rp. {{$pesan->sub_total}}</td>
  </tr>
  @endforeach
  <tr>

    <td colspan="6" style="text-align: center;">Total Pendapatan</td>
    <td>Rp. {{$total}}</td>
  </tr>
</table>



<h3><center>Laporan Penjualan</center></h3>
<hr>

<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Tanggal Pemesanan</th>
    <th>Nama Penerima</th>
    <th>No Hp</th>
    <th>Alamat</th>
    <th>Total</th>
  </tr>
  @php($i = 1)
  @foreach($pesanans as $pesan)
  <tr>
    <td>{{ $i++ }}</td>
    <td>{{$pesan->tgl_pemesanan}}</td>
    <td>{{$pesan->nama_penerima}}</td>
    <td>{{$pesan->no_hp}}</td>
    <td>{{$pesan->alamat}}</td>
    <td>{{$pesan->total_bayar}}</td>
  </tr>
  @endforeach
  <tr>
    
    <td colspan="5" style="text-align: center;">Total Pendapatan</td>
    <td>Rp. {{$total}}</td>
  </tr>
</table>



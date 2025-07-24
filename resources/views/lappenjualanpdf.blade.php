
<table>
    <tr>
        <td><h3 style="text-align: center;">Laporan Penjualan</h3></td>
    </tr>
  </table>
<hr>

<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama Pelanggan</th>
    <th>Biaya Servis</th>
    <th>Biaya Tarif antar</th>
  </tr>
  @php($i = 1)
  @foreach($pesanans as $pesan)
  <tr>
    <td>{{ $i++ }}</td>
    <td>{{$pesan->tgl_order}}</td>
    <td>{{$pesan->nama_pelanggan}}</td>
    <td>{{$pesan->biaya}}</td>
    <td>{{$pesan->tarif_antar}}</td>
  </tr>
  @endforeach
  <tr>

    <td colspan="4" style="text-align: center;">Total Pendapatan</td>
    <td>Rp. {{$pesan->total_biaya}}</td>
  </tr>
</table>



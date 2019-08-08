@extends('templates/one/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">eMoShop</h1>
          <small>Your Friendly Mobilephone Shop</small>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    <div class="card">
      <div class="card-header">
        <h5 class="card-tittle">Produk kami yang tersedia...</h5>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
            <th>Aksi</th>
          </thead>
          <tbody>
            @foreach($result as $row)
              <tr>
                <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                <td>{{ $row->nama_barang }}</td>
                <td>{{ $row->jumlah_barang }}</td>
                <td>Rp.{{ number_format($row->harga,0,',','.') }},-</td>
                <td><a href='{{ url("beli") }}' class="btn btn-info"><i class="fa fa-barcode"></i> Beli Produk</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@extends('templates/customer/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    @include('feedback')  
    <div class="card">
      <div class="card-header">
        <div class="pull-left">
          <h5 class="card-tittle">Produk kami yang tersedia...</h5>
        </div>
        <div class="pull-right">
          <form action='{{ url("barang/cari") }}' method="post" class="form-horizontal">
            {{ csrf_field() }}
            <input type="text" name="cari" class="form-group">
            <button type="submit" class="btn btn-success">Cari Barang</button>
          </form>
        </div>
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
                <td><a href='{{ url("beli/form") }}' class="btn btn-info"><i class="fa fa-barcode"></i> Beli Produk</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
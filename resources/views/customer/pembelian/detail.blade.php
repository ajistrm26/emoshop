@extends('templates/customer/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Pembelian</h1>
          <small>
            {{ $beli->id_jual }} | Total ({{ number_format($beli->harga_total,0,',','.') }},-)
          </small>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    @include('feedback')  
    <div class="card">
      <div class="card-header">
        <a href='{{ url("pembelian/") }}' class="btn btn-warning"><i class="fa fa-backward"></i> Kembali</a>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah Beli</th>
            <th>Harga</th>
          </thead>
          <tbody>
            @foreach($result as $row)
              <tr>
                <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                <td>{{ $row->barang->nama_barang }}</td>
                <td>{{ $row->jumlah_jual }}</td>
                <td>Rp.{{ number_format($row->harga_jual,0,',','.') }},-</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
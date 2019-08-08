@extends('templates/admin/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    @include('feedback')
    <div class="card">
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Barang</th>
          </thead>
          <tbody>
            @if($result->isEmpty())
              <td colspan="5">
                <i>Belum ada data barang</i>
              </td>
            @else
              @foreach($result as $row)
                <tr>
                  <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                  <td><b>{{ $row->id_barang }}</b></td>
                  <td>{{ $row->nama_barang }}</td>
                  <td>{{ $row->jumlah_barang }}</td>
                  <td>Rp.{{ number_format($row->harga,0,',','.') }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
@endsection
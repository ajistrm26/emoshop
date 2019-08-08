@extends('templates/admin/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Barang</h1>
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
          <a href='{{ url("barang/add") }}' class="btn btn-primary"><i class="fa fa-plus-0"></i> Tambah Barang</a>
        </div>
        <div class="pull-right">
          <form action='{{ url("barang/search") }}' method="post" class="form-horizontal">
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
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Barang</th>
            <th>Aksi</th>
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
                  <td>
                    <a href = '{{ url("barang/$row->id_barang/edit") }}' class=" btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <form action='{{ url("barang/$row->id_barang/delete") }}' method="post" style="display:inline;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
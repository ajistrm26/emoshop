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
        <h5 class="card-tittle">Data Pembelian</h5>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <th>No</th>
            <th>ID</th>
            <th>Tanggal Beli</th>
            <th>Harga Total</th>
            <th>Aksi</th>
          </thead>
          <tbody>
            @foreach($result as $row)
              <tr>
                <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                <td>{{ $row->id_jual }}</td>
                <td>{{ $row->tgl_jual }}</td>
                <td>Rp.{{ number_format($row->harga_total,0,',','.') }},-</td>
                <td><a href='{{ url("pembelian/$row->id_jual/detail") }}' class="btn btn-info"><i class="fa fa-eye"></i> Lihat Detail</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
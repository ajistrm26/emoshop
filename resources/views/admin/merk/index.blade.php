@extends('templates/admin/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Merk</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
    @include('feedback')
    <div class="card">
      <div class="card-header">
        <a href='{{ url("merk/add") }}' class="btn btn-primary"><i class="fa fa-plus-0"></i> Tambah Merk</a>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <th>No</th>
            <th>ID Merk</th>
            <th>Nama Merk</th>
            <th>Aksi</th>
          </thead>
          <tbody>
            @if($result->isEmpty())
              <td colspan="5">
                <i>Belum ada data Merk</i>
              </td>
            @else
              @foreach($result as $row)
                <tr>
                  <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                  <td><b>{{ $row->id_merk }}</b></td>
                  <td>{{ $row->nama_merk }}</td>
                  <td>
                    <a href = '{{ url("merk/$row->id_merk/edit") }}' class=" btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <form action='{{ url("merk/$row->id_merk/delete") }}' method="post" style="display:inline;">
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
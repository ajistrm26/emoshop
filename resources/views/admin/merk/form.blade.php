@extends('templates/admin/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Merk</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
    @include('feedback')
    <div class="card">
      <div class="card-header">
        <a href='{{ url("merk/") }}' class="btn btn-warning"><i class="fa fa-backward"></i> Kembali</a>
      </div>
      <div class="card-body p-0">
        <form action='{{ empty($result) ? url("merk/save") : url("merk/$result->id_merk/update") }}' class="form-horizontal" method="post">
          {{ csrf_field() }}
          @if(!empty($result))
            {{ method_field('patch') }}
          @endif
          <div class="form-group">
            <label class="control-label col-sm-2">ID Merk</label>
            <div class="col-sm-9">
              <input type="text" name="id_merk" class="form-control" value="{{ @$result->id_merk }}" placeholder="Masukan ID Merk" {{ empty($result) ? '' : 'readonly' }}>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2">Nama Merk</label>
            <div class="col-sm-9">
              <input type="text" name="nama_merk" class="form-control" value="{{ @$result->nama_merk }}" placeholder="Masukan Nama Merk">
            </div>
          </div>
        </div>
          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-2">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
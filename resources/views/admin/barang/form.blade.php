@extends('templates/admin/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Barang</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
    @include('feedback')
    <div class="card">
      <div class="card-header">
        <a href='{{ url("barang/") }}' class="btn btn-warning"><i class="fa fa-backward"></i> Kembali</a>
      </div>
      <div class="card-body p-0">
        <form action='{{ empty($result) ? url("barang/save") : url("barang/$result->id_barang/update") }}' class="form-horizontal" method="post">
          {{ csrf_field() }}
          @if(!empty($result))
            {{ method_field('patch') }}
          @endif
          <div class="form-group">
            <label class="control-label col-sm-2">Nama Barang</label>
            <div class="col-sm-9">
              <input type="text" name="nama_barang" class="form-control" value="{{ @$result->nama_barang }}" placeholder="Masukan Nama Barang">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Jumlah Barang</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_barang" class="form-control" value="{{ @$result->jumlah_barang }}" placeholder="Masukan Jumlah Barang">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Harga</label>
            <div class="col-sm-9">
              <input type="text" name="harga" class="form-control" value="{{ @$result->harga }}" placeholder="Masukan Harga">
            </div>
          </div>

          <div class="form-group" {{ empty($result) ? '' : 'hidden' }}>
            <label class="control-label col-sm-2">Merk</label>
            <div class="col-sm-9">
              <select name="id_merk" class="form-control">
                  <option value="">--pilih merk--</option>
                @foreach (\App\Merk::all() as $nm)
                  <option value="{{ $nm->id_merk }}" {{ @$result->id_merk==$nm->id_merk ? 'selected' : '' }}>
                    {{ $nm->nama_merk }}
                  </option>
                @endforeach
              </select>
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
@extends('templates/customer/header')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Beli Produk</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
    @include('feedback')
    <div class="card">
      <div class="card-header">
        <a href='{{ url("cust/") }}' class="btn btn-warning"><i class="fa fa-backward"></i> Kembali</a>
      </div>
      <div class="card-body p-0">
        <form action='{{ url("beli/save") }}' class="form-horizontal" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-sm-2">Pilih Barang</label>
            <div class="col-sm-9">
              <select name="pilih_barang" class="form-control">
                <option value="">--Pilih Barang--</option>
                @foreach($result as $row)
                  <option value='{{ $row->id_barang }}'>{{ $row->nama_barang }} - Tersedia {{ $row->jumlah_barang }} - Harga Rp.{{ number_format($row->harga,0,',','.') }},-</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Jumlah Beli</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_beli" class="form-control" placeholder="Masukan Jumlah Beli">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-2 btn-group">
              <button type="submit" name="submit" value="add" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Tambahkan Daftar Keranjang</button>
              @if(!$result2->isEmpty())
                <button type="submit" name="submit" value="save" class="btn btn-success"><i class="fa fa-save"></i> Beli Produk</button>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="card">
      <div class="card-header">
        Daftar Keranjang
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Jumlah Beli</th>
              <th>Harga Beli</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($result2->isEmpty())
              <tr>
                <td colspan="5">Belum ada produk yang dibeli</td>
              </tr>
            @else
              @foreach($result2 as $row2)
                <tr>
                  <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                  <td>{{ $row2->barang->nama_barang }}</td>
                  <td>{{ $row2->jumlah_cart }}</td>
                  <td>Rp.{{ number_format($row2->harga_cart,0,',','.') }},-</td>
                  <td>
                    <form action='{{ url("beli/$row2->id_cart/delete") }}' method="post" style="display:inline;">
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
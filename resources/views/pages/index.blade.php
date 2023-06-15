@extends('template.theme')
@section('title-page', 'Selamat datang, MINIVEN')
@section('container')
@include('template.navbar')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
                <!--card-->
                <div class="card">
                    <div class="card-body">
                        <div class="header-stok-barang">
                            <h3 class="d-inline">Daftar Stok Barang</h3>
                            <button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalTambahBarang">Tambah Barang</button>
                            <button type="button" class="btn btn-warning float-right mb-1" data-toggle="modal" data-target="#modalSelanjutnya">Selanjutnya</button>
                        </div>
                        <!--tabel barang-->
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 0;?>
                                    @foreach ($semua_barang as $barang)
                                    <?php $nomor++ ?>
                                <tr>
                                    <th scope="row"> <?php echo $nomor ?> </th>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jumlah_barang }}</td>
                                    <td>{{ $barang->harga_satuan }}</td>
                                    <td>{{ $barang->total_harga }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateBarang{{ $barang->kode_barang }}">Update</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalHapusBarang{{ $barang->kode_barang }}">Hapus</button>
                                    </td>
                                </tr>
                                <!-- Modal Verif hapus barang-->
                                <div class="modal fade" id="modalHapusBarang{{ $barang->kode_barang }}" tabindex="-1" aria-labelledby="modalHapusBarang" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="text-center">Apakah anda yakin menghapus barang ini?</span></h4>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/beranda-yo/{{ $barang->kode_barang }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">Hapus Barang!</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Verif hapus barang-->

                                <!-- Modal Update Barang-->
                                <div class="modal fade" id="modalUpdateBarang{{ $barang->kode_barang }}" tabindex="-1" aria-labelledby="modalUpdateBarang">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--FORM UPDATE BARANG-->
                                        <form action="/beranda-yo/{{ $barang->kode_barang }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control" id="updateNamaBarang" name="updateNamaBarang" 
                                            value="{{ $barang->nama_barang}}">
                                            </div>
                                            <div class="form-group">
                                            <label for="">Jumlah Barang</label>
                                            <input type="text" class="form-control" id="updateJumlahBarang" name="updateJumlahBarang"
                                            value="{{ $barang->jumlah_barang}}">
                                            </div>
                                            <div class="form-group">
                                            <label for="">Harga Satuan</label>
                                            <input type="text" class="form-control" id="updateHargaSatuan" name="updateHargaSatuan"
                                            value="{{ $barang->harga_satuan}}">
                                            <div class="form-group">
                                            <label for="">Total Harga</label>
                                            <input type="text" class="form-control" id="updateTotalHarga" name="updateTotalHarga"
                                            value="{{ $barang->total_harga}}">
                                            </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                        </form>
                                        <!--END FORM UPDATE BARANG-->
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!-- End Modal UPDATE Barang-->
                                @endforeach
                            </tbody>
                        </table>
                        <!--end tabel barang-->
                    </div>
                </div>
                <!--end card-->
        </div>
    </div>
</div>

<!-- Modal Tambah Barang-->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!--FORM TAMBAH BARANG-->
        <form action="{{ action('BarangController@store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Nama Barang</label>
              <input type="text" class="form-control" id="addNamaBarang" name="addNamaBarang" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="">Jumlah Barang</label>
              <input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
            </div>
            <div class="form-group">
              <label for="">Harga Satuan</label>
              <input type="text" class="form-control" id="addHargaSatuan" name="addHargaSatuan">
            </div>
            <div class="form-group">
              <label for="">Total Harga</label>
              <input type="text" class="form-control" id="addTotalHarga" name="addTotalHarga">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </form>
        <!--END FORM TAMBAH BARANG-->
    </div>
</div>
</div>
</div>
<!-- End Modal Tambah Barang-->

<!-- Modal Verif Selanjutnya-->
<div class="modal fade" id="modalSelanjutnya" tabindex="-1" aria-labelledby="modalSelanjutnya" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Selanjutnya</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h6 class="text-center">Apakah anda ingin membuat laporan?</h6>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="submit" class="btn btn-primary">Buat Laporan!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
<!-- End Verif Selanjutnya-->
@endsection
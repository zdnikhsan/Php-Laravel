<x-navbar></x-navbar>

<div class="container-fluid mt-5">
    <div class="d-flex justify-content-center">
        <div class="row shadow">
          <!-- Left Panel -->
          <div class="col-md-4 bg-warning text-center d-flex flex-column justify-content-center align-items-center p-4">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
              <span style="font-size: 50px;">👩</span>
            </div>
            <h5 class="mt-3 text-dark">Tambah Pelanggan Baru</h5>
            <p>Isi data berikut untuk menambahkan pelanggan baru ke sistem. </p>
            <button class="btn btn-dark rounded-circle mt-2"><</button>
          </div>
      
          <!-- Right Panel -->
          <div class="col-md-8 bg-white p-4">
            <form method="POST" action="{{ route('pelangganAction') }}">
                @csrf
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="nama" name="nama" class="form-control" id="nama">
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Nomor HP</label>
                <input type="number" name="no_hp" class="form-control" id="no_hp">
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat">
              </div>
              <div class="d-grid mb-3 pt-2">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<x-footer></x-footer>
<x-navbar></x-navbar>

<div class="container-fluid">
    <div class="row px-3 py-3 border-bottom">
        <div class="col-md-4 bg-dark">

        </div>
        <div class="col-md-8">
            <h4>Pelanggan Detail</h4>
            <form action="{{ route('pelangganDetailEdit') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $pelanggan->id }}">
                    <div class="mb-3 col-md-6">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="nama" name="nama" class="form-control" id="nama" value="{{ $pelanggan->name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="phone" class="form-label">Nomor HP</label>
                      <input type="number" name="no_hp" class="form-control" id="no_hp" value="{{ $pelanggan->no_hp }}">
                    </div>
                </div>
                <label for="level">Level Pelanggan</label>
                <select name="level" id="level" class="form-control">
                    <option value="{{ $pelanggan->level }}">{{ $pelanggan->level }}</option>
                    <option value="Bronze" {{ old('level', $pelanggan->level ?? '') == 'aktif' ? 'selected' : '' }}>Bronze</option>
                    <option value="Silver" {{ old('level', $pelanggan->level ?? '') == 'nonaktif' ? 'selected' : '' }}>Silver</option>
                    <option value="Gold" {{ old('level', $pelanggan->level ?? '') == 'banned' ? 'selected' : '' }}>Gold</option>
                </select>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="alamat">
                </div>
                <div class="d-grid mb-3 pt-2">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
            <div class="d-grid mb-3 pt-2">
                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data Pelanggan ini?')">
                    @csrf
                    <button type="submit" style="width: 100%" class="btn btn-danger">Hapus</button>
                </form>                        
            </div>                  
        </div>
    </div>
</div>

<x-footer></x-footer>
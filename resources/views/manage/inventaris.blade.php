<x-navbar></x-navbar>

<div class="container">
    <h1>Data Pengeluaran</h1>


    <!-- Button Tambah -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah
    </button>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>  
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $barang->nama }}</td>
                <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                <td>{{ $barang->kategori }}</td>
                <td>{{ $barang->stok }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $barang->id }}">Edit</button>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $barang->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $barang->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('barang.update', $barang) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $barang->id }}">Edit Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-select" required>
                                        <option value="Sabun" {{ $barang->kategori == 'Sabun' ? 'selected' : '' }}>Sabun</option>
                                        <option value="Pewangi" {{ $barang->kategori == 'Pewangi' ? 'selected' : '' }}>Pewangi</option>
                                        <option value="Lainnya" {{ $barang->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('addInvent') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                        value="{{ old('harga') }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                        value="{{ old('role') }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sabun">Sabun</option>
                            <option value="Pewangi">Pewangi</option>
                            <option value="Plastik">Plastik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                        value="{{ old('stok') }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addModal = new bootstrap.Modal(document.getElementById('createModal'));
        addModal.show();
    });
</script>
@endif

<x-footer></x-footer>

<x-navbar></x-navbar>

<div>
    <div class="d-flex bg-warning justify-content-between py-3 p-3" style="height: 150px;">
        <h4 class="mb-0">Detail Transaksi</h4>
    </div>

    {{-- conten 1 --}}

    <div class="row d-flex justify-content-center g-3 mb-4 mx-2" style="transform: translateY(-60px);">
        <div class="col-md-12">
            <div class="card bg-light shadow">
              <div class="card-body">
                <div class="row">
                  <!-- Kolom 1: Chart -->
                  <div class="col-md-6 border-end">
                    <h5 class="mb-3 card-title">Transaksi {{ $transaksi->id }}</h5>
                    <div>
                        <p><strong>Nama Pelanggan:</strong> {{ $transaksi->pelanggan->name }}</p>
                        <p><strong>No HP:</strong> {{ $transaksi->no_hp }}</p>
                        <p><strong>Paket:</strong> {{ $transaksi->paket }}</p>
                        <p><strong>Berat:</strong> {{ $transaksi->berat_pakaian }} kg</p>
                        <p><strong>Tgl Masuk:</strong> {{ \Carbon\Carbon::parse($transaksi->tgl_masuk)->format('d M Y H:i') }}</p>
                        <p><strong>Tgl Selesai:</strong> {{ \Carbon\Carbon::parse($transaksi->tgl_selesai)->format('d M Y H:i') }}</p>
                        <p><strong>Total:</strong> Rp {{ number_format($transaksi->jml_transaksi, 0, ',', '.') }}</p>
                    </div>
                  </div>
        
                  <!-- Kolom 2: Info Pelanggan -->
                  <div class="col-md-6">
                    <div class="card-box">
                        <h5>Riwayat Transaksi</h5>
                        <ul class="list-group">
                            @foreach ($riwayat as $item)
                                <li class="list-group-item">
                                    {{ date('d M Y', strtotime($item->tgl_masuk)) }} - 
                                    Rp {{ number_format($item->jml_transaksi, 0, ',', '.') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <hr/>

                    <div class="card-box pt-2">
                        <strong>Status:</strong>
                        @if($transaksi->status == 'Selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-primary">Diproses</span>
                        @endif
                        <div class="mt-3 d-flex gap-2">
                            <!-- Tombol Edit -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                Edit Transaksi
                            </button>
                        
                            <!-- Tombol Hapus -->
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                Hapus Transaksi
                            </button>
                        </div>
                      </div>
                  </div>

                </div>
                
                
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ url('/transaksi/' . $transaksi->id . '/update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
            <label>Paket</label>
            <input type="text" name="paket" class="form-control" value="{{ $transaksi->paket }}">
            </div>
            <div class="mb-3">
            <label>Berat Pakaian (kg)</label>
            <input type="number" step="0.1" name="berat_pakaian" class="form-control" value="{{ $transaksi->berat_pakaian }}">
            </div>
            <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="datetime-local" name="tgl_selesai" class="form-control"
                value="{{ \Carbon\Carbon::parse($transaksi->tgl_selesai)->format('Y-m-d\TH:i') }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
    </form>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ url('/transaksi/' . $transaksi->id . '/delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            Yakin ingin menghapus transaksi <strong>#{{ $transaksi->id }}</strong>?
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
    </form>
    </div>
</div>

<x-footer></x-footer>
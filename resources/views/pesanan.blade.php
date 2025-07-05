<x-navbar></x-navbar>

<div class="">
    <div class="d-flex justify-content-between py-3 p-3" style="height: 150px; background-color: #0d6efd;">
      <h4 class="mb-0 text-white">Transaksi</h4>

<!-- Modal -->
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('tambahTransaksi') }}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- No hp -->
                <div class="mb-3">
                  <label for="no_hp" class="form-label">No Hp</label>
                  <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                </div>
                <!-- Berat pakaian -->
                <div class="mb-3">
                  <label for="berat" class="form-label">Berat Pakaian</label>
                  <input type="text" class="form-control" id="berat_pakaian" 
                  oninput="this.value = this.value.replace(',', '.');" name="berat_pakaian">
                </div>
                <!-- Paket -->
                <div class="mb-3">
                  <label for="paket" class="form-label">Paket Laundry</label>
                  <select class="form-control" id="paket" name="paket">
                    <option value="">Pilih Paket</option>
                    <option value="1 Hari">1 Hari</option>
                    <option value="3 Hari">3 Hari</option>
                    <option value="Ekspress">Ekspress</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
    
    <div class="row d-flex justify-content-center g-3 mb-4 mx-2" style="transform: translateY(-60px);">
        <div class="col-md-12">
            <div class="card bg-light shadow">
              <div class="card-body">
                <div class="row">
                  <!-- Kolom 1: Chart -->
                  <div class="col-md-6 border-end">
                    <h5 class="mb-3">Total Transaksi per Hari</h5>
                    <canvas id="chartTransaksi" height="150"></canvas>
                  </div>
        
                  <!-- Kolom 2: Info Pelanggan -->
                  <div class="col-md-6">
                    <div class="card-box">
                        <h6 class="card-title">Pendapatan (Harian)</h6>
                        <div class="row">
                          <div class="col-6">
                              <p>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                              <small>Hari ini ({{ now()->translatedFormat('l') }})</small>
                          </div>
                          <div class="col-6">
                              <p>Rp {{ number_format($pendapatanKemarin, 0, ',', '.') }}</p>
                              <small>Kemarin ({{ now()->subDay()->translatedFormat('l') }})</small>
                          </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="card-box pt-2">
                        <h6 class="card-title ">Harga Laundry /Kg</h6>
                        <div class="row pb-4">
                          <div class="col-6">Rp 5.000<br><small class="">3 Hari</small></div>
                          <div class="col-6">Rp 8.000<br><small class="">1 Hari</small></div>
                          <div class="col-6 pt-2">Rp 12.000<br><small class="">Ekspress</small></div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary w-100" style="height: 40px" data-bs-toggle="modal" data-bs-target="#createModal">
                          Tambah Transaksi
                        </button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
    </div>
  
    <div class="card mx-3">
      <div class="card-header bg-white">
        <strong>Transaksi</strong>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Berat</th>
              <th>Tanggal Masuk</th>
              <th>Total Harga</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksi as $item)
              <tr>
                  <td>{{ $item->pelanggan->name ?? '-' }}</td>
                  <td>{{ $item->berat_pakaian }}</td>
                  <td>{{ date('d M Y', strtotime($item->tgl_masuk)) }}</td>
                  <td>Rp {{ number_format($item->jml_transaksi) }}</td>
                  <td><span class="btn text-white {{ now()->lessThan($item->tgl_selesai) ? 'bg-primary' : 'bg-success' }}">{{ now()->lessThan($item->tgl_selesai) ? 'Diproses' : 'Selesai' }}</span></td>
                  <td><a href="{{ route('detailTransaksi', $item->id) }}" class="btn btn-warning">Detail</a></td>
                </tr>
            @endforeach

          </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $transaksi->links() }}
        </div>
      </div>
    </div>
</div>

<script>
  const ctx = document.getElementById('chartTransaksi').getContext('2d');
  const chartTransaksi = new Chart(ctx, {
      type: 'line',
      data: {
          labels: {!! json_encode($labels) !!},
          datasets: [{
              label: 'Jumlah Transaksi Selesai',
              data: {!! json_encode($jumlah) !!},
              borderColor: 'rgba(54, 162, 235, 1)',
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              tension: 0.4,
              borderWidth: 2,
              fill: true,
              pointBackgroundColor: 'rgba(54, 162, 235, 1)',
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  stepSize: 1,
                  ticks: {
                      precision: 0
                  }
              }
          },
          plugins: {
              legend: {
                  display: true,
                  position: 'top',
              }
          }
      }
  });
  </script>

<x-footer></x-footer>

<x-navbar></x-navbar>
   
 
<div class="">
    <div class="d-flex justify-content-between py-3 p-3 bg-success" style="height: 150px;">
      <h4 class="mb-0 text-white">Pelanggan</h4>
    </div>
    
    <div class="row d-flex justify-content-center g-3 mb-4 mx-2" style="transform: translateY(-60px);">
        <div class="col-md-12">
            <div class="card bg-light shadow">
              <div class="card-body">
                <div class="row">
                  <!-- Kolom 1: Chart -->
                  <div class="col-md-6 border-end">
                    <h5 class="mb-3 text-center">Paket Laundry Terfaforit</h5>
                    <div class="d-flex justify-content-center">
                      <canvas id="pelangganPieChart" style="max-width: 300px; max-height: 300px;"></canvas>
                    </div>
                  </div>
        
                  <!-- Kolom 2: Info Pelanggan -->
                  <div class="col-md-6">
                    <h5 class="mb-3 text-center">Informasi Pelanggan</h5>
                    <div class="row">
                      <ul class="list-unstyled col-md-6">
                        <li><strong>Total Pelanggan :</strong> 120</li>
                        <li><strong>Pelanggan Bronze :</strong> 35</li>
                        <li><strong>Pelanggan Silver :</strong> 50</li>
                        <li><strong>Pelanggan Gold  :</strong> 35</li>
                      </ul>
                      <ul class="list-unstyled col-md-6">
                        <li><strong>Level</strong></li>
                        <li><strong>Bronze :</strong> > 1000 Poin</li>
                        <li><strong>Silver :</strong> > 5000 Poin</li>
                        <li><strong>Gold  :</strong> > 10000 Poin</li>
                      </ul>
                    </div>
                    <hr>
                    <p><strong>Note : </strong>Level ditentukan berdasarkan transaksi yang dilakukan user,
                      10 poin didapatkan user ketika melakukan transaksi 1kg</p>
                      
                    <a href="/addPelanggan" class="btn text-white bg-primary w-100 mt-4" style="height: 40px">Tambah Pelanggan</a>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  
    <div class="card mx-3">
      <div class="card-header bg-white">
        <strong>Pelangan</strong>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>No Hp</th>
              <th>Alamat</th>
              <th>Level</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pelanggan as $data )
              <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>{{ $data->alamat }}</td>
                <td>{{ $data->level }}</td>
                <td><a href="{{ route('pelangganDetail', $data->id) }}" class="btn btn-success">Detail</a></td>
              </tr>
            @endforeach           
          </tbody>
        </table>
      </div>
    </div>
</div>

<script>
  const ctx = document.getElementById('pelangganPieChart').getContext('2d');
  const pelangganPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Bronze', 'Silver', 'Gold'],
      datasets: [{
        data: [30, 60, 10], // jumlah bisa disesuaikan
        backgroundColor: [
          '#0d6efd',  // biru
          '#198754',  // hijau
          '#dc3545'   // merah
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>

<x-footer></x-footer>


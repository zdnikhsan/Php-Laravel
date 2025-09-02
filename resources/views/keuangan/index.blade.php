<x-navbar></x-navbar>

<div class="container mt-4">
    <h2>Laporan Keuangan</h2>
    <div class="mb-3">
        <form method="GET" action="{{ route('keuangan.index') }}">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()" class="form-select" style="width:200px; display:inline-block;">
                <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </form>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Pendapatan</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Pengeluaran</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Laba Bersih</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($laba_bersih, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4>Ringkasan Keuangan Tahunan</h4>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Bulan</th>
                    <th>Pendapatan</th>
                    <th>Pengeluaran</th>
                    <th>Laba Bersih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($summary as $item)
                <tr>
                    <td>{{ $item['bulan'] }}</td>
                    <td>Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['pengeluaran'], 0, ',', '.') }}</td>
                    <td class="{{ $item['laba_bersih'] < 0 ? 'text-danger' : 'text-success' }}">
                        Rp {{ number_format($item['laba_bersih'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="card">
        <div class="card-header">
            Grafik Pendapatan Bulanan
        </div>
        <div class="card-body">
            <canvas id="chartPendapatan" height="100"></canvas>
        </div>
    </div>
</div>

<x-footer></x-footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPendapatan').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [@foreach(range(1,12) as $m) '{{ $m }}', @endforeach],
            datasets: [{
                label: 'Pendapatan Bulanan',
                data: [
                    @foreach(range(1,12) as $m)
                        {{ $chartData[$m] ?? 0 }},
                    @endforeach
                ],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            }]
        }
    });
</script>

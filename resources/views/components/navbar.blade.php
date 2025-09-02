<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MyLaundry</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<!-- Tombol toggle sidebar untuk mobile -->
<div class="d-md-none d-flex justify-content-between align-items-center p-3 bg-dark text-white">
  <div class="fw-bold">MyLaundry</div>
  <button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
    ☰
  </button>
</div>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar desktop -->
    <div class="col-md-3 col-lg-2 d-none d-md-block bg-dark text-white p-1 min-vh-100 position-fixed">
      <h4 class="text-center mb-2 fs-4">MyLaundry</h4>
      <hr>
      <ul class="nav flex-column">
        <a href="/dashboard" class="d-flex align-items-center p-2 rounded text-light px-2 text-decoration-none" onmouseover="this.style.backgroundColor='#495057';" onmouseout="this.style.backgroundColor='';">
          <i class="bi bi-house-door-fill pe-2"></i>
          Dashboard
        </a>
        <a href="/pesanan" class="d-flex align-items-center p-2 rounded text-light px-2 text-decoration-none" onmouseover="this.style.backgroundColor='#495057';" onmouseout="this.style.backgroundColor='';">
          <i class="bi bi-card-list pe-2"></i>
          Pesanan
        </a>       
        <div class="dropdown">
          <button class="btn btn-dark dropdown-toggle px-2 w-100 text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-grid pe-1"></i> Manajemen
          </button>
          <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="border-radius: 8px;">
          @can('manage-admin')
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/admin" 
              style="border-radius: 8px; padding: 10px 15px; margin: 2px 0; transition: background-color 0.2s; display: block;">
              <i class="bi bi-person-check" style="margin-right: 8px;"></i> Admin
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/keuangan" 
              style="border-radius: 8px; padding: 10px 15px; margin: 2px 0; transition: background-color 0.2s; display: block;">
              <i class="bi bi-cash-coin" style="margin-right: 8px;"></i> Keuangan
            </a>
          </li>
          @endcan
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/manage" 
               style="border-radius: 8px; padding: 10px 15px; margin: 2px 0; transition: background-color 0.2s; display: block;">
              <i class="bi bi-people" style="margin-right: 8px;"></i> Pengguna
            </a>
          </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="/showInvent" 
              style="border-radius: 8px; padding: 10px 15px; margin: 2px 0; transition: background-color 0.2s; display: block;">
              <i class="bi bi-bag-check-fill" style="margin-right: 8px;"></i> Persediaan
            </a>
          </li>
        </ul>
      </div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-dark px-2 w-100 text-start text-decoration-none" onmouseover="this.style.backgroundColor='#495057';" onmouseout="this.style.backgroundColor='';">
            <i class="bi bi-door-closed-fill"></i>
            Logout
          </button>         
      </form>
        
        
      </ul>
    </div>

    <!-- Konten utama -->
    <main class="col-md-9 col-lg-10 px-0 offset-md-3 offset-lg-2" style="overflow-y: auto">
      <nav class="navbar d-none d-md-block" style="height: 51px; background-color:#e9ecef">
        <div class="d-flex">
          <p class="ms-auto pe-3">admin</p>
        </div>
      </nav>


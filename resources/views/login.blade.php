<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Pemilik Laundry | CleanFast</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .btn-primary {
      background-color: #007B5E;
      border: none;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="text-center mb-4">
      <h3>Login Pemilik Laundry</h3>
      <p class="text-muted">Masuk untuk mengelola usaha Anda</p>
    </div>
    <form action="{{ route('submitLogin') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="nama@laundry.com">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
      </div>
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">Masuk</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

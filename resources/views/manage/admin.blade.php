<x-navbar></x-navbar>

<div>
    <div class="d-flex justify-content-between py-3 p-3 bg-success" style="height: 150px;">
        <h4 class="mb-0 text-white">Manajemen Admin</h4>
    </div>

    <div class="card mx-3" style="transform: translateY(-60px);">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong>Pelangan</strong>
          <button data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-light btn-sm" style="border-radius: 5px;"><i class="bi bi-plus-circle"></i> Tambah Admin</button>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
              <tr>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->role }}</td>
                  <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $admin->id }}" style="color:white;">Edit</button>
                      <form action="{{ route('adminDestroy', $admin->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus admin ini?')" style="color:white;">Hapus</button>
                      </form>
                  </td>
              </tr>
  
            @endforeach        
            </tbody>
          </table>
        </div>
      </div>
</div>
  
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('adminAdd') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color:#007bff;color:white;">
                    <h5 class="modal-title">Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror"
                        value="{{ old('role') }}" required>
                            <option value="">Pilih Role</option>
                            <option value="su_admin">SuperAdmin</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        value="{{ old('password') }}" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="color:white;">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addModal = new bootstrap.Modal(document.getElementById('addModal'));
        addModal.show();
    });
</script>
@endif

@foreach ($admins as $admin)
<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('adminUpdate', $admin->id) }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color:#ffc107;">
                    <h5 class="modal-title">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option {{ $admin->role == 'su_admin' ? 'selected' : '' }}>SuperAdmin</option>
                            <option {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="{{ $admin->password }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" style="color:white;">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<x-footer></x-footer>
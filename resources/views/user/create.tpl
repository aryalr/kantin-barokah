{include file='header.tpl' title='Tambah User'}

<h2>Tambah User Kasir Baru</h2>

<form action="?page=users&action=store" method="post" class="mt-3">
  <div class="mb-3">
    <label for="username" class="form-label">Username:</label>
    <input type="text" id="username" name="username" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-success">Simpan User</button>
  <a href="?page=users" class="btn btn-secondary">Batal</a>
</form>

{include file='footer.tpl'}
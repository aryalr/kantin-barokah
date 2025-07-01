{include file='header.tpl' title='Manajemen User'}

<h2>Manajemen User</h2>

<a href="?page=users&action=create" class="btn btn-primary mb-3">
  <i class="bi bi-person-plus-fill"></i> Tambah User Kasir
</a>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Username</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    {foreach $users as $user}
      <tr>
        <td>{$user.username}</td>
        <td>{$user.role}</td>
        <td>
          {if $user.id_user != $currentUser.id_user}
            <a href="?page=users&action=delete&id={$user.id_user}" class="btn btn-danger btn-sm"
              onclick="return confirm('Yakin ingin menghapus user ini?')">
              <i class="bi bi-trash"></i> Hapus
            </a>
          {else}
            <span class="badge bg-secondary">(Akun Anda)</span>
          {/if}
        </td>
      </tr>
    {/foreach}
  </tbody>
</table>

{include file='footer.tpl'}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Directory</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body::-webkit-scrollbar { display: none; }
body { -ms-overflow-style: none; scrollbar-width: none; }

body {
  font-family: monospace, 'Times New Roman';
  background: linear-gradient(to bottom right, #f8f6fb, #e6e6fa);
  margin: 0;
  min-height: 100vh;
  overflow-x: hidden;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding-top: 50px;
}

.glass-container {
  width: 95%;
  max-width: 1200px;
  padding: 25px;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 20px;
  border: 2px solid #000;
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  overflow-x: hidden;
}

h2 {
  text-align: center;
  font-size: 1.8rem;
  font-weight: 600;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  color: #000;
}

.user-status {
  text-align: center;
  margin-bottom: 15px;
  font-weight: 600;
  font-size: 14px;
  color: #000;
}

.top-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: space-between;
  margin-bottom: 15px;
}

.logout-btn {
  padding: 8px 16px;
  font-size: 13px;
  background: #fff;
  color: #000;
  border-radius: 6px;
  font-weight: 600;
  border: 2px solid #000;
  transition: 0.3s;
}
.logout-btn:hover { background: #f44336; color: white; }

.search-form {
  display: flex;
  align-items: center;
  gap: 6px;
  flex: 1;
  max-width: 300px;
  border: 2px solid #000;
  border-radius: 12px;
  padding: 4px 8px;
  background: #fff;
}

.search-form i { color: #000; font-size: 13px; }

.search-form input {
  border: none;
  outline: none;
  flex: 1;
  font-size: 13px;
  background: transparent;
  font-weight: 500;
  padding-left: 6px;
}

#clearSearch {
  background: transparent;
  border: none;
  font-weight: bold;
  cursor: pointer;
  color: #000;
  font-size: 15px;
}
#clearSearch:hover { color: #c62828; }

table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
  border: 2px solid #000;
  border-radius: 12px;
  overflow: hidden;
  font-size: 13px;
}

th, td {
  padding: 8px 10px;
  border-bottom: 1px solid #ccc;
  word-wrap: break-word;
  text-align: center;
  vertical-align: middle;
}

th {
  background: #C8A2C8;
  color: #fff;
  text-transform: uppercase;
  font-size: 14px;
}

tr:hover td { background: #F4F4FF; }

.email-badge {
  background: #C8A2C8/20;
  color: #4B0082;
  font-weight: 600;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  display: inline-block;
}

a.update-btn, .btn-create {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  padding: 4px 8px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 12px;
  text-decoration: none;
  white-space: nowrap;
  background: #fff;
  color: #000;
  border: 2px solid #000;
  transition: 0.3s;
}
a.update-btn:hover, .btn-create:hover { background: #C8A2C8; color: black; }

a.delete-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  padding: 4px 8px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 12px;
  text-decoration: none;
  white-space: nowrap;
  background: #fff;
  color: #f44336;
  border: 2px solid #000;
  transition: 0.3s;
}
a.delete-btn:hover { background: #f44336; color: white; }

.btn-create { padding: 10px 18px; font-size: 14px; border-radius: 10px; }

/* ==== Pagination ==== */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  margin-top: 12px;
  flex-wrap: wrap;
}

.pagination li a, .pagination li span {
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 35px;  
  height: 35px;     
  border-radius: 8px;
  font-weight: 600;
  font-size: 14px;  
  text-align: center;
  background: #fff;
  color: #000;
  border: 2px solid #000;
  transition: 0.3s;
}

.pagination li a:hover, .pagination li span:hover { background: #C8A2C8; color: black; }
.pagination li.active span { background: #4B0082; color: white; border-color: #000; }
</style>
</head>
<body>
<div class="glass-container">
  <h2><i class="fa-solid fa-users"></i> <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?></h2>

  <?php if(!empty($logged_in_user)): ?>
    <div class="user-status">
      <i class="fa-solid fa-circle-user"></i> Welcome: <span class="font-bold"><?= html_escape($logged_in_user['username']); ?></span>
    </div>
  <?php else: ?>
    <div class="user-status text-red-600 font-bold">Logged in user not found</div>
  <?php endif; ?>

  <div class="top-bar">
    <a href="<?=site_url('auth/logout'); ?>" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    <form action="<?=site_url('users');?>" method="get" class="search-form">
      <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
      <i class="fa-solid fa-magnifying-glass"></i>
      <input id="searchInput" name="q" type="text" placeholder="Search users..." value="<?=html_escape($q);?>">
      <button type="button" id="clearSearch" style="display:none;">&times;</button>
    </form>
  </div>

  <div class="rounded-xl border-2 border-black mb-4">
    <table>
      <thead>
        <tr>
          <th><i class="fa-solid fa-hashtag"></i> ID</th>
          <th><i class="fa-solid fa-user"></i> Username</th>
          <th><i class="fa-solid fa-envelope"></i> Email</th>
          <?php if ($logged_in_user['role'] === 'admin'): ?>
            <th><i class="fa-solid fa-lock"></i> Password</th>
            <th><i class="fa-solid fa-user-shield"></i> Role</th>
          <?php endif; ?>
          <th><i class="fa-solid fa-gear"></i> Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
          <td><?=html_escape($user['id']); ?></td>
          <td><?=html_escape($user['username']); ?></td>
          <td><span class="email-badge"><?=html_escape($user['email']);?></span></td>

          <?php if ($logged_in_user['role'] === 'admin'): ?>
            <td>*******</td>
            <td><?= html_escape($user['role']); ?></td>
          <?php endif; ?>

          <td>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <div class="flex justify-center gap-2">
                <a href="<?=site_url('/users/update/'.$user['id']);?>" class="update-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <a href="<?=site_url('/users/delete/'.$user['id']);?>" class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</a>
              </div>
            <?php else: ?>
              <div class="flex justify-center text-gray-500 font-semibold">
                View Only
              </div>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <ul class="pagination">
    <?= $page; ?>
  </ul>

  <?php if ($logged_in_user['role'] === 'admin'): ?>
    <div class="text-center mt-3">
      <a href="<?=site_url('users/create'); ?>" class="btn-create"><i class="fa-solid fa-user-plus"></i> Create New User</a>
    </div>
  <?php endif; ?>
</div>

<script>
const clearBtn = document.getElementById('clearSearch');
const searchInput = document.getElementById('searchInput');
function toggleClearButton() {
  clearBtn.style.display = searchInput.value.trim() ? 'inline' : 'none';
}
toggleClearButton();
searchInput.addEventListener('input', toggleClearButton);
clearBtn.addEventListener('click', function() {
  searchInput.value = '';
  toggleClearButton();
  window.location.href = '<?=site_url('users');?>';
});
</script>
</body>
</html>

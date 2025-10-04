<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Directory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-[#E6E6FA] min-h-screen font-mono">

  <!-- Navbar -->
  <nav class="bg-white shadow-md border-b-2 border-black">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <h1 class="text-xl font-bold text-black flex items-center gap-2">
        <i class="fa-solid fa-users"></i> 
        <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
      </h1>
      <div class="flex items-center gap-3">
        <span class="text-gray-700">Welcome, <b><?= html_escape($logged_in_user['username']); ?></b></span>
        <a href="<?=site_url('auth/logout');?>" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow">
          Logout
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl border-2 border-black">

      <!-- Search & Add -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <!-- Search -->
        <form method="get" action="<?=site_url('users')?>" class="flex items-center gap-2 border-2 border-black rounded-xl px-3 py-2 bg-white shadow w-full md:w-1/2">
          <i class="fa-solid fa-search text-gray-500"></i>
          <input type="text" name="q" value="<?=html_escape($_GET['q'] ?? '')?>" placeholder="Search users..." class="outline-none w-full">
        </form>

        <!-- Add New (Admin only) -->
        <?php if ($logged_in_user['role'] === 'admin'): ?>
        <a href="<?=site_url('users/create')?>"
           class="inline-flex items-center gap-2 bg-white hover:bg-[#C8A2C8] text-black font-semibold px-5 py-2 rounded-xl shadow transition duration-300 border-2 border-black">
          <i class="fa-solid fa-user-plus"></i> Add New User
        </a>
        <?php endif; ?>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-xl border-2 border-black shadow">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-[#C8A2C8] text-white text-sm uppercase">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Username</th>
              <th class="py-3 px-4">Email</th>
              <?php if ($logged_in_user['role'] === 'admin'): ?>
                <th class="py-3 px-4">Password</th>
                <th class="py-3 px-4">Role</th>
              <?php endif; ?>
              <th class="py-3 px-4">Actions</th>
            </tr>
          </thead>
          <tbody class="text-gray-900 text-sm">
            <?php foreach($users as $user): ?>
              <tr class="hover:bg-gray-100 transition">
                <td class="py-3 px-4 font-medium"><?=html_escape($user['id']);?></td>
                <td class="py-3 px-4"><?=html_escape($user['username']);?></td>
                <td class="py-3 px-4"><?=html_escape($user['email']);?></td>
                <?php if ($logged_in_user['role'] === 'admin'): ?>
                  <td class="py-3 px-4">*******</td>
                  <td class="py-3 px-4"><?=html_escape($user['role']);?></td>
                <?php endif; ?>
                <td class="py-3 px-4 flex justify-center gap-2">
                  <a href="<?=site_url('users/update/'.$user['id']);?>"
                     class="bg-white border-2 border-black hover:bg-[#C8A2C8] px-3 py-1 rounded-lg shadow flex items-center gap-1">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                  </a>
                  <a href="<?=site_url('users/delete/'.$user['id']);?>"
                     onclick="return confirm('Delete this user?');"
                     class="bg-white border-2 border-black hover:bg-red-500 hover:text-white text-red-500 px-3 py-1 rounded-lg shadow flex items-center gap-1">
                    <i class="fa-solid fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6 flex justify-center">
        <?=$page ?? ''?>
      </div>
    </div>
  </div>
</body>
</html>

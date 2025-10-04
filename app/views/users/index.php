<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { font-family: monospace, 'Times New Roman'; background: linear-gradient(to bottom right, #f8f6fb, #e6e6fa); }
    .delete-btn:hover i { color: white !important; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="bg-white shadow-md border-b-2 border-black">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <h1 class="text-xl font-bold text-black flex items-center gap-2 font-mono">
        <i class="fa-solid fa-users text-black"></i> User Directory
      </h1>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl border-2 border-black">

      <!-- Search + Add -->
      <div class="flex flex-col md:flex-row md:justify-between gap-4 mb-6">
        <form method="get" action="<?=site_url()?>" class="flex items-center gap-2 border-2 border-black rounded-xl px-3 py-2 bg-white shadow w-full md:w-1/2">
          <i class="fa-solid fa-search text-gray-500"></i>
          <input type="text" name="q" value="<?=html_escape($_GET['q'] ?? '')?>" placeholder="Search users..." class="outline-none w-full font-mono">
        </form>
        <a href="<?=site_url('users/create')?>"
           class="inline-flex items-center gap-2 bg-white hover:bg-[#C8A2C8] text-black font-semibold px-5 py-2 rounded-xl border-2 border-black shadow transition duration-300">
          <i class="fa-solid fa-user-plus"></i> Add New User
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-xl border-2 border-black shadow">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-[#C8A2C8] text-white uppercase text-sm">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Username</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Actions</th>
            </tr>
          </thead>
          <tbody class="text-gray-900 text-sm">
            <?php foreach($users as $user): ?>
              <tr class="hover:bg-gray-100">
                <td class="py-3 px-4"><?= $user['id']?></td>
                <td class="py-3 px-4"><?= $user['username']?></td>
                <td class="py-3 px-4"><?= $user['email']?></td>
                <td class="py-3 px-4 flex justify-center gap-3">
                  <a href="<?=site_url('users/update/'.$user['id'])?>"
                     class="bg-white border-2 border-black px-3 py-1 rounded-lg hover:bg-[#C8A2C8] shadow transition">Edit</a>
                  <a href="<?=site_url('users/delete/'.$user['id'])?>" onclick="return confirm('Delete this user?')"
                     class="delete-btn bg-white border-2 border-black px-3 py-1 rounded-lg hover:bg-red-500 hover:text-white text-red-500 shadow transition">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</body>
</html>

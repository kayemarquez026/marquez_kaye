<?php
// Controller logic (example)
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$per_page = 5;

// Filter users by search
$filtered_users = array_filter($users, function($u) use($search){
    return stripos($u['first_name'], $search) !== false
        || stripos($u['last_name'], $search) !== false
        || stripos($u['email'], $search) !== false;
});

$total_users = count($filtered_users);
$total_pages = ceil($total_users / $per_page);
$start = ($page - 1) * $per_page;
$users_paginated = array_slice($filtered_users, $start, $per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { font-family: monospace, 'Times New Roman'; }
    .delete-btn:hover i { color: white !important; }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 text-gray-900">

<!-- Navbar -->
<nav class="bg-white/50 backdrop-blur-md shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <h1 class="text-xl font-bold text-black flex items-center gap-2 font-mono">
      <i class="fa-solid fa-users text-black text-lg"></i> User Directory
    </h1>
  </div>
</nav>

<!-- Main Content -->
<div class="max-w-6xl mx-auto mt-10 px-4">
  <div class="bg-white p-8 rounded-2xl shadow-2xl border-black" style="border-width:3px;">

    <!-- Search & Add New User -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
      <form method="GET" class="flex gap-2 w-full md:w-auto">
        <input type="text" name="search" placeholder="Search by name or email..."
               value="<?=htmlspecialchars($search)?>"
               class="px-4 py-2 border-2 border-black rounded-xl w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-[#C8A2C8]">
        <button type="submit" class="px-4 py-2 bg-[#C8A2C8] text-white rounded-xl border-2 border-black hover:bg-[#4B0082] transition duration-200">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>

      <a href="<?=site_url('users/create')?>"
         class="inline-flex items-center gap-2 bg-white hover:bg-[#C8A2C8] text-black font-semibold px-5 py-2 rounded-xl shadow-lg transition duration-300 hover:text-white border-2 border-black">
        <i class="fa-solid fa-user-plus text-black text-lg"></i> Add New User
      </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-2xl border-2 border-black shadow-lg">
      <table class="w-full text-center border-collapse">
        <thead>
          <tr class="bg-[#C8A2C8] text-white text-sm uppercase tracking-wide">
            <th class="py-3 px-4"><i class="fa-solid fa-hashtag"></i> ID</th>
            <th class="py-3 px-4"><i class="fa-solid fa-user"></i> Lastname</th>
            <th class="py-3 px-4"><i class="fa-solid fa-user"></i> Firstname</th>
            <th class="py-3 px-4"><i class="fa-solid fa-envelope"></i> Email</th>
            <th class="py-3 px-4"><i class="fa-solid fa-gear"></i> Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-900 text-sm">
          <?php foreach($users_paginated as $user): ?>
          <tr class="transition duration-200">
            <td class="py-3 px-4 font-medium"><?=$user['id'];?></td>
            <td class="py-3 px-4"><?=$user['last_name'];?></td>
            <td class="py-3 px-4"><?=$user['first_name'];?></td>
            <td class="py-3 px-4">
              <span class="bg-[#C8A2C8]/20 text-[#4B0082] text-sm font-semibold px-3 py-1 rounded-full">
                <?=$user['email'];?>
              </span>
            </td>
            <td class="py-3 px-4 flex justify-center gap-3">
              <a href="<?=site_url('users/update/'.$user['id']);?>"
                 class="bg-white border-2 border-black hover:bg-[#C8A2C8] hover:text-white text-black font-semibold px-3 py-1 rounded-xl shadow flex items-center gap-1 transition duration-200">
                <i class="fa-solid fa-pen-to-square"></i> Update
              </a>
              <a href="<?=site_url('users/delete/'.$user['id']);?>"
                 class="delete-btn bg-white border-2 border-black hover:bg-red-500 hover:text-white text-red-500 px-3 py-1 rounded-xl shadow flex items-center gap-1 transition duration-200">
                 <i class="fa-solid fa-trash"></i> Delete
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-6 gap-2 items-center">
      <a href="<?=($page>1)? site_url('users?page='.($page-1).'&search='.urlencode($search)):'#';?>">
        <button class="px-3 py-1 border-2 border-black rounded-xl shadow font-semibold transition duration-200 <?=($page==1)?'opacity-50 cursor-not-allowed':''?>">
          <i class="fa-solid fa-arrow-left"></i>
        </button>
      </a>

      <?php for($i=1; $i<=$total_pages; $i++): ?>
        <a href="<?=site_url('users?page='.$i.'&search='.urlencode($search));?>">
          <button class="px-3 py-1 border-2 border-black rounded-xl shadow font-semibold transition duration-200 <?=($page==$i)?'bg-[#C8A2C8] text-white':'bg-white text-black hover:bg-[#C8A2C8] hover:text-white'?>">
            <?=$i;?>
          </button>
        </a>
      <?php endfor; ?>

      <a href="<?=($page<$total_pages)? site_url('users?page='.($page+1).'&search='.urlencode($search)):'#';?>">
        <button class="px-3 py-1 border-2 border-black rounded-xl shadow font-semibold transition duration-200 <?=($page==$total_pages)?'opacity-50 cursor-not-allowed':''?>">
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </a>
    </div>

  </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-[#E6E6FA] min-h-screen flex items-center justify-center font-mono text-gray-900">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-[3px] border-black">
    <!-- Heading -->
    <h2 class="text-2xl font-bold text-center text-black mb-6 flex items-center justify-center gap-2">
      <i class="fa-solid fa-pen-to-square text-black"></i> UPDATE NOW...
    </h2>

    <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-4">
      <!-- Username -->
      <div>
        <label class="block text-gray-800 mb-1 flex items-center gap-2">
          <i class="fa-solid fa-user text-yellow-800"></i> Username
        </label>
        <input type="text" name="username" value="<?= html_escape($user['username'])?>" required
               class="w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-800 mb-1 flex items-center gap-2">
          <i class="fa-solid fa-envelope text-red-600"></i> Email Address
        </label>
        <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
               class="w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
      </div>

      <!-- Admin-only: Role & Password -->
      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
        <div>
          <label class="block text-gray-800 mb-1">Role</label>
          <select name="role" required
                  class="w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
          </select>
        </div>

        <div>
          <label class="block text-gray-800 mb-1">Password</label>
          <input type="password" name="password" placeholder="Password" required
                 class="w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
        </div>
      <?php endif; ?>

      <!-- Buttons -->
      <div class="flex flex-col gap-3">
        <button type="submit"
                class="w-full bg-[#C8A2C8] hover:bg-black hover:text-white text-black font-semibold py-3 rounded-xl border-[2px] border-black shadow-lg transition duration-300 flex items-center justify-center gap-2">
          <i class="fa-solid fa-pen-to-square"></i> Update
        </button>
        <a href="<?=site_url('/users');?>" 
           class="w-full text-center bg-black text-white font-semibold py-3 rounded-xl border-[2px] border-black hover:bg-[#C8A2C8] hover:text-black transition duration-300">
          Return to Users
        </a>
      </div>
    </form>
  </div>

</body>
</html>

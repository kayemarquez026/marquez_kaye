<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: monospace, 'Times New Roman';
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 min-h-screen flex items-start justify-center text-gray-900 pt-2"> <!-- Tiny top padding -->

  <div class="bg-white p-7 rounded-2xl shadow-2xl w-full max-w-lg border-black mb-[10px]" style="border-width:3px;">
    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
        <i class="fa-solid fa-user text-white text-3xl"></i>
      </div>
      <h2 class="text-2xl font-bold text-black mt-2">Create User</h2>
      <p class="text-gray-600 text-sm mb-4">Register a new account</p>
    </div>

    <!-- Error message -->
    <?php if (!empty($error)): ?>
      <div class="bg-pink-100 text-pink-800 border border-pink-300 p-2 rounded mb-3 text-center text-sm">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="post" action="<?= site_url('users/create'); ?>" class="space-y-4">

      <!-- Username -->
      <div>
        <label class="block text-black mb-1 font-medium text-sm">Username</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
          <i class="fa-solid fa-user text-gray-700 mr-2 text-sm"></i>
          <input type="text" name="username" placeholder="Enter username" required
                 value="<?= isset($username) ? html_escape($username) : '' ?>"
                 class="w-full bg-white text-black focus:outline-none text-sm">
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-black mb-1 font-medium text-sm">Email Address</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
          <i class="fa-solid fa-envelope text-gray-700 mr-2 text-sm"></i>
          <input type="email" name="email" placeholder="Enter email" required
                 value="<?= isset($email) ? html_escape($email) : '' ?>"
                 class="w-full bg-white text-black focus:outline-none text-sm">
        </div>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-black mb-1 font-medium text-sm">Password</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
          <i class="fa-solid fa-lock text-gray-700 mr-2 text-sm"></i>
          <input type="password" name="password" placeholder="Enter password" required
                 class="w-full bg-white text-black focus:outline-none text-sm">
        </div>
      </div>

      <!-- Confirm Password -->
      <div>
        <label class="block text-black mb-1 font-medium text-sm">Confirm Password</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
          <i class="fa-solid fa-key text-gray-700 mr-2 text-sm"></i>
          <input type="password" name="confirm_password" placeholder="Confirm password" required
                 class="w-full bg-white text-black focus:outline-none text-sm">
        </div>
      </div>

      <!-- Role -->
      <div>
        <label class="block text-black mb-1 font-medium text-sm">Role</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
          <i class="fa-solid fa-user-shield text-gray-700 mr-2 text-sm"></i>
          <select name="role" required class="w-full bg-white text-black focus:outline-none text-sm">
            <option value="">-- Select Role --</option>
            <option value="admin" <?= isset($role) && $role=="admin" ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= isset($role) && $role=="user" ? 'selected' : '' ?>>User</option>
          </select>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit"
              class="w-full bg-[#C8A2C8] text-black font-semibold py-2 rounded-xl border-2 border-black shadow-lg transition duration-300 hover:bg-[#B0E0E6] hover:text-black mt-2">
        <i class="fa-solid fa-user-plus mr-2"></i> Register / Create User
      </button>

    </form>

  </div>

</body>
</html>

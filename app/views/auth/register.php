<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create User</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* Hide scrollbar completely */
body::-webkit-scrollbar { display: none; }
body { -ms-overflow-style: none; scrollbar-width: none; }

html, body {
  height: 100%;
  margin: 0;
}
</style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 flex items-center justify-center">

<div class="bg-white p-5 rounded-2xl shadow-2xl w-10/12 max-w-xl border-2 border-black transform -translate-y-0.5">

  <!-- Header -->
  <div class="flex flex-col items-center mb-5">
    <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
      <i class="fa-solid fa-user text-white text-3xl"></i>
    </div>
    <h2 class="text-2xl font-bold text-black mt-3">Create User</h2>
    <p class="text-gray-600 text-sm mb-3">Register a new account</p>
  </div>

  <!-- Error message -->
  <?php if (!empty($error)): ?>
    <div class="bg-pink-100 text-pink-800 border border-pink-300 p-2 rounded mb-3 text-center text-sm">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <!-- Form -->
  <form method="POST" action="<?= site_url('users/create'); ?>">

    <div class="w-11/12 mx-auto mb-3">
      <label class="block text-black mb-1 font-medium text-sm">Username</label>
      <div class="flex items-center border-2 border-black rounded-xl px-3 py-1.5 w-full">
        <i class="fa-solid fa-user text-gray-700 mr-2 text-sm"></i>
        <input type="text" name="username" placeholder="Enter username" required
               value="<?= isset($username) ? html_escape($username) : '' ?>"
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <div class="w-11/12 mx-auto mb-3">
      <label class="block text-black mb-1 font-medium text-sm">Email Address</label>
      <div class="flex items-center border-2 border-black rounded-xl px-3 py-1.5 w-full">
        <i class="fa-solid fa-envelope text-gray-700 mr-2 text-sm"></i>
        <input type="email" name="email" placeholder="Enter email" required
               value="<?= isset($email) ? html_escape($email) : '' ?>"
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <div class="w-11/12 mx-auto mb-3">
      <label class="block text-black mb-1 font-medium text-sm">Password</label>
      <div class="flex items-center border-2 border-black rounded-xl px-3 py-1.5 w-full">
        <i class="fa-solid fa-lock text-gray-700 mr-2 text-sm"></i>
        <input type="password" name="password" placeholder="Enter password" required
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <div class="w-11/12 mx-auto mb-3">
      <label class="block text-black mb-1 font-medium text-sm">Confirm Password</label>
      <div class="flex items-center border-2 border-black rounded-xl px-3 py-1.5 w-full">
        <i class="fa-solid fa-key text-gray-700 mr-2 text-sm"></i>
        <input type="password" name="confirm_password" placeholder="Confirm password" required
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <div class="w-11/12 mx-auto mb-3">
      <label class="block text-black mb-1 font-medium text-sm">Role</label>
      <div class="flex items-center border-2 border-black rounded-xl px-3 py-1.5 w-full">
        <i class="fa-solid fa-user-shield text-gray-700 mr-2 text-sm"></i>
        <select name="role" required class="w-full bg-white text-black focus:outline-none text-sm">
          <option value="">-- Select Role --</option>
          <option value="admin" <?= isset($role) && $role=="admin" ? 'selected' : '' ?>>Admin</option>
          <option value="user" <?= isset($role) && $role=="user" ? 'selected' : '' ?>>User</option>
        </select>
      </div>
    </div>

    <!-- Button with extra top margin -->
    <div class="w-11/12 mx-auto mt-8">
      <button type="submit"
              class="w-full bg-[#C8A2C8] text-black font-semibold py-2 rounded-xl border-2 border-black shadow-lg hover:bg-[#B0E0E6] transition flex justify-center items-center gap-2">
        <i class="fa-solid fa-user-plus"></i> Register / Create User
      </button>
    </div>

  </form>

  <!-- Text right below the button with 15px space at the bottom -->
    <div class="text-center mt-3 text-sm mb-[15px]">
        Already have an account? 
        <a href="<?= site_url('auth/login'); ?>" class="text-[#f44336] font-semibold hover:underline">Login here</a>
    </div>


</div>
</body>
</html>

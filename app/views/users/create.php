<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 min-h-screen flex items-center justify-center font-mono">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-2 border-black">
    
    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
        <i class="fa-solid fa-user-plus text-white text-3xl"></i>
      </div>
      <h2 class="text-2xl font-bold text-black mt-3">Create User</h2>
      <p class="text-gray-600 text-sm">Add a new user account</p>
    </div>

    <!-- Form -->
    <form action="<?=site_url('users/create')?>" method="POST" class="space-y-5">

      <!-- Username -->
      <div>
        <label class="block text-black mb-1 font-medium">Username</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3">
          <i class="fa-solid fa-user text-[#8B4513] mr-2"></i>
          <input type="text" name="username" placeholder="Enter username" required
                 value="<?= isset($username) ? html_escape($username) : '' ?>"
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-black mb-1 font-medium">Email</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3">
          <i class="fa-solid fa-envelope text-red-500 mr-2"></i>
          <input type="email" name="email" placeholder="example@email.com" required
                 value="<?= isset($email) ? html_escape($email) : '' ?>"
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
        </div>
      </div>

      <!-- Role (only if admin) -->
      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
      <div>
        <label class="block text-black mb-1 font-medium">Role</label>
        <select name="role" class="w-full px-3 py-3 border-2 border-black rounded-xl focus:outline-none">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <?php endif; ?>

      <!-- Password -->
      <div class="relative">
        <label class="block text-black mb-1 font-medium">Password</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3">
          <i class="fa-solid fa-lock text-gray-600 mr-2"></i>
          <input type="password" id="password" name="password" placeholder="Enter password" required
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
          <i class="fa-solid fa-eye absolute right-4 text-gray-600 cursor-pointer" id="togglePassword"></i>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex flex-col gap-3">
        <button type="submit"
                class="w-full bg-[#C8A2C8] text-black font-semibold py-3 rounded-xl border-2 border-black shadow-lg hover:bg-[#B0E0E6] transition">
          <i class="fa-solid fa-user-plus mr-2"></i> Create User
        </button>
        <a href="<?=site_url('/users');?>" 
           class="w-full text-center bg-white hover:bg-gray-200 text-black font-semibold py-3 rounded-xl border-2 border-black shadow">
          Return to Home
        </a>
      </div>
    </form>
  </div>

<script>
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("click", function () {
    const type = password.type === "password" ? "text" : "password";
    password.type = type;
    this.classList.toggle("fa-eye-slash");
  });
</script>

</body>
</html>

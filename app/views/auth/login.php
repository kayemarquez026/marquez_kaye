<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: monospace, 'Times New Roman';
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-[#E6E6FA] min-h-screen flex items-center justify-center text-gray-900">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-[3px] border-black">
    
    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
        <i class="fa-solid fa-right-to-bracket text-white text-3xl"></i>
      </div>
      <h2 class="text-2xl font-bold text-black mt-3">User Login</h2>
      <p class="text-gray-600 text-sm">Access your account securely</p>
    </div>

    <!-- Error Message -->
    <?php if (!empty($error)): ?>
      <div class="mb-4 p-3 rounded-lg border-[2px] border-red-600 bg-red-100 text-red-700 text-center text-sm">
        <i class="fa-solid fa-circle-exclamation"></i> <?= $error ?>
      </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" action="<?= site_url('auth/login') ?>" class="space-y-5">

      <!-- Username -->
      <div>
        <label class="block text-black mb-1 font-medium">Username</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3">
          <i class="fa-solid fa-user text-[#8B4513] mr-2"></i>
          <input type="text" name="username" placeholder="Enter your username" required
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
        </div>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-black mb-1 font-medium">Password</label>
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3 relative">
          <i class="fa-solid fa-lock text-gray-600 mr-2"></i>
          <input type="password" name="password" id="password" placeholder="Enter your password" required
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
          <i class="fa-solid fa-eye toggle-password absolute right-3 cursor-pointer text-gray-700" id="togglePassword"></i>
        </div>
      </div>

      <!-- Button -->
      <button type="submit"
              class="w-full bg-[#C8A2C8] text-black font-semibold py-3 rounded-xl border-2 border-black shadow-lg transition duration-300 hover:bg-[#B0E0E6] hover:text-black flex items-center justify-center gap-2">
        <i class="fa-solid fa-right-to-bracket"></i> Login
      </button>

    </form>

    <!-- Register Link -->
    <div class="mt-5 text-center">
      <p class="text-sm text-gray-700">Don't have an account? 
        <a href="<?= site_url('auth/register'); ?>" class="text-[#4B0082] font-semibold hover:underline">
          Register here
        </a>
      </p>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>
</html>

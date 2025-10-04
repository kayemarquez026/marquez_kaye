<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <style>
    body {
      font-family: monospace, 'Times New Roman';
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 min-h-screen flex items-center justify-center text-gray-900">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-black" style="border-width:3px;">

    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
        <i class="fa-solid fa-lock text-white text-3xl"></i>
      </div>
      <h2 class="text-2xl font-bold text-black mt-3">Login</h2>
      <p class="text-gray-600 text-sm">Enter your credentials to access your account</p>
    </div>

    <!-- Error Message -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-5 text-center text-sm border border-red-700">
        <?= $error ?>
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
        <div class="flex items-center border-2 border-black rounded-xl bg-white px-3">
          <input type="password" name="password" id="password" placeholder="Enter your password" required
                 class="w-full px-2 py-3 bg-white text-black focus:outline-none">
        </div>
      </div>

      <!-- Login Button -->
      <button type="submit"
              class="w-full bg-[#C8A2C8] text-black font-semibold py-3 rounded-xl border-2 border-black shadow-lg transition duration-300 hover:bg-[#B0E0E6] hover:text-black">
        <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
      </button>

    </form>

    <!-- Register Link -->
    <div class="mt-5 text-center">
      <p class="text-gray-600 text-sm">
        Don't have an account? 
        <a href="<?= site_url('auth/register'); ?>" class="text-[#8B4513] font-semibold hover:underline">Register here</a>
      </p>
    </div>

  </div>

</body>
</html>

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
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 min-h-screen flex items-center justify-center text-gray-900">

  <!-- Enlarged Form Card -->
  <div class="bg-white p-16 rounded-3xl shadow-2xl w-full max-w-3xl border-[4px] border-black">
    
    <!-- Header -->
    <div class="flex items-center justify-center mb-10 gap-6">
      <i class="fa-solid fa-user-lock text-black text-5xl"></i>
      <h1 class="text-5xl font-bold text-black">Login</h1>
    </div>
    <p class="text-gray-600 text-center text-lg mb-12">Enter your credentials to access your account</p>

    <!-- Error Message -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 px-6 py-4 rounded mb-8 text-center text-lg border border-red-500">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="<?= site_url('auth/login') ?>" method="POST" class="space-y-8">
      
      <!-- Username -->
      <div>
        <label class="block text-black mb-2 text-xl font-semibold">Username</label>
        <input type="text" name="username" placeholder="Username" required
               class="w-full px-4 py-3 text-lg bg-white text-black border-2 border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label class="block text-black mb-2 text-xl font-semibold">Password</label>
        <input type="password" name="password" placeholder="Password" required
               class="w-full px-4 py-3 text-lg bg-white text-black border-2 border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8] focus:outline-none">
      </div>

      <!-- Login Button -->
      <button type="submit"
              class="w-full bg-[#C8A2C8] text-black font-bold py-4 rounded-xl border-2 border-black shadow-lg text-xl transition duration-300 hover:bg-[#B0E0E6] hover:text-black">
        Login
      </button>

      <!-- Register Link -->
      <p class="text-center text-gray-600 text-lg">
        Don't have an account? <a href="<?= site_url('auth/register'); ?>" class="text-[#8f2c24] font-medium hover:underline">Register here</a>
      </p>

    </form>
  </div>

</body>
</html>

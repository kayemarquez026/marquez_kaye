<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 flex items-center justify-center min-h-screen p-4">

<div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md border-2 border-black min-h-[500px]"> <!-- slightly smaller height -->

  <div class="flex flex-col items-center mb-6">
    <div class="bg-black rounded-full p-3 shadow-md border-4 border-black mb-2">
      <i class="fa-solid fa-user text-white text-3xl"></i>
    </div>
    <h2 class="text-2xl font-bold text-black mb-1">Login</h2>
    <p class="text-gray-600 text-sm">Enter your credentials</p>
  </div>

  <?php if (!empty($error)): ?>
    <div class="bg-pink-100 text-pink-800 border border-pink-300 p-2 rounded mb-4 text-center text-sm">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= site_url('auth/login'); ?>" class="flex flex-col justify-between min-h-[220px]"> 

    <div class="space-y-2"> <!-- fields close to each other -->
      <div class="w-full">
        <label class="block text-black mb-1 font-medium text-sm">Username</label>
        <div class="flex items-center border-2 border-black rounded-xl px-3 py-2 w-full">
          <i class="fa-solid fa-user text-gray-700 mr-2 text-sm"></i>
          <input type="text" name="username" placeholder="Username" required
                 class="w-full bg-white text-black focus:outline-none text-sm py-1">
        </div>
      </div>

      <div class="w-full">
        <label class="block text-black mb-1 font-medium text-sm">Password</label>
        <div class="flex items-center border-2 border-black rounded-xl px-3 py-2 w-full">
          <i class="fa-solid fa-lock text-gray-700 mr-2 text-sm"></i>
          <input type="password" name="password" placeholder="Password" required
                 class="w-full bg-white text-black focus:outline-none text-sm py-1">
        </div>
      </div>
    </div>

    <div class="w-full mt-8"> <!-- smaller spacing before button -->
      <button type="submit" class="w-full bg-[#C8A2C8] text-black font-semibold py-2 rounded-xl border-2 border-black shadow-lg hover:bg-[#B0E0E6] transition flex justify-center items-center gap-2">
        <i class="fa-solid fa-right-to-bracket"></i> Login
      </button>
    </div>
  </form>

  <div class="text-center mt-4 text-sm">
    Don't have an account? 
    <a href="<?= site_url('auth/register'); ?>" class="text-[#f44336] font-semibold hover:underline">Register here</a>
  </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Update User</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  body {
    font-family: monospace, 'Times New Roman';
  }
</style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-lavender-100 min-h-screen flex items-start justify-center text-gray-900 pt-12">

<div class="bg-white p-7 rounded-2xl shadow-2xl w-full max-w-lg border-black" style="border-width:3px;">

  <!-- Header -->
  <div class="flex flex-col items-center mb-6">
    <div class="bg-black rounded-full p-3 shadow-md border-4 border-black">
      <i class="fa-solid fa-pen-to-square text-white text-3xl"></i>
    </div>
    <h2 class="text-2xl font-bold text-black mt-2">Update User</h2>
    <p class="text-gray-600 text-sm mb-4">Edit user details below</p>
  </div>

  <!-- Message Box -->
  <div id="messageBox" class="hidden bg-yellow-200 text-yellow-900 border border-black p-1.5 rounded mb-2 text-center text-xs">
    No changes detected. Your profile was not updated.
  </div>

  <!-- Form -->
  <form id="updateForm" action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-4">

    <!-- Username -->
    <div>
      <label class="block text-black mb-1 font-medium text-sm">Username</label>
      <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
        <i class="fa-solid fa-user text-gray-700 mr-2 text-sm"></i>
        <input type="text" name="username" value="<?= html_escape($user['username']); ?>" required
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <!-- Email -->
    <div>
      <label class="block text-black mb-1 font-medium text-sm">Email</label>
      <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
        <i class="fa-solid fa-envelope text-gray-700 mr-2 text-sm"></i>
        <input type="email" name="email" value="<?= html_escape($user['email']); ?>" required
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>

    <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
    <!-- Role -->
    <div>
      <label class="block text-black mb-1 font-medium text-sm">Role</label>
      <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
        <i class="fa-solid fa-user-shield text-gray-700 mr-2 text-sm"></i>
        <select name="role" required class="w-full bg-white text-black focus:outline-none text-sm">
          <option value="user" <?= $user['role']==='user'?'selected':'' ?>>User</option>
          <option value="admin" <?= $user['role']==='admin'?'selected':'' ?>>Admin</option>
        </select>
      </div>
    </div>

    <!-- Password -->
    <div>
      <label class="block text-black mb-1 font-medium text-sm">New Password</label>
      <div class="flex items-center border-2 border-black rounded-xl bg-white px-2 py-1.5">
        <i class="fa-solid fa-lock text-gray-700 mr-2 text-sm"></i>
        <input type="password" name="password" placeholder="Leave blank if unchanged"
               class="w-full bg-white text-black focus:outline-none text-sm">
      </div>
    </div>
    <?php endif; ?>

    <!-- Buttons -->
    <div class="flex gap-4 mt-2">


      <!-- Cancel Button -->
      <a href="<?=site_url('/users');?>"
        class="flex-1 flex justify-center items-center gap-2 bg-[#C8A2C8] group text-black font-semibold py-2 rounded-xl border-2 border-black shadow-lg transition duration-300 hover:bg-[#f44336] hover:text-white">
        <i class="fa-solid fa-right-from-bracket group-hover:text-white transition duration-300"></i> Cancel
      </a>
      <!-- Update Button -->
      <button type="submit"
              class="flex-1 flex justify-center items-center gap-2 text-black font-semibold py-2 rounded-xl border-2 border-black shadow-lg transition duration-300 hover:bg-[#f44336] hover:text-white group">
        <i class="fa-solid fa-pen-to-square text-[#f44336] group-hover:text-white transition duration-300"></i> Update
      </button>

    </div>

  </form>
</div>

<script>
const form = document.getElementById("updateForm");
const inputs = form.querySelectorAll("input, select");
const messageBox = document.getElementById("messageBox");

// Store original values
const originalValues = {};
inputs.forEach(input => originalValues[input.name] = input.value);

form.addEventListener("submit", function(e){
  let changed = false;
  inputs.forEach(input => {
    if(input.value !== originalValues[input.name]) changed = true;
  });

  if(!changed){
    e.preventDefault();
    messageBox.classList.remove('hidden');
    setTimeout(() => { messageBox.classList.add('hidden'); }, 2000);
  }
});
</script>

</body>
</html>

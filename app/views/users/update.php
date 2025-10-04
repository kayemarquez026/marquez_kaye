<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-[#E6E6FA] min-h-screen flex items-center justify-center font-mono text-gray-900">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-[3px] border-black">
    <h2 class="text-2xl font-bold text-center text-black mb-6 flex items-center justify-center gap-2">
      <i class="fa-solid fa-pen-to-square"></i> Update User
    </h2>

    <div id="messageBox" class="hidden mb-4 p-3 rounded-lg border-[2px] border-black bg-yellow-100 text-yellow-800 flex items-center gap-2">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span>No changes detected.</span>
    </div>

    <form id="updateForm" action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-4">
      <div>
        <label class="block text-gray-800 mb-1 flex items-center gap-2">
          <i class="fa-solid fa-user"></i> Username
        </label>
        <input type="text" name="username" value="<?= html_escape($user['username'])?>" required
               class="inputField w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8]">
      </div>

      <div>
        <label class="block text-gray-800 mb-1 flex items-center gap-2">
          <i class="fa-solid fa-envelope"></i> Email
        </label>
        <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
               class="inputField w-full px-4 py-3 bg-white text-black border-[2px] border-black rounded-xl focus:ring-2 focus:ring-[#C8A2C8]">
      </div>

      <button type="submit"
        class="w-full bg-[#C8A2C8] hover:bg-black hover:text-white text-black font-semibold py-3 rounded-xl border-[2px] border-black shadow-lg transition flex items-center justify-center gap-2">
        <i class="fa-solid fa-pen-to-square"></i> Update
      </button>
    </form>
  </div>

  <script>
    const form = document.getElementById("updateForm");
    const inputs = document.querySelectorAll(".inputField");
    const messageBox = document.getElementById("messageBox");

    const originalValues = {};
    inputs.forEach(input => originalValues[input.name] = input.value);

    form.addEventListener("submit", function(e) {
      let changed = false;
      inputs.forEach(input => {
        if (input.value !== originalValues[input.name]) changed = true;
      });
      if (!changed) {
        e.preventDefault();
        messageBox.classList.remove("hidden");
        setTimeout(() => messageBox.classList.add("hidden"), 2000);
      }
    });
  </script>
</body>
</html>

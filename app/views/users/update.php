<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    section {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      padding: 20px;
    }

    section .bg,
    section .trees {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }

    section .trees {
      z-index: 100;
    }

    .form-container {
      position: relative;
      padding: 50px;
      width: 400px;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      border: 1px solid #fff;
      border-radius: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
      text-align: center;
      font-size: 2.2em;
      font-weight: 600;
      color: #8f2c24;
      margin-bottom: 20px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      font-size: 1em;
      border-radius: 5px;
      border: none;
      margin-bottom: 15px;
    }

    .form-group input {
      background: #fff;
      color: #333;
    }

    .form-group select {
      background: #fff;
      color: #333;
    }
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-80%);
      cursor: pointer;
      font-size: 1.2em;
      color: #8f2c24;
    }

    .btn-submit {
      width: 100%;
      padding: 14px;
      background: #8f2c24;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 1.1em;
      font-weight: 500;
      cursor: pointer;
      transition: 0.5s;
    }

    .btn-submit:hover {
      background: #d64c42;
    }

    .btn-return {
      display: block;
      text-align: center;
      margin-top: 10px;
      padding: 10px;
      background: #282ca7;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-return:hover {
      background: #1f2380;
      transform: translateY(-2px);
    }

    /* Falling leaves animation */
    .leaves {
      position: absolute;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 100;
      pointer-events: none;
    }

    .leaves .set {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }

    .leaves .set div {
      position: absolute;
      display: block;
    }

    .leaves .set div:nth-child(1) { left: 20%; animation: animate 20s linear infinite; }
    .leaves .set div:nth-child(2) { left: 50%; animation: animate 14s linear infinite; }
    .leaves .set div:nth-child(3) { left: 70%; animation: animate 12s linear infinite; }
    .leaves .set div:nth-child(4) { left: 5%;  animation: animate 15s linear infinite; }
    .leaves .set div:nth-child(5) { left: 85%; animation: animate 18s linear infinite; }
    .leaves .set div:nth-child(6) { left: 90%; animation: animate 12s linear infinite; }
    .leaves .set div:nth-child(7) { left: 15%; animation: animate 14s linear infinite; }
    .leaves .set div:nth-child(8) { left: 60%; animation: animate 15s linear infinite; }

    @keyframes animate {
      0%   { opacity: 0; top: -10%; transform: translateX(20px) rotate(0deg); }
      10%  { opacity: 1; }
      20%  { transform: translateX(-20px) rotate(45deg); }
      40%  { transform: translateX(-20px) rotate(90deg); }
      60%  { transform: translateX(20px) rotate(180deg); }
      80%  { transform: translateX(-20px) rotate(45deg); }
      100% { top: 110%; transform: translateX(20px) rotate(225deg); }
    }

    /* Password toggle eye */
    .toggle-eye {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.2em;
      color: #8f2c24;
    }
  </style>
</head>
<body>
  <section>
    <!-- Falling Leaves -->
    <div class="leaves">
      <div class="set">
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_02.png"></div>
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_04.png"></div>
        <div><img src="/public/images/leaf_01.png"></div>
        <div><img src="/public/images/leaf_02.png"></div>
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_04.png"></div>
      </div>
    </div>

    <!-- Background -->
    <img src="/public/images/bg.jpg" class="bg">
    <img src="/public/images/trees.png" class="trees">

    <!-- Update Form -->
    <div class="form-container">
      <h1>Update User</h1>
      <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST">
        <div class="form-group">
          <input type="text" name="username" value="<?=html_escape($user['username']);?>" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" value="<?=html_escape($user['email']);?>" placeholder="Email" required>
        </div>
        
      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
          <div class="form-group">
              <select name="role" required>
                  <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
              </select>
          </div>

        <div class="form-group" style="position: relative;">
          <input type="password" placeholder="Password" name="password" id="password" required>
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>
      <?php endif; ?>

        <button type="submit" class="btn-submit">Update User</button>
      </form>
      <a href="<?=site_url('/users');?>" class="btn-return">Return to Home</a>
    </div>
  </section>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.type === 'password' ? 'text' : 'password';
      password.type = type;

      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Students Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      color: #fff;
    }

    section {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      min-height: 100vh;
      overflow: hidden;
      padding: 20px;
    }

    section .bg, section .trees {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }

    section .trees {
      z-index: 1;
    }

    .glass-container {
      position: relative;
      margin: 40px auto;
      padding: 40px;
      width: 100%;
      max-width: 1000px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.1);
      color: #fff;
      z-index: 200;
    }

    .glass-container h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 2.2em;
      font-weight: 700;
      text-shadow: 0 3px 8px rgba(0,0,0,0.3);
      color: #8f2c24;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .logout-btn {
      padding: 10px 18px;
      background: rgba(220, 53, 69, 0.9);
      border: none;
      border-radius: 8px;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }

    .logout-btn:hover {
      background: #b02a37;
      transform: translateY(-2px);
    }

    .search-form {
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(255, 255, 255, 0.1);
      padding: 8px 14px;
      border-radius: 12px;
      backdrop-filter: blur(6px);
    }

    .search-form input {
      border-radius: 6px;
      padding: 10px;
      border: none;
      font-size: 14px;
    }

    .search-form input:focus {
      outline: none;
      box-shadow: 0 0 8px rgba(102, 126, 234, 0.7);
    }

    .search-form button {
      padding: 10px 18px;
      font-size: 14px;
      font-weight: 600;
      border-radius: 6px;
      border: none;
      background: linear-gradient(to right, #373bff, #282ca7);
      color: #fff;
      transition: 0.3s ease;
    }

    .search-form button:hover {
      background: linear-gradient(to right, #2529b0, #1f2380);
      transform: translateY(-2px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      margin-bottom: 20px;
    }

    th, td {
      padding: 16px;
      text-align: center;
      font-size: 15px;
    }

    th {
      background: rgba(102, 126, 234, 0.85);
      color: #fff;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    td {
      color: #8f2c24;
      text-shadow: 0 2px 5px rgba(0,0,0,0.4);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover {
      background: rgba(255, 255, 255, 0.1);
      transition: 0.3s ease;
    }

    a {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s ease;
      margin: 0 4px;
      display: inline-block;
    }

    a[href*="update"] {
      background: #17a2b8;
      color: #fff;
    }

    a[href*="update"]:hover {
      background: #138496;
      transform: translateY(-2px);
    }

    a[href*="delete"] {
      background: #dc3545;
      color: #fff;
    }

    a[href*="delete"]:hover {
      background: #b02a37;
      transform: translateY(-2px);
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .btn-create {
      width: 50%;
      padding: 15px;
      border: none;
      background: #8f2c24;
      color: #fff;
      font-size: 1.25em;
      font-weight: 500;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-create:hover {
      background: #d64c42;
      transform: translateY(-2px);
    }

    .user-status {
          background: #f0f4ff;
          border: 1px solid #d0d7ff;
          padding: 10px 15px;
          border-radius: 8px;
          display: inline-block;
          font-family: Arial, sans-serif;
          color: #8f2c24;
          font-size: 14px;
        }

        .user-status strong {
          font-weight: 600;
        }

        .user-status .username {
          color: #0d47a1;
          font-weight: 500;
        }

        .user-status .role {
          font-size: 13px;
          color: #555;
        }

        .user-status.error {
          background: #ffeaea;
          border: 1px solid #f5bcbc;
          color: #d32f2f;
        }


            /* Responsive table container */
        .table-responsive {
          width: 100%;
          overflow-x: auto;
          -webkit-overflow-scrolling: touch;
          border-radius: 16px;
          margin-bottom: 20px;
        }

        /* Adjust search + logout alignment on mobile */
        @media (max-width: 768px) {
          .top-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
          }

          .search-form {
            width: 100%;
            justify-content: space-between;
          }

          .search-form input {
            flex: 1;
            min-width: 0;
          }

          table {
            font-size: 13px;
          }

          th, td {
            padding: 8px;
          }

          .btn-create {
            width: 100%;
            font-size: 1em;
          }
        }

        .pagination-container {
          display: flex;
          justify-content: center;
          margin: 25px 0; /* adds gap below the table */
        }

        .pagination-container ul {
          display: flex;
          list-style: none;
          gap: 8px;
          padding: 0;
          margin: 0;
        }

        .pagination-container li a,
        .pagination-container li span {
          display: block;
          padding: 10px 16px;
          border: 1px solid rgba(255,255,255,0.3);
          border-radius: 8px;
          background: rgba(255, 255, 255, 0.15);
          backdrop-filter: blur(6px);
          color: #fff;
          font-size: 14px;
          text-decoration: none;
          transition: all 0.3s ease;
        }

        .pagination-container li a:hover {
          background: #8f2c24;
          color: #fff;
          transform: translateY(-2px);
        }

        .pagination-container li.active span {
          background: #f6871f;
          color: #fff;
          border-color: #8f2c24;
          font-weight: bold;
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
    <img src="/public/images/bg.jpg" class="bg">
    <img src="/public/images/trees.png" class="trees">

    <div class="glass-container">
      <h1>
    <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
      </h1>


      <?php if(!empty($logged_in_user)): ?>
        <div class="user-status">
          <strong>Welcome:</strong> 
          <span class="username"><?= html_escape($logged_in_user['username']); ?></span>
        </div>
      <?php else: ?>
        <div class="user-status error">
          Logged in user not found
        </div>
      <?php endif; ?>


      <div class="top-bar">
        <a href="<?=site_url('auth/logout'); ?>"><button class="logout-btn">Logout</button></a>
        <form action="<?=site_url('users');?>" method="get" class="search-form">
          <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
          <input name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
          <button type="submit">Search</button>  
        </form>
      </div>
      <div class="table-responsive">
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <?php if ($logged_in_user['role'] === 'admin'): ?>
            <th>Password</th>
            <th>Role</th>
          <?php endif; ?>
          <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
          <td><?=html_escape($user['id']); ?></td>
          <td><?=html_escape($user['username']); ?></td>
          <td><?=html_escape($user['email']); ?></td>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <td>*******</td>
              <td><?= html_escape($user['role']); ?></td>
             <?php endif; ?>
          <td>
            <a href="<?=site_url('/users/update/'.$user['id']);?>">Update</a>
            <a href="<?=site_url('/users/delete/'.$user['id']);?>">Delete</a>
          </td>
         
        </tr>
        <?php endforeach; ?>

      </table>
      </div>

      <div class="pagination-container">
        <?php echo $page; ?>
      </div>


      <div class="button-container">
        <?php if ($logged_in_user['role'] === 'admin'): ?>
        <a href="<?=site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
         <?php endif; ?>
      </div>
    </div>
  </section>
</body>
</html>

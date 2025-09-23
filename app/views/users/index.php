<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      min-height: 100vh;
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    .pink-gradient {
      background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
    }
    
    .pink-gradient-dark {
      background: linear-gradient(135deg, #ff6b9d 0%, #ff1493 50%, #c71585 100%);
    }
    
    .pink-shadow {
      box-shadow: 0 10px 30px rgba(255, 105, 180, 0.3);
    }
    
    .pink-glow:hover {
      box-shadow: 0 10px 30px rgba(255, 105, 180, 0.5);
      transform: translateY(-2px);
    }
    
    .delete-btn:hover i {
      color: white !important;
    }
    
    .table-row-hover:hover {
      background: rgba(255, 182, 193, 0.1);
      transform: scale(1.01);
    }
    
    /* Enhanced Pagination Styles */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin-top: 2rem;
    }
    
    .pagination a, .pagination span {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.7);
      color: #c71585;
      border: 2px solid transparent;
    }
    
    .pagination a:hover {
      background: #ff69b4;
      color: white;
      border-color: #ff1493;
      transform: scale(1.1);
    }
    
    .pagination .current {
      background: #ff1493;
      color: white;
      border-color: #c71585;
      transform: scale(1.1);
    }
    
    .pagination .disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    
    .pagination .gap {
      background: transparent;
      color: #c71585;
      font-weight: bold;
    }
    
  </style>
</head>
<body class="relative">

  <!-- Animated Background Overlay -->
  <div class="absolute inset-0 bg-gradient-to-br from-pink-200/20 via-purple-200/20 to-rose-200/20 z-0"></div>

  <!-- Navbar -->
  <nav class="glass-effect shadow-lg relative z-10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-pink-700 flex items-center gap-3">
        <div class="bg-white p-2 rounded-full pink-shadow">
          <i class="fa-solid fa-users text-pink-500 text-xl"></i>
        </div>
        User Directory
      </h1>
      <div class="bg-white/80 px-3 py-1 rounded-full text-pink-600 font-semibold">
        <i class="fa-solid fa-database mr-2"></i>
        Student Management System
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto mt-12 px-4 relative z-10">
    <div class="glass-effect p-8 rounded-3xl pink-shadow border-2 border-white/30">
      <!-- Search Bar -->
      <form method="get" action="<?=site_url()?>" class="mb-8 flex justify-center">
        <div class="relative w-full max-w-md">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search students by name or email..." 
            class="w-full pl-12 pr-4 py-3 bg-white/90 border-2 border-pink-200 rounded-full focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition-all duration-300">
          <i class="fa-solid fa-magnifying-glass text-pink-400 absolute left-4 top-1/2 transform -translate-y-1/2 text-lg"></i>
          <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 pink-gradient text-white p-2 rounded-full w-10 h-10 flex items-center justify-center pink-glow transition-all duration-300">
            <i class="fa fa-arrow-right"></i>
          </button>
        </div>
      </form>

      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-pink-700 mb-2">Student Records</h2>
          <p class="text-pink-600">Manage your student database with ease</p>
        </div>
        
        <!-- Add New User -->
        <a href="<?=site_url('users/create')?>"
           class="group pink-gradient text-white font-semibold px-6 py-3 rounded-full pink-shadow pink-glow transition-all duration-300 flex items-center gap-3">
          <div class="bg-white/20 p-2 rounded-full group-hover:scale-110 transition-transform duration-300">
            <i class="fa-solid fa-user-plus text-white text-lg"></i>
          </div>
          Add New Student
        </a>
      </div>

      <!-- Table Container -->
      <div class="overflow-hidden rounded-2xl pink-shadow">
        <table class="w-full text-center border-collapse bg-white/90 backdrop-blur-sm">
          <thead>
            <tr class="pink-gradient-dark text-white text-sm uppercase tracking-wider">
              <th class="py-4 px-6 font-semibold text-lg">
                <div class="flex items-center justify-center gap-2">
                  <i class="fa-solid fa-hashtag text-white"></i> ID
                </div>
              </th>
              <th class="py-4 px-6 font-semibold text-lg">
                <div class="flex items-center justify-center gap-2">
                  <i class="fa-solid fa-signature text-white"></i> Lastname
                </div>
              </th>
              <th class="py-4 px-6 font-semibold text-lg">
                <div class="flex items-center justify-center gap-2">
                  <i class="fa-solid fa-user text-white"></i> Firstname
                </div>
              </th>
              <th class="py-4 px-6 font-semibold text-lg">
                <div class="flex items-center justify-center gap-2">
                  <i class="fa-solid fa-envelope text-white"></i> Email
                </div>
              </th>
              <th class="py-4 px-6 font-semibold text-lg">
                <div class="flex items-center justify-center gap-2">
                  <i class="fa-solid fa-gears text-white"></i> Actions
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="text-gray-800">
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="border-b border-pink-100 hover:bg-pink-50/50 table-row-hover transition-all duration-300">
                <td class="py-4 px-6 font-semibold text-pink-600">#<?=($user['id']);?></td>
                <td class="py-4 px-6 font-medium"><?=($user['last_name']);?></td>
                <td class="py-4 px-6 font-medium"><?=($user['first_name']);?></td>
                <td class="py-4 px-6">
                  <span class="inline-flex items-center gap-2 bg-pink-100 text-pink-700 text-sm font-semibold px-4 py-2 rounded-full border border-pink-200">
                    <i class="fa-solid fa-envelope text-pink-500"></i>
                    <?=($user['email']);?>
                  </span>
                </td>
                <td class="py-4 px-6">
                  <div class="flex justify-center gap-3">
                    <!-- Update Button -->
                    <a href="<?=site_url('users/update/'.$user['id']);?>"
                       class="group bg-white border-2 border-pink-300 hover:bg-pink-500 text-pink-600 hover:text-white font-semibold px-4 py-2 rounded-full pink-glow transition-all duration-300 flex items-center gap-2">
                      <i class="fa-solid fa-pen-to-square group-hover:scale-110 transition-transform duration-300"></i>
                      Edit
                    </a>
                    <!-- Delete Button -->
                    <a href="<?=site_url('users/delete/'.$user['id']);?>"
                       class="group delete-btn bg-white border-2 border-red-300 hover:bg-red-500 text-red-500 hover:text-white px-4 py-2 rounded-full pink-glow transition-all duration-300 flex items-center gap-2">
                      <i class="fa-solid fa-trash group-hover:scale-110 transition-transform duration-300"></i>
                      Delete
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-8">
        <div class="pagination">
          <?=$page ?? ''?>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="relative z-10 mt-12 py-6 text-center text-pink-600">
    <div class="glass-effect mx-auto max-w-md rounded-full px-6 py-3">
      <p class="flex items-center justify-center gap-2">
        <i class="fa-solid fa-heart text-red-400"></i>
        Made with Love • Student Management System
        <i class="fa-solid fa-graduation-cap text-pink-500"></i>
      </p>
    </div>
  </footer>

  <!-- Floating Elements -->
  <div class="fixed bottom-10 right-10 w-20 h-20 bg-pink-300/30 rounded-full blur-xl z-0"></div>
  <div class="fixed top-20 left-10 w-16 h-16 bg-purple-300/30 rounded-full blur-xl z-0"></div>
  <div class="fixed top-1/2 right-1/4 w-24 h-24 bg-rose-300/30 rounded-full blur-xl z-0"></div>
</body>
</html>
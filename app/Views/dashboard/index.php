<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Perpustakaan Digital</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0fdf4',
              100: '#dcfce7',
              200: '#bbf7d0',
              300: '#86efac',
              400: '#4ade80',
              500: '#22c55e',
              600: '#16a34a',
              700: '#15803d',
              800: '#166534',
              900: '#14532d',
            },
            accent: {
              100: '#f7fee7',
              200: '#ecfccb',
              300: '#d9f99d',
            }
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .sidebar-shadow {
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
    }
    .card-hover {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .smooth-transition {
      transition: all 0.3s ease;
    }
    .book-cover {
      background: linear-gradient(135deg, #e6ffed 0%, #f0fff4 100%);
    }
    .scrollbar-custom::-webkit-scrollbar {
      height: 6px;
    }
    .scrollbar-custom::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    .scrollbar-custom::-webkit-scrollbar-thumb {
      background: #c6f6d5;
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-r from-primary-700 to-primary-900 text-white sidebar-shadow flex flex-col z-20">
      <div class="p-6 flex flex-col items-center border-b border-primary-700">
        <div class="relative mb-4">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode(session('nama')) ?>&background=4f6f52&color=fff" 
               alt="Profile" 
               class="rounded-full w-20 h-20 border-4 border-white" />
          <span class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span>
        </div>
        <h3 class="text-lg font-semibold text-center text-primary-100"><?= session('nama') ?></h3>
        <p class="text-sm text-primary-300 mt-1">Anggota Perpustakaan</p>
      </div>
      
      <nav class="flex-1 p-4 space-y-1">
        <a href="/dashboard" class="flex items-center px-4 py-3 rounded-lg text-primary-100 hover:bg-primary-700 smooth-transition">
          <i class="fas fa-tachometer-alt w-5 mr-3 text-center"></i>
          <span>Dashboard</span>
        </a>
        <a href="/peminjaman" class="flex items-center px-4 py-3 rounded-lg text-primary-100 hover:bg-primary-700 smooth-transition">
          <i class="fas fa-book w-5 mr-3 text-center"></i>
          <span>Peminjaman</span>
        </a>
        <!-- <a href="/buku" class="flex items-center px-4 py-3 rounded-lg text-primary-100 hover:bg-primary-700 smooth-transition">
          <i class="fas fa-search w-5 mr-3 text-center"></i>
          <span>Cari Buku</span>
        </a>
        <a href="/history" class="flex items-center px-4 py-3 rounded-lg text-primary-100 hover:bg-primary-700 smooth-transition">
          <i class="fas fa-history w-5 mr-3 text-center"></i>
          <span>Riwayat</span>
        </a> -->
        <div class="border-t border-primary-700 mt-4 pt-4">
          <a href="/logout" class="flex items-center px-4 py-3 rounded-lg text-primary-100 hover:bg-primary-700 smooth-transition">
            <i class="fas fa-sign-out-alt w-5 mr-3 text-center"></i>
            <span>Logout</span>
          </a>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
          <p class="text-gray-600">Ringkasan aktivitas Anda</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm">
          <i class="far fa-calendar-alt mr-2"></i>
          <span><?= date('l, d F Y') ?></span>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm card-hover border-t-4 border-primary-500">
          <div class="flex items-center">
            <div class="p-3 rounded-lg bg-primary-50 text-primary-600 mr-4">
              <i class="fas fa-book-open text-lg"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Buku Dipinjam</p>
              <h3 class="text-2xl font-semibold text-gray-800">5</h3>
            </div>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm card-hover border-t-4 border-yellow-500">
          <div class="flex items-center">
            <div class="p-3 rounded-lg bg-yellow-50 text-yellow-600 mr-4">
              <i class="fas fa-clock text-lg"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Harus Dikembalikan</p>
              <h3 class="text-2xl font-semibold text-gray-800">3</h3>
            </div>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm card-hover border-t-4 border-green-500">
          <div class="flex items-center">
            <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
              <i class="fas fa-check-circle text-lg"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Buku Telah Dibaca</p>
              <h3 class="text-2xl font-semibold text-gray-800">12</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Welcome Card -->
      <div class="bg-gradient-to-r from-primary-700 to-primary-900 text-white rounded-xl p-6 mb-8 relative overflow-hidden">
        <div class="relative z-10">
          <h2 class="text-xl font-semibold mb-2">Selamat Datang, <?= session('nama') ?>!</h2>
          <p class="text-primary-100 max-w-lg">Temukan inspirasi dan pengetahuan baru dari koleksi buku terbaru kami. Mulai jelajahi sekarang.</p>
          <!-- <button class="mt-4 bg-white text-primary-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 smooth-transition">
            Jelajahi Koleksi
          </button> -->
        </div>
        <div class="absolute right-0 bottom-0 opacity-20">
          <i class="fas fa-book-open text-[200px] text-white"></i>
        </div>
      </div>

      <!-- Book Sections -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recommended Books -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
              <i class="fas fa-star text-yellow-500 mr-2"></i>
              Rekomendasi Untuk Anda
            </h2>
            <a href="#" class="text-sm text-primary-600 hover:text-primary-800 smooth-transition">Lihat Semua</a>
          </div>
          
          <div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-custom">
            <?php 
            $recommendedBooks = [
              ['title' => 'Seni Hidup Minimalis', 'author' => 'Fumio Sasaki'],
              ['title' => 'Laut Bercerita', 'author' => 'Leila S. Chudori'],
              ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring'],
              ['title' => 'Atomic Habits', 'author' => 'James Clear'],
              ['title' => 'The Psychology of Money', 'author' => 'Morgan Housel']
            ];
            
            foreach ($recommendedBooks as $book): ?>
            <div class="flex-shrink-0 w-48 bg-white border border-gray-100 rounded-lg overflow-hidden shadow-xs card-hover">
              <div class="h-32 book-cover flex items-center justify-center">
                <i class="fas fa-book text-4xl text-primary-600 opacity-30"></i>
              </div>
              <div class="p-3">
                <h4 class="font-medium text-gray-800 text-sm truncate"><?= $book['title'] ?></h4>
                <p class="text-xs text-gray-500 mt-1 truncate"><?= $book['author'] ?></p>
                <button class="mt-3 w-full bg-primary-50 text-primary-600 text-xs py-1.5 rounded hover:bg-primary-100 smooth-transition">
                  <i class="fas fa-plus mr-1"></i> Pinjam
                </button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        
        <!-- Popular Books -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
              <i class="fas fa-fire text-orange-500 mr-2"></i>
              Buku Populer
            </h2>
            <!-- <a href="#" class="text-sm text-primary-600 hover:text-primary-800 smooth-transition">Lihat Semua</a> -->
          </div>
          <div class="space-y-3">
            <?php 
            $popularBooks = [
              ['title' => 'Seporsi Mie Ayam Sebelum Mati', 'author' => 'Brian Khrisna', 'rating' => 4.32],
              ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'rating' => 4.3],
              ['title' => 'The Art of Stoicism', 'author' => 'Ian Tuhovsky', 'rating' => 4.08],
              ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'rating' => 4.3]
            ];
            foreach ($popularBooks as $book): ?>
            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg smooth-transition">
              <div class="flex-shrink-0 w-10 h-10 book-cover rounded flex items-center justify-center mr-4">
                <i class="fas fa-book text-primary-600"></i>
              </div>
              <div class="flex-1 min-w-0">
                <h4 class="text-sm font-medium text-gray-800 truncate"><?= $book['title'] ?></h4>
                <p class="text-xs text-gray-500 truncate"><?= $book['author'] ?></p>
              </div>
              <div class="ml-4 flex items-center">
                <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                <span class="text-xs font-medium"><?= $book['rating'] ?></span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku | Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1a4d2e;
            --primary: #4f6f52;
            --primary-light: #739072;
            --accent: #ece3ce;
            --light: #f9f9f9;
            --danger: #e74c3c;
            --warning: #f39c12;
            --success: #2ecc71;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        /* Header Styles */
        .page-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .page-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .library-icon {
            font-size: 32px;
            color: var(--primary);
        }
        
        h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        /* Search Bar */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 400px;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(79, 111, 82, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        /* Books List */
        .books-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 40px;
        }
        
        .book-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 25px;
            border-bottom: 1px solid var(--light-gray);
            transition: background-color 0.2s ease;
        }
        
        .book-item:last-child {
            border-bottom: none;
        }
        
        .book-item:hover {
            background-color: rgba(236, 227, 206, 0.2);
        }
        
        .book-info {
            flex: 1;
        }
        
        .book-title {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }
        
        .book-author {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Buttons */
        .btn {
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            white-space: nowrap;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn-sm {
            padding: 6px 14px;
            font-size: 0.85rem;
        }
        
        /* Borrowed Books Section */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .section-icon {
            font-size: 24px;
            color: var(--warning);
        }
        
        .borrowed-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .borrowed-item {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1fr 120px;
            gap: 15px;
            align-items: center;
            padding: 18px 25px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .borrowed-item:last-child {
            border-bottom: none;
        }
        
        /* Status Badges */
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-waiting {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--warning);
        }
        
        .status-approved {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success);
        }
        
        .status-rejected {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger);
        }
        
        /* Countdown */
        .countdown {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .countdown-warning {
            color: var(--warning);
        }
        
        .countdown-danger {
            color: var(--danger);
            animation: pulse 1s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
        }
        
        .empty-icon {
            font-size: 50px;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .borrowed-item {
                grid-template-columns: 2fr 1.5fr 1fr;
                grid-template-rows: auto auto;
                row-gap: 10px;
            }
            
            .borrowed-item > div:nth-child(4),
            .borrowed-item > div:nth-child(5) {
                grid-column: span 1;
            }
            
            .borrowed-item > div:nth-child(5) {
                grid-column: 3;
                grid-row: 2;
            }
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-container {
                max-width: 100%;
            }
            
            .book-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 15px;
            }
            
            .borrowed-item {
                grid-template-columns: 1fr;
                padding: 15px;
            }
            
            .borrowed-item > div:nth-child(5) {
                grid-column: 1;
                grid-row: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Available Books Section -->
        <div class="page-header">
            <div class="page-title">
                <span class="library-icon">📚</span>
                <h2>Koleksi Buku Tersedia</h2>
            </div>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Cari judul atau penulis..." id="searchInput">
            </div>
        </div>
        
        <?php if (!empty($buku)): ?>
        <div class="books-list" id="booksList">
            <?php foreach($buku as $b): ?>
            <div class="book-item" data-title="<?= strtolower(esc($b['judul'])) ?>" data-author="<?= strtolower(esc($b['penulis'])) ?>">
                <div class="book-info">
                    <div class="book-title"><?= esc($b['judul']) ?></div>
                    <div class="book-author">Oleh <?= esc($b['penulis']) ?></div>
                </div>
                <form action="/peminjaman/pinjam" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="anggota_id" value="<?= session('anggota_id') ?>">
                    <input type="hidden" name="buku_id" value="<?= $b['id'] ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Pinjam</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3>Tidak ada buku yang tersedia saat ini</h3>
            <p>Silakan cek kembali nanti atau tanyakan kepada petugas perpustakaan</p>
        </div>
        <?php endif; ?>
        
        <!-- Borrowed Books Section -->
        <div class="section-header">
            <span class="section-icon">⏳</span>
            <h2>Buku yang Sedang Dipinjam</h2>
        </div>
        
        <?php if (!empty($peminjaman)): ?>
        <div class="borrowed-list">
            <?php foreach($peminjaman as $p): ?>
            <div class="borrowed-item">
                <div>
                    <div class="book-title"><?= esc($p['judul']) ?></div>
                    <div class="book-author">Batas waktu: <?= date('d M Y H:i', strtotime($p['batas_waktu'])) ?></div>
                </div>
                <div>
                    <?php if ($p['status'] === 'menunggu'): ?>
                        <span class="status status-waiting">Menunggu Konfirmasi</span>
                    <?php elseif ($p['status'] === 'disetujui'): ?>
                        <span class="status status-approved">Disetujui</span>
                    <?php elseif ($p['status'] === 'ditolak'): ?>
                        <span class="status status-rejected">Ditolak</span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ($p['status'] === 'disetujui'): ?>
                        <div id="countdown-<?= $p['id'] ?>" class="countdown"></div>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ($p['status'] === 'disetujui'): ?>
                        <form method="post" action="/peminjaman/kembalikan">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" 
                                onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                Kembalikan
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">📖</div>
            <h3>Anda belum meminjam buku apapun</h3>
            <p>Pinjam buku dari koleksi kami untuk memulai petualangan membaca</p>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const bookItems = document.querySelectorAll('.book-item');
            
            bookItems.forEach(item => {
                const title = item.getAttribute('data-title');
                const author = item.getAttribute('data-author');
                
                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Countdown timers for borrowed books
        <?php foreach($peminjaman as $p): ?>
            <?php if ($p['status'] === 'disetujui'): ?>
                const countdown<?= $p['id'] ?> = setInterval(() => {
                    const now = new Date().getTime();
                    const deadline = new Date("<?= $p['batas_waktu'] ?>").getTime();
                    const diff = deadline - now;
                    
                    const countdownEl = document.getElementById("countdown-<?= $p['id'] ?>");
                    
                    if (diff <= 0) {
                        countdownEl.innerHTML = '<span class="countdown-danger">WAKTU HABIS!</span>';
                        clearInterval(countdown<?= $p['id'] ?>);
                    } else {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        
                        let countdownText = '';
                        if (days > 0) countdownText += `${days}d `;
                        countdownText += `${hours}h ${minutes}m ${seconds}s`;
                        
                        countdownEl.innerHTML = countdownText;
                        
                        // Update styling based on remaining time
                        if (diff < 86400000) { // Less than 1 day
                            countdownEl.className = 'countdown countdown-danger';
                        } else if (diff < 259200000) { // Less than 3 days
                            countdownEl.className = 'countdown countdown-warning';
                        } else {
                            countdownEl.className = 'countdown';
                        }
                    }
                }, 1000);
            <?php endif; ?>
        <?php endforeach; ?>
    </script>
</body>
</html>
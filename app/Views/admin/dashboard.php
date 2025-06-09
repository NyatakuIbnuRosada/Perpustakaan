<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Quantum Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #0a2e1a;
            --primary: #3a5a40;
            --primary-light: #588157;
            --accent: #dad7cd;
            --gradient: linear-gradient(135deg, #3a5a40 0%, #588157 100%);
            --light: #f8f9fa;
            --text: #212529;
            --text-light: #6c757d;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --glow: 0 0 20px rgba(88, 129, 87, 0.4);
            --glass: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--text);
            line-height: 1.6;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(218, 215, 205, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(88, 129, 87, 0.1) 0%, transparent 20%);
            min-height: 100vh;
        }

        /* Glassmorphism Panel */
        .admin-container {
            max-width: 1400px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 0 0 1px rgba(255, 255, 255, 0.2);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Futuristic Header */
        .admin-header {
            background: var(--gradient);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%),
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.05) 10px, rgba(255,255,255,0.05) 20px);
            z-index: 0;
            animation: rotate 60s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .admin-title {
            font-size: 2rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-title i {
            font-size: 1.8rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .admin-date {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
            background: rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        /* Navigation Tabs */
        .admin-nav {
            display: flex;
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0 2rem;
        }

        .nav-tab {
            padding: 1rem 1.5rem;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-light);
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
        }

        .nav-tab:hover {
            color: var(--primary);
        }

        .nav-tab.active {
            color: var(--primary-dark);
            border-bottom: 3px solid var(--primary);
        }

        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            background: var(--primary);
            border-radius: 50%;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-content.active {
            display: block;
        }

        /* Holographic Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(58, 90, 64, 0.15);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .stat-value i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            margin: 2rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--primary-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 90, 64, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        /* Sci-Fi Data Table */
        .data-section {
            padding: 0 2rem 2rem;
        }

        .section-title {
            color: var(--primary-dark);
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title i {
            font-size: 1.4rem;
        }

        .data-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: var(--gradient);
            color: white;
            padding: 1.2rem 1.5rem;
            text-align: left;
            font-weight: 500;
            position: relative;
        }

        .data-table th:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 25%;
            height: 50%;
            width: 1px;
            background: rgba(255,255,255,0.3);
        }

        .data-table td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: rgba(88, 129, 87, 0.03);
        }

        /* Category Badges */
        .category-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            background-color: rgba(23, 162, 184, 0.15);
            color: var(--info);
            border: 1px solid rgba(23, 162, 184, 0.3);
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* Neon Status Badges */
        .status {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .status i {
            font-size: 0.8rem;
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.15);
            color: var(--warning);
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-approved {
            background-color: rgba(40, 167, 69, 0.15);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-rejected {
            background-color: rgba(220, 53, 69, 0.15);
            color: var(--danger);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        /* Holographic Action Buttons */
        .action-btn {
            padding: 0.6rem 1.2rem;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(58, 90, 64, 0.3);
            position: relative;
            overflow: hidden;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 90, 64, 0.4);
        }

        .action-btn:active {
            transform: translateY(0);
        }

        .action-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .action-btn:hover::after {
            left: 100%;
        }

        .btn-secondary {
            background: var(--text-light);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
        }

        /* Floating Elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 1.5rem;
            background: var(--gradient);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .admin-container {
                margin: 1rem;
                border-radius: 15px;
            }
            
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }

            .form-row {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1.5rem 1rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
                padding: 1.5rem;
            }
            
            .data-section {
                padding: 0 1.5rem 1.5rem;
            }
            
            .data-table th, 
            .data-table td {
                padding: 1rem;
            }

            .admin-nav {
                overflow-x: auto;
                padding: 0 1rem;
                white-space: nowrap;
            }

            .nav-tab {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .admin-title {
                font-size: 1.6rem;
            }
            
            .stat-value {
                font-size: 2rem;
            }

            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element" style="top:10%; left:5%; font-size:3rem; color:var(--primary-light);"><i class="fas fa-book"></i></div>
        <div class="floating-element" style="top:30%; right:8%; font-size:4rem; color:var(--accent);"><i class="fas fa-book-open"></i></div>
        <div class="floating-element" style="bottom:15%; left:15%; font-size:2.5rem; color:var(--primary);"><i class="fas fa-user-shield"></i></div>
    </div>

    <div class="admin-container">
        <!-- Futuristic Header -->
        <div class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-shield-alt"></i>
                Selamat Datang, Admin!
            </h1>
            <div class="admin-date"><?= date('l, d F Y') ?></div>
        </div>
        
        <!-- Navigation Tabs -->
        <div class="admin-nav">
            <div class="nav-tab active" data-tab="dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </div>
            <div class="nav-tab" data-tab="books">
                <i class="fas fa-book"></i> Manajemen Buku
            </div>
            <div class="nav-tab" data-tab="categories">
                <i class="fas fa-tags"></i> Kategori Buku
            </div>
            <div class="nav-tab" data-tab="loans">
                <i class="fas fa-exchange-alt"></i> Peminjaman
            </div>
            <div class="nav-tab" data-tab="members">
                <i class="fas fa-users"></i> Anggota
            </div>
        </div>
        
        <!-- Dashboard Tab -->
        <div class="tab-content active" id="dashboard-tab">
            <!-- Holographic Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-value">
                        <i class="fas fa-book"></i>
                        <?= esc($totalBuku) ?>
                    </div>
                    <div class="stat-label">Total Koleksi Buku</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">
                        <i class="fas fa-exchange-alt"></i>
                        <?= esc($totalPeminjaman) ?>
                    </div>
                    <div class="stat-label">Total Transaksi Peminjaman</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">
                        <i class="fas fa-users"></i>
                        156
                    </div>
                    <div class="stat-label">Anggota Aktif</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">
                        <i class="fas fa-clock"></i>
                        24
                    </div>
                    <div class="stat-label">Menunggu Konfirmasi</div>
                </div>
            </div>
            
            <!-- Sci-Fi Data Table Section -->
            <div class="data-section">
                <h2 class="section-title">
                    <i class="fas fa-list-ul"></i>
                    Daftar Permohonan Peminjaman
                </h2>
                
                <div class="data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ganti semua referensi $peminjaman dengan $peminjamanMenunggu atau $peminjamanAktif -->

<!-- Contoh: -->
 <?php if(!empty($peminjamanMenunggu)): ?>
    <?php foreach($peminjamanMenunggu as $pmj): ?>
    <tr>
        <td><?= esc($pmj['nama']) ?></td>
        <td><?= esc($pmj['judul']) ?></td>
        <td>
            <span class="status status-menunggu">
                <i class="fas fa-clock"></i>
                Menunggu
            </span>
        </td>
        <td>
            <a href="<?= base_url('admin/konfirmasi/' . $pmj['id']) ?>" class="action-btn">
    <i class="fas fa-cog"></i> Kelola
</a>

        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4" class="text-center">Tidak ada peminjaman yang menunggu</td>
    </tr>
<?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Books Management Tab -->
        <div class="tab-content" id="books-tab">
            <div class="data-section">
                <div class="section-title">
                    <i class="fas fa-book"></i>
                    Manajemen Koleksi Buku
                    <button class="action-btn" id="addBookBtn" style="margin-left: auto;">
                        <i class="fas fa-plus"></i> Tambah Buku Baru
                    </button>
                </div>
                
                <!-- Di bagian tabel buku -->
<div class="data-section">
    <h2 class="section-title">
        <i class="fas fa-book"></i>
        Daftar Buku
    </h2>
    
            <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($books)): ?>
                                    <?php foreach($books as $book): ?>
                                    <tr>
                                        <td><?= esc($book['judul']) ?></td>
                                        <td><?= esc($book['penulis']) ?></td>
                                        <td><?= esc($book['penerbit']) ?></td>
                                        <td><?= esc($book['tahun_terbit']) ?></td>
                                        <td><?= esc($book['stok']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data buku</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Categories Management Tab -->
        <div class="tab-content" id="categories-tab">
            <div class="form-container">
                <h2 class="section-title">
                    <i class="fas fa-tags"></i>
                    Tambah Kategori Baru
                </h2>
                <form id="categoryForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" id="categoryName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription" class="form-label">Deskripsi</label>
                            <input type="text" id="categoryDescription" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="action-btn">
                        <i class="fas fa-save"></i> Simpan Kategori
                    </button>
                </form>
            </div>
            
           <?php if(isset($categories) && !empty($categories)): ?>
    <!-- Tampilkan data kategori -->
    <div class="data-section">
        <h2 class="section-title">
            <i class="fas fa-tags"></i>
            Daftar Kategori
        </h2>
        
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Buku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                <tr>
                    <td><?= esc($category['nama']) ?></td>
                    <td><?= esc($category['deskripsi']) ?></td>
                    <td><?= esc($category['jumlah_buku']) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        Tidak ada data kategori
    </div>
<?php endif; ?>
            </div>
        </div>
        
        <!-- Loans Management Tab -->
        <div class="tab-content" id="loans-tab">
            <div class="data-section">
                <div class="data-section">
    <h2 class="section-title">
        <i class="fas fa-list"></i>
        Semua Peminjaman
    </h2>
    
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($allLoans)): ?>
                    <?php foreach($allLoans as $loan): ?>
                    <tr>
                        <td><?= esc($loan['nim'] ?? '-') ?></td>
                        <td><?= esc($loan['nama']) ?></td>
                        <td><?= esc($loan['judul']) ?></td>
                        <td><?= esc($loan['waktu_pinjam']) ?></td>
                        <td>
                            <span class="status status-<?= strtolower($loan['status']) ?>">
                                <?= esc($loan['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data peminjaman</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
        </div>
        
        <!-- Members Management Tab -->
        <div class="tab-content" id="members-tab">
            <div class="data-section">
                <?php if(isset($members) && !empty($members)): ?>
    <div class="data-section">
        <h2 class="section-title">
            <i class="fas fa-users"></i>
            Daftar Anggota
        </h2>
        
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Fakultas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($members as $member): ?>
                    <tr>
                        <td><?= esc($member['nim']) ?></td>
                        <td><?= esc($member['nama']) ?></td>
                        <td><?= esc($member['jurusan']) ?></td>
                        <td><?= esc($member['fakultas']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        Tidak ada data anggota
    </div>
<?php endif; ?>
        </div>
    </div>
    
    <!-- Add Book Modal -->
    <div class="modal" id="addBookModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-book"></i> Tambah Buku Baru</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="bookForm">
                    <div class="form-group">
                        <label for="bookTitle" class="form-label">Judul Buku</label>
                        <input type="text" id="bookTitle" class="form-control" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="bookAuthor" class="form-label">Pengarang</label>
                            <input type="text" id="bookAuthor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bookPublisher" class="form-label">Penerbit</label>
                            <input type="text" id="bookPublisher" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="bookYear" class="form-label">Tahun Terbit</label>
                            <input type="number" id="bookYear" class="form-control" min="1900" max="<?= date('Y') ?>">
                        </div>
                        <div class="form-group">
                            <label for="bookStock" class="form-label">Jumlah Stok</label>
                            <input type="number" id="bookStock" class="form-control" min="1" value="1" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="bookIsbn" class="form-label">ISBN</label>
                        <input type="text" id="bookIsbn" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="bookCategories" class="form-label">Kategori</label>
                        <select id="bookCategories" class="form-control" multiple>
                            
                            <?php foreach($categories as $category): ?>
                    <tr>
                        <td><?= esc($category['nama']) ?></td>
                        <td><?= esc($category['deskripsi'] ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                        </select>
                        <small class="form-text">Gunakan Ctrl/Cmd untuk memilih lebih dari satu</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="bookDescription" class="form-label">Deskripsi</label>
                        <textarea id="bookDescription" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="bookCover" class="form-label">Cover Buku</label>
                        <input type="file" id="bookCover" class="form-control" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-secondary modal-close">Batal</button>
                <button class="action-btn" id="saveBookBtn">Simpan Buku</button>
            </div>
        </div>
    </div>
    
    <!-- Edit Category Modal -->
    <div class="modal" id="editCategoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-tag"></i> Edit Kategori</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" id="editCategoryId">
                    <div class="form-group">
                        <label for="editCategoryName" class="form-label">Nama Kategori</label>
                        <input type="text" id="editCategoryName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategoryDescription" class="form-label">Deskripsi</label>
                        <input type="text" id="editCategoryDescription" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-secondary modal-close">Batal</button>
                <button class="action-btn" id="updateCategoryBtn">Perbarui Kategori</button>
            </div>
        </div>
    </div>

    <script>
        // Tab Navigation
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });
        
        // Modal Handling
        const openModal = (modalId) => {
            document.getElementById(modalId).style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };
        
        const closeModal = (modalId) => {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        };
        
        // Add Book Modal
        document.getElementById('addBookBtn').addEventListener('click', () => openModal('addBookModal'));
        
        // Close modals when clicking close button or outside
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('.modal');
                closeModal(modal.id);
            });
        });
        
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });
        
        // Edit Category Modal
        document.querySelectorAll('.edit-category').forEach(btn => {
            btn.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                // In a real app, you would fetch category data here
                document.getElementById('editCategoryId').value = categoryId;
                document.getElementById('editCategoryName').value = 'Sample Category';
                document.getElementById('editCategoryDescription').value = 'Sample Description';
                openModal('editCategoryModal');
            });
        });
        
        // Delete Category Confirmation
        document.querySelectorAll('.delete-category').forEach(btn => {
            btn.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    // In a real app, you would send a delete request here
                    alert(`Kategori dengan ID ${categoryId} akan dihapus`);
                }
            });
        });
        
        // Delete Book Confirmation
        document.querySelectorAll('.delete-book').forEach(btn => {
            btn.addEventListener('click', function() {
                const bookId = this.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                    // In a real app, you would send a delete request here
                    alert(`Buku dengan ID ${bookId} akan dihapus`);
                }
            });
        });
        
        // Save Book Form
        document.getElementById('saveBookBtn').addEventListener('click', function() {
            // In a real app, you would collect form data and send it to the server
            alert('Buku baru berhasil disimpan!');
            closeModal('addBookModal');
        });
        
        // Update Category Form
        document.getElementById('updateCategoryBtn').addEventListener('click', function() {
            // In a real app, you would collect form data and send it to the server
            alert('Kategori berhasil diperbarui!');
            closeModal('editCategoryModal');
        });
        
        // Add interactive effects to stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const x = e.pageX - card.getBoundingClientRect().left;
                const y = e.pageY - card.getBoundingClientRect().top;
                
                card.style.transform = `perspective(1000px) rotateX(${(y - card.offsetHeight/2)/20}deg) rotateY(${-(x - card.offsetWidth/2)/20}deg)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        });
    </script>
</body>
</html>
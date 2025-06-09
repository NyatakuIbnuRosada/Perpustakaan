<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Peminjaman | Quantum Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1b5e20;
            --primary: #388e3c;
            --primary-light: #66bb6a;
            --accent: #c8e6c9;
            --gradient: linear-gradient(135deg, #1b5e20 0%, #388e3c 100%);
            --glass: rgba(255, 255, 255, 0.2);
            --glow: 0 0 25px rgba(56, 142, 60, 0.3);
            --success: #4caf50;
            --warning: #ff9800;
            --error: #f44336;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f8e9;
            color: #263238;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(200, 230, 201, 0.3) 0%, transparent 25%),
                radial-gradient(circle at 80% 70%, rgba(102, 187, 106, 0.2) 0%, transparent 25%);
        }

        .confirmation-container {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 2rem;
        }

        .confirmation-header {
            background: var(--gradient);
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
        }

        .confirmation-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .confirmation-content {
            padding: 2rem;
        }

        .error-message {
            background: rgba(244, 67, 54, 0.1);
            color: var(--error);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--error);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .loan-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .detail-card {
            background: #f8f9fa;
            padding: 1.2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .detail-label {
            font-size: 0.85rem;
            color: var(--primary-dark);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            background: rgba(255, 152, 0, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 152, 0, 0.3);
        }

        .confirmation-form {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--primary-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(56, 142, 60, 0.2);
        }

        .confirm-button {
            width: 100%;
            padding: 1rem;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .confirm-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(27, 94, 32, 0.4);
        }

        @media (max-width: 768px) {
            .loan-details {
                grid-template-columns: 1fr;
            }
            
            .confirmation-container {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="confirmation-header">
            <h2 class="confirmation-title">
                <i class="fas fa-clipboard-check"></i>
                Konfirmasi Peminjaman
            </h2>
        </div>
        
        <div class="confirmation-content">
            <?php if (!isset($peminjaman) || empty($peminjaman)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Data peminjaman tidak ditemukan</span>
                </div>
            <?php else: ?>
                <div class="loan-details">
                    <div class="detail-card">
                        <div class="detail-label">Judul Buku</div>
                        <div class="detail-value"><?= esc($peminjaman['judul']) ?></div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Nama Peminjam</div>
                        <div class="detail-value"><?= esc($peminjaman['nama_peminjam']) ?></div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Tanggal Pinjam</div>
                        <div class="detail-value"><?= esc($peminjaman['waktu_pinjam']) ?></div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge">
                                <i class="fas fa-clock"></i>
                                <?= esc($peminjaman['status']) ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <form action="<?= base_url('/admin/prosesKonfirmasi') ?>" method="post" class="confirmation-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($peminjaman['id']) ?>">
                    
                    <div class="form-group">
                        <label for="status">Status Peminjaman</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="dipinjam" <?= esc($peminjaman['status']) === 'dipinjam' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="ditolak" <?= esc($peminjaman['status']) === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu Pengembalian</label>
                        <input type="datetime-local" name="batas_waktu" id="batas_waktu" class="form-control" 
                               value="<?= esc($peminjaman['batas_waktu']) ?>" required>
                    </div>
                    
                    <button type="submit" class="confirm-button">
                        <i class="fas fa-paper-plane"></i> Konfirmasi Peminjaman
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

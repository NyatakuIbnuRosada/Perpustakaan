<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Digital Library</title>
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
            --error: #dc3545;
            --glow: 0 0 20px rgba(88, 129, 87, 0.6);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(218, 215, 205, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(88, 129, 87, 0.1) 0%, transparent 20%);
            overflow-x: hidden;
        }

        .login-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
            border-radius: 20px;
            overflow: hidden;
        }

        .login-illustration {
            background: var(--gradient);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: white;
            z-index: 1;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%),
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.05) 10px, rgba(255,255,255,0.05) 20px);
            z-index: -1;
            animation: rotate 60s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .library-logo {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .illustration-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .illustration-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 80%;
            text-align: center;
            line-height: 1.6;
        }

        .login-form-container {
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            position: relative;
        }

        .form-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .form-title {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .form-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .alert {
            padding: 1rem;
            background: rgba(220, 53, 69, 0.1);
            color: var(--error);
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--error);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert i {
            font-size: 1.2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--primary-dark);
        }

        .input-field {
            position: relative;
        }

        .input-field i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-light);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(58, 90, 64, 0.2);
            background-color: white;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(58, 90, 64, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(58, 90, 64, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .login-button:hover::after {
            left: 100%;
        }

        .floating-books {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .book {
            position: absolute;
            opacity: 0.1;
            animation: floatBook 15s infinite linear;
        }

        @keyframes floatBook {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        .book:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .book:nth-child(2) {
            top: 30%;
            right: 15%;
            animation-delay: 2s;
        }

        .book:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
            
            .login-illustration {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-form-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Illustration Section -->
        <div class="login-illustration">
            <div class="library-logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h1 class="illustration-title">Digital Library Admin Portal</h1>
            <p class="illustration-subtitle">Pinjam Buku Sekarang Bisa Lewat Aplikasi</p>
        </div>

        <!-- Form Section -->
        <div class="login-form-container">
            <!-- Floating Book Decorations -->
            <div class="floating-books">
                <div class="book"><i class="fas fa-book" style="font-size: 3rem; color: var(--primary-light);"></i></div>
                <div class="book"><i class="fas fa-book" style="font-size: 2.5rem; color: var(--primary);"></i></div>
                <div class="book"><i class="fas fa-book" style="font-size: 4rem; color: var(--accent);"></i></div>
            </div>

            <div class="form-header">
                <h2 class="form-title">Admin Login</h2>
                <p class="form-subtitle">Enter your credentials to access the dashboard</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <form action="/admin/dashboard" method="post">
                <div class="form-group">
                    <label for="username">Admin Username</label>
                    <div class="input-field">
                        <i class="fas fa-user-shield"></i>
                        <input type="text" id="username" name="username" class="form-control" required placeholder="Enter admin username">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
                    </div>
                </div>

                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Login
                </button>
            </form>
        </div>
    </div>

    <script>
        // Add subtle interactive effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = 'var(--primary)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = 'var(--primary-light)';
            });
        });
    </script>
</body>
</html>
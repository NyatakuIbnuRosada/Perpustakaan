<?php
// File: app/Views/anggota/register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a4d2e;
            --primary: #4f6f52;
            --primary-light: #739072;
            --accent: #ece3ce;
            --light: #f5f5f5;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: #333;
            line-height: 0.2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, var(--light) 0%, var(--accent) 100%);
        }
        
        .registration-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            height: 650px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 10;
            background: white;
        }
        
        /* Visual Side - Animation Extravaganza */
        .visual-side {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .visual-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://assets.codepen.io/21542/book-pattern.svg') repeat;
            opacity: 0.1;
            animation: patternMove 100s linear infinite;
        }
        
        @keyframes patternMove {
            0% { background-position: 0 0; }
            100% { background-position: 1000px 1000px; }
        }
        
        .library-icon {
            font-size: 100px;
            margin-bottom: 30px;
            display: inline-block;
            animation: float 4s ease-in-out infinite, pulse 2s ease-in-out infinite alternate;
            filter: drop-shadow(0 10px 5px rgba(0,0,0,0.2));
            position: relative;
            z-index: 2;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        
        .visual-side h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 36px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            animation: textGlow 3s ease-in-out infinite alternate;
        }
        
        @keyframes textGlow {
            0% { text-shadow: 0 0 10px rgba(255,255,255,0.3); }
            100% { text-shadow: 0 0 20px rgba(255,255,255,0.6); }
        }
        
        .visual-side p {
            font-size: 18px;
            opacity: 0.9;
            max-width: 80%;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        /* Book Particles Animation */
        .book-particle {
            position: absolute;
            font-size: 24px;
            opacity: 0;
            animation: floatBook linear infinite;
            z-index: 1;
        }
        
        @keyframes floatBook {
            0% {
                transform: translateY(100vh) rotate(0deg) scale(0.5);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100px) rotate(360deg) scale(1.2);
                opacity: 0;
            }
        }
        
        /* Form Side */
        .form-side {
            flex: 1;
            padding: 60px 50px;
            background: white;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        
        .form-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://assets.codepen.io/21542/paper-texture.jpg') repeat;
            opacity: 0.05;
            z-index: 0;
        }
        
        .form-header {
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }
        
        .form-header h2 {
            color: var(--primary-dark);
            font-size: 28px;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }
        
        .form-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
            animation: underlineGrow 1s ease-out forwards;
        }
        
        @keyframes underlineGrow {
            0% { width: 0; }
            100% { width: 60px; }
        }
        
        .form-header p {
            color: #666;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 15px;
            color: var(--primary-dark);
            transform: translateX(0);
            transition: all 0.3s ease;
        }
        
        .form-group:focus-within label {
            transform: translateX(5px);
            color: var(--primary);
        }
        
        .required::after {
            content: " *";
            color: #e74c3c;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.4s ease;
            background-color: rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 2;
        }
        
        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: var(--primary-light);
            outline: none;
            box-shadow: 0 0 0 4px rgba(79, 111, 82, 0.15);
            transform: translateY(-2px);
        }
        input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Untuk Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
        
        .submit-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 16px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.4s ease;
            margin-top: 20px;
            width: 100%;
            position: relative;
            overflow: hidden;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(26, 77, 46, 0.3);
        }
        
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 77, 46, 0.4);
        }
        
        .submit-btn:hover::before {
            left: 100%;
        }
        
        .login-prompt {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: #666;
            position: relative;
            z-index: 2;
        }
        
        .login-prompt a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }
        
        .login-prompt a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        .login-prompt a:hover::after {
            width: 100%;
        }
        
        /* Ink Blot Animation */
        .ink-blot {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 111, 82, 0.1) 0%, rgba(79, 111, 82, 0) 70%);
            border-radius: 50%;
            filter: blur(20px);
            animation: inkSpread 8s ease-in-out infinite alternate;
            z-index: 1;
        }
        
        @keyframes inkSpread {
            0% { transform: scale(0.8); opacity: 0.3; }
            100% { transform: scale(1.2); opacity: 0.1; }
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .registration-container {
                flex-direction: column;
                height: auto;
            }
            
            .visual-side, .form-side {
                padding: 40px 30px;
            }
            
            .library-icon {
                font-size: 80px;
            }
            
            .visual-side h1 {
                font-size: 28px;
            }
        }
        
        @media (max-width: 576px) {
            .registration-container {
                border-radius: 0;
            }
            
            .visual-side, .form-side {
                padding: 30px 25px;
            }
            
            .form-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <!-- Visual Side with Extreme Animations -->
        <div class="visual-side">
            <div class="library-icon">
            <img src="<?= base_url('images/umbb.png') ?>" alt="Library Icon" class="icon-img"></div>
            <h1></h1>
            <h1>MASUK DUNIA </h1>
            <br>
            <br>
            <h1>PENGETAHUAN</h1>
            
            <!-- Animated book particles will be inserted here by JavaScript -->
        </div>
        
        <!-- Form Side -->
        <div class="form-side">
            <!-- Ink blot animations -->
            <div class="ink-blot" style="top: -100px; right: -100px;"></div>
            <div class="ink-blot" style="bottom: -150px; left: -100px; animation-delay: 2s;"></div>
            
            <!-- <div class="form-header">
                <h2>Formulir Pendaftaran</h2>
                <p>Isi data diri Anda untuk bergabung</p>
            </div> -->
            
            <form action="/anggota/saveRegister" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nim" class="required">NIM</label>
                    <input type="number" id="nim" name="nim" required placeholder="Masukkan NIM Anda">
                </div>
                
                <div class="form-group">
                    <label for="nama" class="required">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label for="jurusan" class="required">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" required placeholder="Contoh: Teknik Informatika">
                </div>
                
                <div class="form-group">
                    <label for="fakultas" class="required">Fakultas</label>
                    <input type="text" id="fakultas" name="fakultas" required placeholder="Contoh: Fakultas Teknik">
                </div>
                
                <div class="form-group">
                    <label for="foto" class="required">Foto Profil</label>
                    <input type="file" id="foto" name="foto" required accept="image/*">
                </div>
                
                <button type="submit" class="submit-btn">DAFTAR SEKARANG</button>
                
                <div class="login-prompt">
                    Sudah punya akun? <a href="/login">Silahkan login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create extreme book particle animation
        document.addEventListener('DOMContentLoaded', function() {
            const visualSide = document.querySelector('.visual-side');
            const bookIcons = ['📕', '📗', '📘', '📙', '📔', '📒', '📓', '📖', '📚'];
            
            // Create 50 floating books with random properties
            for (let i = 0; i < 50; i++) {
                const book = document.createElement('div');
                book.className = 'book-particle';
                book.textContent = bookIcons[Math.floor(Math.random() * bookIcons.length)];
                
                // Random properties
                const size = Math.random() * 30 + 20;
                const duration = Math.random() * 10 + 3 ;
                const delay = Math.random() * 15;
                const left = Math.random() * 100;
                
                book.style.fontSize = `${size}px`;
                book.style.animationDuration = `${duration}s`;
                book.style.animationDelay = `${delay}s`;
                book.style.left = `${left}%`;
                book.style.filter = `hue-rotate(${Math.random() * 60}deg) brightness(${Math.random() * 0.5 + 0.8})`;
                
                visualSide.appendChild(book);
            }
            
            // Add interactive mouse effect
            document.addEventListener('mousemove', function(e) {
                const books = document.querySelectorAll('.book-particle');
                books.forEach(book => {
                    const rect = book.getBoundingClientRect();
                    const x = rect.left + rect.width/2 - e.clientX;
                    const y = rect.top + rect.height/2 - e.clientY;
                    const distance = Math.sqrt(x*x + y*y);
                    
                    if (distance < 150) {
                        const force = (150 - distance) / 50;
                        book.style.transform = `translate(${x * force * 0.1}px, ${y * force * 0.1}px)`;
                    }
                });
            });
            
            // Add ripple effect to submit button
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.className = 'ripple';
                ripple.style.left = `${e.offsetX}px`;
                ripple.style.top = `${e.offsetY}px`;
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });
    </script>
</body>
</html>
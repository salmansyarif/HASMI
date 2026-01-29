<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'HASMI - Himpunan Ahlussunnah untuk Masyarakat Islami')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/hasmilogo.jpg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <style>
        /* Mengatur base background agar tidak kedip putih saat loading */
        body {
            background-color: #020617; /* slate-950 */
        }
        
        /* Custom Scrollbar Premium */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb {
            background: #1e3a8a; /* blue-900 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; }

        /* Smooth Transitions */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    @yield('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#020617] text-slate-200 selection:bg-blue-500 selection:text-white">
    
    @include('layouts.navbar')
    
    <main class="min-h-screen pt-16 fade-in">
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    @yield('scripts')
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-slate-950/90', 'backdrop-blur-md', 'shadow-2xl', 'border-b', 'border-slate-800');
            } else {
                navbar.classList.remove('bg-slate-950/90', 'backdrop-blur-md', 'shadow-2xl', 'border-b', 'border-slate-800');
            }
        });
    </script>
</body>
</html>
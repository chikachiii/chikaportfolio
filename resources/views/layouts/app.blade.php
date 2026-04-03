<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jessica Frederine Setiawan | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .sticky-nav {
            background-color: rgba(255, 250, 240, 0.7) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="pastel-gradient min-h-screen">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500 py-6 px-6 md:px-12">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <div class="text-2xl font-bold tracking-tight rounded-xl py-1 px-3 transition-all duration-300">
                    <span class="text-gradient text-2xl md:text-3xl">Jessica Portfolio</span>
                    <i class="fas fa-sparkles text-soft-pink text-sm animate-pulse ml-1"></i>
                </div>
            </a>
            
            <div class="hidden md:flex space-x-10 items-center">
                <a href="{{ route('home') }}" class="font-bold text-gray-600 hover:text-soft-pink transition-all duration-300 relative group {{ Route::is('home') ? 'nav-link-active' : '' }}">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-soft-pink transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('projects.index') }}" class="font-bold text-gray-600 hover:text-soft-pink transition-all duration-300 relative group {{ Route::is('projects.index') ? 'nav-link-active' : '' }}">
                    My Gallery
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-soft-pink transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="md:hidden">
                <button class="text-soft-purple text-2xl p-2 rounded-xl bg-white/40 backdrop-blur-sm"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </nav>

    <main class="pt-24">
        <!-- Flash Messages -->
        @if(session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)"
                 class="fixed top-28 right-6 z-[110] glass-card px-8 py-4 border-l-8 border-soft-pink flex items-center shadow-2xl"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-8"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-8">
                <div class="w-10 h-10 rounded-full bg-soft-pink/20 flex items-center justify-center mr-4">
                    <i class="fas fa-check text-soft-pink"></i>
                </div>
                <span class="font-bold text-gray-700">{{ session('success') }}</span>
                <button @click="show = false" class="ml-6 text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white/30 backdrop-blur-md py-16 mt-24 border-t border-white/40">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex justify-center space-x-10 mb-10">
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/60 flex items-center justify-center text-gray-600 hover:text-soft-pink transition-all transform hover:scale-110 shadow-sm hover:shadow-md"><i class="fab fa-instagram text-2xl"></i></a>
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/60 flex items-center justify-center text-gray-600 hover:text-soft-pink transition-all transform hover:scale-110 shadow-sm hover:shadow-md"><i class="fab fa-whatsapp text-2xl"></i></a>
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/60 flex items-center justify-center text-gray-600 hover:text-soft-pink transition-all transform hover:scale-110 shadow-sm hover:shadow-md"><i class="fas fa-school text-2xl"></i></a>
            </div>
            
            <div class="mb-6 flex justify-center items-center space-x-3">
                <i class="fas fa-star text-soft-pink text-xs"></i>
                <i class="fas fa-heart text-soft-purple text-sm animate-pulse"></i>
                <i class="fas fa-flower text-soft-peach text-xs"></i>
            </div>
            
            <p class="text-gray-500 font-bold text-lg mb-2">Jessica Frederine Setiawan</p>
            <p class="text-gray-400 text-sm font-medium">© 2026 Creative Student Portfolio. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Sticky Navbar logic
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('sticky-nav');
                nav.classList.remove('py-6');
                nav.classList.add('py-3');
            } else {
                nav.classList.remove('sticky-nav');
                nav.classList.remove('py-3');
                nav.classList.add('py-6');
            }
        });

        // Initialize ScrollReveal
        ScrollReveal().reveal('.reveal', {
            delay: 300,
            distance: '30px',
            origin: 'bottom',
            duration: 1200,
            easing: 'cubic-bezier(0.5, 0, 0, 1)',
            reset: false
        });
    </script>
</body>
</html>

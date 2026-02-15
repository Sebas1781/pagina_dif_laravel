<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DIF Tecámac - Trabajando al servicio del pueblo">
    <title>@yield('title', 'DIF Tecámac')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-dif-gray bg-white overflow-x-hidden">

    {{-- NAVBAR --}}
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="{{ route('inicio') }}" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-dif-pink to-dif-pink-light rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-extrabold text-lg">DIF</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-dif-pink font-bold text-lg leading-tight">DIF Tecámac</p>
                        <p class="text-xs text-gray-500">Trabajando al servicio del pueblo</p>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('inicio') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('inicio') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        INICIO
                    </a>
                    <a href="{{ route('nosotros') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('nosotros') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        NOSOTROS
                    </a>
                    <a href="{{ route('servicios') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('servicios') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        SERVICIOS
                    </a>
                    <a href="{{ route('salud') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('salud') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        SALUD
                    </a>
                    <a href="{{ route('educacion') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('educacion') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        EDUCACIÓN Y CULTURA
                    </a>
                    <a href="{{ route('directorio') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 {{ request()->routeIs('directorio') ? 'bg-dif-pink text-white shadow-lg' : 'text-dif-dark hover:bg-dif-cream hover:text-dif-pink' }}">
                        DIRECTORIO
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg text-dif-dark hover:bg-dif-cream transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="lg:hidden hidden bg-white/95 backdrop-blur-lg border-t border-gray-100">
            <div class="px-4 py-4 space-y-2">
                <a href="{{ route('inicio') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('inicio') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">INICIO</a>
                <a href="{{ route('nosotros') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('nosotros') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">NOSOTROS</a>
                <a href="{{ route('servicios') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('servicios') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">SERVICIOS</a>
                <a href="{{ route('salud') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('salud') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">SALUD</a>
                <a href="{{ route('educacion') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('educacion') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">EDUCACIÓN Y CULTURA</a>
                <a href="{{ route('directorio') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('directorio') ? 'bg-dif-pink text-white' : 'text-dif-dark hover:bg-dif-cream' }}">DIRECTORIO</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-br from-dif-pink-dark via-dif-pink to-dif-magenta text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                {{-- Column 1 --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <span class="text-white font-extrabold text-lg">DIF</span>
                        </div>
                        <div>
                            <p class="font-bold text-lg">DIF Tecámac</p>
                            <p class="text-xs text-white/70">Gobierno Municipal</p>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm leading-relaxed">
                        Trabajando al servicio del pueblo. Por el bien de las y los tecamaquenses.
                    </p>
                </div>

                {{-- Column 2 --}}
                <div>
                    <h4 class="font-bold text-lg mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('inicio') }}" class="text-white/80 hover:text-white text-sm transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i>Inicio</a></li>
                        <li><a href="{{ route('nosotros') }}" class="text-white/80 hover:text-white text-sm transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i>Nosotros</a></li>
                        <li><a href="{{ route('servicios') }}" class="text-white/80 hover:text-white text-sm transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i>Servicios</a></li>
                        <li><a href="{{ route('salud') }}" class="text-white/80 hover:text-white text-sm transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i>Salud</a></li>
                        <li><a href="{{ route('educacion') }}" class="text-white/80 hover:text-white text-sm transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i>Educación y Cultura</a></li>
                    </ul>
                </div>

                {{-- Column 3 --}}
                <div>
                    <h4 class="font-bold text-lg mb-4">Contacto</h4>
                    <ul class="space-y-3 text-sm text-white/80">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-dif-pink-light"></i>
                            <span>Av. Esmeralda S/N colonia Lomas de Tecámac, Tecámac, Méx.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-clock mt-1 text-dif-pink-light"></i>
                            <span>Lunes a Viernes: 9:00 - 18:00 hrs</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-phone mt-1 text-dif-pink-light"></i>
                            <span>Próximamente</span>
                        </li>
                    </ul>
                </div>

                {{-- Column 4 --}}
                <div>
                    <h4 class="font-bold text-lg mb-4">Síguenos</h4>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center hover:bg-white hover:text-dif-pink transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center hover:bg-white hover:text-dif-pink transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center hover:bg-white hover:text-dif-pink transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center hover:bg-white hover:text-dif-pink transition-all duration-300 hover:scale-110">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <p class="text-white/60 text-xs mt-6">
                        © {{ date('Y') }} DIF Tecámac. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-4">
            <p class="text-center text-white/50 text-xs">
                Gobierno Municipal de Tecámac · Desarrollo Integral de la Familia
            </p>
        </div>
    </footer>

    {{-- Scroll to top button --}}
    <button id="scroll-top" class="fixed bottom-6 right-6 w-12 h-12 bg-dif-pink text-white rounded-full shadow-2xl flex items-center justify-center opacity-0 translate-y-4 transition-all duration-300 hover:bg-dif-pink-dark hover:scale-110 z-50 cursor-pointer">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const icon = mobileMenuBtn.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Scroll animations (Intersection Observer)
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('scroll-visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-hidden, .scroll-left, .scroll-right, .scroll-scale').forEach(el => {
            observer.observe(el);
        });

        // Scroll to top
        const scrollTopBtn = document.getElementById('scroll-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.remove('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }
        });
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Counter animation
        function animateCounter(el) {
            const target = parseInt(el.getAttribute('data-count'));
            const duration = 2000;
            const start = performance.now();
            function update(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.floor(eased * target).toLocaleString();
                if (progress < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
        }

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    entry.target.dataset.counted = 'true';
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));
    </script>
</body>
</html>

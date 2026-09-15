<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300">
    <div id="navbar-inner" class="mx-auto max-w-7xl px-6 py-5 transition-all duration-300">

        <div class="flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" id="navbar-logo"
                class="text-xl font-bold tracking-widest text-white transition-colors duration-300">
                CORNER BISNIS
            </a>

            {{-- DESKTOP NAV --}}
            <div class="hidden items-center gap-8 md:flex">

                @foreach ($categories as $category)

                @if ($category->name == 'Laundry')

                <a href="{{ route('laundry') }}"
                    class="desktop-nav-link text-white font-medium transition-colors hover:text-gray-300">
                    Laundry
                </a>

                @else

                <div class="group relative">
                    <button type="button"
                        class="desktop-nav-link flex items-center gap-1 text-white font-medium transition-colors hover:text-gray-300">
                        {{ $category->name }}
                        <svg class="h-4 w-4 transition-transform duration-200 group-hover:rotate-180"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="invisible absolute left-0 top-full mt-3 w-52 translate-y-2 rounded-xl bg-white p-2 opacity-0 shadow-xl transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">

                        @foreach ($category->businesses->unique('name') as $business)
                        <a href="{{ route('kos.show', $business->id) }}"
                            class="block rounded-lg px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-100 hover:text-gray-900">
                            {{ $business->name }}
                        </a>
                        @endforeach
                        <div class="my-1 border-t"></div>

                        <a href="{{ route('kos') }}"
                            class="block rounded-lg px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-100 hover:text-gray-900">
                            Lihat semua →
                        </a>
                    </div>
                </div>

                @endif

                @endforeach

            </div>

            {{-- MOBILE HAMBURGER --}}
            <button id="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false"
                class="relative flex h-11 w-11 items-center justify-center rounded-full text-white transition-all duration-300 hover:bg-white/10 md:hidden">

                {{-- OPEN --}}
                <svg id="menu-open-icon" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                {{-- CLOSE --}}
                <svg id="menu-close-icon" class="hidden h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

        </div>

        {{-- MOBILE MENU (DENGAN LOOP) --}}
        <div id="mobile-menu" class="hidden md:hidden">
            <div id="mobile-menu-panel" class="mt-5 overflow-hidden rounded-2xl bg-[#1f1f1f] shadow-2xl transition-colors duration-500">

                @foreach ($categories as $category)

                @if ($category->name == 'Laundry')

                <a href="{{ route('laundry') }}"
                    class="block border-b border-gray-100 px-6 py-4 font-medium text-white transition hover:bg-gray-800">
                    Laundry
                </a>

                @else

                <div class="border-b border-gray-100">
                    <button type="button"
                        class="mobile-category-toggle flex w-full items-center justify-between px-6 py-4 font-medium text-white">
                        <span>{{ $category->name }}</span>

                        <svg class="category-arrow h-5 w-5 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="mobile-submenu hidden bg-[#292929] px-4 pb-3">
                        @foreach ($category->businesses->unique('name') as $business)
                        <a href="{{ route('kos.show', $business->id) }}"
                            class="block rounded-lg px-4 py-3 text-sm text-gray-200 hover:bg-gray-700">
                            {{ $business->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                @endif

                @endforeach

            </div>
        </div>

    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const navbar = document.getElementById('main-navbar');
        const navbarInner = document.getElementById('navbar-inner');
        const navbarLogo = document.getElementById('navbar-logo');

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuPanel = document.getElementById('mobile-menu-panel');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');

        /*
        |--------------------------------------------------------------------------
        | Navbar Scroll
        |--------------------------------------------------------------------------
        */

        function handleNavbarScroll() {

            if (window.scrollY > 50) {

                navbarInner.classList.remove('py-5');
                navbarInner.classList.add('py-3', 'bg-white', 'shadow-lg', 'rounded-b-xl');

                navbarLogo.classList.remove('text-white');
                navbarLogo.classList.add('text-gray-900');

                document.querySelectorAll('.desktop-nav-link').forEach(el => {
                    el.classList.remove('text-white', 'hover:text-gray-300');
                    el.classList.add('text-gray-900', 'hover:text-gray-600');
                });

                menuToggle.classList.remove('text-white');
                menuToggle.classList.add('text-gray-900');

                // MOBILE MENU PANEL JADI PUTIH
                mobileMenuPanel.classList.remove('bg-[#1f1f1f]');
                mobileMenuPanel.classList.add('bg-white');

                document.querySelectorAll('.mobile-category-toggle').forEach(el => {
                    el.classList.remove('text-white');
                    el.classList.add('text-gray-900');
                });

                document.querySelectorAll('.mobile-submenu').forEach(el => {
                    el.classList.remove('bg-[#292929]');
                    el.classList.add('bg-gray-50');
                });

                mobileMenu.querySelectorAll('.mobile-submenu a').forEach(el => {
                    el.classList.remove('text-gray-200');
                    el.classList.add('text-gray-700');
                });

            } else {

                navbarInner.classList.remove('py-3', 'bg-white', 'shadow-lg', 'rounded-b-xl');
                navbarInner.classList.add('py-5');

                navbarLogo.classList.remove('text-gray-900');
                navbarLogo.classList.add('text-white');

                document.querySelectorAll('.desktop-nav-link').forEach(el => {
                    el.classList.remove('text-gray-900', 'hover:text-gray-600');
                    el.classList.add('text-white', 'hover:text-gray-300');
                });

                menuToggle.classList.remove('text-gray-900');
                menuToggle.classList.add('text-white');

                // MOBILE MENU PANEL KEMBALI GELAP
                mobileMenuPanel.classList.remove('bg-white');
                mobileMenuPanel.classList.add('bg-[#1f1f1f]');

                document.querySelectorAll('.mobile-category-toggle').forEach(el => {
                    el.classList.remove('text-gray-900');
                    el.classList.add('text-white');
                });

                document.querySelectorAll('.mobile-submenu').forEach(el => {
                    el.classList.remove('bg-gray-50');
                    el.classList.add('bg-[#292929]');
                });

                mobileMenu.querySelectorAll('.mobile-submenu a').forEach(el => {
                    el.classList.remove('text-gray-700');
                    el.classList.add('text-gray-200');
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Hamburger
        |--------------------------------------------------------------------------
        */

        menuToggle.addEventListener('click', function() {

            const isOpen = !mobileMenu.classList.contains('hidden');

            mobileMenu.classList.toggle('hidden');

            openIcon.classList.toggle('hidden', !isOpen);
            closeIcon.classList.toggle('hidden', isOpen);

            menuToggle.setAttribute('aria-expanded', String(!isOpen));
        });

        /*
        |--------------------------------------------------------------------------
        | Klik di luar menu untuk menutup
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function(event) {

            const isClickInside = mobileMenu.contains(event.target) || menuToggle.contains(event.target);

            if (!isClickInside) {
                mobileMenu.classList.add('hidden');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Mobile Accordion
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.mobile-category-toggle').forEach(button => {

            button.addEventListener('click', function() {

                const submenu = this.nextElementSibling;
                const arrow = this.querySelector('.category-arrow');

                submenu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });

        });

        /*
        |--------------------------------------------------------------------------
        | Tutup menu setelah klik link
        |--------------------------------------------------------------------------
        */

        mobileMenu.querySelectorAll('a').forEach(link => {

            link.addEventListener('click', function() {

                mobileMenu.classList.add('hidden');

                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');

                menuToggle.setAttribute('aria-expanded', 'false');
            });

        });

        /*
        |--------------------------------------------------------------------------
        | Tutup menu saat scroll
        |--------------------------------------------------------------------------
        */

        window.addEventListener('scroll', function() {
            mobileMenu.classList.add('hidden');
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            menuToggle.setAttribute('aria-expanded', 'false');
        });

        window.addEventListener('scroll', handleNavbarScroll);

        handleNavbarScroll();
    });
</script>
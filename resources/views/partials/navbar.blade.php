<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300">
    <div id="navbar-inner" class="mx-auto max-w-7xl px-6 py-5 transition-all duration-300 pointer-events-none">

        <div class="flex items-center justify-between pointer-events-auto">

            {{-- LOGO --}}
            @php
                $logoType = \App\Models\SiteContent::get('navbar_logo_type', 'text');
                $logoText = \App\Models\SiteContent::get('navbar_logo_text', 'RT 04');
                $logoImage = \App\Models\SiteContent::get('navbar_logo_image');
            @endphp

            <a href="{{ route('home') }}" id="navbar-logo"
                class="transition-all duration-500 hover:scale-105 {{ $logoType === 'image' ? '' : 'text-xl font-bold tracking-widest text-white' }}">
                @if ($logoType === 'image' && $logoImage && file_exists(public_path($logoImage)))
                    <img src="{{ asset($logoImage) }}" alt="Logo" id="navbar-logo-img"
                        class="h-10 w-auto object-contain transition-all duration-500 brightness-0 invert">
                @else
                    {{ $logoText }}
                @endif
            </a>

            {{-- DESKTOP NAV --}}
            <div class="hidden items-center gap-8 md:flex">
                @foreach ($categories as $category)

                    @if ($category->name == 'Laundry')
                        <a href="{{ route('laundry') }}"
                            class="desktop-nav-link relative text-white font-medium transition-all duration-300 hover:text-yellow-400 group">
                            Laundry
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    @else
                        <div class="group relative">
                            <button type="button"
                                class="desktop-nav-link relative flex items-center gap-1 text-white font-medium transition-all duration-300 hover:text-yellow-400">
                                {{ $category->name }}
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                            </button>

                            <div class="invisible absolute left-0 top-full mt-3 w-52 translate-y-3 rounded-xl bg-white p-2 opacity-0 shadow-2xl transition-all duration-300 ease-out group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                                @foreach ($category->businesses->unique('name') as $business)
                                    <a href="{{ route('kos.show', $business->id) }}"
                                        class="block rounded-lg px-4 py-3 text-sm text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-[#4a1e2b] hover:to-[#7A384D] hover:text-white hover:translate-x-1">
                                        {{ $business->name }}
                                    </a>
                                @endforeach
                                <div class="my-1 border-t"></div>

                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="block rounded-lg px-4 py-3 text-sm font-semibold text-[#4a1e2b] transition-all duration-200 hover:bg-gradient-to-r hover:from-[#4a1e2b] hover:to-[#7A384D] hover:text-white hover:translate-x-1">
                                    Lihat semua →
                                </a>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>

            {{-- MOBILE HAMBURGER --}}
            <button id="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false"
                class="relative z-[100] pointer-events-auto flex h-11 w-11 items-center justify-center rounded-full text-white transition-all duration-300 hover:bg-white/10 active:scale-95 md:hidden"
                style="pointer-events: auto; touch-action: manipulation;">

                <svg id="menu-open-icon" class="h-7 w-7 pointer-events-none transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg id="menu-close-icon" class="hidden h-7 w-7 pointer-events-none transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu" class="hidden md:hidden pointer-events-auto">
            <div id="mobile-menu-panel" class="mt-5 overflow-hidden rounded-2xl bg-[#1f1f1f] shadow-2xl transition-all duration-500 transform origin-top">

                @foreach ($categories as $category)

                    @if ($category->name == 'Laundry')
                        <a href="{{ route('laundry') }}"
                            class="mobile-menu-link group block border-b border-gray-100/10 px-6 py-4 font-medium text-white transition-all duration-300 hover:bg-gradient-to-r hover:from-[#4a1e2b] hover:to-[#7A384D] hover:pl-8">
                            <span class="inline-flex items-center gap-2">
                                <i class="fas fa-tshirt text-yellow-400 opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-6 group-hover:ml-0"></i>
                                Laundry
                            </span>
                        </a>
                    @else
                        <div class="border-b border-gray-100/10 mobile-accordion-item">
                            <button type="button"
                                class="mobile-category-toggle group flex w-full items-center justify-between px-6 py-4 font-medium text-white transition-all duration-300 hover:bg-white/5">
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-folder text-yellow-400 opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-6 group-hover:ml-0"></i>
                                    {{ $category->name }}
                                </span>
                                <svg class="category-arrow h-5 w-5 transition-transform duration-500 ease-out"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="mobile-submenu hidden bg-[#292929] px-4 pb-3 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                                <div class="pt-2">
                                    @foreach ($category->businesses->unique('name') as $business)
                                        <a href="{{ route('kos.show', $business->id) }}"
                                            class="group block rounded-lg px-4 py-3 text-sm text-gray-200 transition-all duration-200 hover:bg-[#4a1e2b] hover:text-white hover:translate-x-1">
                                            <i class="fas fa-store text-yellow-400 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                                            {{ $business->name }}
                                        </a>
                                    @endforeach

                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="block rounded-lg px-4 py-3 text-sm font-semibold text-yellow-400 hover:bg-[#4a1e2b] hover:text-white mt-1 border-t border-gray-600/50 pt-3 transition-all duration-200 hover:translate-x-1">
                                        Lihat semua →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>

    </div>
</nav>

<script>
    if (!window._navbarInitialized) {
        window._navbarInitialized = true;

        window.addEventListener('load', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuPanel = document.getElementById('mobile-menu-panel');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');
            const navbarInner = document.getElementById('navbar-inner');
            const navbarLogo = document.getElementById('navbar-logo');
            const navbarLogoImg = document.getElementById('navbar-logo-img');

            let justToggled = false;

            // ========== HAMBURGER TOGGLE ==========
            if (menuToggle && mobileMenu) {
                function doToggle(e) {
                    if (e) { e.preventDefault(); e.stopPropagation(); }

                    const isCurrentlyHidden = mobileMenu.classList.contains('hidden');

                    if (isCurrentlyHidden) {
                        // Buka menu dengan animasi
                        mobileMenu.classList.remove('hidden');
                        mobileMenuPanel.classList.remove('scale-y-0', 'opacity-0');
                        mobileMenuPanel.classList.add('scale-y-100', 'opacity-100');

                        if (openIcon) openIcon.classList.add('hidden');
                        if (closeIcon) closeIcon.classList.remove('hidden');
                        menuToggle.setAttribute('aria-expanded', 'true');
                    } else {
                        // Tutup menu dengan animasi
                        mobileMenuPanel.classList.remove('scale-y-100', 'opacity-100');
                        mobileMenuPanel.classList.add('scale-y-0', 'opacity-0');

                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                            mobileMenuPanel.classList.remove('scale-y-0', 'opacity-0');
                        }, 300);

                        if (openIcon) openIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    }

                    justToggled = true;
                    setTimeout(() => { justToggled = false; }, 300);
                    console.log('✅ Hamburger. Menu:', isCurrentlyHidden ? 'OPEN' : 'CLOSED');
                }

                menuToggle.addEventListener('mousedown', doToggle);
                menuToggle.addEventListener('touchstart', doToggle, { passive: false });
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault(); e.stopPropagation();
                    if (!justToggled) doToggle(e);
                });
            }

            // ========== KLIK LUAR → TUTUP ==========
            document.addEventListener('click', function(event) {
                if (justToggled) return;
                if (!mobileMenu || !menuToggle) return;
                const isClickInside = mobileMenu.contains(event.target) || menuToggle.contains(event.target);
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    if (openIcon) openIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // ========== ACCORDION (EXCLUSIVE) ==========
            const accordionButtons = document.querySelectorAll('.mobile-category-toggle');

            accordionButtons.forEach((button, index) => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();

                    const submenu = this.nextElementSibling;
                    const arrow = this.querySelector('.category-arrow');
                    const isCurrentlyOpen = !submenu.classList.contains('hidden');

                    // ⭐ TUTUP SEMUA ACCORDION LAIN (EXCLUSIVE)
                    accordionButtons.forEach(otherButton => {
                        if (otherButton !== this) {
                            const otherSubmenu = otherButton.nextElementSibling;
                            const otherArrow = otherButton.querySelector('.category-arrow');

                            if (otherSubmenu && !otherSubmenu.classList.contains('hidden')) {
                                // Animasi tutup
                                otherSubmenu.style.maxHeight = '0px';
                                setTimeout(() => {
                                    otherSubmenu.classList.add('hidden');
                                    otherSubmenu.style.maxHeight = '';
                                }, 300);
                                if (otherArrow) otherArrow.classList.remove('rotate-180');
                            }
                        }
                    });

                    // Toggle submenu yang diklik
                    if (isCurrentlyOpen) {
                        // Tutup
                        submenu.style.maxHeight = '0px';
                        setTimeout(() => {
                            submenu.classList.add('hidden');
                            submenu.style.maxHeight = '';
                        }, 300);
                        if (arrow) arrow.classList.remove('rotate-180');
                    } else {
                        // Buka
                        submenu.classList.remove('hidden');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        if (arrow) arrow.classList.add('rotate-180');
                    }
                });
            });

            // ========== TUTUP SETELAH KLIK LINK ==========
            if (mobileMenu) {
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenuPanel.classList.remove('scale-y-100', 'opacity-100');
                        mobileMenuPanel.classList.add('scale-y-0', 'opacity-0');

                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                            mobileMenuPanel.classList.remove('scale-y-0', 'opacity-0');
                        }, 300);

                        if (openIcon) openIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
                    });
                });
            }

            // ========== NAVBAR SCROLL ==========
            function handleNavbarScroll() {
                if (!navbarInner) return;

                if (window.scrollY > 50) {
                    navbarInner.classList.remove('py-5');
                    navbarInner.classList.add('py-3', 'bg-white', 'shadow-lg', 'rounded-b-xl');

                    if (navbarLogo && !navbarLogoImg) {
                        navbarLogo.classList.remove('text-white');
                        navbarLogo.classList.add('text-gray-900');
                    }
                    if (navbarLogoImg) navbarLogoImg.classList.remove('brightness-0', 'invert');

                    document.querySelectorAll('.desktop-nav-link').forEach(el => {
                        el.classList.remove('text-white', 'hover:text-yellow-400');
                        el.classList.add('text-gray-900', 'hover:text-[#4a1e2b]');
                    });

                    if (menuToggle) {
                        menuToggle.classList.remove('text-white');
                        menuToggle.classList.add('text-gray-900');
                    }
                    if (mobileMenuPanel) {
                        mobileMenuPanel.classList.remove('bg-[#1f1f1f]');
                        mobileMenuPanel.classList.add('bg-white');
                    }

                    document.querySelectorAll('.mobile-category-toggle').forEach(el => {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-900');
                    });

                    document.querySelectorAll('.mobile-menu-link').forEach(el => {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-900');
                    });

                    document.querySelectorAll('.mobile-submenu').forEach(el => {
                        el.classList.remove('bg-[#292929]');
                        el.classList.add('bg-gray-50');
                    });

                    if (mobileMenu) {
                        mobileMenu.querySelectorAll('.mobile-submenu a').forEach(el => {
                            el.classList.remove('text-gray-200');
                            el.classList.add('text-gray-700');
                        });
                    }
                } else {
                    navbarInner.classList.remove('py-3', 'bg-white', 'shadow-lg', 'rounded-b-xl');
                    navbarInner.classList.add('py-5');

                    if (navbarLogo && !navbarLogoImg) {
                        navbarLogo.classList.remove('text-gray-900');
                        navbarLogo.classList.add('text-white');
                    }
                    if (navbarLogoImg) navbarLogoImg.classList.add('brightness-0', 'invert');

                    document.querySelectorAll('.desktop-nav-link').forEach(el => {
                        el.classList.remove('text-gray-900', 'hover:text-[#4a1e2b]');
                        el.classList.add('text-white', 'hover:text-yellow-400');
                    });

                    document.querySelectorAll('.mobile-menu-link').forEach(el => {
                        el.classList.remove('text-gray-900');
                        el.classList.add('text-white');
                    });

                    if (menuToggle) {
                        menuToggle.classList.remove('text-gray-900');
                        menuToggle.classList.add('text-white');
                    }
                    if (mobileMenuPanel) {
                        mobileMenuPanel.classList.remove('bg-white');
                        mobileMenuPanel.classList.add('bg-[#1f1f1f]');
                    }

                    document.querySelectorAll('.mobile-category-toggle').forEach(el => {
                        el.classList.remove('text-gray-900');
                        el.classList.add('text-white');
                    });

                    document.querySelectorAll('.mobile-submenu').forEach(el => {
                        el.classList.remove('bg-gray-50');
                        el.classList.add('bg-[#292929]');
                    });

                    if (mobileMenu) {
                        mobileMenu.querySelectorAll('.mobile-submenu a').forEach(el => {
                            el.classList.remove('text-gray-700');
                            el.classList.add('text-gray-200');
                        });
                    }
                }
            }

            window.addEventListener('scroll', handleNavbarScroll);
            handleNavbarScroll();
        });
    } else {
        console.log('⚠️ Navbar already initialized');
    }
</script>
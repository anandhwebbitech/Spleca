<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Home') | Spleca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ================= MOBILE RESET ================= */
@media (max-width: 768px) {

    body {
        overflow-x: hidden;
    }

    /* Hide desktop-only elements */
    .desktop-only {
        display: none !important;
    }

    /* Header */
    .header {
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-logo img {
        height: 38px;
    }

    /* Search bar */
    .search-box {
        width: 100%;
        margin-top: 10px;
    }

    .search-box input {
        width: 100%;
        font-size: 14px;
        padding: 8px 12px;
    }

    /* Mobile menu button */
    #menuBtn {
        font-size: 22px;
        background: none;
        border: none;
    }

    /* ================= MOBILE SIDEBAR ================= */
    #wb-mobile-nav {
        position: fixed;
        top: 0;
        left: -100%;
        width: 85%;
        height: 100vh;
        background: #fff;
        z-index: 9999;
        overflow-y: auto;
        transition: 0.3s ease;
        padding: 15px;
    }

    #wb-mobile-nav.active {
        left: 0;
    }

    .menu-open {
        overflow: hidden;
    }

    /* Overlay */
    #overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        display: none;
        z-index: 9998;
    }

    #overlay.active {
        display: block;
    }

    /* Mobile menu list */
    #wb-mobile-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #wb-mobile-nav li {
        border-bottom: 1px solid #eee;
    }

    #wb-mobile-nav a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 8px;
        font-size: 15px;
        color: #222;
        text-decoration: none;
    }

    /* Accordion submenu */
    .wb-accordion-panel {
        display: none;
        padding-left: 15px;
    }

    .wb-accordion-panel.active {
        display: block;
    }

    /* Cart fix */
    .cart-dropdown,
    .cart-panel {
        width: 100%;
        max-width: 100%;
    }

}

    </style>
    {{-- CSS --}}
    @include('layouts.header-link')
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.nav-bar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Core JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Swiper (ONLY ONE version) --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        /* ================== SWIPER ================== */
        if (typeof Swiper !== "undefined") {
            document.querySelectorAll(".mySwiper").forEach(swiperEl => {
                new Swiper(swiperEl, {
                    loop: true,
                    slidesPerView: 1,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: swiperEl.querySelector(".swiper-pagination"),
                        clickable: true,
                    },
                });
            });
        }

        /* ================== CART ================== */
        let cart = [];

        const cartWidget  = document.getElementById('cartWidget');
        const cartOverlay = document.getElementById('cartOverlay');
        const cartPanel   = document.getElementById('cartPanel');
        const closeCart   = document.getElementById('closeCart');
        const cartItems   = document.getElementById('cartItems');
        const cartBadge   = document.getElementById('cartBadge');
        const cartTotal   = document.getElementById('cartTotal');
        const totalAmount = document.getElementById('totalAmount');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // function openCart() {
        //     if (!cartPanel || !cartOverlay) return;
        //     cartPanel.classList.add('active');
        //     cartOverlay.classList.add('active');
        //     document.body.style.overflow = 'hidden';
        // }

        // function closeCartPanel() {
        //     if (!cartPanel || !cartOverlay) return;
        //     cartPanel.classList.remove('active');
        //     cartOverlay.classList.remove('active');
        //     document.body.style.overflow = '';
        // }

        // cartWidget?.addEventListener('click', e => {
        //     e.preventDefault();
        //     openCart();
        // });

        // closeCart?.addEventListener('click', closeCartPanel);
        // cartOverlay?.addEventListener('click', closeCartPanel);

        // window.updateCart = function () {
        //     if (!cartBadge || !cartItems || !cartTotal || !totalAmount) return;

        //     const totalItems = cart.reduce((s, i) => s + i.qty, 0);
        //     const totalPrice = cart.reduce((s, i) => s + i.qty * i.price, 0);

        //     cartBadge.textContent = totalItems;
        //     cartTotal.textContent = `₹${totalPrice.toFixed(2)}`;
        //     totalAmount.textContent = `₹${totalPrice.toFixed(2)}`;

        //     if (!cart.length) {
        //         cartItems.innerHTML = `<p class="text-center">Your cart is empty</p>`;
        //         checkoutBtn && (checkoutBtn.disabled = true);
        //     } else {
        //         cartItems.innerHTML = cart.map(item => `
        //             <div class="cart-item">
        //                 <strong>${item.name}</strong>
        //                 <span>₹${item.price}</span>
        //             </div>
        //         `).join('');
        //         checkoutBtn && (checkoutBtn.disabled = false);
        //     }
        // };

        // checkoutBtn?.addEventListener('click', () => {
        //     alert("Proceeding to checkout");
        // });

        /* ================== MOBILE MENU ================== */
        const mobileNav = document.getElementById('wb-mobile-nav');
        const menuBtn   = document.getElementById('menuBtn');
        const closeBtn  = document.getElementById('closeBtn');
        const overlay   = document.getElementById('overlay');

        function openNav() {
            if (!mobileNav) return;
            mobileNav.classList.add('active');
            document.body.classList.add('menu-open');
        }

        function closeNav() {
            if (!mobileNav) return;
            mobileNav.classList.remove('active');
            document.body.classList.remove('menu-open');
        }

        menuBtn?.addEventListener('click', openNav);
        closeBtn?.addEventListener('click', closeNav);
        overlay?.addEventListener('click', closeNav);

        /* ================== ACCORDION ================== */
        document.querySelectorAll('.wb-accordion-toggle').forEach(btn => {
            btn.addEventListener('click', function () {
                const panel = this.nextElementSibling;
                panel.classList.toggle('active');
            });
        });

        /* ================== DROPDOWNS ================== */
        document.addEventListener('click', () => {
            document.querySelectorAll('.wb-dropdown.active')
                .forEach(d => d.classList.remove('active'));
        });

        document.querySelectorAll('.wb-dropdown').forEach(dropdown => {
            dropdown.addEventListener('click', e => e.stopPropagation());
        });

    });
    </script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }
    });
</script>
    {{-- Page specific JS --}}
    @stack('scripts')

</body>
</html>

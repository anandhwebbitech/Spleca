<style>
    #sidebar {
        min-height: 100vh;
        width: 260px;
        background: linear-gradient(180deg, #ffffff 0%, #f3f6fb 100%);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: #1f2937;
        box-shadow: 10px 0 35px rgba(0, 0, 0, 0.12);
        border-right: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* ================= ENHANCED TOOLTIP ================= */
    .nav-link[data-tooltip] {
        position: relative;
    }

    /* Tooltip box */
    .nav-link[data-tooltip]::after {
        content: attr(data-tooltip);
        position: absolute;
        left: 72px;
        top: 50%;
        transform: translateY(-50%) scale(0.95);
        background: #111827;
        color: #ffffff;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: all 0.18s ease;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
        z-index: 9999;
    }

    /* Tooltip arrow */
    .nav-link[data-tooltip]::before {
        content: "";
        position: absolute;
        left: 64px;
        top: 50%;
        transform: translateY(-50%);
        border-width: 6px;
        border-style: solid;
        border-color: transparent #111827 transparent transparent;
        opacity: 0;
        transition: opacity 0.18s ease;
    }

    /* Show tooltip ONLY when sidebar is collapsed */
    .sidebar.collapsed .nav-link:hover::after,
    .sidebar.collapsed .nav-link:hover::before {
        opacity: 1;
        transform: translateY(-50%) scale(1);
    }

    /* ================= HEADER ================= */
    .sidebar-header {
        position: relative;
        padding-bottom: 18px;
    }

    .sidebar-logo {
        width: 130px;
    }

    .sidebar-header::after {
        content: '';
        display: block;
        width: 70%;
        height: 1px;
        background: linear-gradient(to right, transparent, #d1d5db, transparent);
        margin: 18px auto 0;
    }

    /* Toggle */
    .sidebar-toggle {
        position: absolute;
        top: 0;
        right: 0;
        background: #f1f5f9;
        color: #374151;
        border-radius: 8px;
        padding: 6px 8px;
        border: none;
        transition: 0.3s;
    }

    .sidebar-toggle:hover {
        background: #e5e7eb;
    }

    /* ================= SECTION TITLE ================= */
    .section-block small {
        font-size: 11px;
        letter-spacing: 2px;
        font-weight: 700;
        color: #9ca3af;
    }

    /* ================= NAV LINKS ================= */
    .nav-link {
        color: #374151;
        padding: 14px 18px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.35s ease;
        font-weight: 600;
    }

    .nav-link span:first-child {
        font-size: 20px;
    }

    /* Hover */
    .nav-link:hover {
        background: #f51826;
        color: #ffffff;
        transform: translateX(6px);
    }

    /* Active */
    .nav-link.active {
        background: #f51826;
        color: #ffffff !important;
        box-shadow: 0 10px 25px rgb(255, 255, 255);
    }

    /* ================= MOBILE CLOSE ================= */
    #closeSidebar {
        background: #f3f4f6;
        border: none;
        border-radius: 8px;
        color: #374151;
    }

    /* ================= COLLAPSED MODE ================= */
    .sidebar.collapsed {
        width: 75px !important;
        font-size: 13px;
    }

    .sidebar.collapsed .link-text,
    .sidebar.collapsed .section-block small {
        display: none;
    }

    .sidebar.collapsed .sidebar-logo {
        width: 45px;
    }
    .nav-link i {
        font-size: 20px;
        min-width: 24px;
        text-align: center;
    }
</style>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<div id="sidebar" class="sidebar p-3">

    <!-- Logo -->
    <div class="sidebar-header text-center mb-4">
        <img class="margin-left" src="asset/img/logo.png" alt="">

        <!-- <button id="sidebarToggle" class="sidebar-toggle">
            <i class="bx bx-menu"></i>
        </button> -->
    </div>

    <button class="btn d-lg-none mb-3" id="closeSidebar" style="float:right;">✖</button>

    <!-- MENU -->
    <div class="mb-4 section-block">
        <small>MENU</small>
        <ul class="nav flex-column mt-3">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    data-tooltip="Dashboard">
                    <i class="bx bxs-dashboard"></i>
                    <span class="link-text" style="font-size: medium;">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>


    <!-- COMPONENTS -->
    <div class="section-block">
        <small>COMPONENTS</small>
        <ul class="nav flex-column mt-3">

            <li class="nav-item mb-2">
                <a href="{{ route('maincategorypage') }}"
                    class="nav-link {{ request()->routeIs('maincategorypage') ? 'active' : '' }}"
                    data-tooltip="Categories">
                    <i class="bx bx-category"></i>
                    <span class="link-text" style="font-size: medium;">Categories</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('categorypage') }}"
                    class="nav-link {{ request()->routeIs('categorypage') ? 'active' : '' }}"
                    data-tooltip="Categories">
                    <i class="bx bx-category"></i>
                    <span class="link-text" style="font-size: medium;">Sub-Categories</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('productpage') }}"
                    class="nav-link {{ request()->routeIs('productpage') ? 'active' : '' }}"
                    data-tooltip="Products">
                    <i class="bx bx-package"></i>
                    <span class="link-text" style="font-size: medium;">Products</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('enquirypage') }}"
                    class="nav-link {{ request()->routeIs('enquirypage') ? 'active' : '' }}"
                    data-tooltip="Order List">
                    <i class="bx bx-cart"></i>
                    <span class="link-text" style="font-size: medium;">Enquiry List</span>
                </a>
            </li>
            <!-- <li class="nav-item mb-2">
                <a href="{{ route('orderpage') }}"
                    class="nav-link {{ request()->routeIs('orderpage') ? 'active' : '' }}"
                    data-tooltip="Order List">
                    <i class="bx bx-cart"></i>
                    <span class="link-text" style="font-size: medium;">Order List</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('paymentpage') }}"
                    class="nav-link {{ request()->routeIs('paymentpage') ? 'active' : '' }}"
                    data-tooltip="Payment">
                    <i class="bx bx-credit-card"></i>
                    <span class="link-text" style="font-size: medium;">Payment</span>
                </a>
            </li> -->

        </ul>
    </div>

</div>
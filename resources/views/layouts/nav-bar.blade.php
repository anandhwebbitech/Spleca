 <!-- Top Bar -->
 <style>
     .primary-menu .menu-link {
         font-size: 13px;
         /* smaller text */
         line-height: 1.3;
     }

     .primary-menu .dropdown-menu-full a {
         font-size: 12px;
         /* dropdown items */
     }

     .category-grid .category-card a,
     .subcategory-list a {
         font-size: 12px;
     }

     .search-results {
         position: absolute;
         top: 100%;
         left: 0;
         width: 100%;
         background: #fff;
         border: 1px solid #ddd;
         max-height: 320px;
         overflow-y: auto;
         z-index: 9999;
         display: none;
     }

     .search-results a {
         display: flex;
         gap: 10px;
         padding: 10px;
         text-decoration: none;
         color: #333;
         font-size: 13px;
         border-bottom: 1px solid #f1f1f1;
     }

     .search-results a:hover {
         background: #f5f7fb;
     }

     .search-results img {
         width: 40px;
         height: 40px;
         object-fit: contain;
     }

     /* Ensure the search box doesn't look squashed on desktop */
     .search-box {
         display: flex;
         align-items: center;
     }

     .search-box input {
         width: 100%;
         padding-right: 40px;
         /* space for the button */
     }

     .search-btn {
         position: absolute;
         right: 5px;
         background: none;
         border: none;
         color: #666;
     }

     /* Dropdown styling */
     .search-results {
         position: absolute;
         top: 100%;
         left: 0;
         right: 0;
         background: white;
         z-index: 1000;
         border: 1px solid #ddd;
         display: none;
         /* Toggle this via JS */
     }

     /* Logo Sizing */
     .weicon-logo img {
         max-height: 50px;
         width: auto;
     }

     .top-bar {
         background-color: #f8f9fa;
         /* Or your brand color */
         font-size: 14px;
         border-bottom: 1px solid #ececec;
     }

     .top-bar a {
         color: #444;
         transition: color 0.3s ease;
     }

     .top-bar a:hover {
         color: #007bff;
         /* Primary brand color */
     }

     .social-link {
         display: inline-block;
         width: 30px;
         text-align: center;
     }

     /* Mobile specific tweaks */
     @media (max-width: 767px) {
         .top-bar {
             padding: 10px 0;
         }

         .contact-info {
             font-size: 13px;
         }
     }
 </style>
 <div class="top-bar py-2">
     <div class="container">
         <div class="row align-items-center">

             <div class="col-12 col-md-7 text-center text-md-start mb-2 mb-md-0">
                 <div
                     class="contact-info d-flex flex-column flex-sm-row justify-content-center justify-content-md-start">
                     <a href="tel:+61450381706" class="text-decoration-none">
                         <i class="fas fa-phone-alt me-2"></i>+61 450 381 706
                     </a>
                     <a href="mailto:info@spleca.com.au" class="text-decoration-none">
                         <i class="fas fa-envelope me-2"></i>info@spleca.com.au
                     </a>
                 </div>
             </div>

             {{-- <div class="col-12 col-md-5 text-center text-md-end">
                 <div class="social-icons d-flex justify-content-center justify-content-md-end gap-3">
                     <a href="#" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                     <a href="#" class="social-link"><i class="fa-brands fa-google-plus-g"></i></a>
                     <a href="#" class="social-link"><i class="fa-brands fa-x-twitter"></i></a>
                     <a href="#" class="social-link"><i class="fa-brands fa-skype"></i></a>
                 </div>
             </div> --}}

         </div>
     </div>
 </div>
 <!-- Main Navbar -->
 <nav class="navbar navbar-expand-lg">
     <div class="container">
         <div class="row w-100 align-items-center g-2">
             <div class="col-6 col-md-3 order-1">
                 <a class="navbar-brand" href="{{ route('homepage') }}">
                     <div class="weicon-logo">
                         <img  src="{{ asset('asset/img/logo.png') }}" class="img-fluid" alt="Logo 1">
                     </div>
                 </a>
             </div>

             <div class="col-6 col-md-3 order-2 order-md-3 text-end">
                 <a class="navbar-brand" href="{{ route('homepage') }}">
                     <div class="weicon-logo">
                         <img src="{{ asset('asset/img/logo_weicon.svg') }}" class="img-fluid" alt="Logo 2">
                     </div>
                 </a>
             </div>

             <div class="col-12 col-md-6 order-3 order-md-2">
                 <div class="search-box position-relative">
                     <input type="text" id="productSearch" class="form-control" placeholder="Search products..."
                         autocomplete="off">
                     <button class="search-btn"><i class="fas fa-search"></i></button>

                     <div id="searchResults" class="search-results"></div>
                 </div>
             </div>

         </div>
     </div>
 </nav>

 <!-- Sticky Menu Section -->
 <div class="main-navigation">
     <div class="navigation-wrapper">
         <ul class="primary-menu">
             <li class="menu-item">
                 <a class="menu-link" href="{{ route('homepage') }}">Home</a>
             </li>
             
             <li class="menu-item">
                 <a class="menu-link" href="{{ route('aboutpage') }}">About</a>
             </li>
             <li class="menu-item">
                 <a class="menu-link has-dropdown" href="#">
                     Products <i class="bi bi-chevron-down"></i>
                 </a>
                 <!-- Products Mega Menu -->
                 <div class="dropdown-menu-full">
                     <div class="dropdown-inner">
                         <div class="dropdown-section">
                             <h6 class="section-heading1">
                                 <i class="fa-solid fa-gear"></i>
                                 Products
                             </h6>
                             <ul class="category-grid">
                                 @foreach ($categories as $category)
                                     <li class="category-card">
                                         <a href="{{ route('allproductspage', ['category' => $category->id]) }}">
                                             <i class="fas fa-chevron-right"></i> {{ $category->type_name }}
                                         </a>
                                         <ul class="subcategory-list">
                                             @foreach ($category->subCategories as $sub)
                                                 <!-- <li><a  href="{{ route(name: 'allproductspage') }}"><i class="fa-solid fa-circle"></i> {{ $sub->sub_category_name }}</a></li>   -->
                                                 <li><a
                                                         href="{{ route('allproductspage', ['subcategory' => $sub->id]) }}"><i
                                                             class="fa-solid fa-circle"></i>
                                                         {{ $sub->sub_category_name }}</a></li>
                                             @endforeach
                                         </ul>
                                     </li>
                                 @endforeach
                             </ul>
                         </div>
                     </div>
                 </div>
             </li>
             <li class="menu-item">
                 <a class="menu-link has-dropdown" href="#">
                     Services <i class="bi bi-chevron-down"></i>
                 </a>
                 <!-- Services Mega Menu -->
                 <div class="dropdown-menu-full services-layout">
                     <div class="dropdown-inner">
                         <div class="dropdown-section">
                             <h6 class="section-heading">
                                 <i class="fa-solid fa-concierge-bell"></i>
                                 Our Services
                             </h6>
                             <ul class="category-grid">
                                 <li class="category-card">
                                     <a href="{{ route(name: 'productfinderpage') }}">
                                         <i class="fas fa-search"></i> Product Finder
                                     </a>
                                 </li>
                                 <li class="category-card">
                                     <a href="{{ route(name: 'applicationsandproductspage') }}">
                                         <i class="fas fa-compass"></i> Application and Products
                                     </a>
                                 </li>
                                 <li class="category-card">
                                     <a href="{{ route(name: 'productsolutionspage') }}">
                                         <i class="fas fa-lightbulb"></i> Product Solution
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </li>
             <li class="menu-item">
                 <a class="menu-link has-dropdown" href="#">
                     Blog <i class="bi bi-chevron-down"></i>
                 </a>
                 <!-- Blog Mega Menu -->
                 <div class="dropdown-menu-full blog-layout">
                     <div class="dropdown-inner">
                         <div class="dropdown-section">
                             <h6 class="section-heading">
                                 <i class="fa-solid fa-blog"></i>
                                 Blog & Updates
                             </h6>
                             <ul class="category-grid">
                                 <li class="category-card">
                                     <a href="{{ route('newsletterpage') }}">
                                         <i class="fas fa-newspaper"></i> News Letter
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </li>
             <li class="menu-item">
                 <a class="menu-link btn-contact" href="{{ route('contactpage') }}">
                     <i class="fa-solid fa-phone"></i>Contact Us
                 </a>
             </li>
         </ul>

         <!-- Icons (Right) -->
         <div class="header-actions">
             <!-- <a href="{{ route('wishlistpage') }}" style="position: relative;">
                 <i class="far fa-heart"></i>
                 <span class="notification-badge">{{ $wishlistCount }}</span>
             </a> -->
             <!-- <a href="{{ route('cartpage') }}" style="position: relative;">
                 <i class="fas fa-shopping-cart"></i>
                 <span class="notification-badge">3</span>
             </a> -->
             <!-- <a href="{{ route('profilepage') }}"><i class="far fa-user"></i></a> -->
             <!-- Cart Widget -->
             <!-- <a  href="{{ route('cartpage') }}"  class="cart-widget" id="cartWidget">
                 <i class="fas fa-shopping-cart"></i>
                 <span id="cartTotal">₹{{ number_format($total, 2) }}</span>
             </a> -->

             <!-- Cart Overlay -->
             <div class="cart-overlay" id="cartOverlay"></div>

             <!-- Cart Panel -->
             <div class="cart-panel" id="cartPanel">
                 <div class="cart-header">
                     <h2>
                         <i class="fas fa-shopping-bag"></i>
                         Shopping Cart
                     </h2>
                     <button class="close-cart" id="closeCart">
                         <i class="fas fa-times"></i>
                     </button>
                 </div>

                 <div class="cart-items" id="cartItems">

                     @if ($carts->count() > 0)

                         @foreach ($carts as $cart)
                             @php
                                 $price = $cart->offer_price ?? $cart->product->price;
                             @endphp

                             <div class="wb-cart-item">

                                 <!-- Product Image -->
                                 <img src="{{ asset('public/uploads/products/' . optional($cart->product->images->first())->image) }}"
                                     class="wb-cart-img" alt="{{ $cart->product->name }}">

                                 <!-- Middle Content -->
                                 <div class="wb-cart-info">
                                     <h4 class="wb-cart-title">{{ $cart->product->name }}</h4>

                                     <div class="wb-qty-row">
                                         <button class="wb-qty-btn decrease" data-id="{{ $cart->id }}">-</button>
                                         <span class="wb-qty-value">{{ $cart->quantity }}</span>
                                         <button class="wb-qty-btn increase" data-id="{{ $cart->id }}">+</button>
                                     </div>

                                     <div class="wb-cart-price">₹{{ number_format($price * $cart->quantity, 2) }}
                                     </div>
                                 </div>

                                 <!-- Remove Button -->
                                 <button class="wb-remove-btn" data-id="{{ $cart->id }}">×</button>

                             </div>
                         @endforeach
                     @else
                         <div class="empty-cart text-center">
                             <i class="fas fa-shopping-cart"></i>
                             <p>Your cart is empty</p>
                         </div>
                     @endif

                 </div>


                 <div class="cart-footer">
                     <div class="cart-total">
                         <span>Total:</span>
                         <span class="total-amount" id="totalAmount">
                             ₹{{ number_format($total, 2) }}
                         </span>
                     </div>

                     <button class="checkout-btn" {{ $carts->count() == 0 ? 'disabled' : '' }}>
                         <i class="fas fa-lock"></i> Proceed to Checkout
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- HEADER -->
 <header class="wb-header">
     <button class="wb-hamburger-btn" id="menuBtn" aria-label="Toggle menu" aria-expanded="false">
         <i class="fa-solid fa-bars"></i>
     </button>

     <div class="wb-header-actions">
         <!-- Wishlist -->
         {{-- <div class="wb-action-item" id="wishlistBtn">
             <a href="{{route('wishlistpage')}}">
                 <i class="fa-regular fa-heart"></i>
             </a>
             <span class="wb-badge">3</span>
            
         </div> --}}

         <!-- Profile -->
         {{-- <div class="wb-action-item" id="profileBtn">
             <i class="fa-regular fa-user"></i>
             <div class="wb-dropdown" id="profileDropdown">
                 <div class="wb-dropdown-header">My Account</div>
                 <a href="#" class="wb-dropdown-item">
                     <i class="fa-solid fa-user"></i>
                     <span>Profile</span>
                 </a>
                 <a href="#" class="wb-dropdown-item">
                     <i class="fa-solid fa-box"></i>
                     <span>Orders</span>
                 </a>
                 <a href="{{route('wishlistpage')}}" class="wb-dropdown-item">
                     <i class="fa-solid fa-heart"></i>
                     <span>Wishlist</span>
                 </a>
                 <a href="#" class="wb-dropdown-item">
                     <i class="fa-solid fa-gear"></i>
                     <span>Settings</span>
                 </a>
                 <a href="#" class="wb-dropdown-item">
                     <i class="fa-solid fa-right-from-bracket"></i>
                     <span>Logout</span>
                 </a>
             </div>
         </div>

         <!-- Cart -->
         <div class="wb-action-item">
             <a href="{{route('wishlistpage')}}" class="wb-cart-btn" id="cartBtn">
                 <i class="fa-solid fa-cart-shopping"></i>
                 <span>₹0.00</span>
             </a>
             <div class="wb-dropdown" id="cartDropdown">
                 <div class="wb-empty-state">
                     <i class="fa-solid fa-cart-shopping"></i>
                     <p>Your cart is empty</p>
                 </div>
             </div>
         </div> --}}
     </div>
 </header>

 <!-- MOBILE SIDEBAR -->
 <nav id="wb-mobile-nav" class="wb-mobile-nav" aria-hidden="true">
     <div class="wb-overlay" id="overlay"></div>

     <div class="wb-drawer">
         <div class="wb-drawer-header">
             <a href="#" class="wb-logo"><i class="fa-solid fa-gear"></i></a>
             <button class="wb-close-btn" id="closeBtn" aria-label="Close menu">
                 <i class="fa-solid fa-xmark"></i>
             </button>
         </div>

         <ul class="wb-mobile-menu">
             <li><a href="{{ route('homepage') }}"><i class="fa-solid fa-house"></i> Home</a></li>
             <li><a href="{{ route('aboutpage') }}"><i class="fa-solid fa-circle-info"></i> About</a></li>

             <!-- PRODUCTS MENU -->
             <li class="wb-accordion">
                 <button class="wb-accordion-toggle" aria-expanded="false">
                     <span> Products</span>
                     <i class="fa-solid fa-chevron-right wb-arrow"></i>
                 </button>
                 <div class="wb-panel">
                     <ul>
                         @foreach ($categories as $category)
                             <li class="wb-accordion">
                                 <button class="wb-accordion-toggle sub" aria-expanded="false">
                                     <a href="#" class="a-edit"><span><i class="fa-solid fa-toolbox"></i>
                                             {{ $category->type_name }}</span> </a>
                                     <i class="fa-solid fa-chevron-right wb-arrow"></i>
                                 </button>
                                 <div class="wb-panel">
                                     <ul>
                                         @foreach ($category->subCategories as $sub)
                                             <li><a
                                                     href="{{ route('allproductspage', ['subcategory' => $sub->id]) }}"><i
                                                         class="fa-solid fa-circle"></i>
                                                     {{ $sub->sub_category_name }}</a></li>
                                         @endforeach
                                     </ul>
                                 </div>
                             </li>
                         @endforeach
                     </ul>
                 </div>
             </li>

             <li class="wb-accordion">
                 <button class="wb-accordion-toggle" aria-expanded="false">
                     <span> Service</span>
                     <i class="fa-solid fa-chevron-right wb-arrow"></i>
                 </button>
                 <div class="wb-panel">
                     <ul>
                         <li class="wb-accordion">
                             <button class="wb-accordion-toggle sub" aria-expanded="false">
                                 <a href="{{ route(name: 'productfinderpage') }}" class="a-edit"> <span> Product
                                         Finder</span> </a>
                             </button>
                         </li>

                         <li class="wb-accordion">
                             <button class="wb-accordion-toggle sub" aria-expanded="false">
                                 <a href="{{ route(name: 'applicationsandproductspage') }}" class="a-edit"><span>
                                         Application And Products</span> </a>

                             </button>
                         </li>
                         <li class="wb-accordion">
                             <button class="wb-accordion-toggle sub" aria-expanded="false">
                                 <a href="{{ route(name: 'productsolutionspage') }}" class="a-edit"> <span> Product
                                         Solution</span></a>
                             </button>
                         </li>
                     </ul>
                 </div>
             </li>

             <li class="wb-accordion">
                 <button class="wb-accordion-toggle" aria-expanded="false">
                     <span>Blog</span>
                     <i class="fa-solid fa-chevron-right wb-arrow"></i>
                 </button>
                 <div class="wb-panel">
                     <ul>
                         <li class="wb-accordion">
                             <button class="wb-accordion-toggle sub" aria-expanded="false">
                                 <a href="{{ route('newsletterpage') }}" class="a-edit"> <span> News letter</span>
                                 </a>
                             </button>
                         </li>
                     </ul>
                 </div>
             </li>


             <li><a href="{{ route('contactpage') }}" class="wb-contact"><i class="fa-solid fa-phone"></i> Contact
                     Us</a></li>
         </ul>

         {{-- <div class="wb-footer">
             <a href="{{route('wishlistpage')}}" aria-label="Wishlist"><i class="fa-regular fa-heart"></i><span class="wb-badge">3</span></a>
             <a href="{{ route('profilepage') }}" aria-label="User"><i class="fa-regular fa-user"></i></a>
             <a href="{{route('cartpage')}}"  aria-label="Cart"><i class="fa-solid fa-cart-shopping"></i></a>
         </div> --}}
     </div>
 </nav>

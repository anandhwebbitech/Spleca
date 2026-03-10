@extends('layouts.app')

@section('content')
    <style>
        /* Disable cart button */
        .btn-cart1:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ============================= */
        /* UNIVERSAL PRODUCT IMAGE FIX   */
        /* ============================= */

        .product-image-frame {
            background: #f8f9fa;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* IMPORTANT: This prevents crop & stretch */
        .product-image-frame img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* Ensure cards take full height of the swiper container */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
            /* Changed from 80% to 100% to fill row */
            display: flex;
            flex-direction: column;
            justify-content: start;
            width: 100%;
        }

        /* Ensure images don't stretch weirdly */
        .product-image-frame {
            background: #ffffff;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* padding: 10px; */
        }

        .product-image-static img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover !important;
        }

        /* Ensure description and title have consistent space */
        .prod-info-box {
            flex-grow: 1;
        }

        .pro-de {
            height: 95px
        }

        .pri-sty {
            font-size: 24px;
            font-weight: bold;
            color: #00b894;
        }
        @media (max-width: 767px) {
            .price-section {
                margin-top: 20px;
            }
        }
    </style>

    <div class="container my-4">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-3 col-md-4 col-12 mb-4">
                <div class="filter-sidebar">

                    <h4 class="filter-title">Filters</h4>

                    @foreach ($categories as $category)
                        <div class="filter-section">
                            <div class="filter-header" onclick="toggleFilter('cat-{{ $category->id }}')">
                                <span>{{ $category->type_name }}</span>
                                <span id="cat-{{ $category->id }}-toggle">▼</span>
                            </div>

                            <div id="cat-{{ $category->id }}-content">
                                @foreach ($category->subCategories as $sub)
                                    <label>
                                        <input type="checkbox" class="category-filter" value="{{ $sub->id }}"
                                            name="categories[]" {{ $selectedSubCategory == $sub->id ? 'checked' : '' }}>
                                        {{ $sub->sub_category_name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Price Filter -->
                    <div class="filter-section" hidden>
                        <h5>Price</h5>

                        <input type="number" id="minPrice" placeholder="Min">
                        <input type="number" id="maxPrice" placeholder="Max">

                        <button onclick="applyPriceFilter()">Apply</button>
                    </div>

                </div>
            </div>

            <!-- PRODUCT LIST -->
            <div class="col-lg-9 col-md-8 col-12">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">SPLECA</li>
                        <li class="breadcrumb-item">Products</li>
                    </ol>
                </nav>

                <div class="row g-4" id="product-list">
                    <!-- AJAX Products Here -->
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const getProducts = "{{ route('getproducts') }}";

        $(document).ready(function() {
            loadProducts();

            $(document).on('change', '.category-filter', function() {
                loadProducts();
            });
        });

        function applyPriceFilter() {
            loadProducts();
        }

        function loadProducts() {

            let categories = [];
            $('.category-filter:checked').each(function() {
                categories.push($(this).val());
            });

            let minPrice = $('#minPrice').val();
            let maxPrice = $('#maxPrice').val();

            $.ajax({
                url: getProducts,
                type: "GET",
                data: {
                    category: "{{ $selectedCategory }}",
                    categories: categories,
                    subcategory: "{{ $selectedSubCategory }}",
                    min_price: minPrice,
                    max_price: maxPrice
                },
                success: function(response) {

                    let products = response.products;
                    let html = '';

                    if (products.length === 0) {
                        $('#product-list').html('<p class="text-center">No products found</p>');
                        return;
                    }

                    products.forEach(product => {

                        // Image fallback
                        let imageUrl = "{{ asset('assets/images/no-image.png') }}";

                        if (product.images && product.images.length > 0 && product.images[0].image) {
                            imageUrl = "{{ asset('public/uploads/products') }}/" + product.images[0]
                                .image;
                        }

                        // Short description
                        let shortDesc = product.short_description ?
                            product.short_description.substring(0, 90) +
                            (product.short_description.length > 90 ? '...' : '') :
                            '';

                        html += `
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="product-card">
                             <div class="product-image-container">
                                

                                 <div class="product-image-frame">
                                    <img src="${imageUrl}" 
                                 alt="${product.name}" 
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/images/no-image.png') }}'">                
                                 </div>
                             </div>

                             <div class="product-details">
                                 <div class="prod-info-box">
                                     <div class="pro-de">
                                         <h6 class="product-title">${product.name}</h6>
                                    <p class="product-description">${product.sub}</p>
                                     </div>

                                     <div class="price-section">
                                        <strong class="pri-sty">$ ${parseFloat(product.price).toFixed(2)}</strong>

                                     </div>
                                 </div>

                                 <button class="btn-view w-100 mt-3"
                                    onclick="viewProductDetails(${product.id})">
                                View Details
                            </button>
                             </div>
                         </div>
                </div>`;


                    });

                    $('#product-list').html(html);
                }
            });
        }
        function toggleFilter(id) {
            let content = document.getElementById(id + '-content');
            let toggle = document.getElementById(id + '-toggle');

            if (content.style.display === "none") {
                content.style.display = "block";
                toggle.innerHTML = "▼";
            } else {
                content.style.display = "none";
                toggle.innerHTML = "▲";
            }
        }
    </script>
@endpush

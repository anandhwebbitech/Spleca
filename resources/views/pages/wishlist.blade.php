 @extends('layouts.app')
 @section('content')
    <div class="container py-5">
        <!-- <div class="wl-section-header">
            <div class="wl-results-count">Showing 1–32 of 151 results</div>
            <select class="wl-sort-dropdown">
                <option>Sort by latest</option>
                <option>Sort by price: low to high</option>
                <option>Sort by price: high to low</option>
                <option>Sort by popularity</option>
            </select>
        </div> -->

        <div class="row" id="wishlist-products">
            
            <!-- Product Card  -->
            
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('asset/js/swiper.js') }}"></script>

    <script>
        // Add to cart functionality
        document.querySelectorAll('.wl-btn-cart').forEach(button => {
            button.addEventListener('click', function() {
                alert('Product added to cart!');
            });
        });

        // Wishlist toggle functionality
        document.querySelectorAll('.wl-heart-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const heart = this.querySelector('i');
                heart.classList.toggle('fas');
                heart.classList.toggle('far');
            });
        });

        // View details functionality
        document.querySelectorAll('.wl-btn-details').forEach(button => {
            button.addEventListener('click', function() {
                alert('View product details');
            });
        });
        $(document).ready(function() {
            loadWishlist();
        })

        function loadWishlist() {
        $.ajax({
            url: '{{ route("get.wishlist") }}', // Make sure this route points to getWishlist()
            method: 'GET',
            success: function(data) {
                let html = '';
                let items = data.items;
                if (Object.keys(items).length === 0) {
                    html = `
                        <div class="col-12 text-center">
                            <h5>No products in wishlist</h5>
                        </div>
                    `;
                }else {

                $.each(items, function (id, item) {

                    html += `
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="wl-item-card">

                            <div class="wl-heart-icon"
                                 onclick="removeFromWishlist(${id})">
                                <i class="fas fa-heart text-danger"></i>
                            </div>

                            ${item.discount_percent ? `<span class="wl-discount-tag">-${item.discount_percent}%</span>` : ''}

                            <img src="{{ asset('public/uploads/products') }}/${item.product_img}"
                                 class="wl-item-image"
                                 alt="${item.product_name}">

                            <h3 class="wl-item-name">${item.product_name}</h3>
                            <p class="wl-item-desc">${item.short_description ?? ''}</p>

                            <div class="wl-pricing-wrapper">
                                <span class="wl-price-sale">₹${item.offer_price}</span>
                                ${item.price ? `<span class="wl-price-regular">₹${item.price}</span>` : ''}
                            </div>

                            <div class="wl-action-buttons">
                                <button class="wl-btn-cart"
                                    onclick="addToCart(${id})">
                                    Add to Cart
                                </button>
                                <button class="wl-btn-details" onclick="viewProductDetails(${id})">View Details</button>
                            </div>
                        </div>
                    </div>
                    `;
                });
            }

            $('#wishlist-products').html(html);
            $('.wish-count').text(data.count);
        }
        });
    }
    function viewProductDetails(productId) {
        window.location.href = "{{ url('/product') }}/" + productId;
    }
    </script>
    
@endpush

@endsection

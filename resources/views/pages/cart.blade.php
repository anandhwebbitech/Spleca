 @extends('layouts.app')
 @section('content')
 <div class="container py-5">
     <div class="page-title-section">
         <h1 class="page-main-title">Shopping Cart</h1>
         <p class="page-subtitle-text">Review your items and proceed to checkout</p>
     </div>

     <div class="row g-4">
         <!-- Product Items Section -->
         <div class="col-lg-8">
             <div class="product-card-wrapper p-4" id="cart-items">

             </div>
         </div>

         <!-- Order Summary Section -->
         <div class="col-lg-4">
             <div class="order-summary-card p-4">
                 <h2 class="summary-heading-text">Order Summary</h2>

                 <div class="summary-detail-row">
                     <span class="summary-field-label">Price </span>
                     <span class="summary-field-value">₹{{ number_format($subtotal,2) }}</span>
                 </div>

                 <div class="summary-detail-row discount-amount-row">
                     <span class="summary-field-label">Total Discount </span>
                     <span class="summary-field-value">-₹{{ number_format($discountTotal,2) }}</span>
                 </div>
                 <div class="summary-detail-row">
                     <span class="summary-field-label">Subtotal </span>
                     <span class="summary-field-value">₹{{ number_format($ori_price,2) }}</span>
                 </div>
                 <hr>

                 <div class="summary-detail-row">
                     <span class="summary-field-label">Shipping</span>
                     <span class="summary-field-value">Free</span>
                 </div>
                 
                 <hr>

                 <div class="summary-detail-row">
                     <span class="summary-field-label">Tax (GST 18%)</span>
                     <span class="summary-field-value">₹{{ number_format($gst,2) }}</span>
                 </div>

                 <hr class="summary-divider-line">

                 <div class="total-amount-section">
                     <span class="total-text-label">Total</span>
                     <span class="total-price-display">₹{{ number_format($total,2) }}</span>
                 </div> 

                 <button class="checkout-primary-btn" onclick="proceedCheckout()">
                     <i class="fas fa-lock me-2"></i>Proceed to Checkout
                 </button>

                 <button class="continue-shopping-btn"  onclick="window.location.href='{{ route('allproductspage') }}'">
                     <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                 </button>

                 <div class="promo-code-section">
                     <div class="d-flex gap-2">
                         <input type="text" class="promo-input-field" placeholder="Enter promo code">
                         <button class="promo-apply-btn" onclick="validatePromo()">Apply</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 @push('scripts')

 <script>
     $(document).ready(function() {
         loadCart();
     });

     function loadCart() {
         $.ajax({
             url: '{{ route("get.cart") }}',
             method: 'GET',
             success: function(response) {

                 let html = '';
                 let subtotal = 0;
                 let totalItems = 0;
                 let discountamount = 0;

                 if (!response.cartItems || response.cartItems.length === 0) {
                     $('#cart-items').html(`
                        <div class="empty-basket-state">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Your cart is empty</h3>
                            <p>Add some amazing products to your cart and they will show up here</p>
                            <button class="checkout-primary-btn"  onclick="window.location.href='{{ route('allproductspage') }}'">Start Shopping</button>
                        </div>
                    `);
                     updateSummary(0, 0,0);
                     return;
                 }
                 $.each(response.cartItems, function(index, item) {
                     let product = item.product;
                     let image = (product.images && product.images.length > 0) ?
                         `{{ asset('public/uploads/products') }}/${product.images[0].image}` :
                         `{{ asset('public/uploads/no-image.png') }}`;

                     let price = product.price;
                     let original_price = item.offer_price;
                     let qty = item.quantity;
                     let originalPrice = parseFloat(product.price);
                     let discountPercent = parseFloat(item.discount);

                     let discountAmount = (originalPrice * discountPercent) / 100;
                     let finalPrice = originalPrice - discountAmount;
                     subtotal +=originalPrice;
                     totalItems += qty;
                     discountamount += finalPrice;
                     html += `
                <div class="product-listing-item" data-id="${item.id}">
                    <div class="product-img-container">
                        <img src="${image}" class="product-thumbnail-img">
                    </div>

                    <div class="product-info-wrapper">
                        <div class="product-header-row">
                            <h3 class="product-name-heading">${product.name}</h3>
                            <button class="delete-item-btn" onclick="removeCartItem(${item.id})">
                                <i class="fas fa-times fa-lg"></i>
                            </button>
                        </div>

                        <div class="product-action-row">
                            <div class="qty-selector-group">
                                <button class="qty-change-btn" onclick="updateQty(${item.id}, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="qty-display-number">${qty}</span>
                                <button class="qty-change-btn" onclick="updateQty(${item.id}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <div class="pricing-info-section">
                                <span class="sale-price-amount">₹${original_price}</span>
                                 <span class="original-price4">${price}</span>

                            </div>
                        </div>
                    </div>
                </div>
                `;
                 });

                 $('#cart-items').html(html);
                 updateSummary(subtotal, totalItems, discountamount);
             }
         });
     }

     function updateSummary(subtotal, totalItems, discountamount) {

        //  subtotal = parseFloat(subtotal);

        //  let taxPercent = 18;
        //  let tax = (subtotal * taxPercent) / 100;
        //  let total = subtotal - discountamount + tax;

         

        //  $('.summary-field-value').eq(0)
        //      .text(`₹${subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2 })}`);

        //  // No extra discount here (already applied per item)
         
        //  $('.discount-amount-row .summary-field-value').text(discountamount);

        //  $('.summary-detail-row').eq(3).find('.summary-field-value')
        //      .text(`₹${tax.toLocaleString('en-IN', { minimumFractionDigits: 2 })}`);

        //  $('.total-price-display')
        //      .text(`₹${total.toLocaleString('en-IN', { minimumFractionDigits: 2 })}`);
     }

     function removeCartItem(cartId) {
         Swal.fire({
             title: 'Remove item?',
             text: 'This product will be removed from your cart.',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Yes, remove it',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {

                 $.ajax({
                     url: "{{ route('cart.remove') }}",
                     type: "POST",
                     data: {
                         _token: "{{ csrf_token() }}",
                         cart_id: cartId
                     },
                     success: function(response) {
                         if (response.status === 'success') {

                             Swal.fire({
                                 icon: 'success',
                                 title: 'Removed!',
                                 text: 'Item removed from cart.',
                                 timer: 1200,
                                 showConfirmButton: false
                             });

                             loadCart(); // reload cart items

                         } else {
                             Swal.fire('Error', response.message, 'error');
                         }
                     },
                     error: function() {
                         Swal.fire('Error', 'Something went wrong!', 'error');
                     }
                 });
             }
         });
     }

    function updateQty(cartId, change) {
    $.ajax({
        url: "{{ route('cart.update.qty') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            cart_id: cartId,
            change: change
        },
        success: function (response) {
            if (response.status === 'success') {
                loadCart(); // reload cart with new calculations
                location.reload();   // ⬅ reload the page

            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Something went wrong!');
        }
    });
}
function proceedCheckout() {
    window.location.href = "{{ route('checkoutpage') }}";
}
 </script>
 @endpush

 @endsection
 @extends('layouts.app')
 @section('content')
 <div class="container py-5">
     <div class="checkout-header-section">
         <h1 class="checkout-main-heading">Checkout</h1>
         <p class="checkout-sub-heading">Complete your order by selecting delivery address</p>
     </div>

     <div class="row g-4">
         <!-- Left Column - Checkout Details -->
         <div class="col-lg-8">
             <!-- Delivery Address Section -->
             <div class="section-card-wrapper">
                 <h2 class="section-title-text">
                     <span class="section-title-icon">
                         <i class="fas fa-map-marker-alt"></i>
                     </span>
                     Delivery Address
                 </h2>
                 <div id="address-list"></div>
                 <!-- Add New Address Button -->
                 <button class="add-new-address-btn" onclick="addNewAddress()">
                     <i class="fas fa-plus-circle fa-lg"></i>
                     Add New Address
                 </button>
             </div>

             <!-- Order Items Section -->
             <div class="section-card-wrapper">
                 <h2 class="section-title-text">
                     <span class="section-title-icon">
                         <i class="fas fa-shopping-bag"></i>
                     </span>
                     Order Items
                     <!-- <span class="discount-badge-mini">-25% OFF</span> -->
                 </h2>
                 <div id="checkout-order-items"></div>
             </div>
         </div>

         <!-- Right Column - Order Summary -->
         <div class="col-lg-4">
             <div class="summary-sticky-card">
                 <h2 class="summary-title-heading">Order Summary</h2>

                 <div class="summary-line-item">
                     <span class="summary-line-label">Price </span>
                     <span class="summary-line-value">₹{{ number_format($subtotal,2) }}</span>
                 </div>
                <div class="summary-line-item discount-line-item">
                     <span class="summary-line-label">Discount </span>
                     <span class="summary-line-value">-₹{{ number_format($discountTotal,2) }}</span>
                 </div>
                   <div class="summary-line-item ">
                     <span class="summary-line-label">Subtotal </span>
                     <span class="summary-line-value">₹{{ number_format($ori_price,2) }}</span>
                 </div>
                 <hr>
                 <div class="summary-line-item">
                     <span class="summary-line-label">Tax (GST 18%)</span>
                     <span class="summary-line-value">₹{{ number_format($gst,2) }}</span>
                 </div>
                 <div class="summary-line-item">
                     <span class="summary-line-label">Shipping</span>
                     <span class="summary-line-value">Free</span>
                 </div>
                    <hr>
                 <hr class="summary-separator-line">

                 <div class="total-summary-row">
                     <span class="total-summary-label">Total Amount</span>
                     <span class="total-summary-amount">₹{{ number_format($total,2) }}</span>
                 </div>

                 <button class="proceed-payment-btn" onclick="placeOrder()">
                     <i class="fas fa-credit-card me-2"></i>Place Order
                 </button>

                 <button class="back-to-cart-btn"  onclick="window.location.href='{{ route('cartpage') }}'">
                     <i class="fas fa-arrow-left me-2"></i>Back to Cart
                 </button>

                 <div class="secure-checkout-notice">
                     <i class="fas fa-shield-alt"></i>
                     <span>Your payment information is secure and encrypted</span>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Edit Address Modal -->
 <div class="modal-overlay" id="addressModal">
     <div class="modal-container">
         <div class="modal-header">
             <h3 class="modal-title" id="modalTitle">Edit Address</h3>
             <button class="modal-close-btn" onclick="closeAddressModal()">
                 <i class="fas fa-times"></i>
             </button>
         </div>
         <div class="modal-body">
             <form id="addressForm">
                 <div class="form-group">
                     <label class="form-label">Address Type</label>
                     <select class="form-select" id="addressType">
                         <option value="home">Home</option>
                         <option value="office">Office</option>
                         <option value="other">Other</option>
                     </select>
                 </div>

                 <div class="form-group">
                     <label class="form-label">Full Name *</label>
                     <input type="text" class="form-input" id="fullName" placeholder="Enter full name" required>
                 </div>

                 <div class="form-group">
                     <label class="form-label">Phone Number *</label>
                     <input type="tel" class="form-input" id="phoneNumber" placeholder="+91 98765 43210"
                         required>
                 </div>

                 <div class="form-group">
                     <label class="form-label">Address Line 1 *</label>
                     <input type="text" class="form-input" id="addressLine1"
                         placeholder="House/Flat No., Building Name" required>
                 </div>

                 <div class="form-group">
                     <label class="form-label">Address Line 2</label>
                     <input type="text" class="form-input" id="addressLine2"
                         placeholder="Area, Street, Landmark">
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label class="form-label">City *</label>
                         <input type="text" class="form-input" id="city" placeholder="Bangalore" required>
                     </div>
                     <div class="form-group">
                         <label class="form-label">State *</label>
                         <input type="text" class="form-input" id="state" placeholder="Karnataka" required>
                     </div>
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label class="form-label">Pincode *</label>
                         <input type="text" class="form-input" id="pincode" placeholder="560034" required>
                     </div>
                     <div class="form-group">
                         <label class="form-label">Country *</label>
                         <input type="text" class="form-input" id="country" value="India" required>
                     </div>
                 </div>
             </form>
         </div>
         <div class="modal-footer">
             <button class="modal-cancel-btn" onclick="closeAddressModal()">Cancel</button>
             <button class="modal-save-btn" onclick="saveAddress()">
                 <i class="fas fa-check me-2"></i>Save Address
             </button>
         </div>
     </div>
 </div>
 @push('scripts')

 <script>
     function selectAddress(card) {
         // Remove selected class from all cards
         document.querySelectorAll('.address-selector-card').forEach(c => {
             c.classList.remove('selected-address');
         });

         // Add selected class to clicked card
         card.classList.add('selected-address');

         // Check the radio button
         const radio = card.querySelector('.address-radio-input');
         radio.checked = true;
     }

     function addNewAddress() {
         document.getElementById('modalTitle').textContent = 'Add New Address';
         document.getElementById('addressForm').reset();
         openAddressModal();
     }

     function openAddressModal(addressData = null) {
         const modal = document.getElementById('addressModal');
         modal.classList.add('active');
         document.body.style.overflow = 'hidden';

         if (addressData) {
             // Populate form with existing data for editing
             document.getElementById('modalTitle').textContent = 'Edit Address';
             document.getElementById('fullName').value = addressData.name || '';
             document.getElementById('phoneNumber').value = addressData.phone || '';
             document.getElementById('addressLine1').value = addressData.line1 || '';
             document.getElementById('addressLine2').value = addressData.line2 || '';
             document.getElementById('city').value = addressData.city || '';
             document.getElementById('state').value = addressData.state || '';
             document.getElementById('pincode').value = addressData.pincode || '';
             document.getElementById('addressType').value = addressData.type || 'home';
         }
     }

     function closeAddressModal() {
         const modal = document.getElementById('addressModal');
         modal.classList.remove('active');
         document.body.style.overflow = 'auto';
     }

     function saveAddress() {
         const form = document.getElementById('addressForm');

         if (!form.checkValidity()) {
             form.reportValidity();
             return;
         }

         const formData = {
             type: document.getElementById('addressType').value,
             name: document.getElementById('fullName').value,
             phone: document.getElementById('phoneNumber').value,
             line1: document.getElementById('addressLine1').value,
             line2: document.getElementById('addressLine2').value,
             city: document.getElementById('city').value,
             state: document.getElementById('state').value,
             pincode: document.getElementById('pincode').value,
             country: document.getElementById('country').value
         };

         console.log('Saving address:', formData);
         alert('Address saved successfully!');
         closeAddressModal();
         // Here you would send the data to your backend
     }

     // Close modal when clicking outside
     document.getElementById('addressModal').addEventListener('click', (e) => {
         if (e.target.id === 'addressModal') {
             closeAddressModal();
         }
     });

     function proceedToPayment() {
         const selectedAddress = document.querySelector('.address-selector-card.selected-address');
         if (!selectedAddress) {
             alert('Please select a delivery address');
             return;
         }
         alert('Proceeding to payment options...');
         // Here you would navigate to payment page
     }

     function returnToCart() {
         alert('Returning to shopping cart...');
         // Here you would navigate back to cart page
     }

     // Prevent form submission on address action links
     document.querySelectorAll('.address-edit-link').forEach(link => {
         link.addEventListener('click', (e) => {
             e.preventDefault();
             e.stopPropagation();
             const action = link.textContent.trim().toLowerCase();

             if (action.includes('edit')) {
                 const addressCard = link.closest('.address-selector-card');
                 const addressData = {
                     name: addressCard.querySelector('.address-name-text').textContent,
                     line1: addressCard.querySelectorAll('.address-detail-text')[0].textContent,
                     line2: addressCard.querySelectorAll('.address-detail-text')[1].textContent
                         .split(',')[0],
                     city: addressCard.querySelectorAll('.address-detail-text')[1].textContent.split(
                         ',')[0],
                     state: addressCard.querySelectorAll('.address-detail-text')[1].textContent
                         .split(',')[1]?.trim().split('-')[0]?.trim(),
                     pincode: addressCard.querySelectorAll('.address-detail-text')[1].textContent
                         .split('-')[1]?.trim(),
                     phone: addressCard.querySelectorAll('.address-detail-text')[2].textContent
                         .replace('Phone: ', ''),
                     type: addressCard.querySelector('.address-type-badge').textContent.toLowerCase()
                 };
                 openAddressModal(addressData);
             } else if (action.includes('delete')) {
                 if (confirm('Are you sure you want to delete this address?')) {
                     const addressCard = link.closest('.address-selector-card');
                     addressCard.style.opacity = '0';
                     addressCard.style.transform = 'translateX(-20px)';
                     addressCard.style.transition = 'all 0.3s ease';

                     setTimeout(() => {
                         addressCard.remove();
                         alert('Address deleted successfully');
                     }, 300);
                 }
             }
         });
     });

     function editOrderItem(btn) {
         const orderRow = btn.closest('.order-item-row');
         const itemName = orderRow.querySelector('.order-item-name').textContent;
         const quantityText = orderRow.querySelector('.order-item-quantity').textContent;
         const currentQty = parseInt(quantityText.match(/\d+/)[0]);

         const newQty = prompt(`Edit quantity for ${itemName}:`, currentQty);

         if (newQty !== null && newQty > 0) {
             orderRow.querySelector('.order-item-quantity').textContent = `Quantity: ${newQty}`;
             alert('Quantity updated! Please recalculate totals.');
             // Here you would recalculate the price and update the summary
         }
     }

     function removeOrderItem(btn) {
         const orderRow = btn.closest('.order-item-row');
         const itemName = orderRow.querySelector('.order-item-name').textContent;

         if (confirm(`Remove ${itemName} from order?`)) {
             orderRow.style.opacity = '0';
             orderRow.style.transform = 'translateX(-20px)';
             orderRow.style.transition = 'all 0.3s ease';

             setTimeout(() => {
                 orderRow.remove();
                 alert('Item removed. Please recalculate totals.');
                 // Here you would recalculate the summary
             }, 300);
         }
     }

     function placeOrder() {

         let addressId = $('input[name="address"]:checked').val();

         if (!addressId) {
             Swal.fire('Error', 'Please select a delivery address', 'error');
             return;
         }

         $.ajax({
             url: "{{ route('checkout.place') }}",
             type: "POST",
             data: {
                 _token: "{{ csrf_token() }}",
                 address_id: addressId
             },
             success: function(response) {

                 if (response.status === 'success') {
                     Swal.fire({
                         icon: 'success',
                         title: 'Confirm To Place Order!',
                         text: 'Order ID: ' + response.order_id
                     }).then(() => {
                        window.location.href = "{{ url('select-payment') }}/" + response.order_id;
                    });

                 } else {
                     Swal.fire('Error', response.message, 'error');
                 }
             }
         });
     }
     $(document).ready(function() {
         loadCheckoutCart();
         loadAddresses();
     });

     function loadCheckoutCart() {
         $.ajax({
             url: "{{ route('get.cart') }}", // same cart API
             type: "GET",
             success: function(response) {

                 let html = '';
                 let subtotal = 0;
                 let discountTotal = 0;
                 let totalQty = 0;

                 if (!response.cartItems || response.cartItems.length === 0) {
                     html = `<p>Your cart is empty</p>`;
                     $('#checkout-order-items').html(html);
                     return;
                 }

                 $.each(response.cartItems, function(index, item) {

                     let product = item.product;
                     let qty = item.quantity;
                     let price = parseFloat(product.price);
                     let discount = parseFloat(item.discount ?? 0);

                     let discountAmount = (price * discount) / 100;
                     let finalPrice = price - discountAmount;

                     subtotal += price * qty;
                     discountTotal += discountAmount * qty;
                     totalQty += qty;

                     let image = (product.images && product.images.length > 0) ?
                         `{{ asset('public/uploads/products') }}/${product.images[0].image}` :
                         `{{ asset('public/uploads/no-image.png') }}`;

                     html += `
                <div class="order-item-row">
                    <img src="${image}" class="order-item-thumbnail">

                    <div class="order-item-details">
                        <div class="order-item-name">${product.name}</div>
                        <div class="order-item-quantity">Quantity: ${qty}</div>
                    </div>

                    <div class="order-item-actions">
                        <div class="order-item-price">
                            ₹${(finalPrice * qty).toFixed(2)}
                        </div>
                    </div>
                </div>`;
                 });

                 $('#checkout-order-items').html(html);
                 $('#discount-badge').text(`-${discountTotal.toFixed(0)} OFF`);

             }
         });
     }

     function loadAddresses() {
         $.ajax({
             url: "{{ route('checkout.addresses') }}",
             type: "GET",
             success: function(response) {

                 let html = '';

                 if (!response.addresses || response.addresses.length === 0) {
                     html = `<p>No address found. Please add one.</p>`;
                     $('#address-list').html(html);
                     return;
                 }

                 $.each(response.addresses, function(index, address) {

                     let checked = address.is_default == 1 ? 'checked' : '';
                     let selected = address.is_default == 1 ? 'selected-address' : '';

                     html += `
                <div class="address-selector-card ${selected}" onclick="selectAddress(this)">
                    <div class="d-flex gap-3">
                        <input type="radio"
                               name="address"
                               class="address-radio-input"
                               value="${address.id}"
                               ${checked}>

                        <div class="flex-grow-1">
                            <span class="address-type-badge">
                                ${address.is_default == 1 ? 'Home' : 'Other'}
                            </span>

                            <div class="address-name-text">${address.name}</div>
                            <div class="address-detail-text">${address.address}</div>
                            <div class="address-detail-text">
                                ${address.city}, ${address.state} - ${address.postal_code}
                            </div>
                            <div class="address-detail-text">
                                Phone: ${address.phone}
                            </div>
                        </div>
                    </div>
                </div>`;
                 });

                 $('#address-list').html(html);
             }
         });
     }
 </script>
 @endpush

 @endsection
 @extends('layouts.app')
 @section('content')
 @php
 $user = Auth::user();
 @endphp
 <style>
     .default-box {
         display: flex;
         align-items: center;
         gap: 6px;
         cursor: pointer;
         padding: 6px 12px;
         border: 2px solid #d1d5db;
         border-radius: 6px;
         font-size: 13px;
         font-weight: 500;
         color: #374151;
         transition: all 0.2s ease;
     }

     /* Hide native radio */
     .default-box input[type="radio"] {
         display: none;
     }

     /* Active (checked) style */
     .default-box input[type="radio"]:checked+span {
         color: #120202ff;
     }

     .default-box:has(input:checked) {
         border-color: #0d6efd;
         background-color: #73e187ff;
     }
 </style>
 <div class="container my-5">
     <div class="row">
         <!-- Sidebar -->
         <div class="col-md-2 sidebar">
             <div class="user-greeting">Hello, {{ $user->name }}</div>
             <nav class="nav flex-column">
                 <a class="nav-link active" data-page="overview">Overview</a>
                 <!-- <a class="nav-link" data-page="profile">Your profile</a> -->
                 <a class="nav-link" data-page="addresses">Addresses</a>
                 <!-- <a class="nav-link" data-page="payment">Payment methods</a> -->
                 <a class="nav-link" data-page="orders">Orders</a>
             </nav>
             <a class="logout-link" href="{{route('loginpage')}}">
                 <i class="fas fa-sign-out-alt"></i> LogIn
             </a>
             <!-- <a class="logout-link" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Log out
                </a> -->
             <button type="button" id="logoutBtn" class="logout-link">
                 <i class="fas fa-sign-out-alt"></i> Log out
             </button>
         </div>

         <!-- Main Content -->
         <div class="col-md-10 main-content">
             <!-- Overview Page -->
             <div id="overview-page" class="content-page">
                 <h1 class="section-title">Overview</h1>
                 <p class="mb-4">Directly access your profile information, the default payment method and given addresses.</p>
                 @php
                 $defaultAddress = $addresses->where('is_default', 1)->first();
                 @endphp

                 <div class="row mt-3">
                     <div class="col-md-6">
                         <h2 class="subsection-title">Personal data</h2>
                         <div class="info-card">
                             <p class="mb-2">Name :<strong>{{ $user->name }}</strong></p>
                             <p class="mb-2">Email : <strong>{{ $user->email }}</strong></p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <h2 class="subsection-title">Default billing address</h2>

                         <div class="info-card">
                             @if($defaultAddress)
                             <p class="mb-1"><strong>{{ $defaultAddress->name }}</strong></p>
                             <p class="mb-1">{{ $defaultAddress->address }}</p>
                             <p class="mb-1">
                                 {{ $defaultAddress->city }},
                                 {{ $defaultAddress->state }} -
                                 {{ $defaultAddress->postal_code }}
                             </p>
                             <p class="mb-0">{{ $defaultAddress->country }}</p>
                             @else
                             <p class="mb-0 text-muted">No default address selected</p>
                             @endif
                         </div>
                     </div>

                 </div>
                 <div>
                     <a  href="{{route('passwordpage')}}" class="text-link" >Change password</a>
                 </div>
             </div>

             <!-- Profile Page
             <div id="profile-page" class="content-page" style="display: none;">
                 <h1 class="section-title">Your profile</h1>
                 <p class="mb-4">Check your personal data.</p>

                 <h2 class="subsection-title">Personal data</h2>
                 <div class="info-card">
                     <form>
                         <div class="mb-3">
                             <label class="form-label">Account type*</label>
                             <select class="form-select" style="max-width: 300px;">
                                 <option selected>Private</option>
                                 <option>Business</option>
                             </select>
                         </div>
                         <div class="mb-3">
                             <label class="form-label">Salutation</label>
                             <select class="form-select" style="max-width: 300px;">
                                 <option selected>Mr.</option>
                                 <option>Ms.</option>
                                 <option>Mrs.</option>
                             </select>
                         </div>
                         <div class="row">
                             <div class="col-md-6 mb-3">
                                 <label class="form-label">Name*</label>
                                 <input type="text" class="form-control" value="{{ $user->name }}">
                             </div>

                         </div>
                         <p class="text-muted small">Fields marked with asterisks (*) are required.</p>
                         <button type="submit" class="btn btn-primary" onclick="alert('Changes saved!')">Save changes</button>
                     </form>
                 </div>

                 <h2 class="subsection-title mt-4">Login data</h2>
                 <div class="info-card">
                     <div class="d-flex justify-content-between align-items-center">
                         <div>
                             <strong>Your email address</strong> {{ $user->email }}
                         </div>
                         <div>
                             <a href="#" class="text-link me-3" onclick="alert('Change email functionality'); return false;">Change email address</a>
                             <a href="#" class="text-link" onclick="alert('Change password functionality'); return false;">Change password</a>
                         </div>
                     </div>
                 </div>
             </div> -->

             <!-- Addresses Page -->
             <div id="addresses-page" class="content-page" style="display: none;">
                 <h1 class="section-title">Addresses</h1>
                 <p class="mb-4">View your current default addresses or add new ones.</p>

                 <button class="btn btn-primary mb-4" id="addAddressBtn">
                     <i class="fas fa-plus"></i> Add new address
                 </button>

                 <div class="row">
                     @forelse($addresses as $address)
                     <div class="col-md-6">
                         <div class="info-card mb-3 p-3 position-relative">

                             <p class="mb-1"><strong>{{ $address->name }}</strong></p>
                             <p class="mb-1">{{ $address->address }}</p>
                             <p class="mb-1">
                                 {{ $address->city }},
                                 {{ $address->state }} -
                                 {{ $address->postalcode }}
                             </p>
                             <p class="mb-3">{{ $address->country }}</p>

                             <!-- Bottom actions -->
                             <div class="d-flex justify-content-between align-items-center mt-3">

                                 <button class="btn btn-outline-secondary btn-sm editAddressBtn"
                                     data-id="{{ $address->id }}">
                                     <i class="fas fa-edit"></i> Edit address
                                 </button>

                                 <!-- Default radio -->
                                 <label class="default-box">
                                     <input type="radio"
                                         name="default_address"
                                         class="defaultAddress"
                                         data-id="{{ $address->id }}"
                                         {{ $address->is_default == 1 ? 'checked' : '' }}>
                                     <span>Default</span>
                                 </label>

                             </div>
                         </div>
                     </div>
                     @empty
                     <p class="text-muted">No addresses found</p>
                     @endforelse
                 </div>
             </div>
             <!-- Address Modal -->
             <div class="modal fade" id="addressModal" tabindex="-1">
                 <div class="modal-dialog modal-xl">
                     <div class="modal-content">

                         <div class="modal-header">
                             <h5 class="modal-title">Add New Address</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                         </div>

                         <div class="modal-body">
                             <form id="addressForm">
                                 @csrf

                                 <div class="row">
                                     <div class="col-md-6 mb-3">
                                         <label>Name</label>
                                         <input type="text" name="name" class="form-control" required>
                                         <input type="hidden" name="address_id" id="address_id">
                                     </div>

                                     <div class="col-md-6 mb-3">
                                         <label>Phone</label>
                                         <input type="number" name="phone" class="form-control" required>
                                     </div>
                                     <div class="col-md-4 mb-3">
                                         <label for="country" class="form-label">Country<span class="required">*</span></label>
                                         <select class="form-select" name="country" id="country" required>
                                             <option value="">Select country</option>
                                         </select>
                                     </div>
                                     <div class="col-md-4 mb-3">
                                         <label for="state" class="form-label">State<span class="required">*</span></label>
                                         <select class="form-select" name="state" id="state" required>
                                             <option value="">Select state</option>
                                         </select>
                                     </div>
                                     <div class="col-md-4 mb-3">
                                         <label for="state" class="form-label">City<span class="required">*</span></label>
                                         <select class="form-select" name="city" id="city" required>
                                             <option value="">Select city</option>
                                         </select>
                                     </div>
                                     <div class="col-md-8 mb-3">
                                         <label for="streetAddress" class="form-label">Street address<span class="required">*</span></label>
                                         <input type="text" class="form-control" name="address" id="streetAddress" placeholder="Enter street address..." required>
                                     </div>

                                     <div class="col-md-4 mb-3">
                                         <label for="postalcode" class="form-label">Postal code</label>
                                         <input type="number" class="form-control" id="postalcode" name="postalcode" placeholder="Enter postal code...">
                                     </div>



                                     <!-- <div class="col-md-6">
                                         <label>
                                             <input type="checkbox" name="is_shipping"> Default Shipping
                                         </label>
                                     </div> -->
                                 </div>
                             </form>
                         </div>

                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                 Close
                             </button>
                             <button type="button" class="btn btn-primary" id="saveAddress">
                                 Save Address
                             </button>
                         </div>

                     </div>
                 </div>
             </div>
             <!-- Address Modal -->
             <!-- Payment Methods Page -->
             <!-- <div id="payment-page" class="content-page" style="display: none;">
                 <h1 class="section-title">Payment methods</h1>
                 <p class="mb-4">View all available payment methods and select a default payment method.</p>

                 <h2 class="subsection-title">Default payment method</h2>
                 <div class="info-card">
                     <div class="payment-option">
                         <input type="radio" name="payment" id="paypal" checked>
                         <label for="paypal" class="mb-0 flex-grow-1">
                             <strong>PayPal</strong><br>
                             <small>Payment via PayPal - easy, fast and secure.</small>
                         </label>
                         <span class="paypal-icon">P</span>
                     </div>
                     <div class="payment-option">
                         <input type="radio" name="payment" id="klarna">
                         <label for="klarna" class="mb-0 flex-grow-1">
                             <strong>Klarna</strong>
                         </label>
                     </div>
                     <div class="payment-option">
                         <input type="radio" name="payment" id="credit">
                         <label for="credit" class="mb-0 flex-grow-1">
                             <strong>Credit Card</strong>
                         </label>
                     </div>
                     <div class="payment-option">
                         <input type="radio" name="payment" id="apple">
                         <label for="apple" class="mb-0 flex-grow-1">
                             <strong>Apple Pay / Google Pay</strong>
                         </label>
                     </div>
                     <button class="btn btn-primary mt-3" onclick="alert('Payment method changed!')">Change</button>
                 </div>
             </div> -->

             <!-- Orders Page -->
             <div id="orders-page" class="content-page" style="display: none;">
                 <h1 class="section-title">Orders</h1>
                 <p class="mb-4">Your recent orders:</p>
                <div class="row"  id="ordersContainer"></div>
             </div>
         </div>
     </div>
 </div>
 @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     $(document).ready(function() {
        loadOrders();
         const countryApi = "https://countriesnow.space/api/v0.1/countries/positions";
         const stateApi = "https://countriesnow.space/api/v0.1/countries/states";
         const cityApi = "https://countriesnow.space/api/v0.1/countries/state/cities";

         // LOAD COUNTRIES
         $.get(countryApi, function(response) {
             let options = '<option value="">Select country</option>';
             $.each(response.data, function(i, country) {
                 options += `<option value="${country.name}">${country.name}</option>`;
             });
             $('#country').html(options);
         });

         // COUNTRY CHANGE → LOAD STATES
         $('#country').on('change', function() {
             let country = $(this).val();
             $('#state').html('<option>Loading...</option>');
             $('#city').html('<option>Select city</option>');

             $.ajax({
                 url: stateApi,
                 method: 'POST',
                 contentType: 'application/json',
                 data: JSON.stringify({
                     country: country
                 }),
                 success: function(response) {
                     let options = '<option value="">Select state</option>';
                     $.each(response.data.states, function(i, state) {
                         options += `<option value="${state.name}">${state.name}</option>`;
                     });
                     $('#state').html(options);
                 }
             });
         });

         // STATE CHANGE → LOAD CITIES
         $('#state').on('change', function() {
             let state = $(this).val();
             let country = $('#country').val();
             $('#city').html('<option>Loading...</option>');

             $.ajax({
                 url: cityApi,
                 method: 'POST',
                 contentType: 'application/json',
                 data: JSON.stringify({
                     country: country,
                     state: state
                 }),
                 success: function(response) {
                     let options = '<option value="">Select city</option>';
                     $.each(response.data, function(i, city) {
                         options += `<option value="${city}">${city}</option>`;
                     });
                     $('#city').html(options);
                 }
             });
         });
     })
     $('#logoutBtn').on('click', function() {

         Swal.fire({
             title: 'Are you sure?',
             text: 'You will be logged out from your account',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#6c757d',
             confirmButtonText: 'Yes, logout'
         }).then((result) => {

             if (result.isConfirmed) {

                 $.ajax({
                     url: "{{ route('logout') }}",
                     type: "POST",
                     data: {
                         _token: "{{ csrf_token() }}"
                     },
                     success: function(response) {
                         if (response.status) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Logged out',
                                 timer: 1200,
                                 showConfirmButton: false
                             }).then(() => {
                                 window.location.href = response.redirect;
                             });
                         }
                     },
                     error: function() {
                         Swal.fire(
                             'Error',
                             'Logout failed. Try again.',
                             'error'
                         );
                     }
                 });

             }
         });

     });
     // Page navigation
     document.querySelectorAll('.sidebar .nav-link').forEach(link => {
         link.addEventListener('click', function(e) {
             e.preventDefault();

             // Remove active class from all links
             document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));

             // Add active class to clicked link
             this.classList.add('active');

             // Hide all pages
             document.querySelectorAll('.content-page').forEach(page => page.style.display = 'none');

             // Show selected page
             const pageId = this.getAttribute('data-page') + '-page';
             document.getElementById(pageId).style.display = 'block';
         });
     });

     $('#addAddressBtn').on('click', function() {
         $('#addressForm')[0].reset();
         $('#address_id').val('');
         $('.modal-title').text('Add New Address');
         $('#addressModal').modal('show');
     });
     // Save address via AJAX
     $('#saveAddress').on('click', function(e) {
         e.preventDefault();

         $.ajax({
             url: "{{ route('address.save') }}",
             type: "POST",
             data: $('#addressForm').serialize(),
             success: function(response) {
                 if (response.success) {
                     $('#addressModal').modal('hide');

                     Swal.fire({
                         icon: 'success',
                         title: 'Address Added',
                         text: response.message,
                         timer: 1500,
                         showConfirmButton: false
                     }).then(() => {
                         location.reload();
                     });
                 }
             },
             error: function(xhr) {

                 // ✅ Laravel validation errors
                 if (xhr.status === 422) {
                     let errors = xhr.responseJSON.errors;
                     let errorMsg = '';

                     $.each(errors, function(key, value) {
                         errorMsg += value[0] + '<br>';
                     });

                     Swal.fire({
                         icon: 'warning',
                         title: 'Validation Error',
                         html: errorMsg
                     });

                 } else {
                     Swal.fire({
                         icon: 'error',
                         title: 'Error',
                         text: 'Unable to save address'
                     });
                 }
             }
         });
     });
     $(document).on('click', '.editAddressBtn', function() {

         let addressId = $(this).data('id');

         $.ajax({
             url: "{{ url('/address/edit') }}/" + addressId,
             type: "GET",
             success: function(response) {

                 $('#address_id').val(response.id);
                 $('input[name="name"]').val(response.name);
                 $('input[name="phone"]').val(response.phone);
                 $('input[name="address"]').val(response.address);
                 $('input[name="postalcode"]').val(response.postal_code);


                 $('#country').val(response.country).trigger('change');

                 setTimeout(() => {
                     $('#state').val(response.state).trigger('change');
                 }, 1000);

                 setTimeout(() => {
                     $('#city').val(response.city).trigger('change');
                 }, 3000);

                 $('.modal-title').text('Edit Address');
                 $('#addressModal').modal('show');
             }
         });
     });
     $(document).on('change', '.defaultAddress', function() {

         let addressId = $(this).data('id');

         $.ajax({
             url: "{{ route('address.setDefault') }}",
             type: "POST",
             data: {
                 _token: "{{ csrf_token() }}",
                 address_id: addressId
             },
             success: function(response) {
                 if (response.status) {
                     toastr.success('Default address updated');
                 }
             }
         });
     });
    function loadOrders() {
    const productBaseUrl = "{{ url('/product') }}";

    $.ajax({
        url: "{{ route('user.orders') }}",
        type: "GET",
        success: function (response) {
            let html = '';

            if (response.orders.length === 0) {
                html = `<p class="text-muted">No orders found</p>`;
            }

            $.each(response.orders, function (index, order) {

                let badgeClass =
                    order.status === 'DELIVERED' ? 'bg-success' :
                    order.status === 'CANCELLED' ? 'bg-danger'  :
                    order.status === 'RETURNED'  ? 'bg-info'    :
                                                   'bg-warning';

                html += `
                <div class="col-md-6 mb-4">
                    <div class="info-card p-3 h-100">
                        <div class="row">
                            <div class="col-4">
                                <img src="${order.image}" class="img-fluid rounded" style="max-width:120px">
                            </div>

                            <div class="col-8">
                                <h5>${order.product_name}</h5>
                                <p class="mb-1"><strong>Order ID:</strong> ORD${order.id}</p>
                                <p class="mb-1"><strong>Date:</strong> ${order.order_date}</p>
                                <p class="mb-1"><strong>Quantity:</strong> ${order.quantity}</p>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <strong>₹${order.price}</strong>
                                    <span class="badge ${badgeClass}">${order.status}</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <a href="${productBaseUrl}/${order.product_id}"
                           class="btn btn-outline-primary btn-sm">
                           View Details
                        </a>

                        ${
                          order.status !== 'DELIVERED' &&
                          order.status !== 'CANCELLED' &&
                          order.status !== 'CONFIRM' &&
                          order.status !== 'RETURNED'
                            ? `<button class="btn btn-outline-danger btn-sm cancel-order"
                                       data-id="${order.order_item_id}">
                                       Cancel Order
                               </button>`
                            : ''
                        }
                    </div>
                </div>`;
            });

            $('#ordersContainer').html(html);
        }
    });
}
$(document).on('click', '.cancel-order', function () {
    let orderId = $(this).data('id');

    Swal.fire({
        title: "Cancel this order?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, cancel it!",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('cancel.order') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId
                },
                success: function (res) {

                    Swal.fire("Cancelled!", res.message, "success");

                    loadOrders();   // reload list
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong.", "error");
                }
            });

        }
    });
});
 </script>
 @endpush

 @endsection
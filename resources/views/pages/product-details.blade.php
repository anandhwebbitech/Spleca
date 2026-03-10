 @extends('layouts.app')
 @section('content')
     <style>
        a {
             text-decoration: none;
         }
         .fas.fa-heart {
             color: red;
         }

         .btn-cart1:disabled {
             opacity: 0.5;
             cursor: not-allowed;
             pointer-events: none;
         }


         .ux-gallery-wrapper {
             width: 100%;
             max-width: 500px;
             margin: auto;
         }

         /* FORCING SQUARE BOX */
         .ux-main-view {
             width: 100%;
             aspect-ratio: 1 / 1;
             /* This creates the square */
             border: 1px solid #eaeaea;
             border-radius: 4px;
             overflow: hidden;
             height: 456px;
         }

         .ux-main-view .swiper-slide img {
             width: 100%;
             height: 100%;
             object-fit: cover;
             /* Ensures image fills the square */
         }

         /* THUMBNAILS */
         .ux-thumb-view {
             margin-top: 12px;
             height: 80px;
         }

         .ux-thumb-box {
             width: 100%;
             height: 100%;
             aspect-ratio: 1 / 1;
             cursor: pointer;
             border: 2px solid transparent;
             overflow: hidden;
         }

         .ux-thumb-box img {
             width: 100%;
             height: 100%;
             object-fit: cover;
         }

         /* When a thumbnail is selected */
         .ux-thumb-view .swiper-slide-thumb-active .ux-thumb-box {
             border-color: #333;
         }

         @media (max-width: 767px) {
             .section {
                 grid-template-columns: 1fr;
             }

             .contact-item {
                 gap: 0;
             }

             .icon-shape {
                 width: 50px;
                 height: 50px;
                 margin-right: 15px;
             }
             .icon-shape i {
                 font-size: 24px;
             }
         }

         .current-price4 {
             font-size: 24px;
             font-weight: bold;
             color: #00b894;
         }
     </style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <section class="mt-5">
         <!-- Zoom Modal -->
         <div class="zoom-modal" id="zoomModal">
             <span class="close-zoom" id="closeZoom">&times;</span>
             <img id="zoomedImage" src="" alt="Zoomed view">
         </div>

         <div class="container">
             <div class="product-card4">
                 <div class="row">
                     <div class="col-lg-6">
                         <div class="ux-gallery-wrapper">
                             <div class="swiper ux-main-view" id="uxMainSlider">
                                 <div class="swiper-wrapper">
                                     @foreach ($product->images as $img)
                                         <div class="swiper-slide">
                                             <img src="{{ asset('public/uploads/products/' . $img->image) }}"
                                                 alt="Product Image">
                                         </div>
                                     @endforeach
                                 </div>
                                 <div class="swiper-button-next ux-nav-btn"></div>
                                 <div class="swiper-button-prev ux-nav-btn"></div>
                             </div>

                             <div class="swiper ux-thumb-view mb-4" id="uxThumbSlider">
                                 <div class="swiper-wrapper">
                                     @foreach ($product->images as $img)
                                         <div class="swiper-slide">
                                             <div class="ux-thumb-box">
                                                 <img src="{{ asset('public/uploads/products/' . $img->image) }}">
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         </div>

                         <div class="product-meta ms-4">
                             <div class="meta-item">
                                 <span class="meta-label">Product Number:</span>
                                 <span class="meta-value">{{ $product->sku }}</span>
                             </div>
                             <div class="meta-item">
                                 <span class="meta-label">Product ID:</span>
                                 <span class="meta-value">{{ $product->sku }}</span>
                             </div>
                             <div class="meta-item">
                                 <span class="meta-label">Categories:</span>
                                 {{-- @dd($product->subcategoryname->sub_category_name); --}}
                                 <span class="meta-value">{{ $product->categoryname->type_name }} > {{ $product->subcategoryname->sub_category_name }} </span>
                             </div>
                             <!--<div class="meta-item">-->
                             <!--    <span class="meta-label">Tags:</span>-->
                             <!--    <span class="meta-value">{{ $product->tags }}</span>-->
                             <!--</div>-->
                         </div>
                     </div>

                     <div class="col-lg-6">
                         <div class="product-details-section">
                             <h1 class="product-title1">{{ $product->name }}</h1>
                             <p class="product-subtitle">{{ $product->sub ?? '' }}</p>

                             <div class="d-flex gap-4 mb-3">
                                 <div class="meta-item border-0">
                                     <span class="meta-label">Product Number:</span>
                                     <span class="meta-value">{{ $product->sku }}</span>
                                 </div>
                                 <div class="meta-item border-0">
                                     <span class="meta-label">Product ID:</span>
                                     <span class="meta-value">{{ $product->sku }}</span>
                                 </div>
                             </div>

                             <div class="">
                                 <!--<div>-->
                                 <!--    <span class="current-price4"> $ {{ $product->price }}</span>-->
                                 <!--    {{-- <span class="original-price4">{{ $product->price }}</span>-->
                                 <!--    <span class="discount-text4">{{ $product->discount_percent }}% OFF</span> --}}-->
                                 <!--</div>-->
                                 @php
                                     $variants = json_decode($product->variants, true);

                                     if (is_string($variants)) {
                                         $variants = json_decode($variants, true);
                                     }
                                 @endphp

                                 @if (!empty($variants) && is_array($variants))
                                     <div>
                                         <span class="current-price4" id="productPrice">
                                             ${{ $variants[0]['price'] ?? $product->price }}
                                         </span>
                                     </div>

                                     <div class="mt-3">
                                         <label class="form-label">Select Variant</label>

                                         <select class="form-select" id="variantSelect">
                                             @foreach ($variants as $variant)
                                                 <option value="{{ $variant['price'] }}"
                                                     data-name="{{ $variant['name'] }}">
                                                     {{ $variant['name'] }}
                                                 </option>
                                             @endforeach
                                         </select>
                                     </div>
                                 @else
                                     <div>
                                         <span class="current-price4">
                                             ${{ $product->price }}
                                         </span>
                                     </div>
                                 @endif


                                 <!--@if ($product->stock_status === 'in_stock')
    -->
                                 <span class="stock-badge">
                                     <i class="fas fa-check-circle"></i>
                                     In Stock
                                 </span>
                             <!--@else-->
                                 <!--    <span class="outstock-badge">-->
                                 <!--        <i class="fas fa-times-circle"></i>-->
                                 <!--        Out Of Stock-->
                                 <!--    </span>-->
                                 <!--
    @endif-->
                             </div>


                             <div class="button-group">
                                 <!-- <button class="btn-buy add-to-cart" data-id="{{ $product->id }}">Buy Now</button> -->
                                 <button class="btn-buy add-to-cart" data-bs-toggle="modal"data-bs-target="#contactModal"
                                     data-id="{{ $product->id }}">
                                     Enquiery Now
                                 </button>
                                 {{-- <button class="btn-cart1 add-to-cart disable" data-id="{{ $product->id }}"disabled>Add to
                                     Cart</button> --}}
                             </div>
                             <!-- <div class="action-links">
                                                                 <button type="button"
                                                                     class="action-link addToWishlist "
                                                                     data-id="{{ $product->id }}">
                                                                     <i class="{{ $inWishlist ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                                                                     <span>Add to Wishlist</span>
                                                                 </button>
                                                             </div> -->
                             <!-- <div class="action-links">
                                                                 <button type="button"
                                                                     class="action-link addToWishlist"
                                                                     data-id="{{ $product->id }}"
                                                                     data-action="{{ $inWishlist ? 'remove' : 'add' }}">

                                                                     <i class="{{ $inWishlist ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>

                                                                     <span>
                                                                         {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                                                     </span>
                                                                 </button>
                                                             </div> -->
                             <!-- <a href="#" class="action-link">
                                                                 <i class="fas fa-share-alt"></i>
                                                                 <span>Share product</span>
                                                             </a> -->
                         </div>


                         <div class="features-section me-3">
                             <h5 class="features-title">Key Features:</h5>
                             <ul class="features-list">
                                 <li>Fast-drying formula for quick repairs</li>
                                 <li>Non-conductive properties for electrical safety</li>
                                 <li>Excellent media resistance</li>
                                 <li>Professional grade quality</li>
                                 <li>Works reliably even under water</li>
                                 <li>Can be applied on wet surfaces</li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </section>
     <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
             <div class="modal-content">

                 <div class="modal-header">
                     <h5 class="modal-title">Send a Message</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <div class="modal-body">

                     <!-- YOUR CONTENT START -->
                     <div class="container">
                         <div class="section">
                             <div class="form">
                                 <div class="form-top">
                                     <span class="tag">Send a Message</span>
                                     <h2>Feel free to send in your enquiries</h2>
                                     <p>Complete the enquiry form & we will be in touch as soon as possible.</p>
                                 </div>

                                 <form id="contactForm">
                                     @csrf
                                     <input type="hidden" name="product_id" id="enquiry_product_id" value="12">
                                     <input type="text" name="name" class="input" placeholder="Your Name*"
                                         required>
                                     <input type="email" name="email" class="input" placeholder="Email Address*"
                                         required>
                                     <input type="tel" name="phone" class="input" placeholder="Phone*" required>
                                     <textarea class="input" name="message" placeholder="Your Message*" required></textarea>
                                     <div id="enquiryResponse" class="mb-3"></div>
                                     <button type="submit" class="btn-submit">
                                         Send Message
                                         <i class="fas fa-paper-plane"></i>
                                     </button>
                                 </form>
                             </div>

                             <div class="contact-box mt-4">

                                 <div class="contact-item">
                                     <div class="icon-shape">
                                         <i class="fas fa-warehouse"></i>
                                     </div>
                                     <div class="text">
                                         <h3>Warehouse</h3>
                                         <p>U23 2 Edison Rise ,WANGARA WA 6065</p>
                                         <a href="https://maps.app.goo.gl/2P7WyHiTxkj6Q8T78" class="btn-primary">Find Our
                                             Way</a>
                                     </div>
                                 </div>

                                 <div class="contact-item">
                                     <div class="icon-shape">
                                         <i class="fas fa-envelope"></i>
                                     </div>
                                     <div class="text">
                                         <h3>Send Mail</h3>
                                         <p>info@spleca.com.au</p>
                                         <a href="mailto:info@spleca.com.au" class="btn-primary">Connect Now</a>
                                     </div>
                                 </div>

                                 <div class="contact-item">
                                     <div class="icon-shape">
                                         <i class="fas fa-phone-alt"></i>
                                     </div>
                                     <div class="text">
                                         <h3>Call Now</h3>
                                         <p>+61 450 381 706</p>
                                         <a href="tel:+61430281726" class="btn-primary">Make Appointment</a>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                     <!-- YOUR CONTENT END -->

                 </div>

             </div>
         </div>
     </div>
     <div class="container wbp-container mt-5">
         <div class="wbp-tab-wrapper">

             <!-- NAV TABS -->
             <ul class="nav wbp-nav-tabs" id="wbpTab" role="tablist">
                 <li class="nav-item">
                     <button class="wbp-nav-link active" data-bs-toggle="tab"
                         data-bs-target="#wbp-desc">Description</button>
                 </li>
                 <li class="nav-item">
                     <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-specs">Data Sheet</button>
                 </li>
                 <li class="nav-item">
                     <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-features">Brochures</button>
                 </li>
                 <li class="nav-item">
                     <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-video">Video</button>
                 </li>
                 <li class="nav-item">
                     <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-reviews">Review</button>
                 </li>
             </ul>

             <!-- TAB CONTENT -->
             <div class="tab-content wbp-tab-content">

                 <!-- DESCRIPTION TAB -->
                 <div class="tab-pane fade show active" id="wbp-desc">
                     <h4 class="wbp-heading">Product Description</h4>
                     <p>
                         <b>
                             {{ $product->short_description }}
                         </b>
                     </p>
                     <br>
                     <p>
                         {{ $product->description }}
                     </p>
                 </div>

                 <!-- SPECIFICATIONS TAB -->
                 <div class="tab-pane fade" id="wbp-specs">
                     <h4 class="wbp-heading">Data Sheet</h4>

                     @forelse($product->datasheets as $ds)
                         <div class="pdf-box">
                             <a href="{{ asset('public/uploads/resources/' . $ds->file) }}" download
                                 class="pdf-box-link">
                                 <div class="pdf-box-title">
                                     {{ $ds->title ?? 'Data Sheet' }}
                                 </div>
                                 <span class="pdf-box-size">
                                     {{ $ds->file_size ? number_format($ds->file_size / 1024, 2) . ' KB' : '' }}
                                 </span>
                             </a>
                         </div>
                     @empty
                         <p>No data sheets available</p>
                     @endforelse

                 </div>

                 <!-- FEATURES TAB -->
                 <div class="tab-pane fade" id="wbp-features">
                     <h4 class="wbp-heading">Brouchers</h4>

                     <div class="container-fluid">
                         <!-- First Row: Product Catalogues -->
                         <div class="brouchers-grid">
                             @forelse($product->brochures as $b)
                                 <div class="brouchers-box">
                                     <a href="{{ asset('public/uploads/resources/' . $b->file) }}" download
                                         class="brouchers-box-link">
                                         <div class="brouchers-box-title">
                                             {{ $b->title ?? 'Brochure' }}
                                         </div>
                                     </a>
                                 </div>
                             @empty
                                 <p>No brochures available</p>
                             @endforelse
                         </div>


                     </div>

                 </div>

                 <!-- REVIEWS TAB -->
                 <div class="tab-pane fade" id="wbp-video">
                     <h4 class="wbp-heading">Video</h4>

                     <div class="container-fluid">
                         <!-- Videos Section -->
                         <div class="videos-grid">
                             @forelse($product->videos as $v)
                                 <div class="videos-box">
                                     <div class="video-frame">
                                         <iframe width="100%" height="220"
                                             src="{{ preg_replace(
                                                 '~^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)~',
                                                 'https://www.youtube.com/embed/',
                                                 $v->video_url,
                                             ) }}"
                                             title="{{ $v->title ?? 'Product Video' }}" frameborder="0"
                                             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                             allowfullscreen>
                                         </iframe>
                                     </div>

                                     <div class="videos-box-title mt-2">
                                         {{ $v->title ?? 'Product Video' }}
                                     </div>
                                 </div>
                             @empty
                                 <p>No videos available</p>
                             @endforelse
                         </div>
                     </div>

                 </div>

                 <div class="tab-pane fade" id="wbp-reviews">
                     <h4 class="wbp-heading">Review</h4>

                     <div class="review-container">
                         <p class="no-reviews">There are no reviews yet.</p>

                         <h2 class="review-title">BE THE FIRST TO REVIEW "THREADLOCKING VARNISH"</h2>

                         <p class="privacy-note">
                             Your email address will not be published. Required fields are marked <span
                                 class="required">*</span>
                         </p>

                         <form id="reviewForm">
                            <div class="mb-4">
                                <input type="hidden" id="product_id" value="{{ $product->id }}">
                                 <label class="form-label">Your rating <span class="required">*</span></label>
                                 <div class="star-rating">
                                     <input type="radio" name="rating" id="star5" value="5">
                                     <label for="star5">★</label>
                                     <input type="radio" name="rating" id="star4" value="4">
                                     <label for="star4">★</label>
                                     <input type="radio" name="rating" id="star3" value="3">
                                     <label for="star3">★</label>
                                     <input type="radio" name="rating" id="star2" value="2">
                                     <label for="star2">★</label>
                                     <input type="radio" name="rating" id="star1" value="1">
                                     <label for="star1">★</label>
                                 </div>
                            </div>

                             <div class="mb-4">
                                 <label for="review" class="form-label">Your review <span
                                         class="required">*</span></label>
                                 <textarea class="form-control" id="review" name="review" required></textarea>
                             </div>

                             <div class="mb-4">
                                 <label for="name" class="form-label">Name <span class="required">*</span></label>
                                 <input type="text" class="form-control" id="name" name="name" required>
                             </div>

                             <div class="mb-4">
                                 <label for="email" class="form-label">Email <span class="required">*</span></label>
                                 <input type="email" class="form-control" id="email" name="email" required>
                             </div>

                             {{-- <div class="mb-4">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="saveInfo" name="saveInfo">
                                     <label class="form-check-label" for="saveInfo">
                                         Save my name, email, and website in this browser for the next time I comment.
                                     </label>
                                 </div>
                             </div> --}}

                             <button type="submit" class="btn text-white submit-btn">SUBMIT</button>
                         </form>
                     </div>

                 </div>

             </div>

         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

     @push('scripts')
         <script>
             document.addEventListener("DOMContentLoaded", function() {
                 if (typeof Swiper === 'undefined') {
                     console.error("Swiper is not defined! Check your CDN link.");
                     return;
                 }

                 console.log("Swiper Loaded! Initializing sliders...");

                 // Initialize Thumbs first
                 var uxThumbs = new Swiper("#uxThumbSlider", {
                     spaceBetween: 10,
                     slidesPerView: 4,
                     watchSlidesProgress: true,
                     freeMode: true,
                 });

                 // Initialize Main Slider
                 var uxMain = new Swiper("#uxMainSlider", {
                     loop: true,
                     spaceBetween: 10,
                     navigation: {
                         nextEl: ".swiper-button-next",
                         prevEl: ".swiper-button-prev",
                     },
                     thumbs: {
                         swiper: uxThumbs,
                     },
                 });
             });
         </script>
         <script>
             document.addEventListener("DOMContentLoaded", function() {

                 /* Load wishlist count */
                 fetch("{{ route('wishlist.count') }}")
                     .then(res => res.json())
                     .then(data => {
                         document.getElementById('wishlist-count').innerText = data.count;
                     });

                 /* Toggle wishlist */
             });
             $(document).ready(function() {

                 $('#contactForm').on('submit', function(e) {
                     e.preventDefault();

                     let form = $(this);
                     let formData = form.serialize();

                     $('#enquiryResponse').html('');
                     form.find('button[type="submit"]').prop('disabled', true).text('Sending...');

                     $.ajax({
                         url: "{{ route('enquiry.store') }}",
                         type: "POST",
                         data: formData,
                         success: function(response) {
                             $('#enquiryResponse').html(
                                 '<div class="alert alert-success">Enquiry submitted successfully!</div>'
                             );

                             form[0].reset();

                             // Optional: close modal after 2 sec
                             setTimeout(function() {
                                 location.reload();
                             }, 1500);
                         },
                         error: function(xhr) {
                             let errors = xhr.responseJSON?.errors;
                             let errorHtml = '<div class="alert alert-danger"><ul>';

                             if (errors) {
                                 $.each(errors, function(key, value) {
                                     errorHtml += `<li>${value[0]}</li>`;
                                 });
                             } else {
                                 errorHtml += '<li>Something went wrong. Try again.</li>';
                             }

                             errorHtml += '</ul></div>';
                             $('#enquiryResponse').html(errorHtml);
                         },
                         complete: function() {
                             form.find('button[type="submit"]').prop('disabled', false).text(
                                 'Send Message');
                         }
                     });
                 });

             });
             const contactModal = document.getElementById('contactModal');

             contactModal.addEventListener('show.bs.modal', function(event) {
                 const button = event.relatedTarget; // Buy Now button
                 const productId = button.getAttribute('data-id');

                 document.getElementById('enquiry_product_id').value = productId;

                 console.log('Product ID set:', productId); // debug
             });
             $(document).on("change", "#variantSelect", function() {

                 let price = $(this).val();

                 $("#productPrice").text("$" + price);

             });

             $(document).ready(function () {

                $('#reviewForm').submit(function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('review.store') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: $('#product_id').val(),
                            rating: $('input[name="rating"]:checked').val(),
                            review: $('#review').val(),
                            name: $('#name').val(),
                            email: $('#email').val()
                        },

                        success: function (response) {

                            if(response.status == true){
                                alert(response.message);
                                $('#reviewForm')[0].reset();
                            }

                        },

                        error: function (xhr) {
                            alert("Something went wrong!");
                        }

                    });

                });

            });
         </script>
     @endpush
 @endsection

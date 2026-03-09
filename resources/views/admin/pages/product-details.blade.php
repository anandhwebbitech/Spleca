@extends('admin.layouts.app')
 @section('content')
 <style>
     .fas.fa-heart {
         color: red;
     }
 </style>
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
                     <div class="image-gallery-section4">
                         <div class="slider-container">
                             <input type="radio" name="slider" id="slide1" checked>
                             <input type="radio" name="slider" id="slide2">
                             <input type="radio" name="slider" id="slide3">
                             <input type="radio" name="slider" id="slide4">

                             <div class="slides">
                                 @foreach($product->images as $img)
                                 <div class="slide">
                                     <img src="{{ asset('public/uploads/products/' . $img->image) }}" alt="{{ $product->name }}">
                                 </div>
                                 @endforeach
                             </div>

                             <label for="slide4" class="nav-arrow prev" id="prevArrow">
                                 <i class="fas fa-chevron-left"></i>
                             </label>
                             <label for="slide2" class="nav-arrow next" id="nextArrow">
                                 <i class="fas fa-chevron-right"></i>
                             </label>

                             <div class="slide-indicators">
                                 <label for="slide1"></label>
                                 <label for="slide2"></label>
                                 <label for="slide3"></label>
                                 <label for="slide4"></label>
                             </div>
                         </div>

                         <div class="thumbnail-grid">
                             @foreach($product->images as $img)
                             <label class="thumbnail">
                                 <img src="{{ asset('public/uploads/products/' . $img->image) }}">
                             </label>
                             @endforeach
                         </div>
                     </div>

                     <div class="product-meta ms-4">
                         <div class="meta-item">
                             <span class="meta-label">SKU:</span>
                             <span class="meta-value">{{ $product->sku }}</span>
                         </div>
                         <div class="meta-item">
                             <span class="meta-label">Categories:</span>
                             <span class="meta-value">{{ $product->category->sub_category_name }}</span>
                         </div>
                         <div class="meta-item">
                             <span class="meta-label">Tags:</span>
                             <span class="meta-value">{{$product->tags}}</span>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-6">
                     <div class="product-details-section">
                         <h1 class="product-title1">{{ $product->name }}</h1>
                         <p class="product-subtitle">{{ $product->short_description }}</p>

                         <div class="rating-section">
                             <div class="stars">
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star-half-alt"></i>
                             </div>
                             <span class="review-count">(48 customer reviews)</span>
                         </div>

                         <div class="price-section4">
                             <div>
                                 <span class="current-price4">{{$product-> original_price}}</span>
                                 <span class="original-price4">{{$product-> price}}</span>
                                 <span class="discount-text4">{{$product-> discount_percent}}% OFF</span>
                             </div>
                             @if($product->stock_status === 'in_stock')
                             <span class="stock-badge">
                                 <i class="fas fa-check-circle"></i>
                                 In Stock
                             </span>
                             @else
                             <span class="outstock-badge">
                                 <i class="fas fa-times-circle"></i>
                                 Out Of Stock
                             </span>
                             @endif
                         </div>


                         <div class="button-group">
                             <button class="btn-buy add-to-cart" data-id="{{ $product->id }}">Buy Now</button>
                             <button class="btn-cart1 add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                         </div>
                         <!-- <div class="action-links">
                             <button type="button"
                                 class="action-link addToWishlist "
                                 data-id="{{ $product->id }}">
                                 <i class="{{ $inWishlist ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                                 <span>Add to Wishlist</span>
                             </button>
                         </div> -->
                         <div class="action-links">
                             <button type="button"
                                 class="action-link addToWishlist"
                                 data-id="{{ $product->id }}"
                                 data-action="{{ $inWishlist ? 'remove' : 'add' }}">

                                 <i class="{{ $inWishlist ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>

                                 <span>
                                     {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                 </span>
                             </button>
                         </div>
                         <a href="#" class="action-link">
                             <i class="fas fa-share-alt"></i>
                             <span>Share product</span>
                         </a>
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

 <div class="container wbp-container mt-5">
     <div class="wbp-tab-wrapper">

         <!-- NAV TABS -->
         <ul class="nav wbp-nav-tabs" id="wbpTab" role="tablist">
             <li class="nav-item">
                 <button class="wbp-nav-link active" data-bs-toggle="tab" data-bs-target="#wbp-desc">Description</button>
             </li>
             <li class="nav-item">
                 <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-specs">Data Sheet</button>
             </li>
             <li class="nav-item">
                 <button class="wbp-nav-link" data-bs-toggle="tab" data-bs-target="#wbp-features">Brouchers</button>
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
                     {{$product->description}}
                 </p>
             </div>

             <!-- SPECIFICATIONS TAB -->
             <div class="tab-pane fade" id="wbp-specs">
                 <h4 class="wbp-heading">Data Sheet</h4>

                 @forelse($product->datasheets as $ds)
                 <div class="pdf-box">
                     <a href="{{ asset('public/uploads/resources/' . $ds->file) }}"
                         download
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
                             <a href="{{ asset('public/uploads/resources/' . $b->file) }}"
                                 download
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
                                 <iframe
                                     width="100%"
                                     height="220"
                                     src="{{ preg_replace(
                                            '~^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)~',
                                            'https://www.youtube.com/embed/',
                                            $v->video_url
                                        ) }}"
                                     title="{{ $v->title ?? 'Product Video' }}"
                                     frameborder="0"
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
                         Your email address will not be published. Required fields are marked <span class="required">*</span>
                     </p>

                     <form id="reviewForm">
                         <div class="mb-4">
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
                             <label for="review" class="form-label">Your review <span class="required">*</span></label>
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

                         <div class="mb-4">
                             <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="saveInfo" name="saveInfo">
                                 <label class="form-check-label" for="saveInfo">
                                     Save my name, email, and website in this browser for the next time I comment.
                                 </label>
                             </div>
                         </div>

                         <button type="submit" class="btn text-white submit-btn">SUBMIT</button>
                     </form>
                 </div>

             </div>

         </div>

     </div>
 </div>
 @push('scripts')
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
 </script>
 @endpush

 @endsection
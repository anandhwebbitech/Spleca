<!-- Footer -->
<footer style="background-color:aliceblue" class="ultra-modern-footer">
    <div class="footer-wrapper">

        <div class="footer-hero-section">
            <div class="footer-brand">
                <img src="{{ asset('asset/img/logo.png')}}" alt="SPLECA Logo" class="footer-main-logo">
            </div>
            <div class="brand-statement">
                <p>Delivering reliable industrial adhesives and chemical solutions with quality you can trust.
</p>
            </div>
        </div>

        <div class="footer-bento-grid">

            <div class="bento-box nav-box">
                <h4 class="bento-title">Sitemap</h4>
                <nav class="bento-links">
                    <a href="{{route('homepage')}}">Home</a>
                    <a href="{{route('aboutpage')}}">About Us</a>
                    <a href="{{route('contactpage')}}">Enquiry</a>
                    <a href="{{route('contactpage')}}">Contact</a>
                    <a href="{{route('contactpage')}}">Buy Now</a>
                </nav>
            </div>

            <div class="bento-box contact-box">
                <h4 class="bento-title">Contact</h4>
                <div class="contact-list">
                    <div class="c-item">
                        <small>Address</small>
                        <span>U23 2 Edison Rise ,WANGARA WA 6065</span>
                    </div>
                    <div class="c-item">
                        <small>Phone</small>
                        <a href="tel:+61450381706">(+61) 450 381 706</a>
                    </div>
                    <div class="c-item">
                        <small>Email</small>
                        <a href="mailto:info@spleca.com.au">info@spleca.com.au</a>
                    </div>
                </div>
            </div>

            <div class="bento-box map-box">
                
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3223.2991476393354!2d115.81653428183868!3d-31.795370007280194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32ad8e16582227%3A0x43717fa7a2247903!2sSPLECA%20Solutions%20Pty%20Ltd!5e1!3m2!1sen!2sin!4v1767336136675!5m2!1sen!2sin"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="bento-box social-box">
                <h4 class="bento-title">Connect</h4>
                <div class="social-stack">
                    <a href="https://www.facebook.com/profile.php?id=61572132809944&mibextid=ZbWKwL" class="s-link" target="_blank">Facebook <i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.linkedin.com/company/spleca/" class="s-link" target="_blank">LinkedIn <i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.instagram.com/spleca8?utm_source=qr&igsh=MTh4cGxla2NoNm5udg==" class="s-link" target="_blank">Instagram <i class="fab fa-instagram"></i></a>
                </div>
            </div>

        </div>

        <div class="footer-sub-bar">
            <div class="copyright">2026 © All Rights Reserved.</div>
            <div class="designer">Designed by <a href="https://webbitech.com">Webbitech.com</a></div>
        </div>
    </div>
</footer>

{{-- ================= JS ================= --}}

<!-- Swiper (ONLY ONE VERSION) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Global Site JS -->
<script src="{{ asset('asset/js/script.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const hamburger = document.querySelector(".hamburger");
        const mobileMenu = document.querySelector(".mobile-menu");

        if (hamburger && mobileMenu) {
            hamburger.addEventListener("click", () => {
                hamburger.classList.toggle("active");
                mobileMenu.classList.toggle("active");
                document.body.classList.toggle("no-scroll");
            });
        }
    });

    function viewProductDetails(productId) {
        window.location.href = "{{ url('/product') }}/" + productId;
    }

    // $(document).on('click', '.add-to-cart:not(:disabled)', function(e) {
    //     e.preventDefault();

    //     let productId = $(this).data('id');

    //     $.ajax({
    //         url: "{{ route('cart.add') }}",
    //         type: "POST",
    //         data: {
    //             product_id: productId,
    //             _token: "{{ csrf_token() }}"
    //         },
    //         success: function(response) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Added to Cart',
    //                 text: 'Product added to cart successfully!',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //             window.location.href = "{{ route('cartpage') }}";
    //         },
    //         error: function(xhr) {
    //             if (xhr.status === 401) {
    //                 Swal.fire({
    //                     icon: 'info',
    //                     title: 'Login Required',
    //                     text: 'Please login to continue shopping.',
    //                     showCancelButton: true,
    //                     confirmButtonText: 'Login',
    //                     cancelButtonText: 'Close',
    //                     reverseButtons: true
    //                 }).then((result) => {
    //                     if (result.isConfirmed) {
    //                         // ✅ Go to login page
    //                         window.location.href = "{{ route('login') }}";
    //                     }
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: 'Unable to add product to cart!',
    //                 });
    //             }
    //         }
    //     });
    // });

    //  function removeFromWishlist(id) {
    //     let productId = id;

    //     // Correct: use url() + JS dynamic ID
    //     let toggleUrl = "{{ url('toggle-wishlist') }}/" + encodeURIComponent(productId);

    //     $.ajax({
    //         type: "GET",
    //         url: toggleUrl,
    //         success: function(response) {
    //             // Optional: update wishlist count
    //             $(".wishlist-link .badge").text(response.count);
    //             $(".notification-badge").text(response.count);
    //             $(".wish-count").text(response.count);
    //             // Optional toast message
    //             loadWishlist(); // ✅ reload AFTER success
    //         },
    //         error: function(err) {
    //             console.error("Wishlist Error:", err);
    //         }
    //     });
    // }
    $(document).on("click", ".addToWishlist", function() {
        let productId = $(this).data("id");
        let btn = $(this);

        // Correct: use url() + JS dynamic ID
        let toggleUrl = "{{ url('toggle-wishlist') }}/" + encodeURIComponent(productId);

        $.ajax({
            type: "GET",
            url: toggleUrl,
            success: function(response) {
                if (response.added) {
                    btn.addClass("active"); // heart filled
                } else {
                    btn.removeClass("active"); // heart empty
                }
                location.reload();
                // Optional: update wishlist count
                $(".wishlist-link .badge").text(response.count);
                $(".notification-badge").text(response.count);

                loadWishlist(); // ✅ reload AFTER success
            },
            error: function(err) {
                console.error("Wishlist Error:", err);
            }
        });
    });
</script>
<script>
    const RESOURCE_PATH = "{{ asset('public/uploads/products') }}";

    $(document).ready(function() {
        $('#productSearch').on('keyup', function() {
            let keyword = $(this).val();

            if (keyword.length < 2) {
                $('#searchResults').hide().empty();
                return;
            }

            $.ajax({
                url: "{{ route('search.products') }}",
                type: "GET",
                data: {
                    q: keyword
                },
                success: function(data) {
                    let html = '';

                    if (data.length > 0) {

                        data.forEach(product => {
                            const image = product.images.length ?
                                `${RESOURCE_PATH}/${product.images[0].image}` :
                                `${RESOURCE_PATH}/no-image.png`;
                            html += `
                            <div class="row">
                                <div class="col-2"><img src="${image}" alt="${product.name}" width="40" class="me-2"></div>
                                <div class="col-10">
                                    <a href="{{ url('/product') }}/${product.id}" class="search-item">
                                        <span>${product.name}</span>                            
                                    </a>
                                    <span style="font-size: x-small;">${product.sub}</span> 
                                </div>
                               
                            </div>
                        `;
                        });
                    } else {
                        html = `<div class="p-2 text-muted">No products found</div>`;
                    }

                    $('#searchResults').html(html).show();
                }
            });
        });

        // Hide dropdown on click outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.search-box').length) {
                $('#searchResults').hide();
            }
        });
    });
    $('#inquiryForm').on('submit', function(e) {
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
                form.find('button[type="submit"]').prop('disabled', false).text('Send Message');
            }
        });
    });
</script>

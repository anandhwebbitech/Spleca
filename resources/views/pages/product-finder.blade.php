 @extends('layouts.app')
 @section('content')

    <section class="page-banner">
        <div class="content-wrapper">
            <h1>Product Finder</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>Product Finder</span>
            </div>
        </div>
    </section>

    <div class="main-container pb-0">
        <!-- Intro Section -->
        <div class="intro-text">
            Our range of products is very large. That's why it's not always easy to find the right product for your application. So if you don't know exactly what to look for, our Product Finder can help you. Try it out!
        </div>

        <!-- Section Title -->
        <h1 class="text-center fw-bold">Which Product Finder is the right one for you?</h1>
    </div>

    <!-- Product Finder Cards -->
    <div class="container-fluid px-3">
        <div class="row justify-content-center g-3 pf-wrapper">
            <!-- Card 1: Search. Click. Bond. -->
            <div class="pf-card col-12 col-md-5 col-lg-5">
                <div class="pf-image">
                    <div class="pf-overlay">
                        <div class="pf-icon"><img src="asset/img/product/pf-1.jpg" alt=""></div>
                    </div>
                </div>
                <div class="pf-content">
                    <h2 class="pf-heading">Search. Click. Bond.</h2>
                    <p class="pf-text">Are you already a bonding professional? Or do you know at least some of the bonding conditions for your application, such as bonding type, bonding gap or ambient temperature? Then you can use our Adhesive Finder directly.</p>
                </div>
            </div>

            <!-- Card 2: Which WEICON type am I? -->
            <div class="pf-card col-12 col-md-5 col-lg-5">
                <div class="pf-image">
                    <div style="color: #1e40af; font-size: 3rem; z-index: 5; position: relative;"><img src="asset/img/product/pf-2.jpg" alt=""></div>
                </div>
                <div class="pf-content">
                    <h2 class="pf-heading">Which WEICON type am I?</h2>
                    <p class="pf-text">Are you interested in our products in general? But you don't know, for example, whether you would prefer to use a lubricating oil or a lubricating grease, a 1C or 2C adhesive or you are still missing the right tool? Then use our WhatsApp service to receive more information or take our "Which WEICON type am I?" test on WhatsApp.</p>
                </div>
            </div>
        </div>
    </div>


    <section class="form-sec my-3">
        <div class="inquiry-wrapper">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="info-section">
                        <h2>Get in Touch</h2>
                        <p class="text-white">We'd love to hear from you! Fill out the form and we'll get back to you as soon as possible.</p>

                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Business Street, City, Country</span>
                        </div>

                        <div class="detail-item">
                            <i class="fas fa-phone"></i>
                            <span>+61 450 381 706</span>
                        </div>

                        <div class="detail-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@spleca.com.au</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="form-section">
                        <h3 class="heading-primary">Feel Free to Say Hello</h3>

                        <form id="inquiryForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="field-label">Your Name *</label>
                                    <input type="text" class="form-control input-field" name="name" id="fullname" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="emailaddress" class="field-label">Email Address *</label>
                                    <input type="email" class="form-control input-field" name="email" id="emailaddress" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phonenumber" class="field-label">Phone *</label>
                                    <input type="tel" class="form-control input-field" name="phone" id="phonenumber" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="text" class="field-label">Subject</label>
                                    <input type="text" class="form-control input-field" name="subject"id="fullname" >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="usermessage" class="field-label">Your Message *</label>
                                <textarea class="form-control input-field" id="usermessage" name="message" required></textarea>
                            </div>

                            <button type="submit" class="btn submit-btn text-white">
                                Send Message
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection
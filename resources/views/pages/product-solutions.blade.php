 @extends('layouts.app')
 @section('content')

    <section class="page-banner">
        <div class="content-wrapper">
            <h1>Product Solutions</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>Product Solutions</span>
            </div>
        </div>
    </section>


    <section class="product-finder-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column - Image -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="asset/img/product/pro-solution.jpg"
                        alt="Industrial workers with safety equipment"
                        class="product-finder-image">
                </div>

                <!-- Right Column - Content -->
                <div class="col-lg-6">
                    <h1 class="product-finder-title">Let's Find the Perfect Product Together</h1>

                    <!-- Accordion -->
                    <div class="accordion product-finder-accordion mb-5" id="productAccordion">
                        <!-- Step 01 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step01">
                                    Step 01: Which product is the right one for my application?
                                </button>
                            </h2>
                            <div id="step01" class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    This is a question you may be asking yourself when faced with our large selection of sprays, adhesives or lubricants. To help you answer this question and explain the benefits of our products, we have gathered some of our product solutions here. Is your application missing or do you have any suggestions?
                                </div>
                            </div>
                        </div>

                        <!-- Step 02 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step02">
                                    Step 02: Adhesives in everyday life
                                </button>
                            </h2>
                            <div id="step02" class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    Adhesives are an essential part of our everyday life. They are often used in places, where we wouldn’t expect them at all, like in the office, around the house or on sports equipment.
                                </div>
                            </div>
                        </div>

                        <!-- Step 03 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step03">
                                    Step 03: Cable stripping in everyday life
                                </button>
                            </h2>
                            <div id="step03" class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    In electrical installations, various cable types are used, which need to be stripped, if required. For this reason, different tools exist for all cable types.
                                </div>
                            </div>
                        </div>

                        <!-- Step 04 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step04">
                                    Step 04: How do I find the right adhesive?
                                </button>
                            </h2>
                            <div id="step04" class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    And why use adhesive? Special requirements call for special solutions. And adhesives can offer these special solutions. The advantage of adhesive bonding is that there is a suitable adhesive for almost every application.
                                </div>
                            </div>
                        </div>

                        <!-- Step 05 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step05">
                                    Step 05: What do I have to consider before bonding?
                                </button>
                            </h2>
                            <div id="step05" class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    The right preparation is absolutely essential. We sometimes receive feedback that an adhesive “doesn’t stick” properly.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Connect Button -->
                    <a href="{{route('contactpage')}}" class="btn-product-connect">Connect Now</a>
                </div>
            </div>
        </div>
    </section>


    <div class="container py-5">
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="premium-card">
                    <div class="premium-card__image-wrapper">
                        <img src="asset/img/product/pro-1.jpg" class="premium-card__image" alt="Bonding Process">
                    </div>
                    <div class="premium-card__body">
                        <h5 class="premium-card__title">What do I have to consider before bonding?</h5>
                        <!--<a href="#" class="premium-btn">Read More</a>-->
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="premium-card">
                    <div class="premium-card__image-wrapper">
                        <img src="asset/img/product/pro-2.jpg" class="premium-card__image" alt="Adhesive Application">
                    </div>
                    <div class="premium-card__body">
                        <h5 class="premium-card__title">How do I find the right adhesive?</h5>
                        <!--<a href="#" class="premium-btn">Read More</a>-->
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="premium-card">
                    <div class="premium-card__image-wrapper">
                        <img src="asset/img/product/pro-3.jpg" class="premium-card__image" alt="Cable Stripping Tool">
                    </div>
                    <div class="premium-card__body">
                        <h5 class="premium-card__title">Cable stripping in everyday life</h5>
                        <!--<a href="#" class="premium-btn">Read More</a>-->
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4 (Bottom) -->
        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="premium-card">
                    <div class="premium-card__image-wrapper">
                        <img src="asset/img/product/pro-4.jpg" class="premium-card__image" alt="Online Tools">
                    </div>
                    <div class="premium-card__body">
                        <h5 class="premium-card__title">Adhesives for special requirements</h5>
                        <!--<a href="{{route('newsletterpage')}}" class="premium-btn">Read More</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
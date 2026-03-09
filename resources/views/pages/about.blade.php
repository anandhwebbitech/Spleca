 @extends('layouts.app')
 @section('content')

    <section class="page-banner1">
        <div class="content-wrapper">
            <h1>About Us</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>About Us</span>
            </div>
        </div>
    </section>


    <section class="about-hero">
        <div class="bg-decoration bg-decoration-1"></div>
        <div class="bg-decoration bg-decoration-2"></div>

        <div class="wrapper">
            <div class="hero-grid">
                <div class="content-block">
                    <div class="badge">About SPLECA</div>

                    <h1 class="headline">
                        Serving Diverse<br>
                        Industries with<br>
                        <span class="accent-word">Precision</span>
                    </h1>

                    <p class="body-text">
                        <strong>SPLECA</strong> is a premier provider of technical sprays, adhesives, and sealants, delivering high-quality solutions designed to enhance industrial efficiency, durability, and performance. As an extension of <strong>LECA India</strong>, a company with over two decades of expertise in automation and industrial solutions, SPLECA is built on a strong foundation of quality, innovation, and customer-centric service.
                    </p>

                    <p class="body-text">
                        Partnering with <strong>WEICON</strong>, a globally recognized brand, we specialize in providing technical sprays, adhesives, assembly pastes, sealants, and special tools for the electrical industry. As the sole distributors for WEICON in Western Australia, we deliver premium products and customized solutions.
                    </p>

                    <a href="{{ route('contactpage') }}" class="action-button" aria-label="Contact SPLECA">
                        Connect Now
                    </a>

                </div>

                <div class="image-block">
                    <div class="image-container">
                        <div class="dot-pattern"></div>

                        <div class="main-visual">
                            <img src="asset/img/product/about.jpg" alt="SPLECA Industrial Products and Solutions">
                        </div>

                        <div class="metric-badge">
                            <div class="metric-value">100%</div>
                            <div class="metric-label">Quality</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container mt-5">
        <!-- Tab Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="tab-card active" onclick="switchTab('priority')">
                    <div class="tab-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2618/2618245.png" alt="Target Icon">
                    </div>
                    <div class="text-center">
                        <div class="tab-title">Our Priority</div>
                        <div class="tab-subtitle">Excellence in Service</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tab-card" onclick="switchTab('mission')">
                    <div class="tab-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/3030/3030322.png" alt="Rocket Icon">
                    </div>
                    <div class="text-center">
                        <div class="tab-title">Our Mission</div>
                        <div class="tab-subtitle">Innovation & Growth</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tab-card" onclick="switchTab('industries')">
                    <div class="tab-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2917/2917995.png" alt="Building Icon">
                    </div>
                    <div class="text-center">
                        <div class="tab-title">Industries We Serve</div>
                        <div class="tab-subtitle">Global Solutions</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="row content-row">
            <div class="col-lg-6">
                <div class="content-section">
                    <div id="content-area">
                        <!-- Priority Content -->
                        <div id="priority-content">
                            <span class="badge-custom">SPLECA EXCELLENCE</span>
                            <h2 class="heading-text">
                                Our top priority is delivering <span class="highlight-text">exceptional service.</span>
                            </h2>
                            <p class="description-text">
                                We envision a future where industrial processes are optimized with advanced solutions, reducing downtime, improving efficiency, and ensuring sustainability. SPLECA is committed to being a trusted industry leader, bringing cutting-edge technology and expertise to businesses that demand the best.
                            </p>
                            <a href="{{ route('contactpage') }}" class="connect-btn">
                                CONNECT NOW
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-section">
                    <img id="section-image" src="asset/img/product/acc-1.jpg" alt="Industrial Tool">
                    <div class="label-overlay">
                        <div class="label-text" id="label-text">VISION</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="portfolio-section">
        <div class="container">
            <h2 class="main-heading">Our Product Portfolio</h2>
            <p class="sub-heading">We offer a wide range of specialized products designed for industrial applications, including:</p>

            <div class="row">
                <div class="col-lg-4 col-md-6 fade-in">
                    <div class="product-card1 my-5">
                        <span class="card-number">1</span>
                        <h3 class="card-title">Technical Sprays</h3>
                        <ul class="feature-list">
                            <li class="feature-item">Cleaning & degreasing solutions</li>
                            <li class="feature-item">Lubrication & corrosion protection</li>
                            <li class="feature-item">Surface treatment & maintenance sprays</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fade-in">
                    <div class="product-card1 my-5">
                        <span class="card-number">2</span>
                        <h3 class="card-title">Adhesives & Sealants</h3>
                        <ul class="feature-list">
                            <li class="feature-item">High-strength bonding solutions</li>
                            <li class="feature-item">Industrial-grade sealing applications</li>
                            <li class="feature-item">Structural adhesives for various materials</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fade-in">
                    <div class="product-card1 my-5">
                        <span class="card-number">3</span>
                        <h3 class="card-title">Specialty Solutions</h3>
                        <ul class="feature-list">
                            <li class="feature-item">Custom-engineered products for niche industries</li>
                            <li class="feature-item">Industry-specific technical solutions tailored to unique challenges</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="spleca-excellence-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-4">
                        <h2 class="spleca-main-title">Our Commitment to Excellence</h2>
                    </div>

                    <p class="spleca-paragraph-text">
                        At SPLECA, we prioritize quality, reliability, and customer satisfaction. Every product we offer is tested and certified to meet international industry standards, ensuring businesses get the best solutions for their needs.
                    </p>

                    <p class="spleca-paragraph-text">
                        We believe in collaboration, transparency, and long-term partnerships—our goal is to empower industries with world-class solutions that drive growth and efficiency.
                    </p>

                    <div class="spleca-partner-box text-center">
                        <p class="spleca-partner-description">
                            Partner with SPLECA today and experience the difference of quality, expertise, and innovation. For inquiries, technical support, or collaborations, reach out to our team—we're here to help your business succeed.
                        </p>
                        <a href="{{ route('contactpage') }}" class="abt-butn">Contact Our Team</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container features-section py-5">
        <!-- feature -->
        <div class="section-header">
            <div class="section-subtitle">Why Choose Us</div>
            <h2 class="section-title">Our Core Strengths</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Feature 1 -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Premium Quality<br>Assurance</h3>
                    <p class="feature-description">Each product is rigorously tested to ensure consistency and reliability.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="feature-title">Wide Range of<br>Products</h3>
                    <p class="feature-description">We supply chemicals across a variety of industries</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="feature-title">Fast & Reliable<br>Delivery</h3>
                    <p class="feature-description">With our global network of suppliers and efficient logistics, we ensure timely deliveries to keep your operations running smoothly.</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="feature-title">Safety &<br>Compliance</h3>
                    <p class="feature-description">All our products comply with industry regulations and safety standards, ensuring that they are safe and effective for your use.</p>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="feature-title">Custom<br>Solutions</h3>
                    <p class="feature-description">Our team is ready to meet your exact requirements with tailor-made solutions.</p>
                </div>
            </div>
        </div>
    </div>


    <section class="form-sec">
        <div class="inquiry-wrapper">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="info-section">
                        <h2>Get in Touch</h2>
                        <p class="text-white">We'd love to hear from you! Fill out the form and we'll get back to you as soon as possible.</p>

                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>U23 2 Edison Rise ,WANGARA WA 6065</span>
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
                                    <input type="text" class="form-control input-field" name="subject" id="fullname" >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="usermessage" class="field-label">Your Message *</label>
                                <textarea class="form-control input-field" id="usermessage" name="message" required></textarea>
                            </div>
                            <div id="enquiryResponse" class="mb-3"></div>
                            <button type="submit" class="btn submit-btn text-white btn-submit" >
                                Send Message
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')

    <script>
        const content = {
            priority: {
                badge: 'SPLECA EXCELLENCE',
                heading: 'Our top priority is delivering',
                highlight: 'exceptional service.',
                description: 'We envision a future where industrial processes are optimized with advanced solutions, reducing downtime, improving efficiency, and ensuring sustainability. SPLECA is committed to being a trusted industry leader, bringing cutting-edge technology and expertise to businesses that demand the best.',
                label: 'VISION',
                image: 'asset/img/product/acc-1.jpg'
            },
            mission: {
                badge: 'OUR COMMITMENT',
                heading: 'Our mission is to provide',
                highlight: 'high-performance industrial solutions.',
                description: 'At SPLECA, our mission is to provide high-performance industrial solutions that empower businesses to:<br><br>✔ Improve operational efficiency through superior-quality products<br>✔ Enhance reliability and longevity with durable and tested materials<br>✔ Optimize manufacturing and maintenance with innovative adhesives and sealants<br>✔ Reduce environmental impact through sustainable, high-performance solutions<br><br>We are more than just a supplier—we are partners in innovation, ensuring businesses have access to top-tier technical support, expertise, and solutions that drive success.',
                label: 'MISSION',
                image: 'asset/img/product/acc-2.jpg'
            },
            industries: {
                badge: 'INDUSTRY EXPERTISE',
                heading: 'SPLECA supports a diverse',
                highlight: 'range of industries.',
                description: 'SPLECA supports a diverse range of industries, including:<br><br>✅ Manufacturing & Engineering – High-performance adhesives and maintenance solutions<br>✅ Automotive & Aerospace – Specialty lubricants, bonding solutions, and protective coatings<br>✅ Mining & Energy – Heavy-duty sealants and corrosion-resistant sprays<br>✅ Marine & Shipbuilding – Water-resistant adhesives and protective coatings<br>✅ Electronics & Electricals – Precision adhesives for electrical applications',
                label: 'SECTORS',
                image: 'asset/img/product/acc-3.jpg'
            }
        };

        function switchTab(tab) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-card').forEach(card => {
                card.classList.remove('active');
            });

            // Add active class to clicked tab
            event.currentTarget.classList.add('active');

            // Update content
            const data = content[tab];
            document.getElementById('content-area').innerHTML = `
                <span class="badge-custom">${data.badge}</span>
                <h2 class="heading-text">
                    ${data.heading} <span class="highlight-text">${data.highlight}</span>
                </h2>
                <p class="description-text">
                    ${data.description}
                </p>
                <button class="connect-btn" onclick="window.location.href='{{ route('contactpage') }}'">
                    CONNECT NOW
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            `;

            // Update label and image
            document.getElementById('label-text').textContent = data.label;
            document.getElementById('section-image').src = data.image;
        }
    </script>
@endpush

@endsection

 @extends('layouts.app')
 @section('content')
    <section class="page-banner">
        <div class="content-wrapper">
            <h1>Contact Us</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>Contact Us</span>
            </div>
        </div>
    </section>

    <section class="header">
        <div class="icon-circle">
            <i class="fas fa-headset"></i>
        </div>
        <h1>Need Support? Talk With Our Team</h1>
    </section>

    <div class="container">
        <div class="section">
            <div class="form reveal">
                <div class="form-top">
                    <span class="tag">Send a Message</span>
                    <h2>Feel free to send in your enquiries</h2>
                    <p>Complete the enquiry form & we will be in touch as soon as possible.</p>
                </div>

                <form id="inquiryForm">
                    @csrf
                    <input type="text" class="input" name="name"placeholder="Your Name*" required>
                    <input type="email" class="input" name="email" placeholder="Email Address*" required>
                    <input type="tel" class="input"name="phone" placeholder="Phone*" required>
                    <textarea class="input"name="message" placeholder="Your Message*" required></textarea>
                    <div id="enquiryResponse" class="mb-3"></div>
                    <button type="submit" class="btn-submit">
                        Send Message
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <div class="contact-box">

                <div class="contact-item">
                    <div class="icon-shape">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <div class="text">
                        <h3>Warehouse</h3>
                        <p>U23 2 Edison Rise ,WANGARA WA 6065</p>
                        <button class="btn-primary">Find Our Way</button>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-shape">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="text">
                        <h3>Send Mail</h3>
                        <p>info@spleca.com.au</p>
                        <button class="btn-primary">Connect Now</button>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-shape">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="text">
                        <h3>Call Now</h3>
                        <p>+61 450 381 706</p>
                        <button class="btn-primary">Make Appointment</button>
                    </div>
                </div>

            </div>

            <div class="map reveal" style="animation-delay: 0.3s;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15045.044407675645!2d115.81915028286002!3d-31.795452992578625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32ad8e16582227%3A0x43717fa7a2247903!2sSPLECA%20Solutions%20Pty%20Ltd!5e1!3m2!1sen!2sin!4v1763538500375!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>


@endsection

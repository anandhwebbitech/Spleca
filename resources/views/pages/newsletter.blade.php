 @extends('layouts.app')
 @section('content')

    <section class="page-banner">
        <div class="content-wrapper">
            <h1>Newsletter</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>Newsletter</span>
            </div>
        </div>
    </section>

    <div class="mining_conf_wrapper_2025">
        <div class="container">
            <!-- Hero Banner -->
            <img src="asset/img/newsletter.jpeg" alt="WA Mining Conference 2025" class="mining_hero_banner_img_2025">

            <!-- Section Title -->
            <div class="mining_section_heading_2025">
                <h2>Stay Ahead of the Curve with Our Newsletter</h2>
            </div>

            <!-- Announcement Block -->
            <div class="mining_text_block_2025">
                <p>
                    <strong>SPLECA Solutions</strong> is proud to announce that we'll be exhibiting at the
                    <span class="mining_highlight_span_2025">WA Mining Conference & Exhibition</span> this
                    <strong>8th–9th October 2025 in Perth</strong> — and we're thrilled to be joined by our partners from
                    <span class="mining_highlight_span_2025">WEICON Germany</span> at our shared stand!
                </p>
            </div>

            <div class="mining_text_block_2025">
                <p>
                    Together, we'll be showcasing a premium range of <span class="mining_highlight_span_2025">industrial adhesives, sealants,
                        technical sprays, lubricants, and tools</span> designed to meet the tough demands of the mining and industrial sectors.
                </p>
            </div>

            <div class="mining_divider_line_2025"></div>

            <!-- Visit Section -->
            <div class="mining_visit_box_2025">
                <h3>Visit us at Stall A126 to:</h3>
                <ul class="mining_feature_ul_2025">
                    <li>Explore WEICON's high-performance product range</li>
                    <li>Get expert advice from both the SPLECA and WEICON teams</li>
                </ul>
            </div>

            <!-- Info Cards Grid -->
            <div class="mining_info_container_2025">
                <div class="mining_info_item_2025">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Event</h4>
                    <p>WA Mining Conference & Exhibition 2025</p>
                </div>

                <div class="mining_info_item_2025">
                    <i class="fas fa-calendar-alt"></i>
                    <h4>Dates</h4>
                    <p>8–9 October 2025</p>
                </div>

                <div class="mining_info_item_2025">
                    <i class="fas fa-building"></i>
                    <h4>Venue</h4>
                    <p>Perth Convention & Exhibition Centre | Stall A126</p>
                </div>
            </div>

            <div class="mining_divider_line_2025"></div>

            <!-- CTA Section -->
            <div class="mining_cta_box_2025">
                <h3>Come meet the team, see the products in action, and find out how we're helping WA industries operate smarter and more efficiently!</h3>
            </div>
        </div>
    </div>

@endsection

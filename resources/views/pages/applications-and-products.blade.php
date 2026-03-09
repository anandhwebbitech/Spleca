 @extends('layouts.app')
 @section('content')
    <section class="page-banner">
        <div class="content-wrapper">
            <h1>Application and Products</h1>
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <span>Application and Products</span>
            </div>
        </div>
    </section>


    <section class="weicon-hero-banner">
        <div class="container">
            <p class="text-center">
                WEICON products are used in fascinating applications all over the world, e.g. on the largest bridge in Turkey,
                on pipelines in Romania and South America, or for sophisticated bonding work in Dubai on a trade fair pavilion.
                Our products are used internationally. We have summarised our most exciting applications from recent years to
                highlight their benefits and special features. These global applications illustrate the versatile and
                indispensable role of WEICON products around the world.
            </p>
        </div>
    </section>

    <section class="weicon-showcase-wrapper">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/1.jpg" alt="Conveyor Belts">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                           <a href="#sec-1" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Repair of conveyor belts in a quartz mine</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/2.jpg" alt="Stoneware Sewers">
                            <div class="" style="background: linear-gradient(to right, #000 33%, #fdda24 33%, #fdda24 66%, #ef3340 66%)"></div>
                            <a href="#sec-2" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Mounting stoneware sewers with plastic pipes</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/3.jpg" alt="Inner Coating of Pumps">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-3" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Inner coating of pumps</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/4.jpg" alt="Attachment and Alignment">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-4" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Attachment and alignment to hose covers and couplings on bunker station in harbour</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/5.jpg" alt="Bonding of Brackets">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-5" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Bonding of 28,000 brackets for aluminium rhombs</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/6.jpg" alt="Crack Repair of Moulding Die">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-6" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Crack repair of a moulding die for bumpers in the automotive industry</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/7.jpg" alt="Repair of Leakage on Cooler">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-7" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Repair of a leakage on a cooler</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/8.jpg" alt="Bonding sight glasses">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                           <a href="#sec-8" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Bonding sight glasses to monitor the suspension cables on the Çanakkale 1915 Bridge</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/9.jpg" alt="Sealing of battery packs on electric cars">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                            <a href="#sec-9" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Sealing of battery packs on electric cars</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="weicon-project-card">
                        <div class="weicon-visual-container">
                            <img src="asset/img/app-pro/10.jpg" alt="Repair of a bronze propeller shaft">
                            <div class="" style="background: linear-gradient(to bottom, #000 33%, #dd0000 33%, #dd0000 66%, #ffce00 66%)"></div>
                           <a href="#sec-10" class="weicon-direction-icon text-decoration-none"><i class="fa-solid text-white fa-angle-right"></i></a>
                        </div>
                        <div class="weicon-info-block">
                            <h3>Repair of a bronze propeller shaft</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section 1: Conveyor Belt Repair -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-1" class="col-lg-6">
                    <h2 class="section-title">Repair of conveyor belts in a quartz mine</h2>
                    <ul class="process-list">
                        <li>Removing coarse dirt</li>
                        <li>Roughening and levelling the damaged areas with an angle grinder (rasp disc or cup wheel)</li>
                        <li>Cleaning the surface with WEICON Cleaner Spray S</li>
                        <li>Mixing and applying WEICON Primer G with a paint brush</li>
                        <li>Allow WEICON Primer G sufficient time to flash off</li>
                        <li>Depending on the container application of WEICON Urethane 85</li>
                        <li>Smoothing the surface with WEICON Contour Spatula Flexy</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Very cost-effective way to restore the functioning of the conveyor belts and thus extension of the service life</li>
                        <li>Versatile application possibilities</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/1-1.jpg" alt="Conveyor Belt 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/1-2.jpg" alt="Conveyor Belt 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/1-3.jpg" alt="Conveyor Belt 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/1-4.jpg" alt="Conveyor Belt 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/1-5.jpg" alt="Conveyor Belt 5">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Stoneware Sewers -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-2" class="col-lg-6 order-lg-2">
                    <h2 class="section-title">Mounting stoneware sewers with plastic pipes</h2>
                    <ul class="process-list">
                        <li>Installation of a dosing system due to the large material consumption</li>
                        <li>Gap-filling and bonding with generous application of WEICON Flex 310 M® 2 K</li>
                        <li>With this type of drum dosing system, the adhesive is mixed only in the mixing nozzle</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Compared to other adhesives: elasticity, tolerance compensation, good sealing effect, high adhesive strength and curing independent of ambient conditions thanks to 2C system</li>
                        <li>Adhesive is only mixed in the mixing nozzle</li>
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/2-1.jpg" alt="Stoneware 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/2-2.jpg" alt="Stoneware 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/2-3.jpg" alt="Stoneware 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/2-4.jpg" alt="Stoneware 4">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Industrial Pipeline Sealing -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-3" class="col-lg-6">
                    <h2 class="section-title">Inner coating of pumps</h2>
                    <ul class="process-list">
                        <li>Pre-treatment with sandblasting</li>
                        <li>Cleaning with WEICON Cleaner Spray S
                        </li>
                        <li>Repairing the cavitation and corrosion damages with WEICON HB 300
                        </li>
                        <li>Final coating as wear protection with WEICON Ceramic BL
                        </li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Repairing worn pumps</li>
                        <li>Additional protection for new pumps</li>
                        <li>Cost-effective repair and long service life</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/3-1.jpg" alt="Pipeline 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/3-2.jpg" alt="Pipeline 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/3-3.jpg" alt="Pipeline 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/3-4.jpg" alt="Pipeline 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/3-5.jpg" alt="Pipeline 5">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 4: Metal Tank Restoration -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-4" class="col-lg-6 order-lg-2">
                    <h2 class="section-title">Attachment and alignment to hose covers and couplings on bunker station in harbour</h2>
                    <ul class="process-list">
                        <li>Clean the surface with WEICON Cleaner Spray S</li>
                        <li>Align hose covers</li>
                        <li>Apply WEICON Repair-Tape 10 cm x 3.5 m</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Simple, inexpensive and reliable sealing</li>
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/4-1.jpg" alt="Tank 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/4-2.jpg" alt="Tank 2">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 5: Concrete Floor Coating -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-5" class="col-lg-6">
                    <h2 class="section-title">Bonding of 28,000 brackets for aluminum rhombs at the Pakistan Pavilion at the Expo 2020 in DUBAI</h2>
                    <ul class="process-list">
                        <li>Use of several WEICON products at the pavilion</li>
                        <li>Cleaning the aluminium rhombs with WEICON Cleaner Spray S
                        </li>
                        <li>Application of WEICON Primer K 200 for better cross-linking of the surface
                        </li>
                        <li>Bonding the 28,000 aluminium rhombs with WEICON Flex 310 M® Classic
                        </li>
                        <li>In the adhesion test, the material was damaged rather than the adhesive
                        </li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Adhesive bonding instead of screws</li>
                        <li>Fast and visually appealing solution that meets the highest design requirements</li>
                        <li>Implementation of a total of 28,000 bondings</li>
                        <li>Processing at high outside temperatures of 40 °C possible</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/5-1.jpg" alt="Floor 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/5-2.jpg" alt="Floor 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/5-3.jpg" alt="Floor 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/5-4.jpg" alt="Floor 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/5-5.jpg" alt="Floor 5">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 6: Machinery Base Grouting -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-6"class="col-lg-6 order-lg-2">
                    <h2 class="section-title">Crack repair of a moulding die for bumpers in the automotive industry</h2>
                    <ul class="process-list">
                        <li>Cleaning of the rear honeycomb structure in the damaged area with WEICON Cleaner Spray S</li>
                        <li>Use of WEICON Crack Testing Agent to locate cracks</li>
                        <li>Pouring WEICON WR into the honeycombs to fill the cavities of the die</li>
                        <li>Material grouting of 235 kg WEICON WR was carried out over the period of one week (due to exothermic reaction)</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Mould now withstands future pressure and further cracking is prevented</li>
                        <li>Economic repair to ensure final production of the batch</li>
                        <li>Cost savings of approx. 100,000 € for a new die</li>
                        <li>Another 8,000 to 10,000 pressings could be made to complete production</li>
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/6-1.jpg" alt="Grouting 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/6-2.jpg" alt="Grouting 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/6-3.jpg" alt="Grouting 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/6-4.jpg" alt="Grouting 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/6-5.jpg" alt="Grouting 5">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 7: Fiberglass Tank Repair -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-7" class="col-lg-6">
                    <h2 class="section-title">Repair of a leakage on a cooler</h2>
                    <ul class="process-list">
                        <li>Sealing the leakage on the cooler of a caterpillar</li>
                        <li>Cleaning the surfaces with WEICON Cleaner Spray S</li>
                        <li>Sealing with WEICON Repair Stick Aluminium</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>The service life is significantly extended by the use of the Repair Stick Aluminium</li>
                        <li>The component does not need to be replaced</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-1.jpg" alt="Fiberglass 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-2.jpg" alt="Fiberglass 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-3.jpg" alt="Fiberglass 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-4.jpg" alt="Fiberglass 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-5.jpg" alt="Fiberglass 5">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/7-6.jpg" alt="Fiberglass 6">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 8: Bearing Housing Repair -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-8"class="col-lg-6 order-lg-2">
                    <h2 class="section-title">Bonding sight glasses to monitor the suspension cables on the Çanakkale 1915 Bridge</h2>
                    <ul class="process-list">
                        <li>Sight glasses are sealed on the cable bulbs of the Çanakkale 1915 bridge</li>
                        <li>The surfaces were first dried and cleaned with WEICON Surface Cleaner</li>
                        <li>Subsequent sealing with Flex 310 M® Crystal</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Durable transparent sealing against rainwater</li>
                        <li>High resistance to weathering, especially with regard to temperature changes</li>
                        <li>The requirement of a silicone-free material is met by Flex 310 M® Crystal</li>
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/8.jpg" alt="Bearing 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/8-1.jpg" alt="Bearing 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/8-2.jpg" alt="Bearing 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/8-3.jpg" alt="Bearing 4">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 9: Pump Casing Repair -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-9" class="col-lg-6">
                    <h2 class="section-title">Sealing of battery packs on electric cars</h2>
                    <ul class="process-list">
                        <li>Cleaning with WEICON Surface Cleaner</li>
                        <li>Sealing of the battery packs with WEICON Plast-o-Seal</li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Long-term sealing effect</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/9-1.jpg" alt="Pump 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/9-2.jpg" alt="Pump 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/9-3.jpg" alt="Pump 3">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 10: Chute Lining Application -->
    <div class="solution-section">
        <div class="container">
            <div class="row align-items-center">
                <div id="sec-10" class="col-lg-6 order-lg-2">
                    <h2 class="section-title">Repair of a bronze propeller shaft</h2>
                    <ul class="process-list">
                        <li>Propeller shaft had shrunk slightly by approx. 5 mm in the sealing area due to sediment build-up (stern tube)</li>
                        <li>Shaft was sanded down by 4 mm and by 200 mm in width</li>
                        <li>Cleaning with WEICON Cleaner Spray S</li>
                        <li>Creating a barrier by means of tape (3 mm)
                        </li>
                        <li>Application of WEICON BR at slow rotation of the shaft
                        </li>
                        <li>Slow rotation of the shaft during curing to prevent WEICON BR from dripping off
                        </li>
                        <li>Sanding the shaft to size after curing
                        </li>
                        <li>Finishing the shaft with fine abrasive cloth (approx. 0.2 mm)
                        </li>
                        <li>Reinstalling the propeller shaft
                        </li>
                    </ul>
                    <h3 class="advantage-title">Advantage of our solution:</h3>
                    <ul class="advantage-list">
                        <li>Avoidance of a cost-intensive replacement</li>
                        <li>Easy and time-saving repair</li>
                        <li>Good material compatibility and seawater resistance of WEICON BR</li>
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/10.jpg" alt="Chute 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/10-1.jpg" alt="Chute 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/10-2.jpg" alt="Chute 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="asset/img/app-pro/10-3.jpg" alt="Chute 4">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize all swipers separately
        document.querySelectorAll('.mySwiper').forEach(function(swiperElement, index) {
            new Swiper(swiperElement, {
                loop: true,
                pagination: {
                    el: swiperElement.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: swiperElement.querySelector('.swiper-button-next'),
                    prevEl: swiperElement.querySelector('.swiper-button-prev'),
                },
                autoplay: {
                    delay: 3000 + (index * 200),
                    disableOnInteraction: false,
                },
            });
        });
    </script>
 @endsection
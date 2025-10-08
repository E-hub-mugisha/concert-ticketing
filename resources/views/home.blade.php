<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">Evently</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.html" class="active">Home</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="buy-tickets.html">Buy Tickets</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div class="background-overlay"></div>

            <div class="hero-content">

                <div class="container">

                    <div class="row justify-content-center text-center">

                        <div class="col-lg-10">

                            <div class="hero-text">
                                @if(isset($featuredEvent))
                                <h1 class="hero-title">{{ $featuredEvent->title }}</h1>

                                <p class="hero-subtitle">{{ $featuredEvent->description }}</p>

                                <div class="event-details">
                                    <div class="detail-item">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>{{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('F d, Y') }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $featuredEvent->venue }}</span>
                                    </div>
                                </div>
                                @if($featuredEvent->tickets && $featuredEvent->tickets->count())
                                <a href="#tickets" class="btn btn-warning text-uppercase mt-3 px-4 py-2">Buy Ticket</a>
                                @endif
                                @else
                                <h1 class="text-white">No upcoming event</h1>
                                <p class="text-light">Please check back later for new conferences and events.</p>
                                @endif
                            </div>

                            <div class="countdown-section">

                                <h3 class="countdown-label">Event Starts In</h3>

                                <div class="countdown d-flex justify-content-center">
                                    <div id="timer" class="text-white"></div>
                                </div>

                            </div>

                            <div class="cta-section">

                                <div class="cta-buttons">
                                    <a href="tickets.html" class="btn btn-primary btn-cta">Secure Your Seat</a>
                                    <a href="speakers.html" class="btn btn-secondary btn-cta">View Speakers</a>
                                </div>

                                <p class="cta-note">Limited to 200 executive participants • Early bird pricing ends January 31st</p>

                            </div>

                        </div><!-- End col-lg-10 -->

                    </div><!-- End row -->

                    <div class="sponsors-section">

                        <p class="sponsors-label">Proudly supported by industry leaders</p>

                        <div class="sponsors-logos">
                            <img src="assets/img/clients/clients-1.webp" alt="Partner Logo" class="sponsor-logo">
                            <img src="assets/img/clients/clients-3.webp" alt="Partner Logo" class="sponsor-logo">
                            <img src="assets/img/clients/clients-5.webp" alt="Partner Logo" class="sponsor-logo">
                            <img src="assets/img/clients/clients-7.webp" alt="Partner Logo" class="sponsor-logo">
                            <img src="assets/img/clients/clients-9.webp" alt="Partner Logo" class="sponsor-logo">
                            <img src="assets/img/clients/clients-11.webp" alt="Partner Logo" class="sponsor-logo">
                        </div>

                    </div><!-- End sponsors-section -->

                </div><!-- End container -->

            </div>

        </section><!-- /Hero Section -->

        <!-- Intro Section -->
        <section id="intro" class="intro section">

            <div class="container">

                <div class="row g-4">

                    <div class="col-lg-6">
                        <div class="content">
                            <h2>The Definitive Tech Innovation Summit</h2>
                            <p class="lead">Morbi auctor ipsum vel leo cursus, ac tempor augue tempus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla facilisi. Fusce vitae magna non nulla vulputate tincidunt.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa.</p>

                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number">3</div>
                                    <div class="stat-label">Days</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">8</div>
                                    <div class="stat-label">Tracks</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">150+</div>
                                    <div class="stat-label">Speakers</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">3500+</div>
                                    <div class="stat-label">Attendees</div>
                                </div>
                            </div>

                            <div class="cta-section">
                                <a href="#" class="btn btn-primary">View Full Agenda</a>
                                <a href="#" class="btn btn-outline">Meet the Speakers</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="visual-section">
                            <div class="image-wrapper">
                                <img src="assets/img/events/showcase-5.webp" alt="Tech Summit" class="img-fluid">
                                <div class="gradient-overlay"></div>
                                <div class="floating-badge">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>March 15-17, 2026</span>
                                </div>
                            </div>

                            <div class="highlight-cards">
                                <div class="highlight-card">
                                    <i class="bi bi-people-fill"></i>
                                    <h4>Global Networking</h4>
                                    <p>Connect with industry leaders from 60+ countries</p>
                                </div>
                                <div class="highlight-card">
                                    <i class="bi bi-lightbulb-fill"></i>
                                    <h4>Innovation Showcase</h4>
                                    <p>Discover cutting-edge technologies and startups</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="founder-quote">
                    <div class="row align-items-center">
                        <div class="col-lg-3 text-center">
                            <img src="assets/img/person/person-m-8.webp" alt="Sarah Johnson" class="founder-img">
                        </div>
                        <div class="col-lg-9">
                            <blockquote>
                                <p>"Our mission has always been to bridge the gap between visionary ideas and practical implementation. This summit represents the culmination of years of bringing together the brightest minds in technology."</p>
                                <cite>
                                    <strong>Sarah Johnson</strong>
                                    <span>Founder &amp; Event Director</span>
                                </cite>
                            </blockquote>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Intro Section -->

        <!-- Tickets Section -->
        <section id="tickets" class="tickets section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-card">
                            <div class="ticket-header">
                                <h3>General Admission</h3>
                                <div class="ticket-price">
                                    <span class="currency">$</span>
                                    <span class="amount">149</span>
                                    <span class="period">/ticket</span>
                                </div>
                                <p class="ticket-duration">3-Day Access</p>
                            </div>
                            <div class="ticket-body">
                                <ul class="ticket-features">
                                    <li><i class="bi bi-check-circle-fill"></i>Access to all conference sessions</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Welcome reception networking</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Coffee breaks and lunch included</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Digital conference materials</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Certificate of attendance</li>
                                </ul>
                            </div>
                            <div class="ticket-footer">
                                <a href="buy-tickets.html" class="btn btn-ticket">Register Now</a>
                                <p class="availability-info">250 tickets remaining</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-card featured">
                            <div class="popular-badge">Most Popular</div>
                            <div class="ticket-header">
                                <h3>VIP Experience</h3>
                                <div class="ticket-price">
                                    <span class="currency">$</span>
                                    <span class="amount">299</span>
                                    <span class="period">/ticket</span>
                                </div>
                                <p class="ticket-duration">3-Day Premium Access</p>
                            </div>
                            <div class="ticket-body">
                                <ul class="ticket-features">
                                    <li><i class="bi bi-check-circle-fill"></i>All General Admission benefits</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Reserved front row seating</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Exclusive VIP networking lounge</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Meet &amp; greet with keynote speakers</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Premium swag bag worth $150</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Private dinner with industry leaders</li>
                                </ul>
                            </div>
                            <div class="ticket-footer">
                                <a href="buy-tickets.html" class="btn btn-ticket">Get VIP Access</a>
                                <p class="availability-info">Limited to 50 attendees</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-card">
                            <div class="ticket-header">
                                <h3>Student Pass</h3>
                                <div class="ticket-price">
                                    <span class="original-price">$149</span>
                                    <span class="currency">$</span>
                                    <span class="amount">79</span>
                                    <span class="period">/ticket</span>
                                </div>
                                <p class="ticket-duration">3-Day Student Access</p>
                            </div>
                            <div class="ticket-body">
                                <ul class="ticket-features">
                                    <li><i class="bi bi-check-circle-fill"></i>All conference sessions access</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Student networking events</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Career fair participation</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Mentorship program eligibility</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Student resource kit</li>
                                </ul>
                            </div>
                            <div class="ticket-footer">
                                <a href="buy-tickets.html" class="btn btn-ticket">Student Registration</a>
                                <p class="availability-info">Valid student ID required</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="ticket-info-bar">
                            <div class="countdown-info">
                                <h4><i class="bi bi-clock"></i> Early Bird Pricing Ends Soon!</h4>
                                <div class="countdown d-flex justify-content-center" data-count="2026/12/15">
                                    <div>
                                        <h3 class="count-days"></h3>
                                        <h4>Days</h4>
                                    </div>
                                    <div>
                                        <h3 class="count-hours"></h3>
                                        <h4>Hours</h4>
                                    </div>
                                    <div>
                                        <h3 class="count-minutes"></h3>
                                        <h4>Minutes</h4>
                                    </div>
                                    <div>
                                        <h3 class="count-seconds"></h3>
                                        <h4>Seconds</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="support-info">
                                <p><strong>Need help choosing?</strong> Contact our support team</p>
                                <a href="mailto:tickets@example.com" class="contact-link">tickets@example.com</a>
                                <span class="divider">|</span>
                                <a href="tel:+15551234567" class="contact-link">+1 (555) 123-4567</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Tickets Section -->


    </main>

    <footer id="footer" class="footer position-relative dark-background">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name') }}</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://homiez.rw">Homiez</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
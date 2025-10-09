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

            <a href="{{ route('home')}}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">{{ config('app.name')}}</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home')}}" class="active">Home</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="#tickets">Buy Tickets</a>

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
                                <div class="cta-section">

                                    <div class="cta-buttons">
                                        <a href="#tickets" class="btn btn-primary btn-cta">Secure Your Seat</a>
                                    </div>

                                    <p class="cta-note">Limited to 200 executive participants • Early bird pricing ends January 31st</p>

                                </div>
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
                        </div><!-- End col-lg-10 -->

                    </div><!-- End row -->

                    <div class="sponsors-section">

                        <p class="sponsors-label">Proudly supported by </p>

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
                    @if(isset($featuredEvent))
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>{{ $featuredEvent->title }}</h2>
                            <p class="lead">{{ $featuredEvent->description }}</p>

                            <!-- <div class="stats-grid">
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
                            </div> -->
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="visual-section">
                            <div class="image-wrapper">
                                <img src="{{ asset('storage/' . $featuredEvent->image) }}" alt="{{ $featuredEvent->title }}" class="img-fluid">
                                <div class="gradient-overlay"></div>
                                <div class="floating-badge">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>{{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('F d, Y') }}</span>
                                </div>
                            </div>

                            <!-- <div class="highlight-cards">
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
                            </div> -->
                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <div class="content text-center">
                            <h2>No upcoming event</h2>
                            <p class="lead">Please check back later for new conferences and events.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </section><!-- /Intro Section -->

        <!-- Tickets Section -->
        <section id="tickets" class="tickets section">

            <div class="container">

                <div class="row gy-4">
                    @if($events && $events->count())
                    @foreach($events as $event)
                    @foreach($event->tickets as $ticket)
                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-card">
                            <div class="ticket-header">
                                <h3>{{ $ticket->name }}</h3>
                                <div class="ticket-price">
                                    <span class="currency">$</span>
                                    <span class="amount">{{ number_format($ticket->price, 2) }}</span>
                                    <span class="period">/ticket</span>
                                </div>
                                <p class="ticket-duration">{{ $event->tickets->count() }} Tickets</p>
                            </div>
                            <div class="ticket-body">
                                <ul class="ticket-features">
                                    <li><i class="bi bi-check-circle-fill"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y H:i') }}</li>
                                    <li><i class="bi bi-check-circle-fill"></i>{{ $event->venue }}</li>
                                </ul>
                            </div>
                            <div class="ticket-footer">
                                <a data-bs-toggle="modal" data-bs-target="#ticketModal{{ $ticket->id }}" class="btn btn-ticket">Register Now</a>
                                <p class="availability-info">{{ $ticket->quantity - $ticket->sold }} tickets remaining</p>


                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($event->tickets as $ticket)
                    <div class="modal fade" id="ticketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="ticketModalLabel{{ $ticket->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content border-0 shadow-lg rounded-4">

                                {{-- Modal Header --}}
                                <div class="modal-header bg-primary text-white rounded-top-4">
                                    <h5 class="modal-title" id="ticketModalLabel{{ $ticket->id }}">
                                        Buy {{ $ticket->name }} Ticket
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                {{-- Modal Body --}}
                                <div class="modal-body p-4">
                                    <div class="row">
                                        {{-- Ticket Preview --}}
                                        <div class="col-lg-5 mb-3 mb-lg-0">
                                            <div class="card shadow-sm border-0 rounded-4">
                                                <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top rounded-top-4" alt="{{ $ticket->event->title }}">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title fw-bold">{{ $ticket->event->title }}</h5>
                                                    <p class="mb-1"><strong>Ticket Type:</strong> {{ $ticket->name }}</p>
                                                    <p class="mb-1"><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                                                    <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($ticket->event->event_date)->format('d M Y, h:i A') }}</p>
                                                    <p class="mb-1"><strong>Venue:</strong> {{ $ticket->event->venue }}</p>

                                                    {{-- QR Code Placeholder --}}
                                                    <div class="mt-3">
                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=TICKET{{ $ticket->id }}" class="img-fluid rounded" alt="QR Code">
                                                        <p class="small text-muted mt-1">Scan at entry</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Form Section --}}
                                        <div class="col-lg-7">
                                            <form action="{{ route('checkout') }}" method="POST" class="ticket-form">
                                                @csrf
                                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                                {{-- Ticket Info --}}
                                                <div class="mb-3">
                                                    <p class="mb-1"><strong>Ticket Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                                                    <p class="mb-1"><strong>Available:</strong> {{ $ticket->quantity - $ticket->sold }}</p>
                                                </div>

                                                {{-- Quantity --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control ticket-quantity" min="1" max="{{ $ticket->quantity - $ticket->sold }}" value="1" required>
                                                </div>

                                                {{-- Attendees Section --}}
                                                <div class="attendees-section mb-3"></div>

                                                {{-- Buyer Details --}}
                                                <h6 class="fw-bold mb-2 text-primary">Buyer Details</h6>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-md-4">
                                                        <input type="text" name="customer_name" class="form-control" placeholder="Full Name" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="email" name="customer_email" class="form-control" placeholder="Email" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="customer_phone" class="form-control" placeholder="Phone" required>
                                                    </div>
                                                </div>

                                                {{-- Total --}}
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="fw-bold mb-0">Total:</h5>
                                                    <h5 class="text-success mb-0">$<span class="total-price">{{ number_format($ticket->price, 2) }}</span></h5>
                                                </div>
                                                <input type="hidden" name="total_amount" class="total-amount" value="{{ $ticket->price }}">

                                                {{-- Checkout Button --}}
                                                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                                                    <i class="bi bi-cart-fill me-1"></i> Proceed to Checkout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endforeach
                    @else
                    <div class="col-12">
                        <div class="content text-center">
                            <h2>No tickets available</h2>
                            <p class="lead">Please check back later for ticket availability.</p>
                        </div>
                    </div>
                    @endif
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="ticket-info-bar">
                                <div class="countdown-info">
                                    <h4><i class="bi bi-clock"></i> Early Bird Pricing Ends Soon!</h4>
                                    <!-- <div class="countdown d-flex justify-content-center" data-count="2026/12/15">
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
                                        </div> -->
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
            <p>© <span>Copyright</span>
                <script>
                    document.write(new Date().getFullYear());
                </script> <strong class="px-1 sitename">{{ config('app.name') }}</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://homiez.rw">HOMIEZ</a>
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

    <script>
        document.querySelectorAll('.ticket-form').forEach(form => {
            const quantityInput = form.querySelector('.ticket-quantity');
            const attendeesSection = form.querySelector('.attendees-section');
            const totalPriceSpan = form.querySelector('.total-price');
            const totalAmountInput = form.querySelector('.total-amount');
            const ticketPrice = parseFloat(totalAmountInput.value);

            function updateAttendees() {
                const qty = parseInt(quantityInput.value) || 1;
                attendeesSection.innerHTML = '';
                for (let i = 1; i <= qty; i++) {
                    attendeesSection.innerHTML += `<input type="text" name="attendees[]" class="form-control mb-1" placeholder="Attendee ${i} Name" required>`;
                }
                const total = ticketPrice * qty;
                totalPriceSpan.textContent = total.toFixed(2);
                totalAmountInput.value = total.toFixed(2);
            }

            quantityInput.addEventListener('input', updateAttendees);
            updateAttendees();
        });
    </script>

    <script>
        @if(isset($featuredEvent))
        const eventDate = new Date("{{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('Y-m-d H:i:s') }}").getTime();
        const timer = document.getElementById('timer');
        setInterval(() => {
            const now = new Date().getTime();
            const distance = eventDate - now;

            if (distance < 0) {
                timer.innerHTML = "Event Started!";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timer.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);
        @endif
    </script>

</body>

</html>
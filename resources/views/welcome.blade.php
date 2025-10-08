<!DOCTYPE html>
<html lang="zxx" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.html">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Conference</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#home">Home</a></li>

                        <li><a class="ticker-btn" href="#">Buy Ticket</a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->


    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-9 col-md-12 text-center">
                    @if(isset($featuredEvent))
                    <h6 class="text-white">Now you can join our highlighted event</h6>
                    <h1 class="text-white fw-bold">
                        {{ $featuredEvent->title }}
                    </h1>

                    <p class="text-light mb-3">{{ $featuredEvent->description }}</p>

                    <div class="countdown mb-3">
                        <div id="timer" class="text-white"></div>
                    </div>

                    <h4 class="text-light">
                        <span class="lnr lnr-calendar-full"></span>
                        {{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('F d, Y H:i') }}
                    </h4>
                    <h4 class="text-light">
                        <span class="lnr lnr-map"></span> {{ $featuredEvent->venue }}
                    </h4>

                    @if($featuredEvent->tickets && $featuredEvent->tickets->count())
                    <a href="#tickets" class="btn btn-warning text-uppercase mt-3 px-4 py-2">Buy Ticket</a>
                    @endif
                    @else
                    <h1 class="text-white">No upcoming event</h1>
                    <p class="text-light">Please check back later for new conferences and events.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- Start price Area -->
    @if($events && $events->count())
    <section class="price-area section-gap">
        <div class="container">
            @foreach($events as $event)
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">{{ $event->title }}</h1>
                        <p>{{ $event->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($event->tickets as $ticket)
                <div class="col-lg-4 col-md-6 single-price g-2">
                    <div class="top-part">
                        <h1 class="package-no">{{ $loop->iteration }}</h1>
                        <h4>{{ $ticket->name }}</h4>
                        <p>{{ $event->description }}</p>
                    </div>
                    <div class="package-list">
                        <ul>
                            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y H:i') }}</li>
                            <li><strong>Venue:</strong> {{ $event->venue }}</li>
                            <li><strong>Tickets:</strong> {{ $event->tickets->count() }}</li>
                        </ul>
                    </div>
                    <div class="bottom-part">
                        <div class="mb-3 border-top pt-2">
                            <h5 class="text-dark">{{ $ticket->name }}</h5>
                            <p>${{ number_format($ticket->price, 2) }}
                                ({{ $ticket->quantity - $ticket->sold }} left)
                            </p>
                            <a class="price-btn text-uppercase" data-toggle="modal" data-target="#ticketModal{{ $ticket->id }}">Buy Now</a>
                        </div>

                        <!-- Modal for each ticket -->
                        <div class="modal fade" id="ticketModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel{{ $ticket->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ticketModalLabel{{ $ticket->id }}">Buy {{ $ticket->name }} Ticket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span> <!-- X icon for Bootstrap 4 -->
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('checkout') }}" method="POST" class="ticket-form">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                            <div class="mb-2">
                                                <label>Quantity</label>
                                                <input type="number" name="quantity" class="form-control ticket-quantity" min="1" max="{{ $ticket->quantity - $ticket->sold }}" value="1" required>
                                            </div>

                                            <div class="attendees-section mb-2"></div>

                                            <h5>Buyer Details</h5>
                                            <div class="row mb-2">
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

                                            <h5>Total: $<span class="total-price">{{ number_format($ticket->price, 2) }}</span></h5>
                                            <input type="hidden" name="total_amount" class="total-amount" value="{{ $ticket->price }}">

                                            <button type="submit" class="btn btn-success w-100 mt-2">Proceed to Checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>
    @else
    <p class="text-center">No events available at the moment.</p>
    @endif
    <!-- End price Area -->

    <!-- Start brand Area -->
    <section class="brand-area section-gap">
        <div class="container">
            <div class="row logo-wrap">
                <a class="col single-img" href="#">
                    <img class="d-block mx-auto" src="img/l1.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="d-block mx-auto" src="img/l2.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="d-block mx-auto" src="img/l3.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="d-block mx-auto" src="img/l4.png" alt="">
                </a>
                <a class="col single-img" href="#">
                    <img class="d-block mx-auto" src="img/l5.png" alt="">
                </a>
            </div>
        </div>
    </section>
    <!-- End brand Area -->


    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                        </p>
                        <p class="footer-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="icon-heart3" aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
                <div class="col-lg-5  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                                <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                </div>

                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="js/easing.min.js"></script>
    <script src="js/hoverIntent.js"></script>
    <script src="js/superfish.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>

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
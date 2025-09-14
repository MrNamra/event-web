<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRKI Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="SRKI Logo" style="height: 50px;">
                    </a>
                </div>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <div class="footer-logo">SRKI<span> Events</span></div>
                    <p class="footer-desc">SRKI is dedicated to creating positive change in communities through education, environmental conservation, and social empowerment.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#events"><i class="fas fa-chevron-right"></i> Events</a></li>
                        <li><a href="#team"><i class="fas fa-chevron-right"></i> Team</a></li>
                        <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3 class="footer-heading">Contact Info</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> MTB College Campus, Athwa Gate, Surat, Gujarat</a></li>
                        <li><a href="#"><i class="fas fa-phone"></i> +91 0261 2240172</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> yesha.mehta@srki.ac.in</a></li>
                    </ul>
                </div>
                {{-- <div class="footer-newsletter">
                    <h3 class="footer-heading">Newsletter</h3>
                    <p class="footer-desc">Subscribe to our newsletter to get updates on our activities and events.</p>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Subscribe</button>
                    </form>
                </div> --}}
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 All rights reserved.</p>
                <p>Developed by Namra Ramsha</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('js')
</body>
</html>
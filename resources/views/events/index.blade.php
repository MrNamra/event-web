@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Making a Difference Together</h1>
                <p>SRKI Hackthon is dedicated to creating positive change in communities through education, environmental
                    conservation, and social empowerment initiatives. Join us in our mission to build a better future for
                    all.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary">Get Involved</button>
                    {{-- <button class="btn btn-outline">Learn More</button> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <h2>We Are Committed To Making A Difference</h2>
                    <p>SRKI was founded in 2008 with a vision to create sustainable change in underserved communities. Our
                        work focuses on three core areas: education, environmental conservation, and social empowerment.</p>
                    <p>Through our various initiatives, we've impacted the students across SRKI collage.
                        Our approach combines grassroots activism with innovative solutions to address the world's most
                        pressing challenges.</p>
                    <div class="about-stats">
                        <div class="stat">
                            <div class="stat-number">5 +</div>
                            <div class="stat-text">Lives Impacted</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">12 +</div>
                            <div class="stat-text">Events</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">2 +</div>
                            <div class="stat-text">Volunteers</div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1504805572947-34fad45aed93?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
                        alt="About NexGen NGO" style="width: 100%; border-radius: 15px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events" id="events">
        <div class="container">
            <h2 class="section-title">Events</h2>
            <div class="events-grid">
                @php
                    $events = $events ?? [];
                @endphp
                @foreach($events as $event)
                    <div class="event-card">
                        <div class="event-img" style="background-image: url('{{ $event->banner_image }}');">
                        </div>
                        <div class="event-content">
                            <div class="event-date"><i class="far fa-calendar-alt"></i> {{ $event->start_data }}</div>
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-desc">{{ $event->short_des }}</p>
                            {{-- <div class="event-actions">
                                <button class="btn btn-primary">Register</button>
                                <button class="btn btn-outline">Details</button>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team" id="team">
        <div class="container">
            <h2 class="section-title">Our Team</h2>
            <div class="team-grid">
                @php
                    $teammembers = $teammembers ?? [];
                @endphp
                @foreach ($teammembers as $member)
                    <div class="team-member">
                        <div class="member-img"
                            style="background-image: url('/{{ $member->profile }}');">
                        </div>
                        <div class="member-content">
                            <h3 class="member-name">{{ $member->name }}</h3>
                            <div class="member-role">{{ $member->role }}</div>
                            <p class="member-desc">{{ $member->des }}</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Our Address</h3>
                            <p>MTB College Campus, Athwa Gate, Surat</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Phone Number</h3>
                            <p>+91 0261 2240172</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Email Address</h3>
                            <p>yesha.mehta@srki.ac.in</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="contact-form">
                    <h3 style="margin-bottom: 20px;">Send us a Message</h3>
                    <form>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Enter subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" class="form-control" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Contact Us | Nami Lontar')

@section('content')
<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="hero-bg">
        <img src="{{ asset('assets/about_hero_bg.png') }}" alt="Bakery Background">
    </div>
    <div class="contact-hero-content container">
        <span class="tag">LET'S TALK</span>
        <h1>Get in Touch</h1>
        <p>We’d love to hear from you. Whether you have a question about our pastries or want to place a custom order, our door is always open.</p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="contact-main container">
    <div class="contact-grid">
        <!-- Contact Form -->
        <div class="contact-form-container">
            <h2>Send a Message</h2>
            <form class="contact-form" action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">FULL NAME</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL ADDRESS</label>
                        <input type="email" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">SUBJECT</label>
                    <input type="text" id="subject" name="subject" placeholder="What is this about?" required>
                </div>
                <div class="form-group">
                    <label for="message">MESSAGE</label>
                    <textarea id="message" name="message" rows="6" placeholder="How can we help you?" required></textarea>
                </div>
                <button type="submit" class="btn-send">Send Message <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i></button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="contact-info-container">
            <h2>Our Bakery</h2>
            
            <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="info-text">
                    <h4>VISIT US</h4>
                    <p>123 Bakery Lane, Artisan District,<br>Pastryville, PV 90210</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="info-text">
                    <h4>CALL US</h4>
                    <p>+1 (555) 234-8890</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="info-text">
                    <h4>EMAIL US</h4>
                    <p>hello@namilontar.com</p>
                </div>
            </div>

            <div class="opening-hours">
                <h3>Opening hours</h3>
                <div class="hours-table">
                    <div class="hour-row">
                        <span class="day">Monday - Friday</span>
                        <span class="time">07:00 AM - 08:00 PM</span>
                    </div>
                    <div class="hour-row">
                        <span class="day">Saturday</span>
                        <span class="time">08:00 AM - 10:00 PM</span>
                    </div>
                    <div class="hour-row">
                        <span class="day">Sunday</span>
                        <span class="time active">08:00 AM - 06:00 PM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

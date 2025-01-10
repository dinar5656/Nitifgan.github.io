@extends('layouts.app')

@section('content')
<div class="contact-page">
    <!-- Hero Section with Parallax Effect -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="animate-fade-up">Get In Touch</h1>
            <p class="animate-fade-up">We're here to help and answer any questions you might have</p>
        </div>
    </div>

    <!-- Main Contact Section -->
    <div class="container">
        <!-- Contact Card -->
        <div class="contact-card animate-fade-up">
            <div class="contact-card-content">
                <div class="contact-info">
                    <div class="contact-header">
                        <h2>Contact Information</h2>
                        <p>Connect with us via WhatsApp for quick assistance</p>
                    </div>

                    <div class="contact-methods">
                        <a href="https://wa.me/6285840114000" class="contact-method whatsapp" target="_blank">
                            <div class="icon-wrapper">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="method-details">
                                <h3>WhatsApp</h3>
                                <p>Chat with us</p>
                            </div>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <div class="contact-method">
                            <div class="icon-wrapper">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="method-details">
                                <h3>Business Hours</h3>
                                <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
                                <p>Sat: 9:00 AM - 4:00 PM</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="icon-wrapper">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="method-details">
                                <h3>Location</h3>
                                <p>Jl. Dusun Tarahan, Kecamatan Katibung</p>
                                <p>Lampung Selatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-card animate-fade-up">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.4319962589584!2d105.31659631476567!3d-5.351555096115598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c59f1343b04d%3A0xc47527e89f3f0fcd!2sKatibung%2C%20South%20Lampung%20Regency%2C%20Lampung!5e0!3m2!1sen!2sid!4v1620827046374!5m2!1sen!2sid" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.contact-page {
    min-height: 100vh;
    background-color: #f8fafc;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}

/* Hero Section */
.hero-section {
    height: 60vh;
    min-height: 400px;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/path/to/your/hero-image.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
}

.hero-content {
    color: white;
    max-width: 800px;
    padding: 0 20px;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    letter-spacing: -0.5px;
}

.hero-content p {
    font-size: 1.25rem;
    opacity: 0.9;
}

/* Contact Card */
.contact-card {
    margin-top: -100px;
    margin-bottom: 40px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.contact-card-content {
    padding: 40px;
}

.contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.contact-header h2 {
    font-size: 2rem;
    color: #1a1a1a;
    margin-bottom: 10px;
}

.contact-header p {
    color: #666;
    font-size: 1.1rem;
}

/* Contact Methods */
.contact-methods {
    display: grid;
    gap: 20px;
    max-width: 800px;
    margin: 0 auto;
}

.contact-method {
    display: flex;
    align-items: center;
    padding: 25px;
    background: #f8fafc;
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.contact-method:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.contact-method.whatsapp {
    background: #25D366;
    color: white;
    text-decoration: none;
    justify-content: space-between;
}

.contact-method.whatsapp:hover {
    background: #128C7E;
}

.icon-wrapper {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
}

.contact-method:not(.whatsapp) .icon-wrapper {
    background: white;
}

.icon-wrapper i {
    font-size: 24px;
}

.method-details {
    flex: 1;
}

.method-details h3 {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: inherit;
}

.method-details p {
    color: inherit;
    opacity: 0.9;
    margin: 0;
    line-height: 1.4;
}

.contact-method:not(.whatsapp) .method-details h3 {
    color: #1a1a1a;
}

.contact-method:not(.whatsapp) .method-details p {
    color: #666;
}

.fa-arrow-right {
    font-size: 20px;
}

/* Map Card */
.map-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 40px;
}

.map-container {
    height: 450px;
}

.map-container iframe {
    width: 100%;
    height: 100%;
}

/* Animations */
.animate-fade-up {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animation Delays */
.hero-content h1 {
    animation-delay: 0.2s;
}

.hero-content p {
    animation-delay: 0.4s;
}

.contact-card {
    animation-delay: 0.6s;
}

.map-card {
    animation-delay: 0.8s;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .contact-card-content {
        padding: 30px 20px;
    }

    .contact-method {
        padding: 20px;
    }

    .icon-wrapper {
        width: 40px;
        height: 40px;
    }

    .icon-wrapper i {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .hero-content h1 {
        font-size: 2rem;
    }

    .hero-content p {
        font-size: 1rem;
    }

    .contact-header h2 {
        font-size: 1.5rem;
    }
}
</style>
@endsection
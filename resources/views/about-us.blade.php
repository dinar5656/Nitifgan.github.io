@extends('layouts.app')

@section('content')
<style>
    /* Modern Professional Styling */
    .about-page {
        font-family: 'Inter', sans-serif;
        color: #333;
        line-height: 1.6;
    }

    /* Hero Section */
    .about-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                    url('{{ asset("deskapp/vendors/images/Photoroom-20250106_105746.png") }}');
        background-size: cover;
        background-position: center;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-bottom: 80px;
    }

    .hero-content {
        max-width: 800px;
        padding: 0 20px;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    /* About Section */
    .about-section {
        max-width: 1200px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .about-image-container {
        position: relative;
    }

    .about-image {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .about-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 30px;
        color: #1a1a1a;
    }

    .about-content p {
        margin-bottom: 25px;
        font-size: 1.1rem;
        color: #555;
    }

    /* Stats Section */
    .stats-section {
        background-color: #f8f9fa;
        padding: 80px 0;
        margin-bottom: 100px;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #555;
    }

    /* Values Section */
    .values-section {
        max-width: 1200px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .values-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .values-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    .value-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-10px);
    }

    .value-icon {
        font-size: 2.5rem;
        color: #007bff;
        margin-bottom: 20px;
    }

    .value-card h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .about-grid {
            grid-template-columns: 1fr;
        }

        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .about-content h2 {
            font-size: 2rem;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .stats-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }
</style>

<div class="about-page">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="hero-content">
            <h1>NitifGan Delivery</h1>
            <p>Memudahkan Kehidupan Mahasiswa Sejak 2023</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="about-grid">
            <div class="about-image-container">
                <img src="{{ asset('deskapp/vendors/images/Photoroom-20250106_105746.png') }}" 
                     alt="NitifGan Delivery Store" 
                     class="about-image">
            </div>
            <div class="about-content">
                <h2>Kisah Kami</h2>
                <p>NitifGan Delivery lahir dari semangat untuk mempermudah kehidupan mahasiswa dalam memenuhi kebutuhan sehari-hari. Sebagai mahasiswa, kami memahami betapa padatnya aktivitas kuliah dan keterbatasan waktu seringkali menjadi tantangan besar.</p>
                <p>Kami percaya bahwa hidup di lingkungan kampus adalah tentang saling membantu dan mendukung satu sama lain. NitifGan Delivery hadir sebagai solusi praktis untuk menghubungkan mahasiswa yang membutuhkan barang tertentu dengan teman-teman yang bersedia membantu membelikan atau mengirimkan barang tersebut.</p>
                <p>Dengan komitmen pada kualitas layanan, harga yang terjangkau, dan kepercayaan antar mahasiswa, NitifGan Delivery terus berkembang untuk menjadi partner terbaik Anda dalam setiap kebutuhan.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5000+</div>
                <div class="stat-label">Pengiriman Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Kepuasan Pelanggan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Layanan Pelanggan</div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="values-header">
            <h2>Nilai-Nilai Kami</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">🤝</div>
                <h3>Kepercayaan</h3>
                <p>Kami membangun hubungan berdasarkan kepercayaan dan kejujuran dengan setiap pengguna layanan kami.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">⚡</div>
                <h3>Kecepatan</h3>
                <p>Kami berkomitmen untuk memberikan layanan yang cepat dan efisien untuk memenuhi kebutuhan Anda.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">💫</div>
                <h3>Inovasi</h3>
                <p>Kami terus berinovasi untuk memberikan solusi terbaik bagi komunitas mahasiswa.</p>
            </div>
        </div>
    </section>
</div>
@endsection
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- Newsletter -->
            <div class="subscribe-area">
                <h3>Get Our Newsletter</h3>
                <form class="subscribe-form">
                    <div class="form-group">
                        <input type="email" placeholder="Enter your email" required>
                        <button type="submit" class="btn-subscribe">Subscribe</button>
                    </div>
                </form>
            </div>

            <!-- Main Footer Content -->
            <div class="footer-widgets">
                <!-- Company Info -->
                <div class="footer-widget">
                    <div class="footer-logo">
                        <h2>NitifGan Delivery</h2>
                    </div>
                    <p>Your trusted e-commerce platform for quality products at affordable prices.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/share/15i919hRZd/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/devart124/?igsh=MXF3c3NjMGxzbnhmZA%3D%3D" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-widget">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('about.us') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Shop -->
                <div class="footer-widget">
                    <h4>Shop Now</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/collections') }}">Collections</a></li>
                        <li><a href="{{ url('/new-arrivals') }}">New Arrivals</a></li>
                        <li><a href="{{ url('/featured-products') }}">Featured Products</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-widget">
                    <h4>Contact Us</h4>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Jl. Dusun Tarahan<br>Kecamatan Katibung<br>Lampung Selatan</p>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <p>085840114000</p>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <p>dinarimanda9@gmail.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> NitifGan Delivery. All rights reserved.</p>
            </div>
            <div class="developer">
                <p>Made with <i class="fas fa-heart"></i> by Dinar Imanda</p>
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background-color: #f8f9fa;
    padding: 80px 0 0;
    font-family: 'Inter', sans-serif;
}

.footer-content {
    margin-bottom: 50px;
}

/* Newsletter Styles */
.subscribe-area {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 60px;
}

.subscribe-area h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.subscribe-form .form-group {
    display: flex;
    gap: 10px;
}

.subscribe-form input {
    flex: 1;
    padding: 15px 20px;
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    font-size: 14px;
}

.btn-subscribe {
    padding: 15px 30px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-subscribe:hover {
    background: #0056b3;
}

/* Footer Widgets */
.footer-widgets {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
    gap: 40px;
}

.footer-widget h4 {
    color: #333;
    font-size: 18px;
    margin-bottom: 25px;
    font-weight: 600;
}

.footer-logo h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.footer-widget p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links a {
    width: 36px;
    height: 36px;
    background: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s;
}

.social-links a:hover {
    background: #0056b3;
    transform: translateY(-3px);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #666;
    text-decoration: none;
    transition: all 0.3s;
}

.footer-links a:hover {
    color: #007bff;
    padding-left: 5px;
}

.contact-info {
    list-style: none;
    padding: 0;
    margin: 0;
}

.contact-info li {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    color: #666;
}

.contact-info i {
    color: #007bff;
    margin-top: 5px;
}

.contact-info p {
    margin: 0;
}

/* Footer Bottom */
.footer-bottom {
    padding: 20px 0;
    border-top: 1px solid #e1e1e1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.copyright p, .developer p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.developer i {
    color: #ff4444;
    margin: 0 3px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .footer-widgets {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .site-footer {
        padding: 50px 0 0;
    }

    .footer-widgets {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .subscribe-form .form-group {
        flex-direction: column;
    }

    .footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .social-links {
        justify-content: center;
    }
}
</style>
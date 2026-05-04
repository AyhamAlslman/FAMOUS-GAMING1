<?php
include 'includes/config.php';
$page_title = 'Services - FAMOUS GAMING';
include 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1>Premium Services</h1>
        <p>Luxury Gaming Experience - Professional Hospitality - Exclusive Amenities</p>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="services-amenities-section">
            <h2 class="section-title">Exclusive Amenities</h2>

            <div class="row g-4 services-grid">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-card h-100">
                        <div class="service-image">
                            <img src="images/service-gaming.png" alt="Gaming Experience" class="img-fluid">
                        </div>
                        <div class="service-card-content">
                            <h3>Gaming Excellence</h3>
                            <ul>
                                <li>Latest PS4 & PS5 Consoles</li>
                                <li>Premium Game Library</li>
                                <li>4K HDR Display Technology</li>
                                <li>Professional Controllers</li>
                                <li>VR Gaming Available</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-card h-100">
                        <div class="service-image">
                            <img src="images/service-food.png" alt="Hospitality" class="img-fluid">
                        </div>
                        <div class="service-card-content">
                            <h3>Premium Hospitality</h3>
                            <ul>
                                <li>Gourmet Beverages</li>
                                <li>Specialty Coffee Selection</li>
                                <li>Premium Snacks</li>
                                <li>Fresh Pizza & Sandwiches</li>
                                <li>In-Room Service</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-card h-100">
                        <div class="service-image">
                            <img src="images/service-event.png" alt="Events" class="img-fluid">
                        </div>
                        <div class="service-card-content">
                            <h3>Private Events</h3>
                            <ul>
                                <li>Luxury Birthday Packages</li>
                                <li>Professional Tournaments</li>
                                <li>Corporate Team Building</li>
                                <li>Bespoke Decorations</li>
                                <li>Exclusive Event Rates</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="why-choose-us-container">
            <h2 class="section-title why-choose-us-title">Why Choose Us</h2>
            <div class="row g-4 why-choose-us-grid">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="why-choose-us-item">
                        <div class="why-choose-us-icon">⚡</div>
                        <h4 class="why-choose-us-heading">Ultra-Fast Connectivity</h4>
                        <p class="why-choose-us-description">Zero-latency fiber connection</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="why-choose-us-item">
                        <div class="why-choose-us-icon">🎯</div>
                        <h4 class="why-choose-us-heading">Curated Collection</h4>
                        <p class="why-choose-us-description">Weekly updated game library</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="why-choose-us-item">
                        <div class="why-choose-us-icon">🛋️</div>
                        <h4 class="why-choose-us-heading">Luxury Environment</h4>
                        <p class="why-choose-us-description">Designer furniture and acoustics</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="why-choose-us-item">
                        <div class="why-choose-us-icon">🏆</div>
                        <h4 class="why-choose-us-heading">Elite Competitions</h4>
                        <p class="why-choose-us-description">Professional tournament hosting</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-cta-container">
            <a href="booking.php" class="btn services-cta-btn">Reserve Your Experience</a>
        </div>
    </div>
</section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>

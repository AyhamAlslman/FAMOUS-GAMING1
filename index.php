<?php
include 'includes/config.php';
$page_title = 'Home - FAMOUS GAMING';
include 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1>Welcome to FAMOUS GAMING</h1>
        <p>Experience Premium Gaming in Luxury</p>
        <p>State-of-the-Art Consoles - VIP Rooms - Professional Service</p>
    </div>
</section>

<section class="content">
    <div class="container">
        <h2 class="section-title">Our Premium Rooms</h2>

        <div class="row g-4 rooms-grid">
            <?php
            $rooms = mysqli_query($conn, "SELECT * FROM rooms ORDER BY id ASC");

            while ($room = mysqli_fetch_assoc($rooms)):
                $status_class = ($room['status'] == 'Available') ? 'status-available' : 'status-busy';
                $is_available = ($room['status'] == 'Available');
                $card_status_class = $is_available ? 'room-card-status-available' : 'room-card-status-busy';
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="room-card <?= $card_status_class ?> h-100">
                        <?php if (!empty($room['image_path']) && file_exists($room['image_path'])): ?>
                            <div class="room-image">
                                <img src="<?= htmlspecialchars($room['image_path']) ?>"
                                     alt="<?= htmlspecialchars($room['room_name']) ?>" class="img-fluid">
                            </div>
                        <?php else: ?>
                            <div class="room-image room-image-placeholder">🎮</div>
                        <?php endif; ?>

                        <h3><?= htmlspecialchars($room['room_name']) ?></h3>
                        <div class="room-type"><?= htmlspecialchars($room['room_type']) ?></div>
                        <div class="room-price"><?= number_format($room['price_per_hour'], 2) ?> JOD/hr</div>
                        <div class="room-card-actions">
                            <?php if ($is_available): ?>
                                <a href="booking.php?room_id=<?= (int)$room['id'] ?>#booking-form" class="btn btn-small room-book-btn">
                                    Book Now
                                </a>
                            <?php else: ?>
                                <span class="btn btn-small room-book-btn room-book-btn-disabled" aria-disabled="true">
                                    Booking Unavailable
                                </span> 
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="dashboard-stats homepage-stats">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card homepage-stat-card h-100">
                        <div class="homepage-stat-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="9" y="11" width="30" height="26" rx="6" class="stat-icon-stroke" stroke-width="2"/>
                                <path d="M17 24H25" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <path d="M21 20V28" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="31" cy="21" r="2.2" class="stat-icon-fill"/>
                                <circle cx="34.5" cy="25.5" r="2.2" class="stat-icon-fill"/>
                                <path d="M15 37L18.5 31" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <path d="M33 37L29.5 31" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="stat-number">6+</div>
                        <h3>Gaming Rooms</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card homepage-stat-card h-100">
                        <div class="homepage-stat-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="10" y="9" width="10" height="30" rx="3" class="stat-icon-stroke" stroke-width="2"/>
                                <rect x="28" y="13" width="10" height="22" rx="3" class="stat-icon-stroke" stroke-width="2"/>
                                <path d="M20 17H28" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 31H28" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="15" cy="32" r="1.8" class="stat-icon-fill"/>
                                <circle cx="33" cy="19" r="1.8" class="stat-icon-fill"/>
                            </svg>
                        </div>
                        <div class="stat-number">PS5 / PS4</div>
                        <h3>Consoles</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card homepage-stat-card h-100">
                        <div class="homepage-stat-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="15" class="stat-icon-stroke" stroke-width="2"/>
                                <path d="M24 14V24L30.5 27.5" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 10L18 14" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                                <path d="M33 10L30 14" class="stat-icon-stroke" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="stat-number">Open 7 Days</div>
                        <h3>Every Week</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card homepage-stat-card h-100">
                        <div class="homepage-stat-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 10L28.12 18.35L37.33 19.69L30.66 26.19L32.24 35.37L24 31.04L15.76 35.37L17.34 26.19L10.67 19.69L19.88 18.35L24 10Z" class="stat-icon-stroke" stroke-width="2" stroke-linejoin="round"/>
                                <circle cx="24" cy="23" r="2.3" class="stat-icon-fill"/>
                            </svg>
                        </div>
                        <div class="stat-number">Premium</div>
                        <h3>Experience</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="index-cta-container">
            <a href="booking.php" class="btn">Book Your Experience</a>
        </div>
    </div>
</section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>

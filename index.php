<?php
require_once 'koneksi.php';
require_once 'functions.php';

$ads = getAllAds();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kichi Dog Hub </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="raul.css">
    <style>
    /* General Styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html, body {
  height: 100%;
  font-family: 'Arial', sans-serif;
}

/* Slider Area */
.slider-area {
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: url('assets/img/pic/aa.webp') center center / cover no-repeat;
  position: relative;
}

.overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.1);
  z-index: 1;
}

.slider-content {
  z-index: 2;
  text-align: center;
  color: #fff;
  padding: 20px;
  max-width: 700px;
  width: 100%;
}

.slider-content .video-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 30px;
}

.slider-content .video-icon a {
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(255, 255, 255, 0.15);
  border: 2px solid #fff;
  border-radius: 50%;
  color: #fff;
  font-size: 24px;
  transition: 0.3s ease;
  box-shadow: 0 0 15px rgba(255,255,255,0.1);
  text-decoration: none;
}

.slider-content .video-icon a:hover {
  transform: scale(1.1);
  background-color: rgba(255, 255, 255, 0.3);
  box-shadow: 0 0 20px rgba(255,255,255,0.5);
}

.slider-content h1 {
  font-size: 48px;
  margin-bottom: 15px;
  font-weight: bold;
  color: rgb(255, 0, 128);
}

.slider-content span {
  font-size: 18px;
  display: block;
  margin-bottom: 10px;
}

.slider-content p {
  font-size: 18px;
  margin-bottom: 25px;
  color: rgb(182, 120, 151);
}

.slider-content .hero-btn {
  background-color: #fff;
  color: #000;
  text-decoration: none;
  padding: 12px 25px;
  font-weight: bold;
  border-radius: 30px;
  transition: background 0.3s ease;
}

.slider-content .hero-btn:hover {
  background-color: #ddd;
}

/* Partners Section */
.partners-section {
  padding: 80px 0;
  background-color: #f8f9fa;
}

.section-header h2 {
  font-size: 2.5rem;
  color: #333;
  font-weight: 700;
}

.section-header p {
  font-size: 1.2rem;
  color: #666;
}

.logo-slider-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
  position: relative;
}

.logo-slider {
  height: 200px;
  margin: auto;
  position: relative;
  width: 100%;
  overflow: hidden;
}

.logo-slide-track {
  display: flex;
  align-items: center;
  height: 100%;
  animation: scroll 40s linear infinite;
}

.logo-slide {
  min-width: 300px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 40px;
}

.logo-slide img {
  max-width: 100%;
  max-height: 120px;
  object-fit: contain;
  transition: all 0.3s ease;
  filter: grayscale(0%);
}

.logo-slide:hover img {
  transform: scale(1.15);
  filter: grayscale(0%) drop-shadow(0 5px 15px rgba(0,0,0,0.1));
}

/* Gradient edges */
.logo-slider-container:before,
.logo-slider-container:after {
  content: '';
  position: absolute;
  top: 0;
  width: 100px;
  height: 100%;
  z-index: 2;
}

.logo-slider-container:before {
  left: 0;
  background: linear-gradient(to right, rgba(248, 249, 250, 1) 0%, rgba(248, 249, 250, 0) 100%);
}

.logo-slider-container:after {
  right: 0;
  background: linear-gradient(to left, rgba(248, 249, 250, 1) 0%, rgba(248, 249, 250, 0) 100%);
}

/* Services Section */
.service-card {
  position: relative;
  background: #fff;
  border-radius: 12px;
  padding: 30px 25px;
  margin-bottom: 30px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.08);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  height: 100%;
  border: 1px solid rgba(255,107,107,0.1);
  overflow: hidden;
}

.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(255,107,107,0.15);
  border-color: rgba(255,107,107,0.3);
}

.service-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg,#F3066b 100%,#F3066b 100%);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
  color: #ffff;
  font-size: 32px;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(159, 29, 29, 0.3);
}

.service-card:hover .service-icon {
  transform: scale(1.1) rotate(5deg);
  background: linear-gradient(135deg, #f3066b 30%, #FF6B6B 70%);
}

.service-content h3 {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 15px;
  color: #333;
  text-align: center;
  position: relative;
  padding-bottom: 10px;
}

.service-content h3:after {
  content: '';
  position: absolute;
  width: 40px;
  height: 3px;
  background: linear-gradient(to right,rgb(0, 0, 0), #FF8E53);
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.service-content p {
  color: #666;
  margin-bottom: 20px;
  text-align: center;
  line-height: 1.6;
  font-size: 15px;
}

.service-btn {
  display: inline-block;
  padding: 10px 25px;
  background: transparent;
  color: #F3066b;
  border: 2px solid #FF6B6B;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  text-align: center;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: center;
  width: max-content;
  font-size: 14px;
}

.service-btn:hover {
  background: linear-gradient(to right, #c83d85, #f191bf);
  color: #fff;
  border-color: transparent;
  box-shadow: 0 5px 15px rgba(255,107,107,0.3);
}

.service-btn i {
  margin-left: 8px;
  transition: transform 0.3s ease;
}

.service-btn:hover i {
  transform: translateX(5px);
}

/* Header Button */
.header-btn {
  background: #FF6B6B;
  color: white;
  padding: 15px 30px;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  border: none;
  font-size: 16px;
  display: inline-block;
  text-align: center;
  text-decoration: none;
}

.header-btn:hover {
  background: #e04f0c;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(255, 94, 20, 0.3);
  color: white;
}

/* Dog Profile */
.dog-profile {
  display: flex;
  align-items: stretch; /* perubahan dari center ke stretch */
  gap: 40px;
  padding: 60px 0;
  min-height: 500px; /* tambahkan tinggi minimum */
}

.dog-profile__image {
  flex: 1;
  display: flex;
  overflow: hidden;
  border-radius: 12px;
}

.dog-image-wrapper {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.dog-profile__image img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* ubah dari contain ke cover */
  object-position: center;
  border-radius: 12px;
}

.dog-profile__content {
  flex: 1;
  padding: 20px;
}

.dog-profile__btn {
  display: inline-block;
  padding: 10px 25px;
  background: #FF6B6B;
  color: white;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.dog-profile__btn:hover {
  background: #e04f0c;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(255, 94, 20, 0.3);
}

/* Team Section */
.single-team {
  text-align: center;
  margin-bottom: 30px;
}

.team-img {
  margin-bottom: 20px;
  border-radius: 12px;
  overflow: hidden;
}

.team-img img {
  width: 100%;
  transition: transform 0.3s ease;
}

.team-img:hover img {
  transform: scale(1.05);
}

.team-caption span {
  display: block;
  color: #666;
  margin-bottom: 5px;
}

.team-caption h3 {
  font-size: 1.5rem;
  color: #333;
}

.team-caption h3 a {
  color: inherit;
  text-decoration: none;
}

/* Testimonial Section */
.testimonial-founder {
  text-align: center;
  margin-bottom: 30px;
}

.founder-img img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  margin: 0 auto 15px;
}

.founder-img span {
  display: block;
  font-weight: 600;
  color: #333;
  font-size: 1.2rem;
}

.founder-img p {
  color: #666;
}

.testimonial-top-cap p {
  font-size: 1.2rem;
  line-height: 1.6;
  color: #333;
  font-style: italic;
}

/* Contact Section */
.contact_text {
  text-align: center;
}

.white-btn {
  background: white;
  color: #333;
  padding: 12px 30px;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}

.white-btn:hover {
  background: #f1f1f1;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Footer */
.footer-logo img {
  max-height: 60px;
}

.footer-tittle h4 {
  font-size: 1.3rem;
  margin-bottom: 20px;
  color: #333;
}

.footer-tittle ul {
  list-style: none;
}

.footer-tittle ul li {
  margin-bottom: 10px;
}

.footer-tittle ul li a {
  color: #666;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-tittle ul li a:hover {
  color: #FF6B6B;
}

.footer-social {
  display: flex;
  gap: 15px;
  margin-top: 20px;
}

.footer-social a {
  color: #666;
  font-size: 1.5rem;
  transition: color 0.3s ease;
}

.footer-social a:hover {
  color: #FF6B6B;
}

.footer-copy-right {
  padding: 20px 0;
  color: #666;
}

/* Scroll Up Button */
#back-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 99;
}

#back-top a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background: #FF6B6B;
  color: white;
  border-radius: 50%;
  font-size: 1.5rem;
  transition: all 0.3s ease;
}

#back-top a:hover {
  background: #e04f0c;
  transform: translateY(-5px);
}

/* Animations */
@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-300px * <?= count($ads) ?>));
  }
}

/* Responsive Styles */
@media (max-width: 992px) {
  .logo-slide {
    min-width: 250px !important;
    padding: 0 30px !important;
  }
  
  .logo-slider {
    height: 180px !important;
  }
  
  .logo-slide img {
    max-height: 100px !important;
  }
  
  .dog-profile {
    flex-direction: column;
  }
}

@media (max-width: 768px) {
  .slider-content h1 {
    font-size: 28px;
  }

  .slider-content p,
  .slider-content span {
    font-size: 16px;
  }

  .slider-content .video-icon a {
    font-size: 30px;
    padding: 10px;
  }

  .slider-content .hero-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
  
  .logo-slide {
    min-width: 200px !important;
    padding: 0 20px !important;
  }
  
  .logo-slider {
    height: 150px !important;
  }
  
  .logo-slide img {
    max-height: 80px !important;
  }
  
  .section-header h2 {
    font-size: 2rem !important;
  }
  
  .section-header p {
    font-size: 1rem !important;
  }
  
  .service-card {
    padding: 25px 20px;
  }
  
  .service-icon {
    width: 70px;
    height: 70px;
    font-size: 28px;
  }
}

@media (max-width: 576px) {
  .logo-slide {
    min-width: 150px !important;
    padding: 0 15px !important;
  }
  
  .logo-slider {
    height: 120px !important;
  }
  
  .logo-slide img {
    max-height: 60px !important;
  }
  
  .partners-section {
    padding: 60px 0 !important;
  }
  
  .dog-profile__content h2 {
    font-size: 2rem;
  }
}


  </style>
    <!-- Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- jQuery (wajib untuk Magnific Popup) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Magnific Popup JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
<!-- Preloader Start -->
<div id="preloader-active" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: #fff; display: flex; justify-content: center; align-items: center; z-index: 9999;">
    <div style="max-width: 300px; width: 100%;">
        <div class="tenor-gif-embed"
            data-postid="11601357537675676687"
            data-share-method="host"
            data-aspect-ratio="1.52761"
            data-width="100%">
            <a href="https://tenor.com/view/darklajka-wsl-westsiberian-laika-running-dog-running-gif-11601357537675676687">Darklajka Wsl Sticker</a>
            from <a href="https://tenor.com/search/darklajka-stickers">Darklajka Stickers</a>
        </div>
    </div>
</div>
<script type="text/javascript" async src="https://tenor.com/embed.js"></script>
<!-- Preloader End -->


    <header>
        <!--? Header Start -->
        
        <!-- Header End -->
    </header>
    <main> 
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/alogo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav> 
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li><a href="services.php">Services</a></li>
                                            <li><a href="contact.php">Contact & Location</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                    <a href="services.php" class="header-btn">Book Now</a>
                                </div>
                            </div>
                        </div>   
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-area">
    <div class="overlay"></div>
    <div class="slider-content">
      <div class="video-icon">
        <a href="https://www.youtube.com/embed/UwHD0pseqkY?si=zAydvpzghx1L2jMs" target="_blank">
          <i class="fas fa-play"></i>
        </a>
      </div>
      <span>Kichi Dog Hub—Your Dog’s Second Home, Your First Choice.</span>
      <h1>Welcome to Kichi Dog Hub</h1>
      <p>DOG PARK - DOG POOL - DOG HOTEL - GROOMING - DOG ACADEMY</p>
      <a href="#contact-section" class="hero-btn" onclick="smoothScrollToContact()">Contact Now <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
         
<!-- Infinite Scroll Horizontal -->
<!-- Partners & Sponsors Section -->
<div class="partners-section" style="background-color: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="mb-3" style="font-size: 2.5rem; font-weight: 700; color: #333;">Our Valued Partners & Sponsors</h2>
            <p class="lead" style="font-size: 1.2rem; color: #666;">Proudly collaborating with industry leaders</p>
        </div>
        
        <div class="logo-slider-container" style="position: relative;">
            <div class="logo-slider" style="height: 200px; overflow: hidden;">
                <div class="logo-slide-track" style="display: flex; align-items: center; height: 100%; animation: scroll 40s linear infinite;">
                    <?php foreach ($ads as $ad): ?>
                        <div class="logo-slide" style="min-width: 300px; height: 100%; display: flex; align-items: center; justify-content: center; padding: 0 40px;">
                            <img src="<?= htmlspecialchars($ad['image_path']) ?>" alt="Partner Logo" style="max-width: 100%; max-height: 120px; object-fit: contain; filter: grayscale(0%); transition: all 0.3s ease;">
                        </div>
                    <?php endforeach; ?>
                    <!-- Duplicate for seamless looping -->
                    <?php foreach ($ads as $ad): ?>
                        <div class="logo-slide" style="min-width: 300px; height: 100%; display: flex; align-items: center; justify-content: center; padding: 0 40px;">
                            <img src="<?= htmlspecialchars($ad['image_path']) ?>" alt="Partner Logo" style="max-width: 100%; max-height: 120px; object-fit: contain; filter: grayscale(0%); transition: all 0.3s ease;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Gradient overlays -->
            <div style="position: absolute; top: 0; left: 0; width: 100px; height: 100%; background: linear-gradient(to right, rgba(248, 249, 250, 1) 0%, rgba(248, 249, 250, 0) 100%); z-index: 2;"></div>
            <div style="position: absolute; top: 0; right: 0; width: 100px; height: 100%; background: linear-gradient(to left, rgba(248, 249, 250, 1) 0%, rgba(248, 249, 250, 0) 100%); z-index: 2;"></div>
        </div>
    </div>
</div>


       <!-- Our Services Start -->
<div class="our-services section-padding30">
    <div class="container">
        <div class="row justify-content-sm-center">
            <div class="cl-xl-7 col-lg-8 col-md-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-70">
                    <span>Our Professional Services</span>
                    <h2>Best Dog Services In Town</h2>
                </div> 
            </div>
        </div>
        <div class="row">
            <!-- Dog Park -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div class="service-content">
                        <h3>Dog Park</h3>
                        <p>A safe, spacious area for your dogs to exercise and socialize with other dogs.</p>
                        <a href="park.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Dog Pool -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-swimming-pool"></i>
                    </div>
                    <div class="service-content">
                        <h3>Dog Pool</h3>
                        <p>Special swimming facilities designed for dogs with safety in mind.</p>
                        <a href="pool.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Dog Hotel -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div class="service-content">
                        <h3>Dog Hotel</h3>
                        <p>Luxurious boarding facilities for your pets when you're away.</p>
                        <a href="hotel.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Grooming -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <div class="service-content">
                        <h3>Grooming</h3>
                        <p>Professional grooming and spa treatments for your furry friends.</p>
                        <a href="groom.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Dog Academy -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="service-content">
                        <h3>Dog Academy</h3>
                        <p>Training programs for dogs of all ages and skill levels.</p>
                        <a href="academy.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Space -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="service-content">
                        <h3>Space</h3>
                        <p>Special area for space-themed dog activities and events.</p>
                        <a href="space.php" class="service-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Services End -->
            
           
       <!--? About Area Start-->
<div class="dog-profile">
  <div class="dog-profile__image">
    <div class="dog-image-wrapper">
      <img src="assets/img/shikoku/77.jpg" alt="Shikoku Inu">
    </div>
  </div>
  <div class="dog-profile__content">
    <h5>Our Signature</h5>
    <h2><strong>SHIKOKU - INU</strong></h2>
    <p><strong>The Shikoku Ken</strong> (四国犬, Shikoku-ken) or Kōchi-ken (高知犬) is a Japanese breed of dog from Shikoku island. Originally called "Tosa Inu", it was designated a Living National Monument of Japan in 1937 by the Nihon Ken Hozonkai (Japanese Dog Preservation Society). The name was later changed to avoid confusion with the Tosa Fighting Dog.</p>
    <p>This medium-sized hunting dog originates from the mountainous regions of Shikoku where they were used to hunt deer and wild boar. Characterized by their dense double coat, prick ears, and curled tail, they excel in rough terrain and make excellent hiking companions.</p>
    <p>As a rare breed, Shikoku Ken are primarily found in Japan and their numbers are gradually declining. Similar to other native Japanese breeds like the Kishu Ken, preservation efforts are crucial to prevent their disappearance.</p>
    <a href="shikoku.php" class="dog-profile__btn">Read More</a>
  </div>
</div>


<!-- About Area End-->
        <!--? Team Start -->
        <div class="team-area section-padding30">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>Meet our staff </span>
                            <h2>Our Professional Team</h2>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <!-- single Tem -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/pic/franss.webp" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Frans Nugroho</span>
                                <h3><a href="#">Founder</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/pic/ari.webp" alt="">
                            </div>
                            <div class="team-caption">
                                <span>King Ari</span>
                                <h3><a href="#">Senior Pet Groomer</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/pic/vio.webp" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Vio</span>
                                <h3><a href="#">Groomer</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/pic/rachel.webp" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Rachel</span>
                                <h3><a href="#">Minchi</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/pic/riski.webp" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Riski</span>
                                <h3><a href="#"></a>Groomer</h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Team End -->
        <!--? Testimonial Start -->
        <div class="testimonial-area testimonial-padding section-bg" data-background="assets/img/gallery/section_bg03.png">
            <div class="container">
                <!-- Testimonial contents -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-10">
                        <div class="h1-testimonial-active dot-style">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder">
                                        <div class="founder-img mb-40">
                                            <img src="assets/img/pic/frans.webp" alt="">
                                            <span>Frans Nugroho</span>
                                            <p>Founder of Kichi Dog Hub</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“Saya mendirikan Kichi Dog Hub dengan harapan menghadirkan tempat yang bukan hanya nyaman untuk para doggies, tapi juga menjadi ruang bersama bagi pawparents dan para pecinta anjing untuk bersosialisasi, saling berbagi, dan bertumbuh. Lewat Kichi, saya ingin menciptakan komunitas positif yang memberi dampak, mendukung UMKM, dan menyatukan kita semua dalam cinta terhadap anjing.”

                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        
        <!--? contact-animal-owner Start -->
        <div id="contact-section" class="contact-animal-owner section-bg" data-background="assets/img/gallery/section_bg04.png">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact_text text-center">
                            <div class="section_title text-center">
                                <h3>We're Here if You Need Anything</h3>
                                <p>Feel free to reach out – we'll respond as quickly as possible!</p>
                            </div>
                            <div class="contact_btn d-flex align-items-center justify-content-center">
                                <a href="contact.php" class="btn white-btn">Contact Us</a>
                                <p>Or <a href="https://wa.me/628568343569" style="margin-left: 10px;">
                                    <i class="fab fa-whatsapp" style="font-size: 32px; color: #25D366; vertical-align: middle;"></i>
                                    <span style="vertical-align: middle;">WhatsApp</span>
                                </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact-animal-owner End -->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                       <div class="single-footer-caption mb-50">
                         <div class="single-footer-caption mb-30">
                              <!-- logo -->
                             <div class="footer-logo mb-25">
                                 <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                             </div>
                             <div class="footer-tittle">
                                 <div class="footer-pera">
                                     <p>hi, have nice day! </p>
                                </div>
                             </div>
                             <!-- social -->
                             <div class="footer-social">
                                <a href="https://www.instagram.com/kichidoghub"><i class="fab fa-instagram"></i></a>
                                <a href="https://wa.me/628568343569"><i class="fab fa-whatsapp"></i></a>
                                <a href="https://www.youtube.com/@KichiDogHub"><i class="fab fa-youtube"></i></a>
                                <a href="https://yourwebsite.com"><i class="fas fa-globe"></i></a>
                            </div>
                         </div>
                       </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Company</h4>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="services.php">Services</a></li>
                                    <li><a href="contact.php">  Contact & Location</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Services</h4>
                                <ul>
                                    <li><a href="park.php">Dog Park</a></li>
                                    <li><a href="pool.php">Dog Pool</a></li>
                                    <li><a href="hotel.php">Dog Hotel</a></li>
                                    <li><a href="groom.php">Grooming</a></li>
                                    <li><a href="academy.php">Dog Academy</a></li>
                                    <li><a href="space.php">Space</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Get in Touch</h4>
                                <ul>
                                 <li><a href="https://wa.me/628568343569">+62 856-8343-569</a></li>
                                 <li><a href="mailto:kichidoghub@gmail.com"> kichidoghub@gmail.com</a></li>
                                 <li><a href="https://maps.app.goo.gl/EmPojSusm9n2UUKr7">Jl. Dieng No.9, Gajahmungkur, Kec. Gajahmungkur, Kota Semarang, Jawa Tengah 50232</a></li>
                             </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                     <div class="row d-flex align-items-center">
                         <div class="col-xl-12 ">
                             <div class="footer-copy-right text-center">
                                 <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
        
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.gallery-filter button');
            const galleryItems = document.querySelectorAll('.gallery-grid .col-lg-4');
        
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Hapus class 'active' dari semua button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Tambahkan class 'active' ke button yang diklik
                    this.classList.add('active');
                    
                    const filterValue = this.getAttribute('data-filter');
                    
                    galleryItems.forEach(item => {
                        if (filterValue === '*' || item.classList.contains(filterValue.replace('.', ''))) {
                            item.style.display = 'block'; // Tampilkan item
                        } else {
                            item.style.display = 'none'; // Sembunyikan item
                        }
                    });
                });
            });
        });
        </script>
        
    
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kontrol untuk infinite scroll
        const adScroll = document.getElementById('adScroll');
        const pauseBtn = document.getElementById('pauseBtn');
        const resumeBtn = document.getElementById('resumeBtn');
        const fasterBtn = document.getElementById('fasterBtn');
        const slowerBtn = document.getElementById('slowerBtn');
        
        if (adScroll && pauseBtn && resumeBtn && fasterBtn && slowerBtn) {
            pauseBtn.addEventListener('click', () => {
                adScroll.style.animationPlayState = 'paused';
            });
            
            resumeBtn.addEventListener('click', () => {
                adScroll.style.animationPlayState = 'running';
            });
            
            fasterBtn.addEventListener('click', () => {
                const currentDuration = parseFloat(getComputedStyle(adScroll).animationDuration);
                adScroll.style.animationDuration = `${Math.max(5, currentDuration - 5)}s`;
            });
            
            slowerBtn.addEventListener('click', () => {
                const currentDuration = parseFloat(getComputedStyle(adScroll).animationDuration);
                adScroll.style.animationDuration = `${currentDuration + 5}s`;
            });
        }
        
        // Slideshow otomatis
        const slides = document.querySelectorAll('.ad-slide');
        if (slides.length > 0) {
            let current = 0;
            
            function showNextAd() {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[current].classList.add('active');
                
                const duration = parseInt(slides[current].dataset.duration) || 5000;
                
                setTimeout(() => {
                    current = (current + 1) % slides.length;
                    showNextAd();
                }, duration);
            }
            
            showNextAd();
        }
    });
</script>
<script>
function smoothScrollToContact() {
    const contactSection = document.getElementById('contact-section');
    if (contactSection) {
        contactSection.scrollIntoView({
            behavior: 'smooth'
        });
    }
    return false; // Mencegah default anchor behavior
}

// Atau Anda bisa menggunakan jQuery jika sudah ada di proyek Anda
$(document).ready(function() {
    $('a[href="#contact-section"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#contact-section').offset().top
        }, 800);
    });
});
</script>

    </body>
</html>

<script>
    $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/watch',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id?autoplay=1'
                    }
                }
            }
        });
    });
    </script>
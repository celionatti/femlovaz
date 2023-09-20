<?php


use App\Core\Config;
use App\Core\Forms\BootstrapForm;
use App\Core\Support\Helpers\TimeFormat;
use App\Core\Support\Helpers\StringFormat;


$this->setTitle(Config::get('title') . ' | Home Page');


?>


<?php $this->start('content') ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Femlovaz Global Concepts Limited<span>.</span></h1>
                <h2>RC 1444593</h2>
            </div>
        </div>


    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="assets/img/about.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
                    <h3>Femlovaz Global Concepts Limited</h3>
                    <p class="fst-italic">
                        Femlovaz Global Concepts Limited is a dynamic and innovative company dedicated to providing a wide range of services to meet the diverse needs of our clients. With a commitment to excellence and customer satisfaction, we strive to deliver top-notch solutions in various domains. Our team of experts brings together expertise, experience, and creativity to ensure that every client receives personalized and efficient service.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Customized Solutions: We understand that each client's needs are unique. Our team works closely with you to tailor our services to your specific requirements, ensuring that you receive solutions that align with your goals and preferences.</li>
                        <li><i class="ri-check-double-line"></i> Responsive Customer Support: Our dedicated customer support team is available to assist you with inquiries, technical support, and guidance throughout your engagement with us. We pride ourselves on quick response times and effective solutions.</li>
                        <li><i class="ri-check-double-line"></i> Data Privacy and Security: Your privacy and security are paramount to us. Whether it's handling financial transactions or setting up CCTV systems, we adhere to strict data protection protocols to safeguard your information.</li>
                    </ul>
                    <p>
                        Femlovaz Global Concepts Limited is your one-stop destination for a diverse range of services, all designed to enhance your lifestyle, security, and technological capabilities. Contact us today to learn more about how we can assist you in achieving your goals.
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="assets/img/clients/1.svg" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/2.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/3.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/4.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/5.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/6.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/7.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/8.png" class="img-fluid" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="image col-lg-6" style='background-image: url("assets/img/features.jpg");' data-aos="fade-right"></div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-receipt"></i>
                        <h4>Expertise</h4>
                        <p>Our team consists of seasoned professionals with extensive experience in their respective fields, ensuring that you receive the highest quality of service.</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-cube-alt"></i>
                        <h4>Customer-Centric Approach</h4>
                        <p>We prioritize our clients' needs and go the extra mile to ensure their satisfaction. Your success is our success.</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-images"></i>
                        <h4>Innovation</h4>
                        <p>We stay at the forefront of technological advancements to offer cutting-edge solutions that meet the evolving demands of the modern world.</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-shield"></i>
                        <h4>Reliability</h4>
                        <p>Trust is the cornerstone of our business. You can rely on us for secure transactions, reliable products, and exceptional service.</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Check our Services</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tv"></i></div>
                        <h4><a href="satellite-details.html">Satellite TV Services (DSTV, GOTV) - Sales and Subscriptions</a></h4>
                        <p>we offer comprehensive satellite TV solutions, including sales of DSTV and GOTV packages as well as subscription services. Our goal is to provide you with uninterrupted access to a wide variety of entertainment options.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4><a href="solar-details.html">Inverter and Solar System (Sales and Installations)</a></h4>
                        <p>At Femlovaz, we promote sustainable energy solutions through the sale and installation of high-quality inverters and solar systems. We help you harness the power of renewable energy to reduce your carbon footprint and lower energy costs.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-cctv"></i></div>
                        <h4><a href="">CCTV Sales and Installation</a></h4>
                        <p>Security is a top priority for us. We offer state-of-the-art CCTV systems for both residential and commercial spaces, ensuring enhanced surveillance and peace of mind.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-bitcoin"></i></div>
                        <h4><a href="">Cryptocurrency and Digital Currency Services</a></h4>
                        <p>we specialize in the buying and selling of popular cryptocurrencies such as Bitcoin, Perfectmoney, and Webmoney. Our streamlined process ensures safe and efficient transactions, allowing you to navigate the world of digital currencies with ease.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-desktop"></i></div>
                        <h4><a href="">IT Consultancy</a></h4>
                        <p>Our IT consultancy services cater to businesses seeking to optimize their technological infrastructure. Our experts provide valuable insights and recommendations to enhance your IT systems, streamline processes, and improve overall efficiency.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-amazon"></i></div>
                        <h4><a href="">Gift Card Transactions</a></h4>
                        <p>We facilitate seamless transactions involving a variety of gift cards, including Apple iTunes, Steam Wallet, Amazon, Play Station, and Google Play Store gift cards. Our platform supports transactions using Bitcoin, Perfectmoney, Webmoney, and other digital currencies.</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>Ready to Experience Excellence?</h3>
                <p> Contact Femlovaz Global Concepts Limited today and embark on a journey to enhanced entertainment, sustainable energy, advanced security, and seamless digital transactions. Our team of experts is eager to assist you in finding the perfect solution for your needs..</p>
                <a class="cta-btn" href="#">Click here</a>
            </div>

        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

            <div class="row no-gutters">
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100"></div>
                <div class="col-xl-7 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
                    <div class="content d-flex flex-column justify-content-center">
                        <h3>Voluptatem dignissimos provident quasi</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                        </p>
                        <div class="row">
                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="bi bi-emoji-smile"></i>
                                    <span data-purecounter-start="0" data-purecounter-end="165000" data-purecounter-duration="2" class="purecounter"></span>
                                    <p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="bi bi-journal-richtext"></i>
                                    <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="2" class="purecounter"></span>
                                    <p><strong>Projects</strong> adipisci atque cum quia aspernatur totam laudantium et quia dere tan</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="bi bi-clock"></i>
                                    <span data-purecounter-start="0" data-purecounter-end="6" data-purecounter-duration="4" class="purecounter"></span>
                                    <p><strong>Years of experience</strong> aut commodi quaerat modi aliquam nam ducimus aut voluptate non vel</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="bi bi-award"></i>
                                    <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="4" class="purecounter"></span>
                                    <p><strong>Awards</strong> rerum asperiores dolor alias quo reprehenderit eum et nemo pad der</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Contact Us</p>
            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.978671700766!2d3.301692374183373!3d6.649565121687197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b912c7ab361e9%3A0x95179ba81f08e28a!2s378%20Lagos-Abeokuta%20Expy%2C%20Abule%20Egba%20101232%2C%20Lagos!5e0!3m2!1sen!2sng!4v1692440898439!5m2!1sen!2sng" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
            </div>

            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>378, Lagos Abeokuta Expressway, Beside Tantalizer. Abule Egba, Lagos State</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>femlovazltd@outlook.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+2348052865355</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php $this->end(); ?>
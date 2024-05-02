<?php
require_once "db_connection.php";
require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/aboutus.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/backgr.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h1 class="title">Our Story</h1>
            </div>
            <div class="card-container">
                <div class="card">
                    <img class="img-content" src="images/team.jpg" alt="">
                    <div class="content">
                        <p class="heading">Tutor Master</p>
                        <p style="font-weight: 600;">
                            Elevate your academic journey with our exceptional tutoring services designed for students aspiring to enter university. Lorem ipsum dolor sit amet,consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section1">
        <section class="company-info">
            <h2>About Tutor Masters</h2>
            <p>Tutor Masters is a leading education company dedicated to providing high-quality tutoring services to students of all ages. Our team of experienced tutors are experts in various subjects and are committed to helping students achieve their academic goals.</p>
            <p>At Tutor Masters, we believe in personalized learning and tailor our tutoring sessions to meet the unique needs of each student. Whether you need help with math, science, language arts, or test preparation, we have a tutor for you.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, quam possimus harum quas vitae eius et, nesciunt illo totam, rem dolorem accusamus impedit mollitia molestias quod. Non doloremque a ad.
                Voluptatum in quam, porro maxime laudantium nisi. Totam natus quia expedita quas! Nostrum impedit modi inventore quaerat voluptatem quis accusamus aliquam eveniet sint quam, odit in, temporibus distinctio officia quas?
                Accusamus harum similique numquam unde possimus omnis, error perferendis eos laudantium mollitia dolores tempore repellat quam distinctio, iusto, saepe quisquam dolore voluptatem voluptates? Molestias at voluptatum omnis architecto exercitationem est.
                Aperiam quia corrupti placeat saepe nihil deserunt labore sapiente repellat, voluptatibus officiis totam officia iste dolores voluptates id incidunt, earum magni repellendus ut atque! Sint fuga rerum et eveniet id!</p>
        </section>
    </div>
    <div class="container5">
        <div class="heading-container">
            <h5>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus saepe natus sit porro a, numquam voluptatem ab recusandae esse delectus dignissimos eaque cupiditate nobis cum quisquam rem. Rem, voluptatem suscipit!
                Nisi non ut dolores est repudiandae voluptas commodi delectus reiciendis? Adipisci totam mollitia eum, architecto fuga odio! Quia voluptate eos architecto excepturi aliquid corrupti asperiores ratione veniam necessitatibus, voluptas tempore!
                Officia deserunt voluptatum modi pariatur placeat minus, saepe vitae dicta aliquam maiores, voluptatibus, a rerum? Ratione debitis aut natus consequuntur quis. Deleniti omnis recusandae eveniet accusamus similique magnam! Voluptatum, deleniti!
                Eveniet dolorem excepturi libero, porro perferendis optio modi! Atque, voluptate facere. Non reiciendis ad, magni quae obcaecati corporis fuga soluta aspernatur quasi rem doloribus, distinctio esse iste, tempora voluptate id?
                Totam expedita velit sit culpa exercitationem eligendi accusantium suscipit inventore omnis sequi libero, mollitia nam vero praesentium ratione ut sunt rem non, dicta explicabo maxime voluptatum labore consequatur? Delectus, amet.</h5>
        </div>
        <div class="card-carousel">
            <div class="card" id="1">
                <div class="image-container"></div>
                <h2 class="name">Marianne Van Zeller</h2>
                <p>Expert tutor guiding students towards university success.</p>
            </div>
            <div class="card" id="2">
                <div class="image-container"></div>
                <h2 class="name">Ai WeiWei</h2>
                <p>Experienced educator mentoring students for university admissions.</p>
            </div>
            <div class="card" id="3">
                <div class="image-container"></div>
                <h2 class="name">Alicia Keys</h2>
                <p>Seasoned instructor helping students excel in university entrance.</p>
            </div>
            <div class="card" id="4">
                <div class="image-container"></div>
                <h2 class="name">Ulrich Løvenskjold</h2>
                <p>Accomplished mentor guiding students into university pathways.</p>
            </div>
            <div class="card" id="5">
                <div class="image-container"></div>
                <h2 class="name">Jessie Combs</h2>
                <p>Proven tutor facilitating students' journey to university acceptance.</p>
            </div>
        </div>
        <a href="#" class="visuallyhidden card-controller">Carousel controller</a>
    </div>

    <div id="Carousel-slider">
        <section>
            <div class="Carousel-slider">
                <!-- Background Images div -->
                <div class="slider-item superHero1" data-href="#"></div>
                <div class="slider-item superHero2" data-href="#"></div>
                <div class="slider-item superHero3" data-href="#"></div>
                <div class="slider-item superHero4" data-href="#"></div>
                <div class="slider-item superHero5" data-href="#"></div>
                <div class="slider-item superHero6" data-href="#"></div>
                <div class="slider-item superHero7" data-href="#"></div>
                <!-- Background Images div End -->
            </div>
        </section>
    </div>

    <div class="faq">
        <div class="container2">
            <div class="titleh2">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Why should I consider university tutoring?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>University tutoring can significantly improve your chances of getting accepted into your desired universities. Our tutors provide personalized guidance, help you prepare for entrance exams, and assist with application essays, increasing your overall competitiveness.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">How do university tutors help students?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>University tutors offer tailored support to students by identifying their strengths and weaknesses, creating customized study plans, providing resources and practice materials, offering feedback on academic performance, and guiding them through the university application process.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">What qualifications do your tutors have?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Our tutors are highly qualified professionals with extensive experience in university admissions and tutoring. They possess advanced degrees from prestigious universities, undergo rigorous training, and stay updated on the latest educational trends and techniques.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">How can I get started with university tutoring?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Getting started with university tutoring is easy. Simply contact us to schedule a consultation with one of our tutors. During the consultation, we'll assess your academic goals, discuss your tutoring needs, and create a personalized plan to help you succeed.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">What sets your university tutoring apart?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Our university tutoring stands out due to our personalized approach, experienced tutors, comprehensive resources, and track record of success. We prioritize the individual needs of each student, ensuring they receive the support and guidance necessary to excel academically and gain admission to top universities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/micro-slider@1.0.9/dist/micro-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <?php include "footer.php" ?>
</body>

</html>
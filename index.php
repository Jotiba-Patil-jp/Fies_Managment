<?php
// Establish the connection to MySQL Database
$con = mysqli_connect("localhost", "root", "", "sfm");

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    // Escape input data (optional with prepared statements)
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and execute the SELECT query
    $sel_user = "SELECT * FROM new_students WHERE email = ?";
    $stmt = mysqli_prepare($con, $sel_user);

    if ($stmt === false) {
        die("MySQL prepare error: " . mysqli_error($con));
    }

    // Bind the email parameter
    mysqli_stmt_bind_param($stmt, 's', $email);
    $execute_result = mysqli_stmt_execute($stmt);

    if ($execute_result === false) {
        die("MySQL execute error: " . mysqli_error($con));
    }

    $result = mysqli_stmt_get_result($stmt);
    $check_user = mysqli_num_rows($result);

    if ($check_user != 0) {
        // Email already exists
        echo "<script>alert('Already Applied.  We will contact you..!')</script>";
        echo "<script>window.open('index.php', '_parent')</script>";
    } else {
        // Prepare and execute the INSERT query
        $save = "INSERT INTO new_students (email, name, subject, message,date) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $save);

        if ($stmt === false) {
            die("MySQL prepare error: " . mysqli_error($con));
        }

        // Bind parameters for the INSERT query
        $date= date('Y-m-d H:i:s');
        mysqli_stmt_bind_param($stmt, 'ssss', $email, $name, $subject, $message,$date);
        $execute_result = mysqli_stmt_execute($stmt);

        if ($execute_result === false) {
            die("MySQL execute error: " . mysqli_error($con));
        }

        echo "<script>alert('Successfully Applied. We will contact you..!')</script>";
        echo "<script>window.open('index.php', '_parent')</script>";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Students</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
<!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
  </head>

<body>

  <!-- Sub Header -->
  <!-- <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <p>This is an educational <em>HTML CSS</em> template by TemplateMo website.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <div class="logo-container">
                        <a href="#"><img src="assets/images/logo.jpg" alt="College Logo" class="logo-image"></a>
                    </div>
                    <!-- ***** Logo End ***** -->
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                        <li><a href="meetings.html">Gallery</a></li>
                        <li class="scroll-to-section"><a href="#apply">Apply Now</a></li>
                        <li class="scroll-to-section"><a href="#courses">Courses</a></li> 
                        <li class="scroll-to-section"><a href="./Files/index.php">Login</a></li>
                        <li class="scroll-to-section"><a href="#contact">Contact Us</a></li> 
                    </ul>        
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- CSS Styling -->
<style>
    .header-area {
        background-color: #fff; /* Adjust as needed */
        padding: 10px 0; /* Adjust padding as needed */
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional shadow for effect */
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 20px; /* Adjust padding as needed */
    }

    .logo-image {
        height: 80px; /* Adjust as needed */
        width: auto;
        display: block;
    }

    .main-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav li {
        margin: 0 15px; /* Adjust spacing between menu items */
    }

    .nav a {
        text-decoration: none;
        color: #333; /* Adjust color as needed */
        font-weight: bold;
    }

    .nav a.active {
        color: #f00; /* Adjust active link color as needed */
    }

    .menu-trigger {
        display: none; /* Show only on mobile if needed */
    }

    @media (max-width: 768px) {
        .menu-trigger {
            display: block;
        }

        .nav {
            display: none; /* Hide menu items on mobile */
        }
    }
</style>

  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">
              <h6>Hello Students</h6>
              <h2>Welcome to DMS Mandal's College</h2>
              <p>Your journey to excellence in the world of technology starts here. Join us in exploring endless possibilities and shaping your career with cutting-edge knowledge and skills.
              <div class="main-button-red">
                  <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
              </div>
          </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->

  <section class="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel">
          
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-01.png" alt="">
              </div>
              <div class="down-content">
                <h4>Best Education</h4>
                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
              </div>
            </div>
            
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-02.png" alt="">
              </div>
              <div class="down-content">
                <h4>Best Teachers</h4>
                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
              </div>
            </div>
            
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-03.png" alt="">
              </div>
              <div class="down-content">
                <h4>Best Students</h4>
                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
              </div>
            </div>
            
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-02.png" alt="">
              </div>
              <div class="down-content">
                <h4>Online Meeting</h4>
                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
              </div>
            </div>
            
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-03.png" alt="">
              </div>
              <div class="down-content">
                <h4>Best Networking</h4>
                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="upcoming-meetings" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Upcoming Events</h2>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="categories">
            <h4>Collage offers</h4>
            <ul>
            <li><a href="#meetings">Scholarships for High Achievers</a></li>
        <li><a href="#">Internship Opportunities</a></li>
        <li><a href="#">Study Abroad Programs</a></li>
        <li><a href="#">Workshops and Seminars</a></li>
        <li><a href="#">Student Clubs and Organizations</a></li>
            </ul>
            <div class="main-button-red">
              <a href="meetings.html">Gallery</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                 
                  <a href="#meetings"><img src="assets/images/meeting-01.jpg" alt="New Lecturer Meeting"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Nov <span>10</span></h6>
                  </div>
                  <a href="#meetings"><h4>New Lecturers Meeting</h4></a>
<p>Welcome and network with fellow new lecturers<br>to share experiences and insights.</p>

                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                 
                  <a href="#meetings"><img src="assets/images/meeting-02.jpg" alt="Online Teaching"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Aug <span>24</span></h6>
                  </div>
                  <a href="meeting-details.html"><h4>Online Teaching Techniques</h4></a>
<p>Explore effective strategies and tools<br>for online teaching success.</p>

                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  
                  <a href="#meetings"><img src="assets/images/meeting-03.jpg" alt="Higher Education"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Aug <span>26</span></h6>
                  </div>
                  <a href=""><h4>Higher Education Conference</h4></a>
                  <p>The conference in Belgaum focuses on innovative<br>approaches in higher education.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                 
                  <a href="#meetings"><img src="assets/images/meeting-04.jpg" alt="Student Training"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Aug <span>30</span></h6>
                  </div>
                  <a href="#meeting"><h4>Student Training Meetup</h4></a>
<p>Join us for a hands-on training session<br>focused on student skill development.</p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="apply-now" id="apply">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
              <h3>UNLOCK YOUR FUTURE WITH OUR PROGRAMS</h3>
                <p>Join a community of innovators and leaders. Our programs are designed to provide you with the skills, knowledge, and experience needed to excel in today's competitive world.</p>
                <div class="main-button-red">
                    <div class="scroll-to-section"><a href="#contact">Apply Now!</a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
              <h3>DISCOVER YOUR POTENTIAL</h3>
                <p>Experience world-class education, state-of-the-art facilities, and unparalleled support. Our programs are crafted to help you achieve your career goals and make a positive impact.</p>
                <div class="main-button-yellow">
                    <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
                <div class="accordions is-first-expanded">
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>About Our College</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Our college offers a wide range of undergraduate and postgraduate programs designed to provide students with comprehensive education and hands-on experience. Join us to embark on a journey of academic excellence and career success.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Our Degree Programs</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>We offer a variety of degree programs including BCA, BBA, MBA, MCA, MA, and BSc. Each program is designed to cater to the evolving needs of the industry and to equip students with the skills required to excel in their chosen fields.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Student Life</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                Experience a vibrant campus life with a range of extracurricular activities, clubs, and organizations. Our college provides a supportive environment for personal and professional growth.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion last-accordion">
                        <div class="accordion-head">
                            <span>Contact Us</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>For more information about our programs, admissions, and campus life, please contact us. We are here to help you make an informed decision about your education and future career.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

  <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Our Popular Courses</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
            <div class="item">
              <img src="assets/images/course-01.jpg" alt="Course One">
              <div class="down-content">
                <h4>Bachelor of Computer Applications</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-02.jpg" alt="Course Two">
              <div class="down-content">
                <h4>Bachelor of Business Administration</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-03.jpg" alt="">
              <div class="down-content">
                <h4>Master of Arts <br>(MA)</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-04.jpg" alt="">
              <div class="down-content">
                <h4>Master of Science <br> (MSc)</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-01.jpg" alt="">
              <div class="down-content">
                <h4>Master of Business Administration (MBA)</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <!-- <div class="col-4">
                       <span>$250</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <h2>A Few Facts About Our Collage</h2>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content percentage">
                    <div class="count-digit">94</div>
                    <div class="count-title">Succesed Students</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">126</div>
                    <div class="count-title">Current Teachers</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content new-students">
                    <div class="count-digit">2345</div>
                    <div class="count-title">New Students</div>
                  </div>
                </div> 
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">32</div>
                    <div class="count-title">Awards</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
        <div class="col-lg-6 align-self-center">
          <div class="video">
            <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Let's get in touch</h2>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="name" type="text" id="name" placeholder="YOURNAME...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="YOUR EMAIL..." required="">
                  </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="subject" type="text" id="subject" placeholder="course*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..." required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                    
                     <button type="submit" name="login" class="button">
                     Apply Now!
                                </button>
                       
                    
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="right-info">
            <ul>
              <li>
                <h6>Phone Number</h6>
                <span>010-020-0340</span>
              </li>
              <li>
                <h6>Email Address</h6>
                <span>info@dmscollage.com</span>
              </li>
              <li>
                <h6>Street Address</h6>
                <span>Collage Road, Camp Belguam , 22795-008, India</span>
              </li>
              <li>
                <h6>Website URL</h6>
                <span>www.dmscollage.com</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 20224 . DMS's Mandals Collage Of Computer Applications
          <!-- <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p> -->
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          //  reqSectionPos = reqSection.offset().top - 0;

          // if (isAnimate) {
          //   $('body, html').animate({
          //     scrollTop: reqSectionPos },
          //   800);
          // } else {
          //   $('body, html').scrollTop(reqSectionPos);
          // }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>

</body>
</html>
<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Metrocity</title>
  <meta content="description" name="description">
  <meta content="keywords" name="keywords">

  <!-- Favicons -->
  <link href="icon.png" rel="icon">
  <link href="icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://yt3.ggpht.com/" rel="preconnect">
  <link href="https://i.ytimg.com/" rel="preconnect">
  <link href="https://fonts.gstatic.com/" rel="preconnect">
  <link href="https://googleads.g.doubleclick.net" rel="preconnect">
  <link href="https://www.google.com" rel="preconnect">
  <link href="https://static.doubleclick.net" rel="preconnect">
  <link href="https://jnn-pa.googleapis.com" rel="preconnect">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.1.0/css/glightbox.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.3.0/swiper-bundle.min.css" rel="stylesheet" />
  <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" media="all" async />-->
  <!--<link href="assets/lazyframe/dist/lazyframe.css" rel="stylesheet" />-->

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css?v=17" rel="stylesheet" />
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-PFKDXQDEYK"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-PFKDXQDEYK');
  </script>
  
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PJWNCWZ');</script>
<!-- End Google Tag Manager -->

  
  <!-- Meta Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '3177863002473520');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=3177863002473520&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <!-- <h1 class="text-light"><a href="index.html"><span>Moderna</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
         <a href="https://metrocityproperties.in/"><img src="Logo-Metrocity-White.png" alt="" class="img-fluid"></a>
      </div>
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJWNCWZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="home" href="https://metrocityproperties.in/">Home</a></li>
          <li><a class="about" href="about-us.php">About us</a></li>
          <li class="dropdown"><a class="projects" href="#"><span>Projects</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php
                $select_proj = "SELECT * FROM `projects` WHERE `status` = '1'";
                $res_proj = mysqli_query($con, $select_proj);
                if (mysqli_num_rows($res_proj) > 0)
                {
                  while($row_proj = mysqli_fetch_array($res_proj))
                  {
              ?>
              <li><a class="project_<?php echo $row_proj['p_id']; ?>" href="projects.php?id=<?php echo $row_proj['p_id']; ?>&title=<?php echo strtolower(str_replace(" ","-",$row_proj['p_name'])); ?>"><?php echo $row_proj['p_name']; ?></a></li>
              <?php
                  }
                }
              ?>
            </ul>
          </li>
          
          <li class="dropdown"><a class="media" href="#"><span>Media</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="news" href="news.php">News</a></li>
              <li><a class="adverts" href="promos.php">Advertisements</a></li>
              <li><a class="blog" href="blog.php">Blog</a></li>
            </ul>
          </li>
          <li class="dropdown"><a class="gallery" href="#"><span>Happy Customers</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="customer-booking" href="gallery.php?type=customer-booking">Customer Booking</a></li>
              <li><a class="saledeed" href="gallery.php?type=saledeed">Saledeed</a></li>
            </ul>
          </li>
          <li><a class="contact" href="contact-us.php">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
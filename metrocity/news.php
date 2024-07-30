<?php include 'header.php'; ?>
<main id="main">

    <!-- ======= Our Portfolio Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>News</h2>
          <ol>
            <li><a href="https://metrocityproperties.in/">Home</a></li>
            <li>News</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Portfolio Section -->

    <!-- ======= Portfolio Section ======= -->
    <section class="portfolio">
      <div class="container">

        <!-- <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div> -->

        <div class="row portfolio-container" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

          <?php
          	$select = "SELECT * FROM `news` WHERE `status` = '1' ORDER BY `news_id` DESC";
          	$result = mysqli_query($con, $select);

          	if(mysqli_num_rows($result) > 0)
          	{
          		while($row = mysqli_fetch_array($result))
          		{
          ?>
          <div class="col-lg-4 col-md-6 portfolio-wrap filter-app">
            <div class="portfolio-item">
              <img src="images/news/<?php echo $row['news_img']; ?>" class="img-fluid" alt="" loading="lazy">
              <div class="portfolio-info">
                <h3><?php echo $row['news_title']; ?></h3>
                <div>
                  <a href="images/news/<?php echo $row['news_img']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $row['news_title']; ?>"><i class="bi bi-eye"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php
      			 }
			     }
          ?>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
  $("#header").removeClass("header-transparent");
  $("#header .navbar a.media").addClass("active");
  $("#header .navbar a.news").addClass("active");
</script>
<?php include 'header.php'; ?>
<main id="main">
<?php
	if(isset($_GET['id']))
	{
		$select = "SELECT * FROM `blogs` WHERE `status` = '1' AND `blog_id` = '$_GET[id]'";
		$result = mysqli_query($con, $select);
		$row = mysqli_fetch_array($result);
?>
    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blogs</h2>

          <ol>
            <li><a href="https://metrocityproperties.in/">Home</a></li>
            <li><a href="blog.php">Blogs</a></li>
            <li><?php echo $row["blog_title"]; ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Blog Section -->
<?php
	}
	else
	{
?>
    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blogs</h2>

          <ol>
            <li><a href="https://metrocityproperties.in/">Home</a></li>
            <li>Blogs</li>
          </ol>
        </div>

      </div>
    </section><!-- End Blog Section -->
<?php
	}
?>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">
<?php
	if(isset($_GET['id']))
	{
		$select = "SELECT * FROM `blogs` WHERE `status` = '1' AND `blog_id` = '$_GET[id]'";
		$result = mysqli_query($con, $select);
		$row = mysqli_fetch_array($result);
?>
						<article class="entry entry-single">

              <div class="entry-img">
                <img src="images/blogs/<?php echo $row["blog_img"]; ?>" alt="" class="img-fluid" loading="lazy">
              </div>

              <h2 class="entry-title">
                <?php echo $row["blog_title"]; ?>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center">
                  	<i class="bi bi-clock"></i>
                  	<span><?php echo date("M d, Y", strtotime($row["blog_date"])); ?></span>
                  </li>
                </ul>
              </div>

              <div class="entry-content">
              	<?php echo $row["blog_content"]; ?>
              </div>

            </article><!-- End blog entry -->
<?php
	}
	else
	{
?>
						<div class="row">
<?php
		$select = "SELECT * FROM `blogs` WHERE `status` = '1' ORDER BY `blog_date` DESC";
		$result = mysqli_query($con, $select);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
?>          	
          		<div class="col-md-6">
          			<article class="entry">

		              <div class="entry-img">
		                <img src="images/blogs/<?php echo $row["blog_img"]; ?>" alt="" class="img-fluid" loading="lazy">
		              </div>

		              <h2 class="entry-title">
		                 <?php echo $row["blog_title"]; ?>
		              </h2>

		              <div class="entry-meta">
		                <ul>
		                  <li class="d-flex align-items-center">
		                  	<i class="bi bi-clock"></i>
		                  	<span><?php echo date("M d, Y", strtotime($row["blog_date"])); ?></span>
		                  </li>
		                </ul>
		              </div>

		              <div class="entry-content">
		                <?php echo substr($row["blog_content"], 0, 100).' ...'; ?>
		                <div class="read-more">
		                  <a href="blog.php?id=<?php echo $row["blog_id"]; ?>&title=<?php echo strtolower(str_replace(array(' ', '?', '/', ',', '\'', '.'), array('-', '', '', '', '-', ''), $row["blog_title"])); ?>" target="_blank">Read More</a>
		                </div>
		              </div>

		            </article><!-- End blog entry -->
          		</div>
<?php
			}
		}
?>
          	</div>

            <!-- <div class="blog-pagination">
              <ul class="justify-content-center">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
              </ul>
            </div> -->
<?php
	}
?>
          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">

              	<?php
              		$recent = "SELECT * FROM `blogs` WHERE `status` = '1' ORDER BY `blog_date` DESC";
              		$res_recent = mysqli_query($con, $recent);
              		if(mysqli_num_rows($res_recent) > 0)
              		{
              			while($row_recent = mysqli_fetch_array($res_recent))
              			{
              	?>
                <div class="post-item clearfix">
                  <img src="images/blogs/<?php echo $row_recent['blog_img']; ?>" alt="" loading="lazy">
                  <h4><a href="blog.php?id=<?php echo $row_recent["blog_id"]; ?>&title=<?php echo strtolower(str_replace(array(' ', '?', '/', ',', '\'', '.'), array('-', '', '', '', '-', ''), $row_recent["blog_title"])); ?>" target="_blank"><?php echo $row_recent['blog_title']; ?></a></h4>
                  <time datetime="<?php echo $row_recent["blog_date"]; ?>"><?php echo date("M d, Y", strtotime($row_recent["blog_date"])) ?></time>
                  <span></span>
                </div>
                <?php
                		}
                	}
              	?>

              </div><!-- End sidebar recent posts-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
  $("#header").removeClass("header-transparent");
  $("#header .navbar a.media").addClass("active");
  $(".navbar .dropdown ul a.blog").addClass("active");
</script>
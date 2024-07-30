<?php include 'header.php'; ?>
	<main id="main">

	    <!-- ======= Contact Section ======= -->
	    <section class="breadcrumbs">
	      <div class="container">

	        <div class="d-flex justify-content-between align-items-center">
	          <h2>Contact Us</h2>
	          <ol>
	            <li><a href="https://metrocityproperties.in/">Home</a></li>
	            <li>Contact Us</li>
	          </ol>
	        </div>

	      </div>
	    </section><!-- End Contact Section -->

	    <!-- ======= Contact Section ======= -->
	    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
	      <div class="container">

	        <div class="row">

	          <div class="col-lg-6">

	            <div class="row">
	              <div class="col-md-12">
	                <div class="info-box">
	                  <i class="bi bi-geo-alt"></i>
	                  <h3>Our Address</h3>
	                  <p>Satra Plaza, Office No. 408, Plot No. 19, Sector 19D,<br>Vashi, Navi Mumbai, Maharashtra 400703</p>
	                </div>
	              </div>
	              <div class="col-md-4">
	                <div class="info-box">
	                  <i class="bi bi-envelope"></i>
	                  <h3>Email Us</h3>
	                  <p><a href="mailto:info@metrocityproperties.in">info@metrocityproperties.in</a></p>
	                </div>
	              </div>
	              <div class="col-md-4">
	                <div class="info-box">
	                  <i class="bi bi-telephone"></i>
	                  <h3>Call Us</h3>
	                  <p><a href="tel:+919021500700">+91 90215 00700</a></p>
	                </div>
	              </div>
	              <div class="col-md-4">
	                <div class="info-box">
	                  <i class="bi bi-clock"></i>
	                  <h3>Mon - Sun</h3>
	                  <p>9:00AM - 8:00PM</p>
	                </div>
	              </div>
	            </div>

	          </div>

	          <div class="col-lg-6">
	            <form method="POST" role="form" class="php-email-form">
	              <div class="row">
	                <div class="col-md-6 form-group">
	                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
	                </div>
	                <div class="col-md-6 form-group mt-3 mt-md-0">
	                  <input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="mobile" id="mobile" placeholder="Your Contact No." required>
	                </div>
	              </div>
	              <div class="form-group mt-3">
	                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
	              </div>
	              <div class="form-group my-3">
	                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
	              </div>
	              <div class="text-center">
                    <button type="submit" name="contact">Send Message</button>
                  </div>
	            </form>
	          </div>

	        </div>

	      </div>
	    </section><!-- End Contact Section -->

	    <!-- ======= Map Section ======= -->
	    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.561092258494!2d73.00484261469761!3d19.08302568708399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c13af61ac423%3A0x7d660346e77664c3!2sSatra%20Plaza%2C%20Phase%202%2C%20Sector%2019D%2C%20Vashi%2C%20Navi%20Mumbai%2C%20Maharashtra%20400703!5e0!3m2!1sen!2sin!4v1649916494539!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="lazyframe"></iframe>
      	<!-- End Map Section -->

  </main><!-- End #main -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$("#header").removeClass("header-transparent");
	$("#header .navbar a.contact").addClass("active");
</script>

<?php
if (isset($_POST['contact']))
{
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $subject = mysqli_real_escape_string($con, $_POST['subject']);
  $message = mysqli_real_escape_string($con, $_POST['message']);

  $insert = "INSERT INTO `contact_us` (`name`, `mobile`, `subject`, `message`) VALUES ('$name', '$mobile', '$subject', '$message')";
  $result = mysqli_query($con, $insert);
  if ($result)
  {
    echo '
      <script>
       swal("Success", "Details Submitted Successfully","success").then( () => {
          location.href = ""
        })
      </script>
    ';
  }
  else
  {
    echo '
      <script>
        swal("Error", "There was a technical problem, please try again later!", "error").then( () => {
          location.href = ""
        })
      </script>
    ';
  }
}
?>
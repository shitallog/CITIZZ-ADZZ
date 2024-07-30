<?php
  date_default_timezone_set("Asia/Calcutta");
  include 'header.php';
  $currdate = date('Y-m-d');
?>
<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <!-- Slide 1 -->
            <div class="carousel-item active">
              <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">COMPLETE SOLUTIONS AS PER YOUR PROPERTY NEEDS</h2>
                <p class="animate__animated animate__fadeInUp d-none d-md-block">RS. 3 LAKHS ONWARDS EASY EMI LOAN AVAILABLE 0% INTEREST</p>
                <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->

                
                
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
              <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">ABOVE THE CROWD</h2>
                <p class="animate__animated animate__fadeInUp d-none d-md-block">RS. 3 LAKHS ONWARDS EASY EMI LOAN AVAILABLE 0% INTEREST</p>
                <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
              <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">MAKE YOUR DREAM HOUSE A REALITY</h2>
                <p class="animate__animated animate__fadeInUp d-none d-md-block">RS. 3 LAKHS ONWARDS EASY EMI LOAN AVAILABLE 0% INTEREST</p>
                <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->
              </div>
            </div>

            <!-- <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a> -->

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div id="card_enquiry" class="card animate__animated animate__fadeInUp mx-3" style="">
            <div class="card-body p-0">
              <form class="banner-enquiry-form" method="POST">
                <div class="row">
                  <div class="col-lg col-md-4 py-1">
                    <input type="text" class="form-control border-0" placeholder="Enter Full Name" name="fname" required>
                  </div>
                  <div class="col-lg col-md-4 py-1">
                    <input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control border-0" placeholder="Enter Mobile" name="mobile" required>
                  </div>
                  <div class="col-lg col-md-4 py-1">
                    <select class="form-control border-0" name="project">
                      <option>Select Project</option>
                      <?php
                        $sel_pj = "SELECT * FROM `projects` WHERE `status` = '1'";
                        $res_pj = mysqli_query($con, $sel_pj);
                        if(mysqli_num_rows($res_pj) > 0)
                        {
                          while($row_pj = mysqli_fetch_array($res_pj))
                          {
                      ?>
                      <option value="<?php echo $row_pj['p_name']; ?>"><?php echo $row_pj['p_name']; ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg col-md-12">
                    <input type="submit" name="send_enquiry" class="w-100 h-100" value="Send Enquiry">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">

        <div class="section-title">
          <h2>Featured Properties</h2>
          <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
        </div>

        <div class="row">
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex align-items-" data-aos="fade-up">
            <div class="icon-box icon-box-pink">
              <!-- <div class="icon"><i class="bi bi-piggy-bank"></i></div> -->
              <img src="images/properties/investment_copy2.gif" class="img-fluid" loading="lazy">
              <h4 class="title">Investment Plots</h4>
              <!-- <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p> -->
            </div>
          </div>

          <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex align-items-" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
              <!-- <div class="icon"><i class="bi bi-buildings"></i></div> -->
              <img src="images/properties/commercial_copy2.gif" class="img-fluid" loading="lazy">
              <h4 class="title">Commercial Plots</h4>
              <!-- <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p> -->
            </div>
          </div>

          <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex align-items-" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-green">
              <!-- <div class="icon"><i class="bi bi-building"></i></div> -->
              <img src="images/properties/residential_copy.gif" class="img-fluid" loading="lazy">
              <h4 class="title">Residential Plots</h4>
              <!-- <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p> -->
            </div>
          </div>

          <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex align-items-" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
              <!-- <div class="icon"><i class="bi bi-building-fill"></i></div> -->
              <img src="images/properties/bungalowplot_copy2.gif" class="img-fluid" loading="lazy">
              <h4 class="title">Bungalow / FarmHouse Plots</h4>
              <!-- <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p> -->
            </div>
          </div>

        </div>
        
      </div>
    </section><!-- End Services Section -->
    
    <!-- ======= Why Us Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 video-box px-0">
            <!-- <img src="assets/img/why-us.jpg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/4UuZVsB8W04" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy" class="lazyframe"></iframe>
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

              <h4 class="title">Dr. GIRISH OAK KA SAATH</h4>
              <p class="description">Har Budget Me Fit " Land Parcel "</p>
              <p class="description">Land Parcel Is Our Unique Budget Friendly Plots packages Which 100% Fits In Your Budget.</p>
              <ul>
                <li>True Value Land Parcel</li>
                <li>Prime Land Parcel</li>
                <li>Premium Land Parcel</li>
                <li>Gold Land Parcel</li>
                <li>Platinum Land Parcel</li>
              </ul>
              <p class="description">Choose Your Land Parcel & Book Your Plot Now</p>

          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
    <section class="features">
      <div class="container">

        <div class="section-title">
          <h2>Explore the Connectivities</h2>
        </div>

        <div class="row align-items-center shadow-lg" data-aos="fade-up">
          <div class="col-md-5 px-0">
            <img src="images/commercial/navi-mumbai2.gif" class="img-fluid w-100" alt="" loading="lazy">
          </div>
          <div class="col-md-7">
            <h3 class="mx-2">Navi Mumbai International Airport</h3>
            <p align="justify" class="mx-2 mb-4">
              Metrocity plots are located in the proximity of 15 min from the upcoming Navi Mumbai International Airport. Navi Mumbai international airport will be one of the largest greenfields. It will also have cutting-edge facilities and technologies to handle the projected traffic flow and cater to the best air travel experience in India, making it a preferred winged gateway to our region. Keeping in mind all the facilities and connectivity, a big opportunity for the investors to invest in the property.
            </p>
          </div>
        </div>

        <div class="row align-items-center shadow-lg" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2 px-0">
            <img src="images/commercial/sewri2.gif" class="img-fluid w-100" alt="" loading="lazy">
          </div>
          <div class="col-md-7 order-2 order-md-1">
            <h3 class="mx-2">Sewri - Nhava Sheva Sealink</h3>
            <p align="justify" class="mx-2 mb-4">
              The Mumbai Trans-Harbor Sea Link is a 21.8 Km extended bridge connecting Mumbai with Navi Mumbai. The bridge commences in Sewri, crosses Thane Creek north of Elephanta Island, and ends at Chirle village, near Nhava Sheva. Due to incredible connectivity from Mumbai to Navi Mumbai, the investors are taking a keen interest to invest in the nearby properties. As inflation rises, the prices of the property will rise 10x times. Metrocity plots are located in the proximity of 15 minutes from the Mumbai Trans-Harbor Sea Link.
            </p>
          </div>
        </div>

        <div class="row align-items-center shadow-lg" data-aos="fade-up">
          <div class="col-md-5 px-0">
            <img src="images/commercial/ranjanpada2.gif" class="img-fluid w-100" alt="" loading="lazy">
          </div>
          <div class="col-md-7">
            <h3 class="mx-2">Ranjanpada Railway Station</h3>
            <p align="justify" class="mx-2 mb-4">Ranjanpada railway station is a proposed rail project in Navi Mumbai, serving the nearby locations and Jasai areas;  owned by Indian railways and operated by central railways. With the announcement of the rail project, the prices of the land properties have been triggered. So, it is the right time for the investors to invest in the lands, as day by day the prices have been increasing. We are real estate consultants in the field of land estate. Helping the investors to buy properties nearby smoothly in the Ranjanpada areas.</p>
          </div>
        </div>

        <div class="row align-items-center shadow-lg" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2 px-0">
            <img src="images/commercial/chirle2.gif" class="img-fluid w-100" alt="" loading="lazy">
          </div>
          <div class="col-md-7 order-2 order-md-1">
            <h3 class="mx-2">Chirle Junction Connectivity</h3>
            <p align="justify" class="mx-2 mb-4">
              Chirle junction is the under-construction Mumbai Trans Harbour Link that connects Chirle with Sewri. A village in the Uran taluka of the Raigarh district. With the proposed Mumbai Trans-Harbor Sea Link, the village property has increased due to exemplary connectivity from Mumbai to Navi Mumbai. It is the right time for the investors to invest in the property. Our various plots are nearby to the locations which can be an eminent opportunity for the future investments.
            </p>
          </div>
        </div>
        
      </div>
    </section><!-- End Features Section -->
    
    <!-- ======= Service Details Section ======= -->
    <section class="service-details section-bg">
      <div class="container">

        <div class="row">

          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card section-bg">
              <div class="card-img">
                <img src="2.png" alt="..." class="img-fluid w-100" loading="lazy">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="#">Best Land Investments</a></h5>
                <p align="justify" class="card-text">We are a fast-growing real estate company in Mumbai that deals with land, plots, and farmhouses. We have a huge list of properties across Thane, Navi Mumbai, Pen, Karjat, Khalapur, and the Konkan region.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card section-bg">
              <div class="card-img">
                <img src="1.png" alt="..." class="img-fluid w-100" loading="lazy">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="#">Customer Satisfaction</a></h5>
                <p align="justify" class="card-text">At MetroCity, we focus on customer satisfaction and make it our priority to ensure that you are comfortable with all steps of the process. Our experienced sales associates are here to help you make the right decisions in buying your valuable land.</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Service Details Section -->
    
    <img src="images/Associate-web.jpg" class="img-fluid" data-aos="fade-up" date-aos-delay="200" loading="lazy">

  </main><!-- End #main -->

  <?php
    $banner = "SELECT * FROM `banner` WHERE `banner_date` = '$currdate' AND `status` = '1'";
    $res_b = mysqli_query($con, $banner);
    if (mysqli_num_rows($res_b) > 0)
    {
      while ($row_b = mysqli_fetch_array($res_b))
      {
  ?>
  <!-- The Modal -->
  <div class="ad_modal modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal body -->
        <div class="modal-body p-0">
        <button type="button" class="btn-close float-end" data-bs-dismiss="modal">
          <i class="bi bi-circle-x" aria-hidden="true"></i>
        </button>
          <img src="images/banner/<?php echo $row_b['banner_img']; ?>" class="img-fluid" loading="lazy">
        </div>

      </div>
    </div>
  </div>
  <?php
      }
    }
  ?>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$("#header .navbar a.home").addClass("active");
  	$(window).on('load', function()
    {
      $('#myModal').modal('show');
    });
</script>

<?php
if (isset($_POST['send_enquiry']))
{
  $name = mysqli_real_escape_string($con, $_POST['fname']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $project = mysqli_real_escape_string($con, $_POST['project']);

  $insert = "INSERT INTO `enquiry` (`name`, `mobile`, `project`) VALUES ('$name', '$mobile', '$project')";
  $result = mysqli_query($con, $insert);
  if ($result)
  {
    echo '
      <script>
       swal("Success", "Enquiry Submitted Successfully","success").then( () => {
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
<?php include 'header.php'; ?>
<style type="text/css">
  .location-section .container:nth-child(even) .row:nth-child(odd) {
    /*border: 4px solid;*/
}
</style>
  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs bg-white">
      <div class="container">
        <?php
          if(isset($_GET['id']))
          {
            $select = "SELECT * FROM `projects` WHERE `p_id` = '$_GET[id]' AND `status` = '1'";
            $result = mysqli_query($con, $select);
            $row = mysqli_fetch_array($result);
        ?>
        <div class="d-flex justify-content-between align-items-center">
          <h2>Projects</h2>
          <ol>
            <li><a href="https://metrocityproperties.in/">Home</a></li>
            <li>Projects</li>
            <li><?php echo $row['p_name']; ?></li>
          </ol>
        </div>
        <?php
          }
        ?>
      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 px-0">
            <img src="images/projects/<?php echo $row['p_img']; ?>" class="img-fluid w-100" alt="" loading="lazy">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center">

            <h3 class="pt-3 ms-0 ms-md-3"><?php echo $row['p_name']; ?></h3>
            <p align="justify" class="ms-0 ms-md-3"><?php echo $row['p_desc']; ?></p>

          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section class="why-us location-section" data-aos="fade-up" date-aos-delay="200">
      <h1 class="text-center mb-5">Choose your city for your <?php echo $row['p_name']; ?></h1>
    <?php
      if(isset($_GET['id']))
      {
        $select_img = "SELECT * FROM `project_imgs` WHERE `proj_id` = '$_GET[id]' AND `status` = '1'";
        $result_img = mysqli_query($con, $select_img);
        while($row_img = mysqli_fetch_array($result_img))
        {
    ?>
    
      <div class="container mb-5">

        <div class="row">          
          <div class="col-lg-6 px-0">
            <img src="images/projects/<?php echo $row_img['p_img']; ?>" class="img-fluid w-100" alt="" loading="lazy">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center">

            <h3 class="pt-3 ms-0 ms-md-3"><?php echo $row_img['location']; ?></h3>
            <p align="justify" class="ms-0 ms-md-3"><?php echo $row_img['location_desc']; ?></p>
			<button type="button" class="border-0 btn ms-0 ms-md-3 rounded-0 text-uppercase text-white w-25" style="background: #0969ad;" data-bs-toggle="modal" data-bs-target="#showForm">book now</button>
          </div>          
        </div>
      </div>
    
    <?php
        }
      }
    ?>
    </section><!-- End Why Us Section -->

  </main><!-- End #main -->

  <!-- The Modal -->
  <div class="modal fade" id="showForm">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-0 shadow-lg" style="background: #0969ad;">

        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h4 class="modal-title text-white">Enquiry</h4>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
        </div>

        <!-- Modal body -->
        <div class="modal-body">          
          <form method="POST" class="form">
            <div class="form-group mb-4 mx-4">
              <label class="mb-2 text-white">Full Name <span class="text-danger">*</span></label>
              <input type="text" name="fname" placeholder="Enter Full Name" class="form-control border-0 rounded-0 shadow" required>
            </div>

            <div class="form-group mb-4 mx-4">
              <label class="mb-2 text-white">Enter Mobile <span class="text-danger">*</span></label>
              <input type="tel" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" class="form-control border-0 rounded-0 shadow" placeholder="Enter Mobile" name="mobile" required>
            </div>

            <div class="form-group mb-4 mx-4">
              <label class="mb-2 d-block text-white">Select Location <span class="text-danger">*</span></label>
              <select class="form-control border-0 rounded-0 shadow" id="location" name="location[]" multiple style="width:100%;" required>
                <?php
                  $sel_loc = "SELECT DISTINCT `location` FROM `project_imgs` WHERE `status` = '1'";
                  $res_loc = mysqli_query($con, $sel_loc);
                  if(mysqli_num_rows($res_loc) > 0)
                  {
                    while($row_loc = mysqli_fetch_array($res_loc))
                    {
                ?>
                <option value="<?php echo $row_loc['location']; ?>"><?php echo $row_loc['location']; ?></option>
                <?php
                    }
                  }
                ?>
              </select>
            </div>

            <div class="form-group mb-4 mx-4 d-flex">
              <input type="submit" name="enquiry_project" class="btn btn-success w-50 m-1 border-0 rounded-0 shadow">
              <button type="button" class="btn btn-danger w-50 m-1 border-0 rounded-0 shadow" data-bs-dismiss="modal">Close</button>
            </div>

          </form>            
        </div>

      </div>
    </div>
  </div>
  <!-- End Modal -->

<?php include 'footer.php'; ?>
<script type="text/javascript">
  $("#header").removeClass("header-transparent");
  $("#header .navbar a.projects").addClass("active");
  $("#header .navbar a.project_<?php echo $_GET['id'] ?>").addClass("active");

  $(".location-section .container:nth-child(even) .row:nth-child(odd) .col-lg-6:first-child").addClass("order-0 order-lg-1");
  $(".location-section .container:nth-child(even) .row:nth-child(odd) .col-lg-6:last-child").addClass("order-1 order-lg-0");
  
  $(document).ready(function()
  {
    $("#location").select2({ placeholder: "Select Multiple Location", dropdownParent: $("#showForm") });
  });
</script>

<?php
if (isset($_POST['enquiry_project']))
{
  $name = mysqli_real_escape_string($con, $_POST['fname']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $location = mysqli_real_escape_string($con, implode(', ', $_POST['location']));

  $insert = "INSERT INTO `project_enquiry` (`name`, `mobile`, `location`) VALUES ('$name', '$mobile', '$location')";
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
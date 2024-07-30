(function () {
	"use strict";

	if($(".dataTable").length) var dataTable = $(".dataTable").DataTable({ "pageLength": 5 });

	$(document).ready(function() {
      if($('.image-popup').length)
      {
        $('.image-popup').magnificPopup({
          type: 'image',
          gallery: {
                enabled: true
              },
        });
      }
      
      $('#forgot-password').submit(function(e)
      {
        e.preventDefault();
        var forgotFormData = new FormData();
        forgotFormData.append('forgot_email', $('[name="forgot_email"]').val());
        $.ajax({
          url: "forgot_process.php",
          type: "POST",
          data: forgotFormData,
          cache: false,
          processData: false,
		  contentType: false,
          beforeSend: function()
          {
              $('[name="send_mail"]').attr('disabled', true).append('<i class="spinner-border spinner-border-sm ms-3"></i>');
          },
          success: function (response)
    	  {
            //$('#forgotmsg').html(response);
            if($(response).hasClass('alert-warning') || $(response).hasClass('alert-danger'))
            {
            	$('#forgotmsg').html(response);
              	$('[name="send_mail"]').attr('disabled', false).children('i').remove();
            }
            else
            {
              $('#forgotmsg').html(response);
              $('<form id="otp-verify" class="form" method="POST"><input type="hidden" name="forgot_email" value="'+$('[name="forgot_email"]').val()+'"><div class="input-group shadow-sm mb-3"><input type="number" name="otp" class="form-control" placeholder="Enter OTP to verify" required><button class="btn btn-success" type="submit" name="otp_verify" id="button-addon2">Verify</button></div></form>').insertAfter('#forgot-password');
              $('#forgot-password').remove();
            }
          },
          complete: function ()
          {            
              
              //$('[name="send_mail"]').attr('disabled', false).children('i').remove();
          }
      	});
      });
	});
	
	$(document).ready(function()
	{
		var toggle_sidebar = false,
		toggle_topbar = false,
		nav_open = 0,
		topbar_open = 0;

		if(!toggle_sidebar) {
			var $toggle = $('.sidenav-toggler');

			$toggle.click(function() {
				if (nav_open == 1){
					$('html').removeClass('nav_open');
					$toggle.removeClass('toggled');
					nav_open = 0;
				}  else {
					$('html').addClass('nav_open');
					$toggle.addClass('toggled');
					nav_open = 1;
				}
			});
			toggle_sidebar = true;
		}

		if(!toggle_topbar) {
			var $topbar = $('.topbar-toggler');

			$topbar.click(function(){
				if (topbar_open == 1) {
					$('html').removeClass('topbar_open');
					$topbar.removeClass('toggled');
					topbar_open = 0;
				} else {
					$('html').addClass('topbar_open');
					$topbar.addClass('toggled');
					topbar_open = 1;
				}
			});
			toggle_topbar = true;
		}

		//select all
		$('[data-select="checkbox"]').change(function(){
			var $target = $(this).attr('data-target');
			$($target).prop('checked', $(this).prop("checked"));
		});

	});

	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
	const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

	var checkarray = [];
  // Single input check
  $('[name="checksingle[]"]').each(function(key, element)
  {
    $(element).click(function()
    {
      if( $(element).is(":checked") )
      {
        $('[name="checkall[]"]').prop("checked", true);
        var check1 = $(this).val();
        if(!checkarray.includes(check1))
          checkarray.push(check1);
        $('input[name="deleteall[]"]').val(checkarray);
      }
      else
      {          
        var check2 = $(this).val();
        checkarray.splice(checkarray.indexOf(check2), 1);
        $('input[name="deleteall[]"]').val(checkarray);
        //console.log(checkarray);
        if(checkarray.length === 0)
        {
          $('[name="checkall[]"]').prop("checked", false);
        }
      }
    });
  });
  
	// Select all input check
  $('input[name="checkall[]"]').click(function()
  {
    if($(this).is(":checked"))
    {
      $('input[name="checksingle[]"]').each(function(key, element)
      {
        $(this).prop("checked", true);
        var check = $(this).val();
        if(!checkarray.includes(check))
          checkarray.push(check);
      });
      // console.log(checkportfolioarray);
      $('input[name="deleteall[]"]').val(checkarray);
    }
    else
    {
      $('input[name="checksingle[]"]').each(function(key, element)
      {
        $(this).prop("checked", false);
        checkarray = [];
      });
      $('input[name="deleteall[]"]').val('');
    }
  });

  $('#alldeleteform').submit(function()
  {
    if (confirm("Are you sure, you want to delete this?") == false)
    {
      return false;
    }
    else
    {
      $('#alldeleteform').unbind('submit').submit();
      return true;
    }
    return false;
  });
})();

/******** View Password on click **********/
function ShowPassword()
{
  var input = $(".input_generate");
  var eye = $(".eye_btn i");

  if (eye.hasClass('bi bi-eye-fill'))
  {
    eye.removeClass("bi bi-eye-fill");
    eye.addClass("bi bi-eye-slash-fill");
    input.attr('type', 'text');
  }
  else if (eye.hasClass('bi bi-eye-slash-fill'))
  {
    eye.removeClass("bi bi-eye-slash-fill");
    eye.addClass("bi bi-eye-fill");
    input.attr('type', 'password');
  }
}

/******** Universal delete function to warn before deleting data **********/
function deletefunc(e, url)
{
  e.preventDefault();
  swal({
    title: "Warning",
    text: "Are you sure, you want to delete this?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete)
    {
      location.href = url
    }
  });
}
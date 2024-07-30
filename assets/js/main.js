(function() {
	"use strict";

	/******** User Registration **********/
	if($("#RegisterForm").length)
	{
		const registerForm = $("#RegisterForm"), registerFormData = new FormData();
		registerForm.on("submit", function(e)
		{
			e.preventDefault();
			const registerInputArray = $(this).children().find("input");
			registerInputArray.each(function (key, value)
			{
				registerFormData.append($(this).attr("name"), $(this).val());
			});

			$.ajax({
				url: "signup_process.php",
				type: "POST",
      			data: registerFormData,
      			datatype: 'json',
      			cache: false,
      			processData: false,
      			contentType: false,
      			beforeSend: function()
      			{
      				registerForm.children('button').html('<div class="spinner-border spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span> </div> register now').attr("disabled", true);
      			},
      			success: function (response)
      			{
      				$.each(JSON.parse(response), function (i, v)
      				{
      					if (i =='success')
      					{
      						swal('Success', v, i)
					            .then(() => {
					              location.href = 'sign-in.php'
					        });
      					}
      					else if(i =='warning')
      					{
      						swal('Warning', v, i)
					            .then(() => {
					              // location.href = 'sign-up.php'
					        });
      					}
      					else
      					{
      						swal('Error', v, i)
					            .then(() => {
					              location.href = 'sign-up.php'
					        });
      					}
      				});
      			},
      			complete: function ()
      			{
      				registerForm.children('button').html('register now').attr("disabled", false);
      			}
			});
		});
	}

	/******** User Email Login **********/
	if($("#LoginWithEmail").length)
	{
		const loginEmailForm = $("#LoginWithEmail"), loginEmailFormData = new FormData();
		loginEmailForm.on("submit", function(e)
		{
			e.preventDefault();
			const loginEmailInputArray = $(this).children().find("input");
			loginEmailInputArray.each(function (key, value)
			{
				loginEmailFormData.append($(this).attr("name"), $(this).val());
			});

			$.ajax({
				url: "sign_email_process.php",
				type: "POST",
      			data: loginEmailFormData,
      			// datatype: 'json',
      			cache: false,
      			processData: false,
      			contentType: false,
      			beforeSend: function()
      			{
      				loginEmailForm.children('button').html('<div class="spinner-border spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span> </div> login').attr("disabled", true);
      			},
      			success: function (response)
      			{
      				$.each(JSON.parse(response), function (i, v)
      				{
      					if (i =='success')
      					{
      						swal('Success', v, i)
					            .then(() => {
					              location.href = 'index.php'
					        });
      					}
      					else
      					{
      						swal('Error', v, i)
					            .then(() => {
					              location.href = 'sign-in.php'
					        });
      					}
      				});
      			},
      			complete: function ()
      			{
      				loginEmailForm.children('button').html('login').attr("disabled", false);
      			}
			});
		});
	}

	/******** User Mobile Login **********/
	if($("#LoginWithMobile").length)
	{
		const loginMobileForm = $("#LoginWithMobile"), loginMobileFormData = new FormData();
		loginMobileForm.on("submit", function(e)
		{
			e.preventDefault();
			const loginMobileInputArray = $(this).children().find("input");
			loginMobileInputArray.each(function (key, value)
			{
				loginMobileFormData.append($(this).attr("name"), $(this).val());
			});

			$.ajax({
				url: "sign_mobile_process.php",
				type: "POST",
      			data: loginMobileFormData,
      			datatype: 'json',
      			cache: false,
      			processData: false,
      			contentType: false,
      			beforeSend: function()
      			{
      				loginMobileForm.children('button').html('<div class="spinner-border spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span> </div> login').attr("disabled", true);
      			},
      			success: function (response)
      			{
      				$.each(JSON.parse(response), function (i, v)
      				{
      					if (i =='success')
      					{
      						swal('Success', v, i)
					            .then(() => {
					              location.href = 'index.php'
					        });
      					}
      					else
      					{
      						swal('Error', v, i)
					            .then(() => {
					              location.href = 'sign-in.php'
					        });
      					}
      				});
      			},
      			complete: function ()
      			{
      				loginMobileForm.children('button').html('login').attr("disabled", false);
      			}
			});
		});
	}
  
  	/******** User Mobile Login **********/
	if($("#uforgot-password").length)
	{
      $('#uforgot-password').submit(function(e)
      {
          e.preventDefault();
          var uforgotFormData = new FormData();
          uforgotFormData.append('uforgot_email', $('[name="uforgot_email"]').val());
          $.ajax({
              url: "uforgot_process.php",
              type: "POST",
              data: uforgotFormData,
              cache: false,
              processData: false,
              contentType: false,
              beforeSend: function()
              {
                  $('[name="usend_mail"]').attr('disabled', true).append('<i class="spinner-border spinner-border-sm ms-3"></i>');
              },
              success: function (response)
              {
                  //$('#uforgotmsg').html(response);
                  if($(response).hasClass('alert-warning') || $(response).hasClass('alert-danger'))
                  {
                      $('#uforgotmsg').html(response);
                      $('[name="usend_mail"]').attr('disabled', false).children('i').remove();
                  }
                  else
                  {
                      $('#uforgotmsg').html(response);
                      $('<form id="uotp-verify" class="form" method="POST"><input type="hidden" name="uforgot_email" value="'+$('[name="uforgot_email"]').val()+'"><div class="input-group shadow-sm mb-3"><input type="number" name="uotp" class="form-control" placeholder="Enter OTP to verify" required><button class="btn btn-success" type="submit" name="uotp_verify" id="button-addon2">Verify</button></div></form>').insertAfter('#uforgot-password');
                      $('#uforgot-password').remove();
                  }
              },
              complete: function ()
              {
                  //$('[name="usend_mail"]').attr('disabled', false).children('i').remove();
              }
          });
      });
    }

	$(document).ready(function() {

    $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
			    enabled: true
			  },
    });

    if($('#pdf-canvas').length)
    {
	    // If absolute URL from the remote server is provided, configure the CORS
			// header on that server.
			var canvas = document.getElementById('pdf-canvas');
			// var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/examples/learning/helloworld.pdf';
			var url = canvas.getAttribute("url");

			// Loaded via <script> tag, create shortcut to access PDF.js exports.
			var pdfjsLib = window['pdfjs-dist/build/pdf'];

			// The workerSrc property shall be specified.
			pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

			// Asynchronous download of PDF
			var loadingTask = pdfjsLib.getDocument(url);
			loadingTask.promise.then(function(pdf)
			{
			  console.log('PDF loaded');
			  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page)
			  {
			    console.log('Page loaded');
			    
			    var scale = 1.5;
			    // var viewport = page.getViewport({scale: scale});

			    var viewport = page.getViewport({scale: canvas.width / page.getViewport({scale: 1}).width});

			    // Prepare canvas using PDF page dimensions
			    
			    var context = canvas.getContext('2d');
			    // canvas.height = viewport.height;
			    // canvas.width = viewport.width;

			    // Render PDF page into canvas context
			    var renderContext = {
			      canvasContext: context,
			      viewport: viewport
			    };
			    var renderTask = page.render(renderContext);
			    renderTask.promise.then(function () {
			      console.log('Page rendered');
			    });
			  });
			}, function (reason)
			{
			  // PDF loading error
			  console.error(reason);
			});
		}
		
	});
})();

/******** Check whether input value is number for contact number **********/
function isNumber(evt)
{
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  {
    swal('', "Please enter only Numbers.", 'warning');
    return false;
  }
  //phoneNo.value.length < 10 || phoneNo.value.length > 10              

  return true;
}

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

/******** Check User's Current Password **********/
function CheckUserPassword(current)
{
	const checkUserFormData = new FormData();
	checkUserFormData.append('oldpass', $('[name="current-password"]').val());
	$.ajax({
		url: "check_user_password.php",
		type: "POST",
		data: checkUserFormData,
		datatype: 'json',
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function()
		{
			current.attr('disabled', true).children('i').removeClass('bi-person-lock').addClass('spinner-border spinner-border-sm');
		},
		success: function (response)
    {
    	$.each(JSON.parse(response), function (i, v)
			{
				if (i =='success')
				{
					$('#userMSG').removeClass('text-danger').addClass('text-success').html(v);
					$('[name="new-password"]').attr('disabled', false);
					$('#newpassword').removeClass('d-none').addClass('d-block');
				}
				else
				{
					$('#userMSG').removeClass('text-success').addClass('text-danger').html(v);
					$('[name="new-password"]').attr('disabled', true);
					$('#newpassword').removeClass('d-block').addClass('d-none');
				}
			});
    },
		complete: function ()
		{
			current.attr("disabled", false).children('i').removeClass('spinner-border spinner-border-sm').addClass('bi-person-lock');
		}
	});
}
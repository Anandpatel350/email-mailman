<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <section class="pt-3">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body  py-2 px-5">
                <h2 class="text-uppercase text-left pt-2 mb-3">Create your account</h2>
                <!-- form -->
                <form method="post" action="" enctype="maltipart/form-data" id="formdata">
                  <span id="Formsubmit" class="text-danger"></span>

                  <div class="position-absolute w-25 end-0 me-5 mt-4">
                    <div><img src="pictures/piclogo.png" class="rounded-3 pb-3" style="width:150px" alt="Avatar" /></div>
                    <div><input type="file" id="Pic" name="avtar"></div>
                    <span id="picerr" class="text-danger"> </span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="FistName">First Name</label>
                    <input type="text" id="FirstName" class="w-50 form-control form-control-lg"  />
                    <span id="nameErr" class="text-danger"></span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="LastName">Last Name</label>
                    <input type="text" id="LastName" class="w-50 form-control form-control-lg"  />
                    <span id="lnameErr" class="text-danger"></span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="UserName">User Name</label>
                    <input type="text" id="UserName" class="w-50 form-control form-control-lg"  />
                    <span id="unemeErr" class="text-danger"></span>
                  </div>

                  <div class="form-outline mb-3">
                    <label class="form-label" for="email">Enter Your Email</label>
                    <div class="d-flex"><input type="text" id="Email" class="w-50 form-control form-control-lg"  />
                      <p class="pt-2 ps-2">@mailman.com</p>
                    </div>
                    <span id="emailErr" class="text-danger"></span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="AltEmail">Enter Your Recovery Email</label>
                    <input type="email" id="AltEmail" class="form-control form-control-lg"  />
                    <span id="cemailErr" class="text-danger"></span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="password">Enter New Password Here</label>
                    <div class="d-flex">
                      <input type="password" id="Password" class="form-control form-control-lg pe-5"  />
                      <i class="fas fa-question-circle ps-2"><img src="./pictures/q.png" alt="icon" style="width:20px;height:20px"></i>
                    </div>
                    <span id="passErr" class="text-danger"></span>
                  </div>

                  <div class="form-outline mb-3">
                    <label class="form-label" for="ConfirmPassword">Confirm password</label>
                    <input type="password" id="ConfirmPassword" class="form-control form-control-lg"  />
                    <span id="cpassErr" class="text-danger"></span>
                  </div>


                  <div class="form-check d-flex mb-5">
                    <label class="form-check-label" for="checkbox">
                      <input class="form-check-input me-2" type="checkbox" value="" id="checkbox" required />
                      I agree to the terms and conditions of ManMail
                    </label>
                  </div>

                  <div class="d-flex pb-5 pe-5">
                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body me-5" id="submitt" name="submit">Register</button>

                    <button type="button" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="signinst">Sign-in Instead</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
  $(document).ready(function() {
    $("#formdata").submit(function(e) {
      e.preventDefault();
      var error = 0;
      var FnameVal = $("#FirstName").val();
      var LnameVal = $("#LastName").val();
      var UserVal = $("#UserName").val();
      var EmailVal = $("#Email").val();
      var AltemailVal = $("#AltEmail").val();
      var PassVal = $("#Password").val();
      var CnfpassVal = $("#ConfirmPassword").val();

      var formData = new FormData();
      var file = document.querySelector('#Pic');
      formData.append("files", file.files[0]);
      formData.append("submit", true);
      formData.append("First_name", FnameVal);
      formData.append("Last_name", LnameVal);
      formData.append("User_Name", UserVal);
      formData.append("Email_name", EmailVal);
      formData.append("Atlemail_name", AltemailVal);
      formData.append("Passworda", PassVal);
      formData.append("ConfirmPassworda", CnfpassVal);


      $.ajax({
        url: "phpinclude/signup.php",
        data: (formData),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        type: 'POST',
        success: function(data) {

          if (!data.response) {
            // console.log(data.arrayvalue)
            $.each(data.arrayvalue, function(index, value) {
              // console.log(index + " --- "     + value);
                $("#" + index).html(value);
            });
            // foreach( in ) {
            // }        
          } else {
            location.href = "registrationssuccess.php"
          }
        }
      });

    });
    $('#signinst').click(function()
    {
      location.href = "index.php"
    })
  });
</script>

</html>
<!-- Jquary validation -->
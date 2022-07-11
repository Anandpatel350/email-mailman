<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <section class="vh-100 bg-image">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body  py-5 px-5">
                <h2 class="text-uppercase text-center pt-2 mb-4">Set New Password</h2>
  
                <form action="index.php" id="formfp">
                    <div class="form-outline mb-3">
                        <label class="form-label" for="">New Password</label>
                        <input type="text" id="password" class="form-control form-control-lg" />
                        <span id="passErr"> </span>
                      </div>
                      <div class="form-outline mb-3">
                          <label class="form-label" for="">Confirm Password</label>
                    <input type="text" id="passwordagain" class="form-control form-control-lg" />
                    <span id="cpassErr"> </span>
                  </div>
                  <div class="d-flex justify-content-between pt-4">
                      <div>
                        <button type="submit" class="btn btn-success" id="submit">Success</button>
                      </div>
                      <div class="float-right">
                        <a class="text-decoration-none text-success" href="index.html">Return To Login</a>
                      </div>
                  </div>
                </form>
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body><script>
$(document).ready(function() {
    var reset = "<?php echo $_GET['reset'];?>"
    var unique_id = "<?php echo base64_decode($_GET['unique_id']);?>"

    $("#formfp").submit(function(e) {
      e.preventDefault();
      var error=0;
      var PassVal = $("#password").val();
      var CnfpassVal = $("#passwordagain").val();
      var data={
        'submit':true,
        'Password':PassVal,
        'passwordagain':CnfpassVal,
        'link_data': reset,
        'user_id': unique_id

      }
      $.post("phpinclude/forgetpasswordbe.php", data,
      function (data, textStatus, jqXHR) {
        if(!data['response']){
          $("#"+data['error_id']).html(data['message'])
        }else{
          location.href="index.php"
        }
      },
      "JSON"
      );
    });
  });
  </script>
</html>

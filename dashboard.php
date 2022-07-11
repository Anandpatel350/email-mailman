<?php
include 'profileupdatedata.php';
if (!isset($_SESSION['Email'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./scsscode/mainpage.css" rel="stylesheet">
    <title>inbox</title>
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-light bg-success p-4  px-5">
        <a>
            <h2 class="text-light ms-5 ps-5"></h2>
        </a>
        <form class="form-inline ps-5 ms-5">
            <input class="form-control mr-2 ms-5 ps-5" type="search" placeholder="Search" aria-label="Search">
        </form>
        <div class="dropdown">
            <div class="d-flex py-2">
                <!-- username -->
                <button class="btn btn-outline-dark me-3" type="submit"><?php echo $_SESSION['Email']; ?></button>
                <?php
                $profile_url = !empty($data['Picture']) ? $data['Picture'] : 'piclogo.png';
                ?>

                <div><img src="images/<?php echo $profile_url; ?>" class="rounded-5 dropdown-toggle fixd" style="width:40px" alt="Avatar" data-bs-toggle="dropdown" aria-expanded="false" />
                    <ul class="dropdown-menu fix" aria-labelledby="dropdownMenu2">
                        <li><button class="dropdown-item" type="button"><a href="userprofile.php">Profile</a></button></li>
                        <li><button class="dropdown-item" type="button"><a href="phpinclude/logout.php">Log Out</a></button></li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-sm-3">
            <div class="SideBar">
                <a>
                    <h2 class="text-light  ps-4">MailMan</h2>
                </a>
                <div><button type="submit" class="btn btn-outline-dark bg-info mt-5 px-5 ms-2 my-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Compose</button></div>
                <ul class="list-group text-center w-50 ms-3 my-2">
                    <a href="" class="text-decoration-none">
                        <li class="list-group-item text-monospace my-2 btnindex">Inbox</li>
                    </a>
                    <a href="" class="text-decoration-none">
                        <li class="list-group-item text-monospace my-2 btnsend">Send</li>
                    </a>
                    <a href="" class="text-decoration-none">
                        <li class="list-group-item text-monospace my-2 btndraft">Draft</li>
                    </a>
                    <a href="" class="text-decoration-none">
                        <li class="list-group-item text-monospace my-2 btntrash">Trash</li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="container mt-5 ms-1">
                <div class="d-flex ">
                    <div class="form-check mt-2">
                        <label class="form-check-label " for="checkbox">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox" />
                            Select
                        </label>
                    </div>
                    <div><button class="btn btn-outline-dark mx-5" type="submit">Delete</button></div>
                    <div><button class="btn btn-outline-dark" type="submit">Read/Unread</button></div>
                </div>
                <div class="pt-5 justify-content-around">
                    <div class="card">
                        <h5 class="card-header">Inbox</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>abc@mailman.com</th>
                                        <th>subject</th>
                                        <th>YY/MM-DD</th>

                                    </tr>
                                    <tbody id="table-data">
                                        

                                    </tbody>
                                </table>


                            </div>
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- compose toggle -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" id="fData">
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">To:</label>
                                <input type="email" class="form-control" id="toname">
                                <span id="toemailErr" class="text-danger"></span>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">CC:</label>
                                <input type="email" class="form-control" id="ccname">
                                <span id="ccemailErr" class="text-danger"></span>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">BCC:</label>
                                <input type="email" class="form-control" id="bccname">
                                <span id="bccemailErr" class="text-danger"></span>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">SUBJECT:</label>
                                <input type="text" class="form-control" id="subject">
                            </div>
                            <div class="mb-2">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" rows="10" cols="50"></textarea>
                            </div>
                            <div>
                                <input type="file" id="attachment" name="myfile"><br><br>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit1">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#submit1").click(function(e) {
                    e.preventDefault(e);
                    //    alert("hello");
                    var tonameval = $("#toname").val();
                    var ccnameval = $("#ccname").val();
                    var bccnameval = $("#bccname").val();
                    var subnameval = $("#subject").val();
                    var messagetextval = $("#message-text").val();
                    var fData = new FormData();
                    var file = document.querySelector('#attachment');
                    fData.append("files", file.files[0]);
                    fData.append("submsg", true);
                    fData.append("to_name", tonameval);
                    fData.append("cc_name", ccnameval);
                    fData.append("bcc_name", bccnameval);
                    fData.append("sub_name", subnameval);
                    fData.append("text_name", messagetextval);
                    jQuery.ajax({
                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: (fData),
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data['response']) {
                                alert(data['message']);
                                location.href = "dashboard.php"
                            }
                            else{
                                $("#" + data['error_id']).html(data['message'])
                            }

                        }
                    });
                });

                $(".btnsend").click(function(e) {
                    e.preventDefault(e);
                    //    alert("hello");
                    jQuery.ajax({
                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            sendItem: true
                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.msg + "</h1>");
                            } else {
                                $("#table-data").empty();
                                $.each(data, function(index, value) {
                                    $("#table-data").append("<tr><td>" + value.to_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });
                $(".btnindex").click(function(e) {
                    e.preventDefault(e);
                    //    alert("hello");
                    jQuery.ajax({
                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            inboxitem: true
                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.msg + "</h1>");
                            } else {
                                $("#table-data").empty();
                                $.each(data, function(index, value) {
                                    
                                    $("#table-data").append("<tr><td>" + value.from_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });
                $(".btndraft").click(function() {
                    alert("draft button click");
                });
                $(".btntrash").click(function() {
                    alert("trash button click");
                });
            });
        </script>
</body>

</html>
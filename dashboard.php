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
    <!-- <link href="./scsscode/mainpage.css" rel="stylesheet"> -->
    <title>inbox</title>
    <!-- newcss -->
    <style>
      
        body {
            margin: 0;
            padding: 0;
            /* font-family: "Lato", sans-serif; */
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 400px;
            background-color: #f1f1f1;
            position: absolute;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
            text-align: center;
        }



        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }


        .sidebar a:hover:not(.buttonq) {

            color: red;
        }

        div.content {
            margin-left: 430px;
            margin-top: 50px;
            padding: 1px 16px;
            height: auto;
            /* width: 70%; */
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            div.content {
                margin-left: 0;
            
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }
      
    </style>

    <!-- 00000000000000 -->
</head>

<body>
    <!-- new html -->
    <nav class="navbar navbar-light bg-success">
        <div class="container-fluid m-3">
            <a class="navbar-brand">
                <h1 class="text-light ms-2">Mail Man</h1>
            </a>
            <form>
                <input type="search" class="form-control rounded px-5" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id="search-item" />
            </form>
            <div class="dropdown">
                <div class="d-flex">
                        <!-- username -->
                        <button class="btn btn-outline-dark me-3" type="submit"><?php echo $_SESSION['Email']; ?></button>
                        <?php
                        $profile_url = !empty($data['Picture']) ? $data['Picture'] : 'piclogo.png';
                        ?>
                    
                        <div><img src="images/<?php echo $profile_url; ?>" class="rounded-5 dropdown-toggle fixd" style="width:50px" alt="Avatar" data-bs-toggle="dropdown" aria-expanded="false" />
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item text-center" type="button"><a href="userprofile.php">Profile</a></button></li>
                                <li><button class="dropdown-item text-center" type="button"><a href="phpinclude/logout.php">Log Out</a></button></li>
                            </ul>

                        </div>
                    
                </div>
            </div>

        </div>
    </nav>

   
    <!-- netatable -->
    <div class="sidebar">
        <div class="mt-3">
        <a ><div><button type="submit" class="btn btn-outline-dark bg-info px-5 " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Compose</button></div></a>
        <a href="#news" class="btninbox">Inbox</a>
        <a href="#contact" class="btnsend">Send</a>
        <a href="#about" class="btndraft">Draft</a>
        <a href="#about" class="btntrash">Trash</a>
        </div>
    </div>

    
        <div class="content">

        <div class="col-sm-12">
            <div class="container">
                <div class="d-flex ">
                    <div><button class="btn btn-outline-dark mx-5" style="display:none" id="del" type="submit">Delete</button></div>
                    <div><button class="btn btn-outline-dark " style="display:none" id="ru" type="submit">Read/Unread</button></div>
                </div>
                <div class="pt-3">
                    <div class="card">
                        <h5 class="card-header" id="heading">Inbox</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <div id="table_head">
                                        <tr>
                                            <th></th>
                                            <th>@mailman.com</th>
                                            <th>subject</th>
                                            <th>YY/MM-DD</th>

                                        </tr>
                                    </div>
                                    <tbody id="table-data">


                                    </tbody>
                                </table>


                            </div>
                            <nav aria-label="Page navigation example " id="paggi">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="sideclose"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" id="fData">
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">To:</label>
                                <input type="email" class="form-control" id="toname">

                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">CC:</label>
                                <input type="email" class="form-control" id="ccname">

                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">BCC:</label>
                                <input type="email" class="form-control" id="bccname">

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closed">Close</button>
                        <button type="button" class="btn btn-primary" id="submit1">Send message</button>
                    </div>
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
                $("tr").show();
                $("#paggi").show();
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

                                $("#table-data").append("<tr data-id=" + value.id + "><td><input type='checkbox' class='check' data-id=" + value.id + "></td><td>" + value.from_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                            });
                        }

                    }
                });
              
                // -----------------------open mail-------------
                $(document).on("click", "tr", function(e) {

                    e.preventDefault(e);

                    $("#table-data").html("");
                    $("#heading").html("mail box");
                    $("tr").hide();
                    $("#paggi").hide();

                    var trval = $(this).attr('data-id');
                    jQuery.ajax({

                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'selectrow': trval


                        },
                        success: function(data) {
                            var tab = '';
                            $.each(data, function(index, value) {
                                tab += '<div class="container">';
                                tab += '<div class="panel-body">';
                                tab += '<div class="panel-body">';
                                tab += '  <div class="row">'
                                tab += '<div class="col-sm-6">'
                                tab += ' <h6>from: ' + value.from_email + '</h6><br>'
                                tab += '   <h6>to: ' + value.to_email + '</h6><br>'
                                tab += ' </div>'
                                tab += ' <div class="col-sm-6">'


                                tab += ' <h6>Date:' + value.time + '</h6>'
                                tab += '</div>'
                                tab += '</div>'
                                tab += ' <div class="row">'
                                tab += '  <div class="col-sm-12" > <h6>Subject:' + value.subject + ' </h6></div><br><br>'
                                tab += '</div>'
                                tab += ' <div class="row" >'

                                tab += '<div class="col-sm-12" > <p> message:-  ' + value.message + '</p></div>  '
                                tab += '</div>'
                                tab += '</div>'
                                tab += '</div>'
                                tab += '</div>'

                            });

                            $("#table-data").append(tab);
                        }
                    });

                });
                // ---------------------------------------------
                //-----------------------search bar------------
                $("#search-item").on("keyup", function(e) {
                    e.preventDefault(e);
                    $("#heading").html("Search Items");
                    var searchval = $("#search-item").val();
                    jQuery.ajax({

                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'searchitem': true,
                            'serchtext': searchval


                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.msg + "</h1>");
                            } else {
                                $("#table-data").empty();
                                $.each(data, function(index, value) {
                                    $("#table-data").append("<tr data-id=" + value.id + "><td><input type='checkbox' class='check' data-id=" + value.id + "></td><td>" + value.to_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });


                // ---------------------draft auto saved------
                $("#closed,#sideclose").click(function(e) {
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
                    fData.append("draftdata", true);
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
                                alert(data['message'])
                                location.href = "dashboard.php"
                            } else {
                                $("#" + data['error_id']).css('border', '1px solid red')



                            }

                        }
                    });
                });
                // ------------

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
                                alert(data['message'])
                                location.href = "dashboard.php"
                            } else {
                                // $("#" + data['error_id']).html(data['message'])
                                $("#" + data['error_id']).css('border', '1px solid red')
                                // const myTimeout = setTimeout(myGreeting, 8000);

                                // function myGreeting() {
                                //     $("#" + data['error_id']).css('border-color', '#ced4da')
                                // }

                            }

                        }
                    });
                });
                $('.btninbox').click(function()
                {
              location.href="dashboard.php"
                });
                $(".btnsend").click(function(e) {

                    e.preventDefault(e);
                    $("tr").show();
                    $("#paggi").show();
                    $("#heading").html("Send Item");
                    // --------------------------------------------------
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
                                    $("#table-data").append("<tr data-id=" + value.id + "><td><input type='checkbox' class='check' data-id=" + value.id + "></td><td>" + value.to_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });
                $(".btntrash").click(function(e) {
                    e.preventDefault(e);
                    $("tr").show();
                    $("#paggi").show();
                    $("#heading").html("Trash Item");
                    // --------------------------------------------------
                    //    alert("hello");
                    jQuery.ajax({
                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            sendItemd: true
                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.msg + "</h1>");
                            } else {
                                $("#table-data").empty();
                                $.each(data, function(index, value) {
                                    $("#table-data").append("<tr data-id=" + value.id + "><td><input type='checkbox' class='check' data-id=" + value.id + "></td><td>" + value.to_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });
                // -------------------draft-------------------------
                $(".btndraft").click(function(e) {
                    e.preventDefault(e);
                    $("#paggi").show();
                    $("#heading").html("Draft Item");
                    $("tr").show();
                    // --------------------------------------------------
                    //    alert("hello");
                    jQuery.ajax({
                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            draftitem: true
                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.msg + "</h1>");
                            } else {
                                $("#table-data").empty();
                                $.each(data, function(index, value) {
                                    $("#table-data").append("<tr data-id=" + value.id + "><td><input type='checkbox' class='check' data-id=" + value.id + "></td><td>" + value.to_email + "</td><td>" + value.subject + "</td><td>" + value.time + "</td></tr>");
                                });
                            }

                        }
                    });
                });

                // ----------------------delete buttons------------
                $(document).on("click", ".check", function(e) {
                    e.stopPropagation();
                    var checke = $(this).is(':checked');
                    if (checke) {
                        $("#del,#ru").show();
                    } else {
                        $("#del,#ru").hide();
                    }
                    var iddata = $(this).attr("data-id");
                    $("#del").click(function() {
                        $.ajax({
                            url: "fetch.php",
                            dataType: "json",
                            type: "POST",

                            data: {

                                ids: iddata
                            },
                            success: function(data) {
                                if (data['response']) {
                                    alert(data['message']);
                                    $("#del,#ru").hide();



                                }

                            }
                        });

                    });
                });

                
            });
        </script>
</body>

</html>
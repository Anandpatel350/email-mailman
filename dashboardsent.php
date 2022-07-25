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
    <!-- newcss -->

    <style>
        #popup {
            display: none;
            position: absolute;
            top: 160px;
            right: 25px;
            z-index: 9999;
           text-align: center;
            width: 500px;
            height: 100px;
            padding-top: 40px;
            color: green;
        }
    </style>
    <!-- 00000000000000 -->
</head>

<body>
    <!-- new html -->
    <nav class="navbar navbar-light bg-success">
        <div class="container-fluid m-3 navbar-cont">
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
                        <ul class="dropdown-menu mt-2" style="margin-left:150px;" aria-labelledby="dropdownMenu2">
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
            <a>
                <div><button type="submit" class="btn btn-outline-dark bg-info px-5 " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Compose</button></div>
            </a>
            <a href="dashboard.php" class="">Inbox</a>
            <a href="dashboardsent.php" class="">Send</a>
            <a href="dashboarddraft.php" class="">Draft</a>
            <a href="dashboardtrash.php" class="">Trash</a>
        </div>
    </div>


    <div class="content">

        <div class="col-sm-12">
            <div class="container">
                <div class="d-flex ">
                <div><button class="btn btn-outline-dark mx-2" style="display:none;" id="del" type="submit">Delete</button></div>
                </div>
                <div class="pt-3">
                    <div class="card">
                        <h5 class="card-header" id="heading">Sent Item</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                            <div id=table-data></div>

                            </div>
                            
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
                    
                    <input type="hidden" id="page_number" value="1">
                </div>
                
            </div>
        </div>
    </div>
    <div class="alert alert-secondary " id="popup" role="alert"></div>
    <!-- hidden inpute -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
         function loadTable(page) {
                jQuery.ajax({
                    url: "fetch.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'sendItem': true,
                        'page_no': page
                    },
                    success: function(data) {
                        if (data.status == false) {
                            $("#table-data").html("<h1>" + data.massege + "</h1>");
                        } else {
                            // $("#table-d  ata").empty();
                            $("#table-data").html(data);
                        }

                    }
                });
            }
            loadTable();
            // -----------paggination code-----
            $(document).on("click", "#paggi ul .page-link", function(e) {
                e.preventDefault();
                var page_id = $(this).attr('id');
                $("#page_number").val(page_id);
                loadTable(page_id);

            });

            // -----------------------open mail-------------
            $(document).on("click", ".inboxclass", function(e) {

                e.preventDefault(e);

                
                $("#table-data").html("");

                var trval = $(this).parent().attr('data-id');
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
                            $("#heading").html("<div class='d-flex'><button id='backbutton' class='btn btn-info px-4' type='submit'>&laquo;</button> <h5 class='ps-5 pt-2'>Subject : " + value.subject + "</h5></div>")


                            tab += "<div class='container p-5 border border-success'>"
                            tab += "<div class='panel-body'>"
                            tab += "<div class='row'>"
                            tab += "<div class='col-sm-9'>"
                            tab += "<div class='dropdown'>"
                            tab +=  "<div class='dropdown'>"
                            tab +=  "<a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>"
                            tab +=   "Dropdown link"
                            tab +=  "</a>"

                            tab +=   "<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>"
                            tab +=  "<li><a class='dropdown-item link-primary' href='#'>Too:- "+value.to_email+"</a></li>"
                            tab +=  "<li><a class='dropdown-item link-primary' href='#'>Cc:- "+value.cc_email+"</a></li>"
                            tab +=  "<li><a class='dropdown-item link-primary' href='#'>Bcc:- "+value.bcc_email+"</a></li>"
                            tab += "</ul>"
                            tab += "</div>"
                            tab += "</div>"
                            tab += "</div>"
                            tab += "<div class='col-sm-3 text-end'>"
                            tab += "<h6>Date:2022-07-22 18:40:31</h6>"
                            tab += "</div>"
                            tab += "</div>"
                            tab += "<div class='row mt-5'>"

                            tab += " <div class='col-sm-12'><div class='border rounded-3' style='word-wrap: break-word; padding:10px;height:350px'>"+value.message +"</div></div>"

                            tab += "</div>"
                            tab += "<div class='row mt-2'>"
                            tab += "<div class='col-sm-12''>"
                            tab +="<a href='' class='link-primary'>Attachments</a>"
                            tab += "</div>"
                            tab += "</div>"
                            tab += "<div class='row mt-5'>"
                            tab += "<div class='d-flex '>"
                            tab += "<div><button class='btn btn-outline-dark mx-2'  id='Reply' type='submit'>Reply</button></div>"
                            tab += "<div><button class='btn btn-outline-dark mx-4'  id='Reply All' type='submit'>Reaply All</button></div>"
                            tab += "</div>"
                            tab += "</div>"

                            tab +=  "</div>"
                            tab +=  "</div>"

                        });

                        $("#table-data").append(tab);
                    }
                });

            });
             // back button
             $(document).on("click", "#backbutton ", function(e) {
                $('#heading').html('<h5>Sent Item</h5>')
                var x = $("#page_number").val();
                loadTable(x);

            });
            // ---------------------------------------------
            //-----------------------search bar------------
            $("#search-item").on("keyup", function(e) {
                e.preventDefault(e);
                loadTablesearch();

                function loadTablesearch(page) {
                    $("#heading").html("Search Items");
                    var searchval = $("#search-item").val();
                    jQuery.ajax({

                        url: "fetch.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'searchitem': true,
                            'serchtext': searchval,
                            'page_no': page


                        },
                        success: function(data) {
                            if (data.status == false) {
                                $("#table-data").html("<h1>" + data.massege + "</h1>");
                            } else {
                                // $("#table-d  ata").empty();
                                $("#table-data").html(data);
                            }

                        }
                    });
                }
                // -----------paggination code-----
                $(document).on("click", "#paggii ul .page-link", function(e) {
                    e.preventDefault();
                    var page_id = $(this).attr('id');
                    console.log(page_id)
                    loadTablesearch(page_id);

                });

            });


            // ---------------------draft auto saved------
            $("#closed").click(function(e) {
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
                            // alert(data['message'])
                            $('#popup').html('<i><h4>'+data['message']+'</h4><i>');
                            $('#popup').show(function(){$('#popup').delay(700).fadeOut(700);});
                            $("#sideclose").click();
                            $("#toname,#ccname,#bccname,#subject,#message-text,#attachment").val("");
                            $("#toname,#ccname,#bccname").css('border', '');

                        } else {
                            $("#" + data['error_id']).css('border', '1px solid red')



                        }

                    }
                });
            });
            // ------------compose-------------

            $("#submit1").click(function(e) {
                e.preventDefault(e);
                //    alert("hello");
                $("#toname,#ccname,#bccname").css('border', '')
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
                        if (!data['response']) {
                            // alert(data['message'])
                            $.each(data.error_value, function(index, value) {
                                $("#" + value).css('border', '1px solid red')
                            });
                        } else {
                            
                            $('#popup').html('<i><h4>'+data['message']+'<h4><i>');
                            $('#popup').show(function(){$('#popup').delay(700).fadeOut(700);});
                            $("#sideclose").click();
                            $("#toname,#ccname,#bccname,#subject,#message-text,#attachment").val("");
                            $("#toname,#ccname,#bccname").css('border', '');
                            var x=$("#page_number").val();
                            loadTable(x);
                          

                        }

                    }
                });
            });



            // ----------------------delete buttons--------------
            $(document).on("click", ".checkinbox ", function(e) {
                e.stopPropagation();
                var checke = $(this).is(':checked');
                if (checke) {
                    $("#del").show();
                } else {
                    $("#del").hide();
                }
                // var iddata = $(this).attr("data-id");
            });
            $(document).on("click", "#del ", function(e) {
                e.preventDefault(e);
                let iddata = jQuery('input[name="inboxtable"]:checked').attr('data-id');
                $.ajax({
                    url: "fetch.php",
                    dataType: "json",
                    type: "POST",

                    data: {
                        Send_value: true,
                        send_delete: iddata
                    },
                    success: function(data) {
                        console.log(data);
                        if (data['response']) {
                            $("#del").hide();
                            console.log(x);
                            var x=$("#page_number").val();
                            loadTable(x);

                        }
                    }
                });
            });


        });
    </script>
</body>

</html>
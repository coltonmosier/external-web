<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>External Advanced Software Engineering</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/templatemo-style.css">
    <script src="../assets/js/jquery-3.5.1.js"></script>
</head>

<body>

    <body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
        <!-- MENU -->
        <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand">Search Equipment Database External</a>
                </div>
                <!-- MENU LINKS -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                        <li><a href="index.php" class="smoothScroll">Home</a></li>
                        <li><a href="search.php" class="smoothScroll">Search Equipment</a></li>
                        <li><a href="add.php" class="smoothScroll">Add Equipment</a></li>
                        <li><a href="modify.php" class="smoothScroll">Modify Equipment</a></li>
                        <li><a href="view.php" class="smoothScroll">View Equipment</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- HOME -->
        <section id="home">
            </div>
        </section>
        <!-- FEATURE -->
        <section id="feature">
            <div class="container">
                <div class="row">
                    <!-- THIS SHOULD SHOW A LIMIT OF 10K RECORDS -->
                    <!-- THIS SHOULD SHOW A LIMIT OF 10K RECORDS -->
                    <!-- THIS SHOULD SHOW A LIMIT OF 10K RECORDS -->
                    <!-- THIS SHOULD SHOW A LIMIT OF 10K RECORDS -->
                    <h3>View Database</h3>
                    <div id="result"></div>
                </div>
            </div>
        </section>
        <script>
            let device_types = {};
            let manufacturers = {};
            $(document).ready(function() {
                // populate device dropdown
                $.ajax({
                    url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/device",
                    type: "GET",
                    dataType: "json",
                    success: function(result) {
                        result.MSG.forEach(function(item) {
                            device_types[item.id] = item.name;
                        });
                    },
                    error: function(error) {
                        console.log('message Error' + JSON.stringify(error));
                    }
                });
                // populate manufacturer dropdown
                $.ajax({
                    url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/manufacturer",
                    type: "GET",
                    dataType: "json",
                    success: function(result) {
                        result.MSG.forEach(function(item) {
                            manufacturers[item.id] = item.name;
                        });
                    },
                    error: function(error) {
                        console.log('message Error' + JSON.stringify(error));
                    }
                });
                $.ajax({
                    url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        if (res.Status === 'SUCCESS') {
                            if (res.MSG.length > 0) {
                                var table = '<table class="table table-striped"><thead><tr><th>Device Type</th><th>Manufacturer</th><th>Serial Number</th><th>Status</th></tr></thead><tbody>';
                                res.MSG.forEach(function(item) {
                                    table += '<tr><td>' + device_types[item.device_type_id] + '</td><td>' + manufacturers[item.manufacturer_id] + '</td><td>' + item.serial_number + '</td><td>' + item.status + '</td></tr>';
                                });
                                table += '</tbody></table>';
                                $("#result").html(table);
                            } else {
                                $("#result").html('No records found');
                            }
                        } else {
                            $("#result").html(res.MSG);
                        }
                    },
                    error: function(error) {
                        console.log('message Error' + JSON.stringify(error));
                    }
                });
            });
        </script>
    </body>

</html>

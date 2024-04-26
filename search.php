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
                    <form action="" method="post">
                        <div class="form-group" style="display: inline-block; margin-right: 10px; vertical-align: top;">
                            <label for="device_type">Device Type</label>
                            <select class="form-control" style="margin-top: 10px; width: auto;" name="device_type" id="device_type">
                                <option value="">Any</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: inline-block; margin-right: 10px; vertical-align: top;" id="manu-in-div">
                            <label for="manufacturer">Manufacturer</label>
                            <select class="form-control" style="margin-top: 10px; width: auto;" name="manufacturer" id="manufacturer">
                                <option value="">Any</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: inline-block; vertical-align: top;" id="sn-in-div">
                            <label for="serial">Serial Number</label>
                            <span class="help-block" id="sn-help"></span>
                            <input type="text" class="form-control" style="width: 650px;" name="serial" id="serial">
                        </div>
                        <div class="form-group">
                                <label for="status">Status</label>
                                <input type="radio" name="status"  value="active" checked> Active 
                                <input type="radio" name="status"  value="inactive"> Inactive
                        </div>
                        <div class="form-group">
                            <button type="submit" id="search" class="btn btn-primary" name="submitSearch" value="submitSearch">Search</button>
                        </div>
                    </form>
                    <hr>
                    <h3>Search Results</h3>
                    <div id="result">
                    </div>
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
                            $('#device_type').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
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
                            $('#manufacturer').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                            manufacturers[item.id] = item.name;
                        });
                    },
                    error: function(error) {
                        console.log('message Error' + JSON.stringify(error));
                    }
                });
                $("#search").click(function(e) {
                    e.preventDefault()
                    // run if device type and manufacturer are empty
                    if (($('#serial').val() != "") && ($("#device_type").val() === "") && ($("#manufacturer").val() === "")) {
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/sn-like/" + $("#serial").val(),
                            type: "GET",
                            dataType: "json",
                            success: function(res) {
                                if (res.Status === 'SUCCESS') {
                                    if (res.MSG.length > 0) {
                                        var table = '<table class="table table-striped"><thead><tr><th>Device Type</th><th>Manufacturer</th><th>Serial Number</th></tr></thead><tbody>';
                                        res.MSG.forEach(function(item) {
                                            table += '<tr><td>' + device_types[item.device_type_id] + '</td><td>' + manufacturers[item.manufacturer_id] + '</td><td>' + item.serial_number + '</td></tr>';
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                        // run if serial is the only empty
                    } else if (($('#serial').val() === "") && ($("#device_type").val() != "") && ($("#manufacturer").val() != "")) {
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/device/" + $("#device_type").val() + "/manufacturer/" + $("#manufacturer").val(),
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                        // run if serial and manufacturer are empty
                    } else if (($('#serial').val() === "") && ($("#device_type").val() != "") && ($("#manufacturer").val() === "")) {
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/device/" + $("#device_type").val(),
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                        // run if serial and device are empty
                    } else if (($('#serial').val() === "") && ($("#device_type").val() === "") && ($("#manufacturer").val() !== "")) {
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/manufacturer/" + $("#manufacturer").val(),
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                        // hanlde all fields being empty
                    } else if (($('#serial').val() === "") && ($("#device_type").val() === "") && ($("#manufacturer").val() === "")) {
                        let radios = document.getElementsByName('status');
                        let status = '';
                        for (var i = 0, length = radios.length; i < length; i++) {
                            if (radios[i].checked) {
                                status = radios[i].value;
                                break;
                            }
                        }
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment",
                            type: "GET",
                            dataType: "json",
                            success: function(res) {
                                if (res.Status === 'SUCCESS') {
                                    if (res.MSG.length > 0) {
                                        var table = '<table class="table table-striped"><thead><tr><th>Device Type</th><th>Manufacturer</th><th>Serial Number</th><th>Status</th></tr></thead><tbody>';
                                        res.MSG.forEach(function(item) {
                                            if (item.status === status) {
                                                table += '<tr><td>' + device_types[item.device_type_id] + '</td><td>' + manufacturers[item.manufacturer_id] + '</td><td>' + item.serial_number + '</td><td>' + item.status + '</td></tr>';
                                            }
                                            //table += '<tr><td>' + device_types[item.device_type_id] + '</td><td>' + manufacturers[item.manufacturer_id] + '</td><td>' + item.serial_number + '</td><td>' + item.status + '</td></tr>';
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                    } else {
                        console.log("No fields are empty");
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/sn-like/" + $("#serial").val() + "/manufacturer/" + $("#manufacturer").val() + "/device/" + $("#device_type").val(),
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
                                $("#result").html(error.responseJSON.MSG);
                                console.log('message Error: ' + JSON.stringify(error.responseJSON.MSG));
                            }
                        });
                    }
                });
            });
        </script>
    </body>

</html>

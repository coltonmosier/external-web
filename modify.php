<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Advanced Software Engineering</title>
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
                    <a href="#" class="navbar-brand">Modify Equipment Database</a>
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
                    <?php
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'SerialDoesntExist') {
                        echo "<div class='alert alert-danger' role='alert'>Serial Number does not exist in database!</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'DeviceDoesntExist') {
                        echo "<div class='alert alert-danger' role='alert'>Device Type does not exist in database!</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'ManufacturerDoesntExist') {
                        echo "<div class='alert alert-danger' role='alert'>Manufacturer does not exist in database!</div>";
                    }
                    ?>

                    <!-- Add Manufacturer Form -->
                    <h3>Modify Equipment Activity</h3>
                    <form method="post" action="">
                        <div class="form-group" id="serial-in-div">
                            <label for="newSerial">Serial Number:</label>
                            <span class="help-block" id="new-serial-status"></span>
                            <input  type="text" class="form-control" style="width: 650px;" id="newSerialInput" name="newSerial">
                            <label for="newSerial">Device Type:</label>
                            <input type="text" disabled class="form-control" style="width: auto;" id="eq_deviceType" name="deviceType">
                            <label for="newSerial">Manufacturer:</label>
                            <input type="text" disabled class="form-control" style="width: auto;" id="eq_manufacturer" name="manufacturer">
                            <label for="newSerial">Status:</label>
                            <input type="radio" name="eq_status" value="active"> Active
                            <input type="radio" name="eq_status" value="inactive"> Inactive
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewSerial" value="submitNewSerial" id="serial-btn" disabled>Modify</button>
                        </div>
                    </form>
                    <hr>
                    <!-- Add Manufacturer Form -->
                    <!--TODO: FINISH -->
                    <h3>Modify Manufacturer Activity</h3>
                    <form method="post" action="">
                        <div class="form-group" id="manu-in-div">
                            <label for="oldManufacturer">Select Manufacturer to Modify:</label>
                            <span class="help-block" id="old-manufacturer-status"></span>
                            <select class="form-control" id="oldManufacturerInput" name="oldManufacturer">
                            </select>
                            <input type="radio" name="manustatus" value="active" checked> Active
                            <input type="radio" name="manustatus" value="inactive"> Inactive<br>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewManu" value="submitNewManu" id="manu-btn" >Modify</button>
                        </div>
                    </form>
                    <hr>
                    <!-- Add Device Type Form -->
                    <!--TODO: FINISH -->
                    <h3>Modify Device Type</h3>
                    <form method="post" action="">
                        <div class="form-group" id="dev-in-div">
                            <label for="oldDevice">Select Device to Modify:</label>
                            <select class="form-control" id="oldDevice" name="oldDevice">
                            </select>
                            <input type="radio" name="devstatus" value="active" checked> Active
                            <input type="radio" name="devstatus" value="inactive"> Inactive<br>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewDevice" value="submitNewDevice" id="dev-btn" >Modify</button>
                        </div>
                    </form>



                </div>
            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var device_types = {};
                var manufacturers = {};
                $.ajax({
                    url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/device",
                    type: "GET",
                    dataType: "json",
                    success: function(result) {
                        result.MSG.forEach(function(item) {
                            $('#oldDevice').append($('<option>', {
                                value: item.id,
                                text: item.name + ' (' + item.status + ')'
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
                            $('#oldManufacturerInput').append($('<option>', {
                                value: item.id,
                                text: item.name + ' (' + item.status + ')'
                            }));
                            manufacturers[item.id] = item.name;
                        });
                    },
                    error: function(error) {
                        console.log('message Error' + JSON.stringify(error));
                    }
                });
                // HANDLE SERIAL NUMBER INPUT
                var newSerialInput = document.getElementById('newSerialInput');
                var serialValue = newSerialInput.value;
                var serialInDiv = document.getElementById('serial-in-div');
                var newStatusSpan = document.getElementById('new-serial-status');
                var serialBtn = document.getElementById('serial-btn');
                var eq_deviceType = document.getElementById('eq_deviceType');
                var eq_manufacturer = document.getElementById('eq_manufacturer');
                var eq_radios = document.getElementsByName('eq_status');

                var equip_id = ''

                newSerialInput.addEventListener('input', function() {
                    serialValue = newSerialInput.value;
                    if (serialValue.length > 0) {
                        serialBtn.disabled = false;
                    } else {
                        serialBtn.disabled = true;
                    }
                    if (serialValue.startsWith('SN-')) {
                        newStatusSpan.textContent = "";
                        serialInDiv.classList.remove('has-error');
                        serialBtn.disabled = false;
                    } else {
                        newStatusSpan.textContent = "Serial Number must start with 'SN-'";
                        serialInDiv.classList.add('has-error');
                        serialBtn.disabled = true;
                    }
                });

                newSerialInput.addEventListener('focusout', function() {
                    if (serialValue.length == 0) {
                    alert(serialValue)
                        newStatusSpan.textContent = "Serial Number cannot be empty!";
                        serialInDiv.classList.add('has-error');
                        return;
                    }
                    $.ajax({
                        url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/sn?sn=" + serialValue,
                        type: "GET",
                        dataType: "json",
                        success: function(result) {
                            equip_id = result.MSG.auto_id;
                            eq_deviceType.value = device_types[result.MSG.device_type_id];
                            eq_deviceType.id = result.MSG.device_type_id;
                            eq_manufacturer.value = manufacturers[result.MSG.manufacturer_id];
                            eq_manufacturer.id = result.MSG.manufacturer_id;
                            // i need to put it to the selected value
                            $('#eq_deviceType').find('option[value="' + result.MSG.device_type_id + '"]').prop('selected', true);
                            $('#eq_manufacturer').find('option[value="' + result.MSG.manufacturer_id + '"]').prop('selected', true);
                            eq_radios.forEach(function(radio) {
                                if (radio.value == result.MSG.status) {
                                    radio.checked = true;
                                }
                            });
                        },
                        error: function(error) {
                            console.log('message Error' + JSON.stringify(error));
                            newStatusSpan.textContent = "Serial Number does not exist in database!";
                            serialInDiv.classList.add('has-error');
                            newSerialInput.value = "";
                            eq_deviceType.value = "";
                            eq_manufacturer.value = "";
                        }
                    });
                });

                function redirect(url) {
                    window.location.href = url;
                }

                serialBtn.addEventListener('click', function(e) {
                    console.log('modify equipment')
                    e.preventDefault();
                    var id = equip_id;
                    $.ajax({
                        url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment/" + id + "/status?status=" + document.querySelector('input[name="eq_status"]:checked').value,
                        type: "PATCH",
                        success: function(result) {
                            redirect('index.php?msg=SerialModified');
                        },
                        error: function(error) {
                            console.log('message Error ' + JSON.stringify(error));
                        }
                    })
                })


                // HANDLE MANUFACTURER INPUT
                var manuBtn = document.getElementById('manu-btn');

                manuBtn.addEventListener('click', function(e){
                    e.preventDefault();
                    var id = document.getElementById('oldManufacturerInput').value;
                    var status = document.querySelector('input[name="manustatus"]:checked').value;
                    $.ajax({
                        url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/manufacturer/" + id + "/status?status=" + status,
                        type: "PATCH",
                        success: function(result) {
                            redirect('index.php?msg=ManufacturerModified');
                        },
                        error: function(error) {
                            console.log('message Error ' + JSON.stringify(error));
                        }
                    })
                });

                // HANDLE DEVICE INPUT
                var devBtn = document.getElementById('dev-btn');

                devBtn.addEventListener('click', function(e){
                    e.preventDefault();
                    var id = document.getElementById('oldDevice').value;
                    var status = document.querySelector('input[name="devstatus"]:checked').value;
                    $.ajax({
                        url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/device/" + id + "/status?status=" + status,
                        type: "PATCH",
                        success: function(result) {
                            redirect('index.php?msg=DeviceModified');
                        },
                        error: function(error) {
                            console.log('message Error ' + JSON.stringify(error));
                        }
                    })
                });

            }); // end DOMContentLoaded
        </script>
    </body>

</html>

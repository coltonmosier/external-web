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
                    <a href="#" class="navbar-brand">Add New Equipment</a>
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
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'EquipmentExists') {
                        echo "<div class='alert alert-danger' role='alert'>Serial Number already exists in database!</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'DeviceExists') {
                        echo "<div class='alert alert-danger' role='alert'>Device Type already exists in database!</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'ManufacturerExists') {
                        echo "<div class='alert alert-danger' role='alert'>Manufacturer already exists in database!</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'SerialNumberEmpty') {
                        echo "<div class='alert alert-danger' role='alert'>Serial Number can't be empty</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'DeviceEmpty') {
                        echo "<div class='alert alert-danger' role='alert'>Device Type can't be empty</div>";
                    }
                    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'ManufacturerEmpty') {
                        echo "<div class='alert alert-danger' role='alert'>Manufacturer can't be empty</div>";
                    }
                    ?>
                    <?php
                    if (!isset($_REQUEST['newManu']) && !isset($_REQUEST['newDevice'])) {
                        echo '<!-- Add Equipment Form -->';
                        echo '<h3>Add Serial Number</h3>';
                        echo '<form method="post" action="">';
                        echo '    <div class="form-group">';
                        echo '        <label for="exampleDevice">Device:</label>';
                        echo '        <select class="form-control" id="exampleDevice" name="device">';
                        echo '        </select>';
                        echo '    </div>';
                        echo '    <div class="form-group">';
                        echo '        <label for="exampleManufacturer">Manufacturer:</label>';
                        echo '        <select class="form-control" id="exampleManufacturer" name="manufacturer">';
                        echo '        </select>';
                        echo '    </div>';
                        echo '    <div class="form-group" id="serial-in-div">';
                        echo '        <label for="exampleSerial">Serial Number:</label>';
                        echo '        <span class="help-block" id="serial-status"></span>';
                        echo '        <input type="text" autocomplete="off" class="form-control" id="serialInput"';
                        echo '            name="serialnumber">';
                        echo '    </div>';
                        echo '    <div>';
                        echo '        <button type="submit" id="equipt-btn" class="btn btn-primary" name="submit" value="submit" disabled>Add</button>';
                        echo '        <button type="submit" id="newManu" class="btn btn-primary" name="newManu" value="newManu">Add';
                        echo '            New Manufacturer</button>';
                        echo '        <button type="submit" id="newDevice" class="btn btn-primary" name="newDevice" value="newDevice">Add';
                        echo '            New Device Type</button>';
                        echo '    </div>';
                        echo '</form>';
                        echo '<hr>';
                    }
                    ?>
                    <!-- Add Manufacturer Form -->
                    <?php
                    if (isset($_REQUEST['newManu'])) {
                        echo '<h3>Add Manufacturer</h3>';
                        echo '<form method="post" action="">';
                        echo '    <div class="form-group" id="manufacturer-in-div">';
                        echo '        <label for="exampleManufacturer">Manufacturer:</label>';
                        echo '        <span class="help-block" id="manufacturer-status"></span>';
                        echo '        <input type="text" autocomplete="off" class="form-control" id="manufacturerInput" name="manufacturer">';
                        echo '    </div>';
                        echo '    <div>';
                        echo '        <button type="submit" id="manu-btn" class="btn btn-primary" name="submitManu"';
                        echo '            value="submitManu" disabled>Add</button>';
                        echo '        <button type="submit" id="newEquip" class="btn btn-primary" name="newEquipment" value="newEquipment">Add';
                        echo '            New Equipment</button>';
                        echo '        <button type="submit" id="newDevice" class="btn btn-primary" name="newDevice" value="newDevice">Add';
                        echo '            New Device Type</button>';
                        echo '    </div>';
                        echo '</form>';
                        echo '<hr>';
                    }
                    ?>
                    <!-- Add Device Type Form -->
                    <?php
                    if (isset($_REQUEST['newDevice'])) {
                        echo '<h3>Add Device Type</h3>';
                        echo '<form method="post" action="">';
                        echo '    <div class="form-group" id="device-in-div">';
                        echo '        <label for="exampleDevice">Device:</label>';
                        echo '        <span class="help-block" id="device-status"></span>';
                        echo '        <input type="text" autocomplete="off" class="form-control" id="deviceInput" name="device">';
                        echo '    </div>';
                        echo '    <div>';
                        echo '        <button type="submit" id="device-btn" class="btn btn-primary" name="submitDevice"';
                        echo '            value="submitDevice" disabled>Add</button>';
                        echo '        <button type="submit" id="newEquip" class="btn btn-primary" name="newEquipment" value="newEquipment">Add';
                        echo '            New Equipment</button>';
                        echo '        <button type="submit" id="newDevice" class="btn btn-primary" name="newManu" value="newManu">Add';
                        echo '            New Manufacturer</button>';
                        echo '    </div>';
                        echo '</form>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <script type='text/javascript'>
            function redirect(url) {
                window.location.href = url;
            }
            document.addEventListener('DOMContentLoaded', function() {
                if (document.getElementById('equipt-btn')) {
                    var serialInput = document.getElementById('serialInput');
                    var serialInDiv = document.getElementById('serial-in-div');
                    var statusSpan = document.getElementById('serial-status');
                    var equipBtn = document.getElementById('equipt-btn');
                    let device_types = {};
                    let manufacturers = {};
                    $.ajax({
                        url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/device",
                        type: "GET",
                        dataType: "json",
                        success: function(result) {
                            result.MSG.forEach(function(item) {
                                $('#exampleDevice').append($('<option>', {
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
                                $('#exampleManufacturer').append($('<option>', {
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
                    serialInput.addEventListener('input', function() {
                        var inputValue = serialInput.value;
                        if (inputValue.startsWith("SN-")) {
                            statusSpan.textContent = "";
                            serialInDiv.classList.remove('has-error');
                            equipBtn.disabled = false;
                        } else {
                            statusSpan.textContent = "Serial number must start with 'SN-'.";
                            serialInDiv.classList.add('has-error');
                            equipBtn.disabled = true;
                        }
                    });
                    equipBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var serialNumber = serialInput.value;
                        var device = $('#exampleDevice').val();
                        var manufacturer = $('#exampleManufacturer').val();
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/equipment?sn=" + serialNumber + "&device=" + device + "&manufacturer=" + manufacturer,
                            type: "POST",
                            dataType: "json",
                            success: function(result) {
                                redirect("index.php?msg=EquipmentAdded");
                            },
                            error: function(error) {
                                console.log('message Error' + JSON.stringify(error));
                                if (error.responseJSON.MSG == "equipment already exists in database") {
                                    redirect("add.php?msg=EquipmentExists");
                                }
                            }
                        })
                    })
                }
                if (document.getElementById('newManu')) {
                    var newManu = document.getElementById('newManu');
                    newManu.addEventListener('click', function() {
                        redirect("add.php?newManu");
                    });
                }
                if (document.getElementById('newDevice')) {
                    var newDevice = document.getElementById('newDevice');
                    newDevice.addEventListener('click', function() {
                        redirect("add.php?newDevice");
                    });
                }
                if (document.getElementById('newEquip')) {
                    var newEquip = document.getElementById('newEquip');
                    newEquip.addEventListener('click', function() {
                        redirect("add.php");
                    });
                }
                if (document.getElementById('manu-btn')) {
                    var manufacturerInput = document.getElementById('manufacturerInput');
                    var manufacturerInDiv = document.getElementById('manufacturer-in-div');
                    var statusSpan = document.getElementById('manufacturer-status');
                    var manuBtn = document.getElementById('manu-btn');
                    manufacturerInput.addEventListener('input', function() {
                        var inputValue = manufacturerInput.value;
                        if (inputValue.length > 0) {
                            statusSpan.textContent = "";
                            manufacturerInDiv.classList.remove('has-error');
                            manuBtn.disabled = false;
                        } else {
                            statusSpan.textContent = "Manufacturer can't be empty.";
                            manufacturerInDiv.classList.add('has-error');
                            manuBtn.disabled = true;
                        }
                    });
                    manuBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var manufacturer = manufacturerInput.value;
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/manufacturer?name=" + manufacturer,
                            type: "POST",
                            dataType: "json",
                            success: function(result) {
                                redirect("index.php?msg=ManufacturerAdded");
                            },
                            error: function(error) {
                                console.log('message Error' + JSON.stringify(error));
                                if (error.responseJSON.MSG == "manufacturer type already exists") {
                                    redirect("add.php?msg=ManufacturerExists");
                                }
                            }
                        })
                    })
                }
                if (document.getElementById('device-btn')) {
                    var deviceInput = document.getElementById('deviceInput');
                    var deviceInDiv = document.getElementById('device-in-div');
                    var statusSpan = document.getElementById('device-status');
                    var deviceBtn = document.getElementById('device-btn');
                    deviceInput.addEventListener('input', function() {
                        var inputValue = deviceInput.value;
                        if (inputValue.length > 0) {
                            statusSpan.textContent = "";
                            deviceInDiv.classList.remove('has-error');
                            deviceBtn.disabled = false;
                        } else {
                            statusSpan.textContent = "Device type can't be empty.";
                            deviceInDiv.classList.add('has-error');
                            deviceBtn.disabled = true;
                        }
                    });
                    deviceBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var device = deviceInput.value;
                        $.ajax({
                            url: "https://ec2-3-129-26-111.us-east-2.compute.amazonaws.com:8080/api/v1/device?name=" + device,
                            type: "POST",
                            dataType: "json",
                            success: function(result) {
                                redirect("index.php?msg=DeviceAdded");
                            },
                            error: function(error) {
                                console.log('message Error' + JSON.stringify(error));
                                if (error.responseJSON.MSG == "device type already exists") {
                                    redirect("add.php?msg=DeviceExists");
                                }
                            }
                        })
                    })
                }
            });
        </script>
    </body>

</html>

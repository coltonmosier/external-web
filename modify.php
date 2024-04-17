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
                        require_once("functions.php");
                        $dblink = db_connect("devices");
                        $devices = array();
                        $devicesActivity = array();
                        $manufacturers = array();
                        $manufacturersActivity = array();
                        $sql = "select `name`, `id`, `status` from `device_type`";
                        $result = $dblink->query($sql) or die($dblink->error);
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            $devices[$row['id']] = $row['name'];
                            $devicesActivity[$row['id']] = $row['status'];
                        }
                        $sql = "select `name`, `id`, `status` from `manufacturer`";
                        $result = $dblink->query($sql) or die($dblink->error);
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            $manufacturers[$row['id']] = $row['name'];
                            $manufacturersActivity[$row['id']] = $row['status'];
                        }
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
                    <h3>Modify Serial Number</h3>
                    <form method="post" action="">
                        <div class="form-group" id="serial-in-div">
                            <label for="oldSerial">Serial Number to Modify:</label>
                            <span class="help-block" id="old-serial-status"></span>
                            <input type="text" class="form-control" id="oldSerialInput" name="oldSerial">

                            <label for="newSerial">Update Serial Number to:(cannot be blank)</label>
                            <span class="help-block" id="new-serial-status"></span>
                            <input type="text" class="form-control" id="newSerialInput" name="newSerial">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewSerial" value="submitNewSerial"
                                id="serial-btn" disabled>Modify</button>
                        </div>
                    </form>
                    <hr>
                    <!-- Add Manufacturer Form -->
                    <h3>Modify Manufacturer</h3>
                    <form method="post" action="">
                        <div class="form-group" id="manu-in-div">
                            <label for="oldManufacturer">Manufacturer to Modify:</label>
                            <span class="help-block" id="old-manufacturer-status"></span>
                            <select class="form-control" id="oldManufacturerInput" name="oldManufacturer">
                                <?php
                                        foreach($manufacturers as $key => $value){
                                            if ($manufacturersActivity[$key] == 'inactive') {
                                                echo "<option value='$key'>$value (Inactive)</option>";
                                            } else {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                        }
                                    ?>
                            </select>
                                <input type="radio" name="manustatus" value="active" checked> Active
                                <input type="radio" name="manustatus" value="inactive"> Inactive<br>
                            <label for="newManufacturer">Update Manufacturer to:(cannot be blank)</label>
                            <span class="help-block" id="new-manufacturer-status"></span>
                            <input type="text" class="form-control" id="newManufacturerInput" name="newManufacturer">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewManu" value="submitNewManu"
                                id="manu-btn" disabled>Modify</button>
                        </div>
                    </form>
                    <hr>
                    <!-- Add Device Type Form -->
                    <h3>Modify Device Type</h3>
                    <form method="post" action="">
                        <div class="form-group" id="dev-in-div">
                            <label for="oldDevice">Device to Modify:</label>
                            <select class="form-control" id="oldDevice" name="oldDevice">
                                <?php
                                        foreach($devices as $key => $value){
                                            if ($devicesActivity[$key] == 'inactive') {
                                                echo "<option value='$key'>$value (Inactive)</option>";
                                            } else {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                        }
                                    ?>
                            </select>
                                <input type="radio" name="devstatus" value="active" checked> Active
                                <input type="radio" name="devstatus" value="inactive"> Inactive<br>
                            <label for="newDevice">Update Device to:(cannot be blank)</label>
                            <span class="help-block" id="new-device-status"></span>
                            <input type="text" class="form-control" id="newDeviceInput" name="newDevice">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submitNewDevice"
                                value="submitNewDevice" id="dev-btn" disabled>Modify</button>
                        </div>
                    </form>



                </div>
            </div>
        </section>
    </body>

</html>
<?php
if (isset($_POST['submitNewSerial'])) {
    $oldSerial = $_POST['oldSerial'];
    $newSerial = $_POST['newSerial'];
    $sql = "select `auto_id` from `serial_numbers` where `serial_number` = '$oldSerial'";
    $res = $dblink->query($sql) or 
        die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
    if ($res->num_rows == 0) {
        redirect("modify.php?msg=SerialDoesntExist");
    } else {
        $sql = "update `serial_numbers` set `serial_number` = '$newSerial' where `serial_number` = '$oldSerial'";
        $result = $dblink->query($sql) or die($dblink->error);
        redirect("index.php?msg=SerialModified");
    }
}

if (isset($_POST['submitNewManu'])) {
    $oldManu = $_POST['oldManufacturer'];
    $newManu = $_POST['newManufacturer'];
    $status = $_POST['manustatus'];
    $sql = "update `manufacturer` set `name` = '$newManu', `status` = '$status' where `id` = '$oldManu'";
    $result = $dblink->query($sql) or die($dblink->error);
    redirect("index.php?msg=ManufacturerModified");
}

if (isset($_POST['submitNewDevice'])){
    $oldDevice = $_POST['oldDevice'];
    $newDevice = $_POST['newDevice'];
    $status = $_POST['devstatus'];
    $sql = "update `device_type` set `name` = '$newDevice', `status` = '$status' where `id` = '$oldDevice'";
    $result = $dblink->query($sql) or die($dblink->error);
    redirect("index.php?msg=DeviceModified");
}

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // HANDLE SERIAL NUMBER INPUT
        var oldSerialInput = document.getElementById('oldSerialInput');
        var newSerialInput = document.getElementById('newSerialInput');
        var serialInDiv = document.getElementById('serial-in-div');
        var oldStatusSpan = document.getElementById('old-serial-status');
        var newStatusSpan = document.getElementById('new-serial-status');
        var serialBtn = document.getElementById('serial-btn');

        oldSerialInput.addEventListener('input', function () {
            var inputValue = oldSerialInput.value;
            if (inputValue.startsWith("SN-")) {
                oldStatusSpan.textContent = "";
                serialInDiv.classList.remove('has-error');
                serialBtn.disabled = false;
            } else {
                oldStatusSpan.textContent = "Serial number must start with 'SN-'.";
                serialInDiv.classList.add('has-error');
                serialBtn.disabled = true;
            }
        });
        newSerialInput.addEventListener('input', function () {
            var inputValue = newSerialInput.value;
            if (inputValue.startsWith("SN-")) {
                newStatusSpan.textContent = "";
                serialInDiv.classList.remove('has-error');
                serialBtn.disabled = false;
            } else {
                newStatusSpan.textContent = "Serial number must start with 'SN-'.";
                serialInDiv.classList.add('has-error');
                serialBtn.disabled = true;
            }
        });

        // HANDLE MANUFACTURER INPUT
        var newManufacturerInput = document.getElementById('newManufacturerInput');
        var manuInDiv = document.getElementById('manu-in-div');
        var newManuSpan = document.getElementById('new-manufacturer-status');
        var manuBtn = document.getElementById('manu-btn');

        newManufacturerInput.addEventListener('input', function () {
            var inputValue = newManufacturerInput.value;
            if (inputValue.length > 0) {
                newManuSpan.textContent = "";
                manuInDiv.classList.remove('has-error');
                manuBtn.disabled = false;
            } else {
                newManuSpan.textContent = "Manufacturer cannot be blank.";
                manuInDiv.classList.add('has-error');
                manuBtn.disabled = true;
            }
        });

        // HANDLE DEVICE INPUT
        var newDeviceInput = document.getElementById('newDeviceInput');
        var devInDiv = document.getElementById('dev-in-div');
        var newDeviceSpan = document.getElementById('new-device-status');
        var devBtn = document.getElementById('dev-btn');

        newDeviceInput.addEventListener('input', function () {
            var inputValue = newDeviceInput.value;
            if (inputValue.length > 0) {
                newDeviceSpan.textContent = "";
                devInDiv.classList.remove('has-error');
                devBtn.disabled = false;
            } else {
                newDeviceSpan.textContent = "Device cannot be blank.";
                devInDiv.classList.add('has-error');
                devBtn.disabled = true;
            }
        });
    });
</script>

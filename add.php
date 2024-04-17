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
                        require_once("functions.php");
                        $dblink = db_connect("devices");
                        $devices = array();
                        $manufacturers = array();
                        $sql = "select `name`, `id` from `device_type` where `status` = 'active'";
                        $result = $dblink->query($sql) or die($dblink->error);
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            $devices[$row['id']] = $row['name'];
                        }
                        $sql = "select `name`, `id` from `manufacturer` where `status` = 'active'";
                        $result = $dblink->query($sql) or die($dblink->error);
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            $manufacturers[$row['id']] = $row['name'];
                        }
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
                    foreach($devices as $key => $value){
                        echo "<option value='$key'>$value</option>";
                    }
                    echo '        </select>';
                    echo '    </div>';
                    echo '    <div class="form-group">';
                    echo '        <label for="exampleManufacturer">Manufacturer:</label>';
                    echo '        <select class="form-control" id="exampleManufacturer" name="manufacturer">';
                    foreach($manufacturers as $key => $value){
                        echo "<option value='$key'>$value</option>";
                    }
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
                    echo '            value="submitManu" >Add</button>';
                    echo '        <button type="submit" id="newManu" class="btn btn-primary" name="newEquipment" value="newEquipment">Add';
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
                    echo '            value="submitDevice" >Add</button>';
                    echo '        <button type="submit" id="newManu" class="btn btn-primary" name="newEquipment" value="newEquipment">Add';
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
    </body>

</html>
<?php
if (isset($_POST['submit'])) {
    $device = $_POST['device'];
    $manufacturer = $_POST['manufacturer'];
    $serialnumber = trim($_POST['serialnumber']);
    if ($serialnumber == "") {
        redirect("add.php?msg=SerialNumberEmpty");
    }
    $sql = "select `auto_id` from `serial_numbers` where `serial_number` = '$serialnumber'";
    $res = $dblink->query($sql) or 
        die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
    if ($res->num_rows <= 0) {
        $sql = "insert into `serial_numbers` (`device_type_id`, `manufacturer_id`, `serial_number`) values ('$device', '$manufacturer', '$serialnumber')";
        $dblink->query($sql) or 
            die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
        redirect("index.php?msg=EquipmentAdded");
    } else {
        redirect("add.php?msg=EquipmentExists");
    }
}
if (isset($_POST['nawMenu'])) {
    redirect("add.php?newManu");
}
if (isset($_POST['newDevice'])) {
    redirect("add.php?newDevice");
}
if (isset($_POST['newEquipment'])) {
    redirect("add.php");
}

if (isset($_POST['submitManu'])) {
    $manufacturer = trim($_POST['manufacturer']);
    if ($manufacturer == "") {
        redirect("add.php?newManu&msg=ManufacturerEmpty");
    }
    $sql = "select `id` from `manufacturer` where `name` = '$manufacturer'";
    $res = $dblink->query($sql) or 
        die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
    if ($res->num_rows > 0) {
        redirect("add.php?newManu&msg=ManufacturerExists");
    } else {
        $sql = "insert into `manufacturer` (`name`, `status`) values ('$manufacturer', 'active')";
        $dblink->query($sql) or 
            die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
        redirect("index.php?msg=ManufacturerAdded");
    }
}

if (isset($_POST['submitDevice'])) {
    $device = trim($_POST['device']);
    if ($device == "") {
        redirect("add.php?newDevice&msg=DeviceEmpty");
    }
    $sql = "select `id` from `device_type` where `name` = '$device'";
    $res = $dblink->query($sql) or 
        die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
    if ($res->num_rows > 0) {
        redirect("add.php?newDevice&msg=DeviceExists");
    } else {
        $sql = "insert into `device_type` (`name`, `status`) values ('$device', 'active')";
        $dblink->query($sql) or 
            die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
        redirect("index.php?msg=DeviceAdded");
    }
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if(document.getElementById('serialInput')){
            var serialInput = document.getElementById('serialInput');
            var serialInDiv = document.getElementById('serial-in-div');
            var statusSpan = document.getElementById('serial-status');
            var equipBtn = document.getElementById('equipt-btn');

            serialInput.addEventListener('input', function () {
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
        }
    });
</script>

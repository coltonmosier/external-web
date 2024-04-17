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
                    <a href="#" class="navbar-brand">Search Equipment Database</a>
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
                    ?>
                    <form action="" method="post">
                        <div class="form-group" style="display: inline-block; margin-right: 10px; vertical-align: top;">
                            <label for="device_type">Device Type</label>
                            <select class="form-control" style="margin-top: 10px; width: auto;" name="device_type"
                                id="device_type">
                                <option value="">Any</option>
                                <?php
                                        foreach($devices as $id => $name){
                                            echo "<option value='$id'>$name</option>";
                                        }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group" style="display: inline-block; margin-right: 10px; vertical-align: top;"
                            id="manu-in-div">
                            <label for="manufacturer">Manufacturer</label>
                            <select class="form-control" style="margin-top: 10px; width: auto;" name="manufacturer"
                                id="manufacturer">
                                <option value="">Any</option>
                                <?php
                                        foreach($manufacturers as $id => $name){
                                            echo "<option value='$id'>$name</option>";
                                        }
                                ?>
                            </select>
                        </div>

                        <div class="form-group" style="display: inline-block; vertical-align: top;" id="sn-in-div">
                            <label for="serial">Serial Number</label>
                            <span class="help-block" id="sn-help"></span>
                            <input type="text" class="form-control" style="width: 650px;" name="serial" id="serial">
                        </div>
                        <div class="form-group">
                            <label for="limit">Limit</label>
                            <input type="number" style="width: 200px;" class="form-control" name="limit" id="limit" value="1">
                        </div>
                        <div class="form-group">
                            <label for="offset">Offset</label>
                            <input type="number" style="width: 200px;" class="form-control" name="offset" id="offset" value="0">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="submitSearch"
                                value="submitSearch">Search</button>
                        </div>
                    </form>
                    <hr>
                    <h3>Search Results</h3>
                    <?php
                        if (isset($_POST['submitSearch'])) {
                            $device = $_POST['device_type'];
                            $manufacturer = $_POST['manufacturer'];
                            $serialnumber = trim($_POST['serial']);
                            $limit = $_POST['limit'];
                            $offset = $_POST['offset'];
                            $sql = "";
                            if ($device == "" && $manufacturer == "" && $serialnumber == "") {
                                $sql = "select `device_type_id`, `manufacturer_id`, `serial_number` from `serial_numbers` limit $limit offset $offset";
                            } else {
                                $sql = "select `device_type_id`, `manufacturer_id`, `serial_number` from `serial_numbers`";
                                $sql.= $device == "" ? "" :" where `device_type_id` = $device ";
                                $sql.= $manufacturer == "" ? "" : ($device == "" ? " where " : " and ") . "`manufacturer_id` = $manufacturer";
                                $sql.= $serialnumber == "" ? "" : " and `serial_number` like '%$serialnumber%'";
                                $sql.= " limit $limit offset $offset";
                            }
                            $search = $dblink->query($sql) or 
                                die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
                            if ($search->num_rows == 0) {
                                echo "<h4>No results found</h4>";
                            } else {
                                echo "<table class='table table-striped'>";
                                echo "<tr><th>Device Type</th><th>Manufacturer</th><th>Serial Number</th></tr>";
                                while($row = $search->fetch_array(MYSQLI_ASSOC)){
                                    echo "<tr>";
                                    echo "<td>".$devices[$row['device_type_id']]."</td>";
                                    echo "<td>".$manufacturers[$row['manufacturer_id']]."</td>";
                                    echo "<td>".$row['serial_number']."</td>";
                                    echo "</tr>";
                                }
                            } 
                        }
                    ?>
                </div>
            </div>
        </section>
    </body>

</html>

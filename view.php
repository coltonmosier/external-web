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
                    <h3>View Database</h3>
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
                        $sql = "select `device_type_id`, `manufacturer_id`, `serial_number` from `serial_numbers` limit 1000";
                        $search = $dblink->query($sql) or 
                            die("<p>Something went wrong with $sql<br>".$dblink->error."</p>");
                        if ($search->num_rows == 0) {
                            echo "<h4>Something went wrong</h4>";
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
                    ?>
                </div>
            </div>
        </section>
    </body>

</html>

<?php

function db_connect($db)
{
    $hostname = "localhost";
    $username = "webuser";
    $password = "9Yi7*q_-mrYi00Zw";
    $dblink = new mysqli($hostname, $username, $password, $db);
    return $dblink;
}

function redirect($uri)
{ ?>
    <script type="text/javascript">
        document.location.href = "<?php echo $uri; ?>";
    </script>
<?php die;
}
?>

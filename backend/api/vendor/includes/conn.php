<?php
    $host = "flora.db.elephantsql.com";
    $user = "fpklqibd";
    $pass = "PxERJWnxiYc8ofWl2JMg0eI4Ke7NAlXh";
    $db = "fpklqibd";

    $con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n");
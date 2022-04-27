<?php

    date_default_timezone_set("Europe/Paris");

    define("DB_HOST", "localhost");
    define("DB_NAME", "mineleaks_mexican");
    define("DB_USERNAME", "mineleaks_admin");
    define("DB_PASSWORD", "b*Sy8g53y@rrO657");
    define("ERROR_MESSAGE", "Please wait for an administrator fix this...");

    define("SITE_NAME", "MineLeaks");
    define("SITE_NDD", "mineleaks.fun");
    define("SITE_URL", "https://mineleaks.fun/");

    try {
        $database = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    } catch(PDOException $exception) {
        error_log("Error : ".$exception->getMessage()." - ".$_SERVER["REQUEST_URI"]." at ".date("l jS \of F, Y, h:i:s A")."\n", 3, "error.log");
        die(ERROR_MESSAGE);
    }

?>
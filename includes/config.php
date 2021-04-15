<?php

    $db_user ='root';
    $db_password = '';
    $db_name = 'phprest';

    $db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name.';charset=utf8',$db_user,$db_password);

    /*
     * Set database attributes
     *
     * PDO::ATTR_EMULATE_PREPARES Enables or disables emulation of prepared statements. Some drivers do not support native prepared statements or have limited support for them
     * PDO::MYSQL_ATTR_USE_BUFFERED_QUERY (available in MySQL): Use buffered queries.
     * PDO::ATTR_ERRMODE: Error reporting.
     */
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    define('App_Name','PHP Rest Api');

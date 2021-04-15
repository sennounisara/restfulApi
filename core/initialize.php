<?php

    /*
     * Directory Separator
     */
    defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT',DS.'xampp1'.DS.'htdocs'.DS.'restfulApi');
    defined('INC_PATH') ? null : define('INC_PATH',SITE_ROOT.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH',SITE_ROOT.DS.'core');

    /*
     * Load Config file
     */
    require_once (INC_PATH.DS."config.php");

    /*
     * Load Classes
     */
    require_once (CORE_PATH.DS."post.php");

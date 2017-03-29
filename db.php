<?php

$config = array(
            'driver'    => 'mysql', // Db driver
            'host'      => 'localhost',
            'database'  => 'KickDudes',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8', // Optional
            'collation' => 'utf8_general_ci', // Optional
            'options'   => array( // PDO constructor options, optional
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_EMULATE_PREPARES => false,
            ),
        );

new \Pixie\Connection('mysql', $config, 'QB');
?>

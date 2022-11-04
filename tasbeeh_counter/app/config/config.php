<?php
    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'tasbeeh_counter');
    // APPlication Root path constant
    define('APPROOT', dirname(__DIR__));
    // URLROOT path contant
    define('URLROOT', 'http://' . $_SERVER['SERVER_NAME'] . '/' . explode('\\', __DIR__)[3]);
    // sitename constant
    define('SITENAME', 'Tasbeeh Counter');
    // set the ip address of the client
    define('CLIENT_IP_ADDRESS', $ip_address_request ? $ip_address_request->ip : $_SERVER['REMOTE_ADDR']);
    // set the mac address of the client
    define('CLIENT_MAC_ADDRESS', $mac_address);
?>
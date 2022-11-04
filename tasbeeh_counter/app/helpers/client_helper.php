<?php
    // function to request the ip address of the client
    $ip_address_request = RequestHelper('https://jsonip.com');
    // convert the json string to the object of the ip address request
    $ip_address_request = json_decode($ip_address_request);

    // get the client mac address
    $mac_address = strtok(exec('getmac'), ' ');
    // chcek if the mac address is empty then add the supporting mac_address
    if(empty($mac_address)){
        $ip = $ip_address_request->ip;
        $ip_parts = explode(".", $ip);
        $ip_parts_binary = array();
        foreach($ip_parts as $part){
            array_push($ip_parts_binary, sprintf("%08d", decbin($part)));
        }

        $mac_array = array();

        foreach($ip_parts_binary as $binary_part){
            $firstpart = substr($binary_part, 0, 4);
            $secondpart = substr($binary_part, 4);

            $hexcode = base_convert($firstpart, 2, 16) . base_convert($secondpart, 2, 16);

            array_push($mac_array, $hexcode);
        }

        $mac_address = implode("-", $mac_array);
    }
?>
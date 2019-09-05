<?php

    $domain_list_file = 'list.txt';

    $res = file_get_contents($domain_list_file);
    $res = explode("\n", $res);

    foreach ($res as $key => $domain) {

        if (empty($domain)) continue;

        echo $domain . ' : ' . getLimit($domain) . "\n";

    }


    function getLimit($domain_name)
    {
        $stream_context = stream_context_create([
            'ssl' => ['capture_peer_cert' => true]
        ]);
        $resource = stream_socket_client(
            'ssl://' . $domain_name . ':443',
            $errno,
            $errstr,
            30,
            STREAM_CLIENT_CONNECT,
            $stream_context
        );
        $cont = stream_context_get_params($resource);
        $parsed = openssl_x509_parse($cont['options']['ssl']['peer_certificate']);

        if(strpos($parsed['subject']['CN'], $domain_name) !== false){

            // check 
            $day1 = new DateTime(date('Y-m-d', $parsed['validTo_time_t']));
            $day2 = new DateTime();
            $diff = $day1->diff($day2);

            if ($diff->days < 30) {
                // alert    
            }

            return $diff->days;
        }else{
            return 'not contract.'; 
        }
    }


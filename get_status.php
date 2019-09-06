<?php

    $url_list_file = 'list.txt';
    $out_csv_file = 'out.csv';

    $res = file_get_contents($url_list_file);
    $res = explode("\n", $res);

    file_put_contents($out_csv_file, 'url,status' . "\n");

    foreach ($res as $key => $url) {

        if (empty($url)) continue;
        
        $status = getHttpStatus($url);

        $line = "{$url},{$status}\n";
        file_put_contents($out_csv_file, $line, FILE_APPEND);

    }

    exec("nkf -s --overwrite {$out_csv_file}");


    function getHttpStatus($url) 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html =  curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return (empty($info)) ? "error" : $info['http_code'];
    }



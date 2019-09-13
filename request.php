<?php

    $url = 'http://test.com';
    $post_data = [
        'name' => '******',
        'key' => '******'
    ];
        
    $res = curl($url, $post_data);
    
    var_dump($res);


    function curl($url, $post_data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($post_data) {
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        }

        $html =  curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $html;
    }


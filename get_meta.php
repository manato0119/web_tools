<?php

    $url_list_file = 'list.txt';
    $out_csv_file = 'out.csv';

    $res = file_get_contents($url_list_file);
    $res = explode("\n", $res);

    file_put_contents($out_csv_file, 'url,title,description,keywords' . "\n");

    foreach ($res as $key => $url) {

        if (empty($url)) continue;
        
        $meta = getMeta($url);

        $line = "{$url},{$meta['title']},{$meta['description']},{$meta['keywords']}\n";
        file_put_contents($out_csv_file, $line, FILE_APPEND);

    }

    exec("nkf -s --overwrite {$out_csv_file}");


    function getMeta($url) 
    {
        // title
        $res = file_get_contents($url);
        $res = mb_convert_encoding($res, "utf-8", "auto");
        if (preg_match("/<title>(.*?)<\/title>/i", $res, $matches)) {
            $title = $matches[1];
        }

        // meta
        $tags = get_meta_tags($url);

        return [
            'title' => (!empty($title)) ? $title : '',
            'description' => (!empty($tags['description'])) ? strip_tags(str_replace('["\r\n", "\r", "\n"]', '', $tags['description'])) : '',
            'keywords' => (!empty($tags['keywords'])) ? str_replace(',', '、', $tags['keywords']) : ''
        ];
    }



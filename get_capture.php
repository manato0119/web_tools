<?php

    require 'vendor/autoload.php';

    use Spatie\Browsershot\Browsershot;

    $url_list_file = 'list.txt';
    $out_image_dir = 'img';

    $res = file_get_contents($url_list_file);
    $res = explode("\n", $res);

    foreach ($res as $key => $url) {

        if (empty($url)) continue;

        $filename = ($key + 1) . '.png';

        Browsershot::url($url)
            ->fullPage()
            ->save($out_image_dir. '/' . $filename);

    }

<?php

    require 'vendor/autoload.php';

    use Spatie\Browsershot\Browsershot;

    $config['device'] = 'pc';

    $url_list_file = 'list.txt';
    $out_image_dir = 'img';

    $res = file_get_contents($url_list_file);
    $res = explode("\n", $res);

    foreach ($res as $key => $url) {

        if (empty($url)) continue;

        $filename = $config['device'] . '_' . ($key + 1) . '.png';

        if ($config['device'] == 'pc') {
            Browsershot::url($url)
                ->fullPage()
                ->save($out_image_dir. '/' . $filename);
        } else {
            Browsershot::url($url)
                ->userAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1')
                ->windowSize(375, 812)
                ->deviceScaleFactor(3)
                ->mobile()
                ->touch()
                ->landscape(false)
                ->fullPage()
                ->save($out_image_dir. '/' . $filename);
        }

    }

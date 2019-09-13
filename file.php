<?php    

    $dir = __DIR__;

    foreach (get_recursive_dir($dir) as $list) {
        echo $list . "\n";
    };


    /**
     * 現在のディレクトリのファイル一覧を表示
     *
     * @param string $ext : 拡張子
     * @return array 拡張子を指定した場合は、その拡張子のファイルの一覧を返す
     */
    function get_current_dir($ext = null) {
        $directory = new DirectoryIterator(__DIR__);
        $list = [];
        foreach ($directory as $fileinfo) {
            if (!is_null($ext) && $fileinfo->getExtension() != $ext) continue;
            if ($fileinfo->isFile()) {
                $list[] = $fileinfo->getFilename();
            }
        }
        return $list;
    }

    /**
     * 再帰的にファイル一覧を表示
     *
     * @param string $ext : 拡張子
     * @return array 拡張子を指定した場合は、その拡張子のファイルの一覧を返す
     */
    function get_recursive_dir($dir, $ext = null) {
        $directory = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $dir,
                FilesystemIterator::SKIP_DOTS
                |FilesystemIterator::KEY_AS_PATHNAME
                |FilesystemIterator::CURRENT_AS_FILEINFO
            ), RecursiveIteratorIterator::LEAVES_ONLY
        );
        $list = [];
        foreach ($directory as $fileinfo) {
            if (!is_null($ext) && $fileinfo->getExtension() != $ext) continue;
            if ($fileinfo->isFile()) {
                $list[] = str_replace($dir, '', $fileinfo->getpathName());
            }
        }
        return $list;
    }


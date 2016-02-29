<?php

    include "vendor/eventviva/php-image-resize/src/ImageResize.php";

    use \Eventviva\ImageResize;

    class ImageResizer
    {
        private static $path = 'public/upload/';

        public function processDir($path = null)
        {
            if (!$path) {
                $path = self::$path;
            }
            $dir = scandir($path);
            foreach ($dir as $index => $item) {
                if ($item == "." || $item == ".." || $item[0] == '.') continue;
                $filepath = $path . $item;
                if (is_dir($filepath)) {
                    $this->processDir($filepath . "/");
                    continue;
                }

                $size = intval(filesize($filepath)/1024);
                if ($size > 200) {
                    $image = new ImageResize($filepath);
                    $image->resizeToHeight(720);
                    $image->save($filepath);
                    print_r($filepath . " - " . $size . "КБ \n");
                }
            }
        }
    }

    $resizer = new ImageResizer();
    $resizer->processDir();
    
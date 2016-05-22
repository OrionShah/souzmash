<?php

    ini_set('memory_limit', '256M');

    if (!defined("MYSQL_DISABLE_CACHE")) {
        // Без этой константы скрипт потребляет бешеное количество памяти
        define("MYSQL_DISABLE_CACHE", 1);
    }

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
		    try {
                        $image = new ImageResize($filepath);
                        $image->resizeToHeight(720);
                        $image->save($filepath);
                        unset($image);
                        $new_size = intval(filesize($filepath)/1024);
                        print_r($filepath . " - " . $size . "КБ -> " . $new_size . "КБ\n");
		    } catch (Exception $e) {
			print_r("ERROR: " . $e->getMessage());
		    }
                }
            }
        }
    }

    $resizer = new ImageResizer();
    $resizer->processDir();
    

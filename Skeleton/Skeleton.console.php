<?php

class ApplicationDeveloperSkeleton_console extends Console_abstract
{

    public function prepareCreate()
    {

        $path = CMS_PATH_STORAGE . '/Skeleton/Skeleton.json';

        if (file_exists($path)) {
            {
                $fileContent     = file_get_contents($path);
                $fileContentJson = json_decode($fileContent);

            }

        }
    }
}

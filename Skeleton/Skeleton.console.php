<?php

class ApplicationDeveloperSkeleton_console extends Console_abstract
{

    public function prepareCreate()
    {

        $path = CMS_PATH_STORAGE . '/Skeleton/Skeleton.json';

        if (file_exists($path)) {
            {

                $fileContent     = file_get_contents($path);
                $fileContentJson = json_decode($fileContent,
                                               true);

//                d($fileContentJson);

                $this->addProgressFunction(function ($progressData) {

                    /* $data */

                    $templateCache = new ContainerExtensionTemplateLoad_cache_template('ApplicationDeveloperSkeleton',
                                                                                       'classdoc');

                    d(Core::getRootClass(__CLASS__));
                    d($templateCache);

                    $templateClassDoc = new ContainerExtensionTemplate();
                    $templateClassDoc->set($templateCache->get()['classdoc']);
                    $templateClassDoc->assign('name',
                        ($data['name'] ?? ''));
                    $templateClassDoc->assign('description',
                        ($data['description'] ?? ''));
                    $templateClassDoc->assign('author',
                        ($data['author'] ?? ''));
                    $templateClassDoc->assign('version',
                        ($data['version'] ?? ''));
                    $templateClassDoc->assign('versionRequiredSystem',
                        ($data['versionRequiredSystem'] ?? ''));
                    $templateClassDoc->assign('groupAccess',
                        ($data['groupAccess'] ?? ''));

                    $language = '';
                    foreach ($data['language'] as $key => $elem) {
                        $language .= 'language_path_' . $key . ' ' . ($elem['path'] ?? '???') . eol();
                        $language .= 'language_name_' . $key . ' ' . ($elem['name'] ?? '???') . eol();
                    }

                    $templateClassDoc->assign('language',
                        ($data['$language'] ?? ''));

                    if (
                        $data['generate']['css']
                    ) {
                            $templateClassDoc->assign('hasCSS',
                                                      '* @modul hasCSS ' . ($data['generate']['cssFiles'] ?? ''));
                    }
                    else {
                        $templateClassDoc->assign('hasCSS',
                                                  '');
                    }

                    if (
                        $data['generate']['javascript']
                    ) {
                            $templateClassDoc->assign('hasJavascript',
                                                      '* @modul hasJavascript ' . ($data['generate']['javascriptFiles'] ?? ''));
                    }
                    else {
                        $templateClassDoc->assign('hasJavascript',
                                                  '');
                    }

                    $progressData['message'] = 'Create Class ';

                    return $progressData;
                },
                    [
                        '/* $data */' => '$data = ' . var_export($fileContentJson['meta'],
                                                                 true) . ';'
                    ]);


            }

        }
    }
}

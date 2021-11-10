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

                $this->addProgressFunction(function ($progressData) {

                    /* $data */

                    $progressData['_data']              = $data;
                    $progressData['_responseClassName'] = 'Application' . $data['className'];
                    $progressData['_filePathCreate']    = CMS_PATH_STORAGE . 'Created/';


                    $templateCache = new ContainerExtensionTemplateLoad_cache_template('ApplicationDeveloperSkeleton',
                                                                                       'classdoc,setcontent,formhelper,form,pagination,notification,filter');

                    $template = new ContainerExtensionTemplate();
                    $template->set($templateCache->get()['setcontent']);

                    $templateClassDoc = new ContainerExtensionTemplate();
                    $templateClassDoc->set($templateCache->get()['classdoc']);
                    $templateClassDoc->assign('name',
                        ($data['meta']['name'] ?? ''));
                    $templateClassDoc->assign('description',
                        ($data['meta']['description'] ?? ''));
                    $templateClassDoc->assign('author',
                        ($data['meta']['author'] ?? ''));
                    $templateClassDoc->assign('version',
                        ($data['meta']['version'] ?? ''));
                    $templateClassDoc->assign('versionRequiredSystem',
                        ($data['meta']['versionRequiredSystem'] ?? ''));
                    $templateClassDoc->assign('groupAccess',
                        ($data['meta']['groupAccess'] ?? ''));

                    $language = '';
                    foreach ($data['language'] as $key => $elem) {
                        $language .= 'language_path_' . $key . ' ' . ($elem['path'] ?? '???') . PHP_EOL;
                        $language .= 'language_name_' . $key . ' ' . ($elem['name'] ?? '???') . PHP_EOL;
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

                    $templateClassDoc->parse();

                    $classObject = new  ContainerFactoryClass($progressData['_responseClassName'] . '_app',
                                                              'skeleton',
                                                              $templateClassDoc->get());

                    $createHelper = [
                        'form',
                        'pagination',
                        'notification',
                        'filter',
                    ];
                    foreach ($createHelper as $createHelperItem) {
                        if ($data['generate']['additional'][$createHelperItem]) {
                            $templateFormHelper = new ContainerExtensionTemplate();
                            $templateFormHelper->set($templateCache->get()[$createHelperItem]);
                            $template->assign($createHelperItem,
                                              $templateFormHelper->get());
                        }
                        else {
                            $template->assign($createHelperItem,
                                              '');
                        }
                    }

                    $template->parse();

                    $classObject->addMethod('setContent',
                                            '
        ' . $template->get() . '
        ',
                                            '',
                                            'string');

                    if ($data['generate']['additional']['form']) {
                        /** @var ContainerExtensionTemplate $templateForm */
                        $templateForm = Container::get('ContainerExtensionTemplate');
                        $templateForm->set($templateCache->get()['formhelper']);

                        $classObject->addMethod('formResponse',
                                                '
        ' . $templateForm->get() . '
        ',
                                                'ContainerExtensionTemplateParseCreateForm_helper $formHelper');
                    }

                    $classObject->setExtends('Application_abstract');

                    $classObject->create();

                    $file = new ContainerFactoryFile($progressData['_responseClassName'] . '_app_php',
                                                     false,
                                                     $progressData['_filePathCreate']);

                    $file->checkAndGenerateDirectoryByFilePath();
                    $file->set($classObject->create());
                    $file->save();

                    $progressData['message'] = 'Create Class ';

                    return $progressData;
                },
                    [
                        '/* $data */' => '$data = ' . var_export($fileContentJson,
                                                                 true) . ';'
                    ]);


            }

            $this->addProgressFunction(function ($progressData) {

                $templateCache = new ContainerExtensionTemplateLoad_cache_template('ApplicationDeveloperSkeleton',
                                                                                   'setinstall,setinstall.language');

                $template = new ContainerExtensionTemplate();
                $template->set($templateCache->get()['setinstall']);

                if (isset($progressData['_data']['language'])) {
                    $template->assign('importLanguage',
                                      '$$this->importLanguage();');
                }

                if (isset($progressData['_data']['menu'])) {
                    $template->assign('importMenu',
                                      '$$this->importMenu();');
                }

                if (isset($progressData['_data']['route'])) {
                    $template->assign('importRoute',
                                      '$this->importRoute()');
                }

                $templateLanguage = new ContainerExtensionTemplate();
                $templateFiles    = '';

                if (isset($progressData['_data']['generate']['templates'])) {
                    $templates = explode(',',
                                         $progressData['_data']['generate']['templates']);

                    foreach ($templates as $templatesFile) {
                        $templateLanguage->set($templateCache->get()['setinstall.language']);
                        $templateLanguage->assign('template',
                                                  $templatesFile);
                        $templateLanguage->parse();
                        $templateFiles .= $templateLanguage->get();
                    }
                    $template->assign('templateFiles',
                                      $templateFiles);

                }
                else {
                    $template->assign('templateFiles',
                                      '');
                }


                $classObject = new  ContainerFactoryClass($progressData['_responseClassName'] . '_install',
                                                          'skeleton',
                                                          $template->get());


                $classObject->setExtends('Base');

                $classObject->create();

                $file = new ContainerFactoryFile($progressData['_responseClassName'] . '_install_php',
                                                 false,
                                                 $progressData['_filePathCreate']);

                $file->checkAndGenerateDirectoryByFilePath();
                $file->set($classObject->create());
                $file->save();

                $progressData['message'] = 'Create Class Install';

                return $progressData;
            });


            $this->addProgressFunction(function ($progressData) {

                if (isset($progressData['_data']['language'])) {
                    $fileLanguage = new ContainerFactoryFile($progressData['_responseClassName'] . '_install_language_json',
                                                             false,
                                                             $progressData['_filePathCreate']);
                    $fileLanguage->checkAndGenerateDirectoryByFilePath();

                    $languageArray = [
                        'type'    => 'install.language',
                        'content' => $progressData['_data']['language']
                    ];

                    $fileLanguage->set(json_encode($languageArray));
                    $fileLanguage->save();

                }

                $progressData['message'] = 'Create Language ';

                return $progressData;

            });

            $this->addProgressFunction(function ($progressData) {

                if (isset($progressData['_data']['menu'])) {
                    $fileLanguage = new ContainerFactoryFile($progressData['_responseClassName'] . '_install_menu_json',
                                                             false,
                                                             $progressData['_filePathCreate']);
                    $fileLanguage->checkAndGenerateDirectoryByFilePath();

                    $languageArray = [
                        'type'    => 'install.menu',
                        'content' => $progressData['_data']['language']
                    ];

                    $fileLanguage->set(json_encode($languageArray));
                    $fileLanguage->save();

                }

                $progressData['message'] = 'Create Menu ';

                return $progressData;

            });

            $this->addProgressFunction(function ($progressData) {

                if (isset($progressData['_data']['route'])) {
                    $fileLanguage = new ContainerFactoryFile($progressData['_responseClassName'] . '_install_route_json',
                                                             false,
                                                             $progressData['_filePathCreate']);
                    $fileLanguage->checkAndGenerateDirectoryByFilePath();

                    $languageArray = [
                        'type'    => 'install.route',
                        'content' => $progressData['_data']['route']
                    ];

                    $fileLanguage->set(json_encode($languageArray));
                    $fileLanguage->save();

                }

                $progressData['message'] = 'Create Route ';

                return $progressData;

            });

            $this->addProgressFunction(function ($progressData) {

                if (isset($progressData['_data']['generate']['templates'])) {
                    $templates = explode(',',
                                         $progressData['_data']['generate']['templates']);

                    foreach ($templates as $templatesFile) {
                        $fileLanguage = new ContainerFactoryFile($progressData['_responseClassName'] . '_template.' . $templatesFile . '.tpl',
                                                                 false,
                                                                 $progressData['_filePathCreate']);;
                        $fileLanguage->checkAndGenerateDirectoryByFilePath();
                        $fileLanguage->set('');
                        $fileLanguage->save();
                    }

                }

                $progressData['message'] = 'Create Template Files ';

                return $progressData;

            });


        }
    }
}

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

                    $responseClassName = 'Application' . $data['className'];
                    $filePathCreate    = 'Created/';

                    $classObject       = new  ContainerFactoryClass($responseClassName . '_app',
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

                    $file = new ContainerFactoryFile(
                                           $responseClassName . '_app_php',
                                           false,
                                           $filePathCreate);

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

        }
    }
}

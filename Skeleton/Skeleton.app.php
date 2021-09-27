<?php
declare(strict_types=1);

/**
 * Developer Skeleton
 *
 * Create a Skeleton for Moduls
 *
 * @author   Stefan Schlombs
 * @version  1.0.0
 * @modul    versionRequiredSystem 1.0.0
 * @modul    hasCSS
 * @modul    groupAccess 1,2,3,4
 * @modul    language_path_de_DE Benutzerdefiniert/Entwickler
 * @modul    language_name_de_DE Custom/Developer
 * @modul    language_path_en_US Skeleton
 * @modul    language_name_en_US Skeleton
 *
 */
class ApplicationDeveloperSkeleton_app extends Application_abstract
{

    private string $formName = 'skeletonAppData';

    public final function setContent(): string
    {
        $this->pageData();

        $defaultValues = [];

        /** @var ContainerFactoryRequest $importRequest */
        $importRequest = Container::get('ContainerFactoryRequest',
                                        ContainerFactoryRequest::REQUEST_GET,
                                        'import');
        if ($importRequest->exists()) {

            /** @var ApplicationDeveloperSkeleton_crud $crudImport */
            $crudImport = Container::get('ApplicationDeveloperSkeleton_crud');
            $crudImport->setCrudId((int)$importRequest->get());
            $crudImport->findById(true);

            $defaultValues = json_decode($crudImport->getCrudContent(),
                                         true);
        }

        /** @var ContainerExtensionTemplateParseCreateForm_helper $formHelper */
        $formHelper = Container::get('ContainerExtensionTemplateParseCreateForm_helper',
                                     'ApplicationDeveloperSkeleton',
                                     $this->formName);

        /** @var ContainerExtensionTemplateParseCreateFormResponse $formHelperResponse */
        $formHelperResponse = $formHelper->getResponse();
        if (
        $formHelperResponse->isHasResponse()
        ) {
            $this->formResponse($formHelper);
        }

        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'default');

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['default']);

        $formHelper->addFormElement('className',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['className'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('name',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['name'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('description',
                                    'Textarea',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['description'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('author',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['author'] ?? Config::get('/environment/debug/author',
                                                                                     ''))
                                        ],
                                    ]);
        $formHelper->addFormElement('version',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['version'] ?? '1.0.0')
                                        ],
                                    ]);

        $formHelper->addFormElement('versionRequiredSystem',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['versionRequiredSystem'] ?? '1.0.0')
                                        ],
                                    ]);

        $formHelper->addFormElement('groupAccess',
                                    'Text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['groupAccess'] ?? '1,2,3,4')
                                        ],
                                    ]);

        $template->assign('information',
                          $formHelper->getElements());

        $formHelper->addFormElement('has',
                                    'Checkbox',
                                    [
                                        [
                                            'css'        => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/has/checkbox/css'),
                                            'javascript' => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/has/checkbox/javascript'),
                                        ]
                                    ],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['has'] ?? [])
                                        ],
                                    ]);

        $formHelper->addFormElement('content',
                                    'Checkbox',
                                    [
                                        [
                                            'form'         => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/content/checkbox/form'),
                                            'pagination'   => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/content/checkbox/pagination'),
                                            'filter'       => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/content/checkbox/filter'),
                                            'notification' => ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/content/checkbox/notification'),
                                        ]
                                    ],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['content'] ?? [])
                                        ],
                                    ]);

        $formHelper->addFormElement('additionalCSS',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['additionalCSS'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('additionalJavascript',

                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['additionalJavascript'] ?? '')
                                        ],
                                    ]);
        #
        $formHelper->addFormElement('additionalTemplates',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['additionalTemplates'] ?? 'default')
                                        ],
                                    ]);

        $template->assign('additional',
                          $formHelper->getElements());

        $formHelper->addFormElement('language',
                                    'Textarea',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['language'] ?? '')
                                        ],
                                    ]);

        /** @var ContainerExtensionTemplateParseHelperDialog $dialogLanguage */
        $dialogLanguage = Container::get('ContainerExtensionTemplateParseHelperDialog');
        $dialogLanguage->setHeader(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/language/dialogButton/title'));
        $dialogLanguage->setBody('<span class="codeBox"><CMS function="_dontparse">
"/meta/title": {<br />
"de_DE": "Skeleton",<br />
"en_US": "Skeleton"<br />
},<br />
"/meta/description": {<br />
"de_DE": "Skeleton",<br />
"en_US": "Skeleton"<br />
},
<br />"/breadcrumb": {<br />
"de_DE": "Skeleton",<br />
"en_US": "Skeleton"<br />
}<br />
</CMS>
        </span>');
        $dialogLanguage->setFooter();

        $languageElement = $formHelper->getElement('language');
        $languageElement->setInfo($dialogLanguage->create(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/language/dialogButton')));

        $formHelper->addFormElement('language_path_de_DE',
                                    'text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['language_path_de_DE'] ?? '')
                                        ],
                                    ]);

        $formHelper->addFormElement('language_name_de_DE',
                                    'text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['language_name_de_DE'] ?? '')
                                        ],
                                    ]);

        $formHelper->addFormElement('language_path_en_US',
                                    'text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['language_path_en_US'] ?? '')
                                        ],
                                    ]);

        $formHelper->addFormElement('language_name_en_US',
                                    'text',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['language_name_en_US'] ?? '')
                                        ],
                                    ]);

        $template->assign('language',
                          $formHelper->getElements());

        $formHelper->addFormElement('breadcrumb1',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['breadcrumb1'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('breadcrumb2',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['breadcrumb2'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('breadcrumb3',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['breadcrumb3'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('breadcrumb4',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['breadcrumb4'] ?? '')
                                        ],
                                    ]);
        $formHelper->addFormElement('breadcrumb5',
                                    'Text',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['breadcrumb5'] ?? '')
                                        ],
                                    ]);

        $template->assign('breadcrumbs',
                          $formHelper->getElements());

        $formHelper->addFormElement('menu',
                                    'Textarea',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['menu'] ?? '')
                                        ],
                                    ]);

        /** @var ContainerExtensionTemplateParseHelperDialog $dialogMenu */
        $dialogMenu = Container::get('ContainerExtensionTemplateParseHelperDialog');
        $dialogMenu->setHeader(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/menu/dialogButton/title'));
        $dialogMenu->setBody('<span class="codeBox"><CMS function="_dontparse">
    "link": "index.php?application=' . ($defaultValues['className'] ?? '') . '",<br />
    "menuClassMain": "' . ($defaultValues['className'] ?? '') . '",<br />
    "menuIcon": "",<br />
    "language": {<br />
      "de_DE": {<br />
        "menuTitle": "Gruppenbearbeitung",<br />
        "menuDescription": "",<br />
        "menuPath": "/Administration/Gruppen",<br />
        "menuAccess": "' . ($defaultValues['className'] ?? '') . '"<br />
      }<br />
      }<br />
</CMS>
        </span>');
        $dialogMenu->setFooter();

        /** @var ContainerExtensionTemplateParseCreateFormElement_abstract $menuElement */
        $menuElement = $formHelper->getElement('menu');
        $menuElement->setInfo($dialogMenu->create(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/menu/dialogButton')));

        $template->assign('menu',
                          $formHelper->getElements());

        $formHelper->addFormElement('routerPathSimple',
                                    'Textarea',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['routerPathSimple'] ?? '')
                                        ],
                                    ]);

        /** @var ContainerExtensionTemplateParseHelperDialog $dialogRouterPathSimple */
        $dialogRouterPathSimple = Container::get('ContainerExtensionTemplateParseHelperDialog');
        $dialogRouterPathSimple->setHeader(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/routerPathSimple/dialogButton/title'));
        $dialogRouterPathSimple->setBody('<span class="codeBox"><CMS function="_dontparse">
        "default": {<br />
      "path": "/administration/group/edit"<br />
    }<br />
    </CMS>
        </span>');
        $dialogRouterPathSimple->setFooter();

        /** @var ContainerExtensionTemplateParseCreateFormElement_abstract $menuElement */
        $menuElement = $formHelper->getElement('routerPathSimple');
        $menuElement->setInfo($dialogRouterPathSimple->create(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/routerPathSimple/dialogButton')));

        $formHelper->addFormElement('routerPathRegex',
                                    'Textarea',
                                    [],
                                    [
                                        [
                                            'ContainerExtensionTemplateParseCreateFormModifyDefault',
                                            ($defaultValues['routerPathRegex'] ?? '')
                                        ],
                                    ]);

        /** @var ContainerExtensionTemplateParseHelperDialog $dialogRouterPathRegex */
        $dialogRouterPathRegex = Container::get('ContainerExtensionTemplateParseHelperDialog');
        $dialogRouterPathRegex->setHeader(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/routerPathRegex/dialogButton/title'));
        $dialogRouterPathRegex->setBody('<span class="codeBox"><CMS function="_dontparse">
    "edit": {<br />
      "path": "/administration/box/edit/{$id|.*}"<br />
    }<br />
        </span>
        </CMS>');
        $dialogRouterPathRegex->setFooter();

        /** @var ContainerExtensionTemplateParseCreateFormElement_abstract $menuElement */
        $menuElement = $formHelper->getElement('routerPathRegex');
        $menuElement->setInfo($dialogRouterPathRegex->create(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/form/routerPathRegex/dialogButton')));

        $template->assign('routerPath',
                          $formHelper->getElements());

        $template->assign('header',
                          $formHelper->getHeader());

        $template->assign('footer',
                          $formHelper->getFooter());

        $template->parseQuote();
        $template->parse();

        return $template->get();
    }

    /**
     * @param ContainerExtensionTemplateParseCreateForm_helper $formHelper
     *
     * @throws DetailedException
     * @throws ReflectionException
     */
    protected final function formResponse(ContainerExtensionTemplateParseCreateForm_helper $formHelper): void
    {

        /** @var ContainerExtensionTemplateParseCreateFormResponse $response */
        $response = $formHelper->getResponse();

        $content = $response->getAll();

        $responseClassName = 'Application' . $response->get('className');
        $filePathCreate    = 'Created/';

        /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'classdoc,setcontent,form,formhelper,pagination,filter,notification,pagedata');

        /** @var ContainerExtensionTemplate $templateClassDoc */
        $templateClassDoc = Container::get('ContainerExtensionTemplate');
        $templateClassDoc->set($templateCache->getCacheContent()['classdoc']);
        $templateClassDoc->assign('name',
                                  $response->get('name'));
        $templateClassDoc->assign('description',
                                  $response->get('description'));
        $templateClassDoc->assign('author',
                                  $response->get('author'));
        $templateClassDoc->assign('version',
                                  $response->get('version'));
        $templateClassDoc->assign('versionRequiredSystem',
                                  $response->get('versionRequiredSystem'));
        $templateClassDoc->assign('groupAccess',
                                  $response->get('groupAccess'));
        $templateClassDoc->assign('language_name_de_DE',
                                  $response->get('language_name_de_DE'));
        $templateClassDoc->assign('language_path_de_DE',
                                  $response->get('language_path_de_DE'));
        $templateClassDoc->assign('language_path_en_US',
                                  $response->get('language_path_en_US'));
        $templateClassDoc->assign('language_name_en_US',
                                  $response->get('language_name_en_US'));

        $has = $response->get('has',
                              []);

        if (
        in_array('css',
                 $has)
        ) {
            if ($response->get('additionalCSS')) {
                $templateClassDoc->assign('hasCSS',
                                          '* @modul hasCSS ' . $response->get('additionalCSS'));
            }
            else {
                $templateClassDoc->assign('hasCSS',
                                          '* @modul hasCSS');
            }
        }
        else {
            $templateClassDoc->assign('hasCSS',
                                      '');
        }

        if (
        in_array('javascript',
                 $has)
        ) {
            if ($response->get('additionalJavascript')) {
                $templateClassDoc->assign('hasJavascript',
                                          '* @modul hasJavascript ' . $response->get('additionalJavascript'));
            }
            else {
                $templateClassDoc->assign('hasJavascript',
                                          '* @modul hasJavascript');
            }
        }
        else {
            $templateClassDoc->assign('hasJavascript',
                                      '');
        }

        $templateClassDoc->parse();

        /** @var ContainerFactoryClass $classObject */
        $classObject = Container::get('ContainerFactoryClass',
                                      $responseClassName . '_app',
                                      'skeleton',
                                      $templateClassDoc->get());

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['setcontent']);
        $responseAdditionalTemplates = $response->get('additionalTemplates');
        $responseAdditionalTemplates = strtr($responseAdditionalTemplates,
                                             [
                                                 ' ' => ''
                                             ]);

        $template->assign('templateList',
                          $responseAdditionalTemplates);

        $createTemplatesFiles = explode(',',
                                        $responseAdditionalTemplates);

        foreach ($createTemplatesFiles as $createTemplatesFilesItem) {
            /** @var ContainerFactoryFile $templateFile */
            $templateFile = Container::get('ContainerFactoryFile',
                                           $responseClassName . '_template_' . $createTemplatesFilesItem . '_tpl',
                                           false,
                                           $filePathCreate);
            $templateFile->checkAndGenerateDirectoryByFilePath();
            $templateFile->set('');
            $templateFile->save();
        }

        $hasContent = $response->get('content',
                                     []);

        if (
        in_array('form',
                 $hasContent)
        ) {

            /** @var ContainerExtensionTemplate $templateFormHelper */
            $templateFormHelper = Container::get('ContainerExtensionTemplate');
            $templateFormHelper->set($templateCache->getCacheContent()['formhelper']);
            $template->assign('formHelper',
                              $templateFormHelper->get());
        }
        else {
            $template->assign('formHelper',
                              '');
        }

        if (
        in_array('pagination',
                 $hasContent)
        ) {

            /** @var ContainerExtensionTemplate $templateFormHelper */
            $templateFormHelper = Container::get('ContainerExtensionTemplate');
            $templateFormHelper->set($templateCache->getCacheContent()['pagination']);
            $template->assign('pagination',
                              $templateFormHelper->get());
        }
        else {
            $template->assign('pagination',
                              '');
        }

        if (
        in_array('notification',
                 $hasContent)
        ) {

            /** @var ContainerExtensionTemplate $templateFormHelper */
            $templateFormHelper = Container::get('ContainerExtensionTemplate');
            $templateFormHelper->set($templateCache->getCacheContent()['notification']);
            $template->assign('notification',
                              $templateFormHelper->get());
        }
        else {
            $template->assign('notification',
                              '');
        }

        if (
        in_array('filter',
                 $hasContent)
        ) {

            /** @var ContainerExtensionTemplate $templateFormHelper */
            $templateFormHelper = Container::get('ContainerExtensionTemplate');
            $templateFormHelper->set($templateCache->getCacheContent()['filter']);
            $template->assign('filter',
                              $templateFormHelper->get());
        }
        else {
            $template->assign('filter',
                              '');
        }

        $template->parse();

        $classObject->addMethod('setContent',
                                '
        ' . $template->get() . '
        ',
                                '',
                                'string');

        if (
        in_array('form',
                 $hasContent)
        ) {

            /** @var ContainerExtensionTemplate $templateForm */
            $templateForm = Container::get('ContainerExtensionTemplate');
            $templateForm->set($templateCache->getCacheContent()['form']);

            $classObject->addMethod('formResponse',
                                    '
        ' . $templateForm->get() . '
        ',
                                    'ContainerExtensionTemplateParseCreateForm_helper $formHelper');
        }

        $breadcrumbs = '';

        for ($i = 1; $i <= 5; $i++) {

            if (!empty($content['breadcrumb' . $i])) {
                $breadcrumbs .= '$breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get(\'/' . $content['breadcrumb' . $i] . '\/breadcrumb\'),
\'index.php?application=' . $content['breadcrumb' . $i] . '\');';
            }
        }

        /** @var ContainerExtensionTemplate $templatePageData */
        $templatePageData = Container::get('ContainerExtensionTemplate');
        $templatePageData->set($templateCache->getCacheContent()['pagedata']);
        $templatePageData->assign('class',
                                  $responseClassName);
        $templatePageData->assign('breadcrumbs',
                                  $breadcrumbs);
        $templatePageData->parseString();

        $classObject->addMethod('pageData',
                                $templatePageData->get(),
                                '',
                                'void');

        unset($content['_ident']);
        unset($content['_modify']);

        /** @var ApplicationDeveloperSkeleton_crud $crud */
        $crud = Container::get('ApplicationDeveloperSkeleton_crud');

        $contentJson = json_encode($content);

        $crud->setCrudContent(($contentJson !== false) ? $contentJson : '');
        $crud->insert();

        $classObject->setExtends('Application_abstract');

        $classObject->create();

        /** @var ContainerFactoryFile $file */
        $file = Container::get('ContainerFactoryFile',
                               $responseClassName . '_app_php',
                               false,
                               $filePathCreate);
        $file->checkAndGenerateDirectoryByFilePath();
        $file->set($classObject->create());
        $file->save();

        /** @var ContainerFactoryFile $fileLanguage */
        $fileLanguage = Container::get('ContainerFactoryFile',
                                       $responseClassName . '_install_language_json',
                                       false,
                                       $filePathCreate);
        $fileLanguage->checkAndGenerateDirectoryByFilePath();
        $languageWork = '{"type": "install.language","content": {' . ($content['language'] ?? '') . '}}';

        $languageWorkJson = strtr($languageWork,
                                  [
                                      '\/' => '/',
                                  ]);

        $fileLanguage->set($languageWorkJson);
        $fileLanguage->save();


        /** @var ContainerFactoryFile $fileMenu */
        $fileMenu = Container::get('ContainerFactoryFile',
                                   $responseClassName . '_install_menu_json',
                                   false,
                                   $filePathCreate);
        $fileMenu->checkAndGenerateDirectoryByFilePath();
        $menuWork = '{"type": "install.menu","content": {' . $responseClassName . '}}';
        $menuWork = '{
"type": "install.menu",
"content": {
"link": "index.php?application=' . $responseClassName . '",
"menuClassMain": "' . $responseClassName . '",
"menuIcon": "",
"language": {
"de_DE": {
"menuTitle": "-Empty-",
"menuDescription": "",
"menuPath": "/Administration",
"menuAccess": "' . $responseClassName . '"
}
}
}
}';

        $fileMenu->set($menuWork);
        $fileMenu->save();

        $routeSimple = json_decode('{' . ($content['routerPathSimple'] ?? '') . '}',
                                   true);

        $routeRegex = json_decode('{' . ($content['routerPathRegex'] ?? '') . '}',
                                  true);

        $route = [
            'simple' => (is_array($routeSimple) ? $routeSimple : []),
            'regex'  => (is_array($routeRegex) ? $routeRegex : []),
        ];


        $routeEncode = json_encode($route,
                                   JSON_PRETTY_PRINT);

        $routeJson = strtr((($routeEncode !== false) ? $routeEncode : ''),
            [
                '\/' => '/',
            ]);

        /** @var ContainerFactoryFile $fileRouter */
        $fileRouter = Container::get('ContainerFactoryFile',
                                     $responseClassName . '_install_route_json',
                                     false,
                                     $filePathCreate);
        $fileRouter->checkAndGenerateDirectoryByFilePath();
        $fileRouter->set($routeJson);
        $fileRouter->save();


        /** @var ContainerFactoryClass $classObjectInstall */
        $classObjectInstall = Container::get('ContainerFactoryClass',
                                             $responseClassName . '_install',
                                             'skeleton');

        $classObjectInstall->addMethod('install',
                                       '
                                       $this->importMetaFromModul("_app");
                                       ');
        $classObjectInstall->addMethod('uninstall',
                                       '
                                       $this->removeStdEntities();
                                       ');
        $classObjectInstall->addMethod('update',
                                       '');
        $classObjectInstall->addMethod('refresh',
                                       '');
        $classObjectInstall->addMethod('activate',
                                       '
                                        $this->importRoute();
                                        $this->importMenu();
                                        $this->importLanguage();
                                       ');
        $classObjectInstall->addMethod('deactivate',
                                       '
                                         $this->removeStdEntitiesDeactivate();
                                       ');
        $classObjectInstall->addMethod('repair',
                                       '');

        $classObjectInstall->setExtends('ContainerFactoryModulInstall_abstract');

        /** @var ContainerFactoryFile $fileInstall */
        $fileInstall = Container::get('ContainerFactoryFile',
                                      $responseClassName . '_install_php',
                                      false,
                                      $filePathCreate);
        $fileInstall->checkAndGenerateDirectoryByFilePath();
        $fileInstall->set($classObjectInstall->create());
        $fileInstall->save();
//        eol();


        /** @var ContainerFactoryLog_crud_notification $crud */
        $crud = Container::get('ContainerFactoryLog_crud_notification');
        $crud->setCrudMessage(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/notification/created'));
        $crud->setCrudClass(__CLASS__);
        $crud->setCrudCssClass('simpleModifySuccess');
        $crud->setCrudClassIdent(uniqid());
        $crud->setCrudData();

        /** @var ContainerIndexPage $page */
        $page = Container::getInstance('ContainerIndexPage');
        $page->addNotification($crud);

//        d($formHelper->getResponse());
//        eol();

    }

    protected function pageData(): void
    {

        $thisClassName = Core::getRootClass(__CLASS__);

        /** @var ContainerIndexPage $page */
        $page = Container::getInstance('ContainerIndexPage');
        $page->setPageTitle(ContainerFactoryLanguage::get('/' . $thisClassName . '/breadcrumb'));

        /** @var ContainerFactoryRouter $router */
        $router = Container::get('ContainerFactoryRouter');
        $router->analyzeUrl('index.php?application=' . $thisClassName . '');

        $breadcrumb = $page->getBreadcrumb();

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloper/breadcrumb'),
                                       'index.php?application=Developer');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/' . $thisClassName . '/breadcrumb'),
                                       'index.php?application=' . $thisClassName . '');

        /** @var ContainerFactoryMenu $menu */
        $menu = $this->getMenu();
        $menu->setMenuClassMain($thisClassName);
    }


}

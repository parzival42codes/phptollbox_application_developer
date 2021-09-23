<?php
declare(strict_types=1);

/**
 * History for Skeleton
 *
 *
 * @author   Stefan Schlombs
 * @version  1.0.0
 * @modul    versionRequiredSystem 1.0.0
 * @modul    hasCSS
 * @modul    groupAccess 1,2,3,4
 * @modul    language_path_de_DE Benutzerdefiniert/Entwickler/Skeleton
 * @modul    language_name_de_DE Custom/Developer/Skeleton
 * @modul    language_path_en_US History
 * @modul    language_name_en_US History
 *
 */
class ApplicationDeveloperSkeletonHistory_app extends Application_abstract
{

    public final function setContent(): string
    {

        $this->pageData();

        /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'default,button,information,generated,meta,language,breadcrumb,router');

        Event::trigger(__CLASS__ . '/templateCache',
                       null,
                       $this->scope,
                       $templateCache);

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['default']);

        /** @var ApplicationDeveloperSkeleton_crud $crud */
        $crud  = Container::get('ApplicationDeveloperSkeleton_crud');
        $count = $crud->count();

        /** @var ContainerExtensionTemplateParseCreatePaginationHelper $pagination */
        $pagination = Container::get('ContainerExtensionTemplateParseCreatePaginationHelper',
                                     'content',
                                     $count,
                                     3);
        $pagination->create();


        /** @var ApplicationDeveloperSkeleton_crud $crud */
        $crud        = Container::get('ApplicationDeveloperSkeleton_crud');
        $crudImports = $crud->find([],
                                   [
                                       'crudId DESC'
                                   ],
                                   [],
                                   $pagination->getPagesView(),
                                   $pagination->getPageOffset());

        $tableTcs = [];

        /** @var ApplicationDeveloperSkeleton_crud $crudImport */
        foreach ($crudImports as $crudImport) {
            $content = json_decode($crudImport->getCrudContent(),
                                   true);
            /** @var ContainerExtensionTemplateParseHelperDialog $dialogExport */
            $dialogExport = Container::get('ContainerExtensionTemplateParseHelperDialog');
            $dialogExport->setHeader('Export');
            $dialogExport->setBody($crudImport->getCrudContent());
            $dialogExport->setFooter();

            /** @var ContainerExtensionTemplate $templateButton */
            $templateButton = Container::get('ContainerExtensionTemplate');
            $templateButton->set($templateCache->getCacheContent()['button']);
            $templateButton->assign('crudId',
                                    $crudImport->getCrudId());
            $templateButton->assign('export',
                                    $dialogExport->create(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeletonHistory/exportButton')));
            $templateButton->parse();

            /** @var ContainerExtensionTemplate $templateInformation */
            $templateInformation = Container::get('ContainerExtensionTemplate');
            $templateInformation->set($templateCache->getCacheContent()['information']);
            $templateInformation->assign('className',
                (($content['className'] ?? '')));
            $templateInformation->assign('informationName',
                ($content['name'] ?? '?'));
            $templateInformation->assign('informationDescription',
                ($content['description'] ?? '?'));
            $templateInformation->assign('informationAuthor',
                ($content['author'] ?? '?'));
            $templateInformation->assign('informationVersion',
                ($content['version'] ?? '?'));
            $templateInformation->assign('informationVersionRequiredSystem',
                ($content['versionRequiredSystem'] ?? '?'));
            $templateInformation->parse();

            if (
                in_array('css',
                    ($content['has'] ?? []))
            ) {
                $hasCss = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasCss = '{insert/resources resource="icon" icon="char_no"}';
            }

            if (
                in_array('javascript',
                    ($content['has'] ?? []))
            ) {
                $hasJavascript = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasJavascript = '{insert/resources resource="icon" icon="char_no"}';
            }

            if (
                in_array('form',
                    ($content['content'] ?? []))
            ) {
                $hasContentForm = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasContentForm = '{insert/resources resource="icon" icon="char_no"}';
            }

            if (
                in_array('pagination',
                    ($content['content'] ?? []))
            ) {
                $hasContentPagination = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasContentPagination = '{insert/resources resource="icon" icon="char_no"}';
            }

            if (
                in_array('filter',
                    ($content['content'] ?? []))
            ) {
                $hasContentFilter = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasContentFilter = '{insert/resources resource="icon" icon="char_no"}';
            }

            if (
                in_array('notification',
                    ($content['content'] ?? []))
            ) {
                $hasContentNotification = '{insert/resources resource="icon" icon="char_yes"}';
            }
            else {
                $hasContentNotification = '{insert/resources resource="icon" icon="char_no"}';
            }

            /** @var ContainerExtensionTemplate $templateGenerated */
            $templateGenerated = Container::get('ContainerExtensionTemplate');
            $templateGenerated->set($templateCache->getCacheContent()['generated']);
            $templateGenerated->assign('generatedCss',
                                       $hasCss);
            $templateGenerated->assign('generatedJavascript',
                                       $hasJavascript);
            $templateGenerated->assign('generatedForm',
                                       $hasContentForm);
            $templateGenerated->assign('generatedPagination',
                                       $hasContentPagination);
            $templateGenerated->assign('generatedFilter',
                                       $hasContentFilter);
            $templateGenerated->assign('generatedNotification',
                                       $hasContentNotification);
            $templateGenerated->assign('generatedCssFiles',
                ($content['additionalCSS'] ?? '?'));
            $templateGenerated->assign('generatedJavascriptFiles',
                ($content['additionalJavascript'] ?? '?'));
            $templateGenerated->assign('additionalTemplates',
                ($content['additionalTemplates'] ?? '?'));
            $templateGenerated->parse();


            /** @var ContainerExtensionTemplate $templateLanguage */
            $templateLanguage = Container::get('ContainerExtensionTemplate');
            $templateLanguage->set($templateCache->getCacheContent()['language']);;
            $templateLanguage->assign('language',
                                      nl2br($this->modifyViewData(($content['language'] ?? ''))));
            $templateLanguage->parse();

            /** @var ContainerExtensionTemplate $templateBreadcrumb */
            $templateBreadcrumb = Container::get('ContainerExtensionTemplate');
            $templateBreadcrumb->set($templateCache->getCacheContent()['breadcrumb']);
            $templateBreadcrumb->assign('breadcrumb1',
                                        $this->modifyClassName(($content['breadcrumb1'] ?? '')));
            $templateBreadcrumb->assign('breadcrumb2',
                                        $this->modifyClassName(($content['breadcrumb2'] ?? '')));
            $templateBreadcrumb->assign('breadcrumb3',
                                        $this->modifyClassName(($content['breadcrumb3'] ?? '')));
            $templateBreadcrumb->assign('breadcrumb4',
                                        $this->modifyClassName(($content['breadcrumb4'] ?? '')));
            $templateBreadcrumb->assign('breadcrumb5',
                                        $this->modifyClassName(($content['breadcrumb5'] ?? '')));
            $templateBreadcrumb->parse();

            /** @var ContainerExtensionTemplate $templateRouter */
            $templateRouter = Container::get('ContainerExtensionTemplate');
            $templateRouter->set($templateCache->getCacheContent()['router']);
            $templateRouter->assign('routerPathSimple',
                                    nl2br($this->modifyViewData(($content['routerPathSimple'] ?? ''))));
            $templateRouter->assign('routerPathRegex',
                                    nl2br($this->modifyViewData(($content['routerPathRegex'] ?? ''))));
            $templateRouter->parse();

            $tableTcs[] = [
                'button'      => $templateButton->get(),
                'information' => $templateInformation->get(),
                'generated'   => $templateGenerated->get(),
                'language'    => $templateLanguage->get(),
                'breadcrumb'  => $templateBreadcrumb->get(),
                'router'      => $templateRouter->get(),
            ];
        }

        $template->assign('HistoryTable_HistoryTable',
                          $tableTcs);
        $template->parse();
        return $template->get();
    }

    private function pageData(): void
    {
        /** @var ContainerIndexPage $page */
        $page = Container::getInstance('ContainerIndexPage');
        $page->setPageTitle(ContainerFactoryLanguage::get('/' . $this->___getRootClass() . '/breadcrumb'));

        /** @var ContainerFactoryRouter $router */
        $router = Container::get('ContainerFactoryRouter');
        $router->analyzeUrl('index.php?application=' . $this->___getRootClass() . '');


        $breadcrumb = $page->getBreadcrumb();

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/breadcrumb'),
                                       'index.php?application=ApplicationDeveloperSkeleton');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/' . $this->___getRootClass() . '/breadcrumb'),
                                       'index.php?application=' . $this->___getRootClass());

        /** @var ContainerFactoryMenu $menu */
        $menu = $this->getMenu();
        $menu->setMenuClassMain('ApplicationDeveloperSkeleton');
    }


    /**
     * @param string $content
     *
     * @return string
     */
    private function modifyViewData(string $content): string
    {
        return strtr($content,
                     [
                         '{' => '&#123;',
                         '}' => '&#125;',
                     ]);
    }

    private function modifyClassName(string $content): string
    {
        if (empty($content)) {
            return '';
        }

        $contentClassNameSplit = preg_split('/([A-Z^\.\-]*[a-z\.\-]*)/',
                                            $content,
                                            -1,
                                            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        if (empty($contentClassNameSplit)) {
            throw new DetailedException('modifyClassNameError');
        }

        return implode('&shy;',
                       $contentClassNameSplit);

    }

}

<?php declare(strict_types=1);

/**
 * History
 *
 * Import a History Export to History
 *
 * @author  Stefan Schlombs
 * @version 1.0.0
 * @modul   versionRequiredSystem 1.0.0
 * @modul   hasCSS
 */
class ApplicationDeveloperSkeletonHistoryImport_app extends Application_abstract
{


    public function setContent(): string
    {
        $this->pageData();

        /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'default');

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['default']);

        /** @var ContainerExtensionTemplateParseCreateForm_helper $formHelper */
        $formHelper = Container::get('ContainerExtensionTemplateParseCreateForm_helper',
                                     'ApplicationDeveloperSkeletonHistoryImport',
                                     'historyImport');

        $formHelper->addFormElement('jsonImport',
                                    'Textarea',
                                    [],
                                    [
                                        'ContainerExtensionTemplateParseCreateFormModifyValidatorRequired',
                                    ]);

        $template->assign('jsonImport',
                          $formHelper->getElements());

        /** @var ContainerExtensionTemplateParseCreateFormResponse $formHelperResponse */
        $formHelperResponse = $formHelper->getResponse();
        if (
        $formHelperResponse->isHasResponse()
        ) {
            $this->formResponse($formHelper);
        }


        $template->assign('header',
                          $formHelper->getHeader());

        $template->assign('footer',
                          $formHelper->getFooter());

        $template->parse();
        return $template->get();


    }

    public function formResponse(ContainerExtensionTemplateParseCreateForm_helper $formHelper): void
    {

        /** @var ContainerExtensionTemplateParseCreateFormResponse $response */
        $response = $formHelper->getResponse();
        if (!$response->hasError()) {

            /** @var ApplicationDeveloperSkeleton_crud $crud */
            $crud = Container::get('ApplicationDeveloperSkeleton_crud');
            $crud->setCrudContent($response->get('jsonImport'));
            $crud->insert();


            /** @var ContainerFactoryLog_crud_notification $crud */
            $crud = Container::get('ContainerFactoryLog_crud_notification');
            $crud->setCrudMessage(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeletonHistoryImport/notification/imported'));
            $crud->setCrudClass(__CLASS__);
            $crud->setCrudCssClass('simpleModifySuccess');
            $crud->setCrudClassIdent('ApplicationDeveloperSkeletonHistoryImport');
            $crud->setCrudData('');

            /** @var ContainerIndexPage $page */
            $page = Container::getInstance('ContainerIndexPage');
            $page->addNotification($crud);
        }


    }

    public function pageData(): void
    {
        $thisClassName = Core::getRootClass(__CLASS__);

        /** @var ContainerIndexPage $page */
        $page = Container::getInstance('ContainerIndexPage');
        $page->setPageTitle(ContainerFactoryLanguage::get('/' . $thisClassName . '/meta/title'));
        $page->setPageDescription(ContainerFactoryLanguage::get('/' . $thisClassName . '/meta/description'));

        /** @var ContainerFactoryRouter $router */
        $router = Container::get('ContainerFactoryRouter');
        $router->analyzeUrl('index.php?application=' . $thisClassName . '');



        $breadcrumb = $page->getBreadcrumb();

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeleton/breadcrumb'),
                                       'index.php?application=ApplicationDeveloperSkeleton');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloperSkeletonHistory/breadcrumb'),
                                       'index.php?application=ApplicationDeveloperSkeletonHistory');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/' . $thisClassName . '/meta/title'),
                                       'index.php?application=ApplicationDeveloperSkeletonHistoryImport');

        /** @var ContainerFactoryMenu $menu */
        $menu = $this->getMenu();
        $menu->setMenuClassMain('ApplicationDeveloperSkeleton');

    }
}

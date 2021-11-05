<?php
declare(strict_types=1);

/**
 * Developer Documentation
 *
 * Create a Documentation from Moduls
 *
 * @modul author Stefan Schlombs
 * @modul version 1.0.0
 * @modul versionRequiredSystem 1.0.0
 *
 */
class ApplicationDeveloperDocumentation_app extends Application_abstract
{

    public function setContent(): string
    {
        $this->pageData();

        /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'default');

        /** @var ContainerExtensionDocumentation_crud $crud */
        $crud    = Container::get('ContainerExtensionDocumentation_crud');
        $crudDoc = $crud->find();

        /** @var ContainerFactoryMenu $configMenu */
        $configMenu = Container::get('ContainerFactoryMenu');

        /** @var ContainerFactoryUser $user */
        $user = Container::getInstance('ContainerFactoryUser');
        $configMenu->setMenuAccessList($user->getUserAccess());

        /** @var ContainerExtensionDocumentation_crud $crudDocItem */
        foreach ($crudDoc as $crudDocItem) {
            $path = ContainerFactoryModul::getModulMenuLanguage($crudDocItem->getCrudClass(),
                                                                $crudDocItem->getCrudClass());

            $pathData = explode('/',
                                $path);
            array_shift($pathData);
            $name = array_pop($pathData);

            /** @var ContainerFactoryMenuItem $menuItem */
            $menuItem = Container::get('ContainerFactoryMenuItem');
            $menuItem->setPath('/' . implode('/',
                                             $pathData));
            $menuItem->setDescription('');
            $menuItem->setTitle($name);
            $menuItem->setLink('index.php?application=ApplicationDeveloperDocumentation&id=' . $crudDocItem->getCrudId());
            $menuItem->setAccess('ApplicationDeveloperDocumentation');

            $configMenu->addMenuItem($menuItem);
        }

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->get()['default']);

        /** @var ContainerFactoryRequest $requestDoc */
        $requestDoc = Container::get('ContainerFactoryRequest',
                                     ContainerFactoryRequest::REQUEST_GET,
                                     'id');

        if ($requestDoc->exists()) {

            /** @var ContainerExtensionDocumentation_crud $crud */
            $crud = Container::get('ContainerExtensionDocumentation_crud');
            $crud->setCrudClass((string)$requestDoc->get());
            $crud->findById(true);

            $path = ContainerFactoryModul::getModulMenuLanguage($crud->getCrudClass(),
                                                                $crud->getCrudClass());

            $pathData = explode('/',
                                $path);
            array_shift($pathData);
            $name = array_pop($pathData);

            $template->assign('menu',
                              $configMenu->createMenu('/' . implode('/',
                                                                    $pathData),
                                                      $name));

            $template->assign('doc',
                              $crud->getCrudContent());

        }
        else {
            $template->assign('menu',
                              $configMenu->createMenu());
            $template->assign('doc',
                              '');
        }

        $template->parse();
        return $template->get();
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

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloper/breadcrumb'),
                                       'index.php?application=Developer');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/' . $thisClassName . '/meta/title'),
                                       'index.php?application=' . $thisClassName . '');

        /** @var ContainerFactoryMenu $menu */
        $menu = $this->getMenu();
        $menu->setMenuClassMain($thisClassName);

    }
}

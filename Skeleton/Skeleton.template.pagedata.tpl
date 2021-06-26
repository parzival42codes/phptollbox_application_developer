/** @var ContainerIndexPage $page */
$page = Container::getInstance('ContainerIndexPage');
$page->setPageTitle(ContainerFactoryLanguage::get('/'.$this->___getRootClass().'/meta/title'));
$page->setPageDescription(ContainerFactoryLanguage::get('/'.$this->___getRootClass().'/meta/description'));

$router = Container::get('ContainerFactoryRouter');
$router->analyzeUrl('index.php?application='.$this->___getRootClass());

$breadcrumb = $page->getBreadcrumb();

$breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/'.$this->___getRootClass().'/meta/title'),
'index.php?application='.$this->___getRootClass());

{$breadcrumbs}

/** @var ContainerFactoryMenu $menu */
$menu = $this->getMenu();
$menu->setMenuClassMain($this->___getRootClass());

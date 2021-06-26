
$this->pageData();

/** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
$templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
Core::getRootClass(__CLASS__),
'{$templateList}');

{$formHelper}
{$filter}
{$pagination}
{$notification}

/** @var ContainerExtensionTemplate $template */
$template = Container::get('ContainerExtensionTemplate');
$template->set($templateCache->getCacheContent()['default']);

$template->parse();
return $template->get();

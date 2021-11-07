
$this->createPageData();

$templateCache = new ContainerExtensionTemplateLoad_cache_template(
Core::getRootClass(__CLASS__),
'{$templateList}');

{$form}
{$filter}
{$pagination}
{$notification}

$template = new ContainerExtensionTemplate();
$template->set($templateCache->get()['default']);

$template->parse();
return $template->get();

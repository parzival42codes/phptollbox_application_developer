
/** @var ApplicationDeveloperSkeleton_crud $crud */
$crud  = Container::get('ApplicationDeveloperSkeleton_crud');
$count = $crud->count();

/** @var ContainerExtensionTemplateParseCreatePaginationHelper $pagination */
$pagination = Container::get('ContainerExtensionTemplateParseCreatePaginationHelper',
'',
$count);
$pagination->create();


/** @var ApplicationDeveloperSkeleton_crud $crud */
$crud        = Container::get('ApplicationDeveloperSkeleton_crud');
$crudFind = $crud->find([],
[],
[],
$pagination->getPagesView(),
$pagination->getPageOffset());

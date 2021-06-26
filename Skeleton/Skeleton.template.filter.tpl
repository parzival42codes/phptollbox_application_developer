$filterData = $this->getFilterData();

/** @var ContainerExtensionTemplateParseCreateFilterHelper $filter */
$filter = Container::get('ContainerExtensionTemplateParseCreateFilterHelper',
'');

$filter->addFilter('crudType',
null,
ContainerFactoryLanguage::get('/ApplicationAdministrationLogError/filter/header/type'),
'select',
$filterData);

$filter->create();

$filterValues = $filter->getFilterValues();
$filterCrud   = [];
if (isset($filterValues['crudType']) && !empty($filterValues['crudType'])) {
$filterCrud['crudType'] = $filterValues['crudType'];
}

/** @var ContainerFactoryLog_crud_notification $crud */
$crud = Container::get('ContainerFactoryLog_crud_notification');
$crud->setCrudMessage(sprintf(ContainerFactoryLanguage::get('/ApplicationAdministrationUserGroupEdit/notification/saved'),
$groupLanguageItem['name']));
$crud->setCrudClass(__CLASS__);
$crud->setCrudCssClass('simpleModifySuccess');
$crud->setCrudClassIdent($this->id);
$crud->setCrudData($differences);

/** @var ContainerIndexPage $page */
$page = Container::getInstance('ContainerIndexPage');
$page->addNotification($crud);

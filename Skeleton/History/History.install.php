<?php

class ApplicationDeveloperSkeletonHistory_install extends ContainerFactoryModulInstall_abstract
{

    public function install(): void
    {
        $this->importMetaFromModul('_app');
//        $this->importQueryDatabaseFromCrud('ApplicationDeveloperSkeleton_crud');
        $this->importLanguage();
        $this->readLanguageFromFile('default');
        $this->readLanguageFromFile('information');
//        $this->readLanguageFromFile('information');

        $this->importRoute();
        $this->setGroupAccess(Core::getRootClass(__CLASS__),
                              [
                                  4
                              ]);

    }

    public function activate(): void
    {

    }

}

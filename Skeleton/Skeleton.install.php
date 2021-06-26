<?php

class ApplicationDeveloperSkeleton_install extends ContainerFactoryModulInstall_abstract
{

    public function install():void
    {
        $this->importMetaFromModul('_app');
        $this->importQueryDatabaseFromCrud('ApplicationDeveloperSkeleton_crud');
        $this->importLanguage();
        $this->readLanguageFromFile('default');

        $this->setGroupAccess(Core::getRootClass(__CLASS__),
                              [
                                  1,
                                  2,
                                  3,
                                  4
                              ]);

    }

}

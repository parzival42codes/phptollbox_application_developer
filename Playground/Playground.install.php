<?php

class ApplicationDeveloperPlayground_install extends ContainerFactoryModulInstall_abstract
{

    public function install(): void
    {
        $this->importMetaFromModul('_app');
//        $this->importLanguage();
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

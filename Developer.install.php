<?php
declare(strict_types=1);

/**
 * Developer
 *
 * Developer Tools
 *
 * @modul author Stefan Schlombs
 * @modul version 1.0.0
 * @modul versionRequiredSystem 1.0.0
 * @modul hasCSS
 * @modul hasJavascript
 *
 */
class ApplicationDeveloper_install extends ContainerFactoryModulInstall_abstract
{
    public function install():void
    {
        $this->importLanguage();

        $this->installFunction(function () {
            /** @var array $data */ /*$before*/

            /** @var ApplicationDeveloperSkeleton_crud $crud */
            $crud = Container::get('ApplicationDeveloperSkeleton_crud');
            $crud->setCrudContent('{"className":"DeveloperTestapplication","name":"Test","description":"Foo","author":"Stefan Schlombs","version":"1.0.0","versionRequiredSystem":"1.0.0","has":["css","javascript"],"content":["form","pagination","filter","notification"],"additionalCSS":"","additionalJavascript":"","additionalTemplates":"debug","language":"\"\/meta\/title\": {\r\n\"de_DE\": \"Skeleton\",\r\n\"en_US\": \"Skeleton\"\r\n},\r\n\"\/meta\/description\": {\r\n\"de_DE\": \"Skeleton\",\r\n\"en_US\": \"Skeleton\"\r\n},\r\n\"\/breadcrumb\": {\r\n\"de_DE\": \"Skeleton\",\r\n\"en_US\": \"Skeleton\"\r\n}","breadcrumb1":"ApplicationDeveloper","breadcrumb2":"","breadcrumb3":"","breadcrumb4":"","breadcrumb5":"","menu":"{\r\n\"type\": \"install.menu\",\r\n\"content\": {\r\n\"link\": \"index.php?application=DeveloperTestapplication\",\r\n\"menuClassMain\": \"DeveloperTestapplication\",\r\n\"menuIcon\": \"\",\r\n\"language\": {\r\n\"de_DE\": {\r\n\"menuTitle\": \"Gruppenbearbeitung\",\r\n\"menuDescription\": \"\",\r\n\"menuPath\": \"\/Administration\/Gruppen\",\r\n\"menuAccess\": \"DeveloperTestapplication\"\r\n}\r\n}\r\n}\r\n}","routerPathSimple":"\"default\": {\r\n\"path\": \"\/administration\/box\/edit\"\r\n}","routerPathRegex":"\"edit\": {\r\n\"path\": \"\/administration\/box\/edit\/\"\r\n}"}');
            $crud->insert();

            $progressData['message'] = 'Demo History Skeleton';

            /*$after*/
        });
    }

    public function activate(): void
    {

    }

}

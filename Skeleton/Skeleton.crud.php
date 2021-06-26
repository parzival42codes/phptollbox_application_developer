<?php

/**
 * Class ApplicationDeveloperSkeleton_crud
 *
 * @database dataVariableCreated
 *
 */
class ApplicationDeveloperSkeleton_crud extends Base_abstract_crud
{
    protected static string $table   = 'custom_developer_skeleton';
    protected static string $tableId = 'crudId';

    /**
     * @var int|null
     * @database type int;11
     * @database isPrimary
     * @database default ContainerFactoryDatabaseEngineMysqlTable::DEFAULT_AUTO_INCREMENT
     */
    protected ?int $crudId = null;

    /**
     * @var string
     * @database type text
     */
    protected string $crudContent = '';

    /**
     * @return string
     */
    public function getCrudContent(): string
    {
        return $this->crudContent;
    }

    /**
     * @param string $crudContent
     */
    public function setCrudContent(string $crudContent): void
    {
        $this->crudContent = $crudContent;
    }

    /**
     * @return int|null
     */
    public function getCrudId():?int
    {
        return $this->crudId;
    }

    /**
     * @param int|null $crudId
     */
    public function setCrudId(?int $crudId): void
    {
        $this->crudId = $crudId;
    }


}

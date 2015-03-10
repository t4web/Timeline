<?php

namespace Timeline\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Sql;
use PDOException;

class InitController extends AbstractActionController {

    /**
     * @var Adapter
     */
    private $dbAdapter;

    public function __construct(Adapter $dbAdapter){
        $this->dbAdapter = $dbAdapter;
    }

    public function runAction() {

        $this->createTableTimeline();

        return "Success completed" . PHP_EOL;
    }

    private function createTableTimeline() {
        $table = new Ddl\CreateTable('timeline');

        $id = new Column\Integer('id');
        $id->setOption('AUTO_INCREMENT', 1);
        $table->addColumn($id);

        $table->addColumn(new Column\Integer('type'));

        $creationDate = new Column\Date('creation_date');
        $creationDate->setNullable(false);
        $table->addColumn($creationDate);

        $type = new Column\Integer('type');
        $type->setNullable(false);
        $table->addColumn($type);

        $objectId = new Column\Integer('object_id');
        $objectId->setNullable(true);
        $table->addColumn($objectId);

        $initiatorId = new Column\Integer('initiator_id');
        $initiatorId->setNullable(true);
        $table->addColumn($initiatorId);

        $table->addConstraint(new Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

}

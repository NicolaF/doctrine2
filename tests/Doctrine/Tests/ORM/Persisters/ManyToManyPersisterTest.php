<?php

namespace Doctrine\Tests\ORM\Persisters;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Persisters\Collection\ManyToManyPersister;
use Doctrine\Tests\Mocks\ConnectionMock;
use Doctrine\Tests\Models\ManyToManyPersister\ChildClass;
use Doctrine\Tests\Models\ManyToManyPersister\ParentClass;
use Doctrine\Tests\OrmTestCase;

/**
 * Tests for {@see ManyToManyPersister}
 * @covers Doctrine\ORM\Persisters\Collection\ManyToManyPersister
 */
class ManyToManyPersisterTest extends OrmTestCase {

    /** @var EntityManager */
    private $em;

    /** @var ManyToManyPersister */
    private $persister;

    protected function setUp() {
        parent::setUp();
        $this->em = $this->_getTestEntityManager();
        $this->persister = new ManyToManyPersister($this->em);
    }

    /**
     * @group ManyToManyPersister
     * @throws \Doctrine\ORM\ORMException
     */
    public function testDeleteManyToManyCollection() {
        $parent = new ParentClass();
        $parent->id = 1;
        $child = new ChildClass();
        $child->id1 = 1;
        $child->id2 = 2;
        $parent->children->add($child);
        $this->em->persist($parent);
        $this->em->flush();

        $childReloaded = $this->em->find(ChildClass::class, ['id1' => 1, 'id2' => 2]);

        $this->persister->delete($childReloaded->parents);

        /** @var ConnectionMock $conn */
        $conn = $this->em->getConnection();

        $updates = $conn->getExecuteUpdates();
        $lastUpdate = array_pop($updates);

        $this->assertEquals('DELETE FROM parent_child WHERE child_id1 = ? AND child_id2 = ?', $lastUpdate['query']);
        $this->assertEquals([1,2], $lastUpdate['params']);

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 19/01/18
 * Time: 16:40
 */

namespace Doctrine\Tests\ORM\Persisters;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;
use Doctrine\Tests\Mocks\ConnectionMock;
use Doctrine\Tests\Models\ManyToManyPersister\ChildClass;
use Doctrine\Tests\Models\ManyToManyPersister\ParentClass;
use Doctrine\Tests\OrmTestCase;
use Doctrine\ORM\Persisters\Collection\ManyToManyPersister;
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
        $parent->setId(1);
        $child = new ChildClass();
        $child->setId1(1);
        $child->setId2(2);
        $parent->getChildren()->add($child);
        $this->em->persist($parent);
        $this->em->flush();

        $childReloaded = $this->em->find(ChildClass::class, ['id1' => 1, 'id2' => 2]);

        $this->persister->delete($childReloaded->getParents());

        /** @var ConnectionMock $conn */
        $conn = $this->em->getConnection();

        $updates = $conn->getExecuteUpdates();

        $lastUpdate = array_pop($updates);

        $this->assertEquals('DELETE FROM parent_child WHERE child_id1 = ? AND child_id2 = ?', $lastUpdate['query']);
        $this->assertEquals([1,2], $lastUpdate['params']);

    }

}
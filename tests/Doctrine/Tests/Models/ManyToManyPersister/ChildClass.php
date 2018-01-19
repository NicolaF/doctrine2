<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 19/01/18
 * Time: 16:44
 */

namespace Doctrine\Tests\Models\ManyToManyPersister;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
/**
 * Class ChildClass
 * @package Doctrine\Tests\Models\ManyToManyPersister
 * @Entity()
 * @Table(name="child")
 */
class ChildClass {

    /**
     * @var integer
     * @Column(name="id1", type="integer")
     * @Id()
     *
     */
    private $id1;

    /**
     * @var integer
     * @Column(name="id2", type="integer")
     * @Id()
     *
     */
    private $id2;

    /**
     * @var Collection|ParentClass[]
     * @ManyToMany(targetEntity="Doctrine\Tests\Models\ManyToManyPersister\ParentClass", inversedBy="children")
     * @JoinTable(name="parent_child", joinColumns={
     *     @JoinColumn(name="child_id1", referencedColumnName="id1"),
     *     @JoinColumn(name="child_id2", referencedColumnName="id2")
     * }, inverseJoinColumns={
     *     @JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parents;

    public function __construct() {
        $this->parents = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId1(): int {
        return $this->id1;
    }

    /**
     * @param int $id1
     */
    public function setId1(int $id1): void {
        $this->id1 = $id1;
    }

    /**
     * @return mixed
     */
    public function getId2() {
        return $this->id2;
    }

    /**
     * @param mixed $id2
     */
    public function setId2($id2) {
        $this->id2 = $id2;
    }

    /**
     * @return Collection
     */
    public function getParents() {
        return $this->parents;
    }

    /**
     * @param Collection $parents
     */
    public function setParents($parents) {
        $this->parents = $parents;
    }

}
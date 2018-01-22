<?php

namespace Doctrine\Tests\Models\ManyToManyPersister;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity()
 * @Table(name="manytomanypersister_child")
 */
class ChildClass {

    /**
     * @var integer
     * @Column(name="id1", type="integer")
     * @Id()
     *
     */
    public $id1;

    /**
     * @var integer
     * @Column(name="id2", type="integer")
     * @Id()
     *
     */
    public $id2;

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
    public $parents;

    public function __construct() {
        $this->parents = new ArrayCollection();
    }
}
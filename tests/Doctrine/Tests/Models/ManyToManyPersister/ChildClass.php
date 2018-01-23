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
     * @var OtherParentClass
     * @Id()
     * @ManyToOne(targetEntity="Doctrine\Tests\Models\ManyToManyPersister\OtherParentClass", cascade={"persist"})
     * @JoinColumn(name="other_parent_id", referencedColumnName="id")
     *
     */
    public $otherParent;

    /**
     * @var Collection|ParentClass[]
     * @ManyToMany(targetEntity="Doctrine\Tests\Models\ManyToManyPersister\ParentClass", inversedBy="children")
     * @JoinTable(name="parent_child", joinColumns={
     *     @JoinColumn(name="child_id1", referencedColumnName="id1"),
     *     @JoinColumn(name="child_id2", referencedColumnName="other_parent_id")
     * }, inverseJoinColumns={
     *     @JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    public $parents;

    public function __construct() {
        $this->parents = new ArrayCollection();
    }
}
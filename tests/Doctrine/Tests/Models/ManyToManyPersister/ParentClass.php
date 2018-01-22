<?php

namespace Doctrine\Tests\Models\ManyToManyPersister;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @Entity()
 * @Table(name="manytomanypersister_parent")
 */
class ParentClass {

    /**
     * @var integer
     * @Column(name="id", type="integer")
     * @Id()
     */
    public $id;

    /**
     * @var Collection|ChildClass[];
     * @ManyToMany(targetEntity="Doctrine\Tests\Models\ManyToManyPersister\ChildClass", mappedBy="parents", orphanRemoval=true, cascade={"persist"})
     */
    public $children;

    public function __construct() {
        $this->children = new ArrayCollection();
    }
}
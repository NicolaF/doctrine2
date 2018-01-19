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

/**
 * @Entity()
 * @Table(name="parent")
 */
class ParentClass {

    /**
     * @var integer
     * @Column(name="id", type="integer")
     * @Id()
     */
    private $id;

    /**
     * @var Collection|ChildClass[];
     * @ManyToMany(targetEntity="Doctrine\Tests\Models\ManyToManyPersister\ChildClass", mappedBy="parents", orphanRemoval=true, cascade={"persist"})
     */
    private $children;

    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return Collection|ChildClass[]
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param Collection|ChildClass[] $children
     */
    public function setChildren($children): void {
        $this->children = $children;
    }


}
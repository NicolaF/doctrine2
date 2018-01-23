<?php

namespace Doctrine\Tests\Models\ManyToManyPersister;


/**
 * Class OtherParentClass
 * @package Doctrine\Tests\Models\ManyToManyPersister
 * @Entity()
 * @Table(name="manytomanypersister_other_parent")
 */
class OtherParentClass {

    /**
     * @var integer
     * @Id()
     * @Column(name="id", type="integer")
     */
    public $id;
}
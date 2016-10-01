<?php
/*
 * The MIT License
 *
 * Copyright 2015 Anthony Maudry <anthony.maudry@thuata.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Thuata\FrameworkTestBundle\Test\Repository\Registry;

use Thuata\FrameworkBundle\Tests\AbstractTestCase;
use Thuata\FrameworkTestBundle\Entity\ValidEntity;
use Thuata\FrameworkTestBundle\Repository\Registry\ArrayRegistry;

/**
 * <b>ArrayREgistryTest</b><br>
 *
 *
 * @package Thuata\FrameworkTestBundle\Test\Repository\Registry
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class ArrayRegistryTest extends AbstractTestCase
{
    public static function getValidEntity($index = 1)
    {
        $entity = new ValidEntity();
        $entity->setDate(new \DateTime('2016-05-01'))
            ->setDeleted(false)
            ->setDescription(sprintf('ValidEntity %d description', $index))
            ->setName(sprintf('ValidEntity %d', $index));

        return $entity;
    }

    public function test_ArrayRegistryAddCalled()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertTrue($registry->isCalledAdd());
    }

    public function test_ArrayRegistryAddAdded()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertEquals(count($registry->getRegistry()), 1);
    }

    public function test_ArrayRegistryAddInstance()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertInstanceOf(ValidEntity::class, $registry->getRegistry()[1]);
    }

    public function test_ArrayRegistryGetInstance()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertInstanceOf(ValidEntity::class, $registry->findByKey(1));
    }

    public function test_ArrayRegistryGetData()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertEquals('ValidEntity 1', $registry->findByKey(1)->getName());
    }

    public function test_ArrayRegistryGetInvalid()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertNull($registry->findByKey(2));
    }

    public function test_ArrayRegistryAddOneGetTwo()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertEquals(1, count($registry->findByKeys([1, 2])));
    }

    public function test_ArrayRegistryGetTwoInstance()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertInstanceOf(ValidEntity::class, $registry->findByKeys([1, 2])[0]);
    }

    public function test_ArrayRegistryGetTwoName()
    {
        $registry = new ArrayRegistry();

        $entity = $this->getValidEntity(1);

        $registry->add(1, $entity);

        $this->assertEquals('ValidEntity 1', $registry->findByKeys([1, 2])[0]->getName());
    }

    public function test_ArrayRegistryAddTwoGetSecond()
    {
        $registry = new ArrayRegistry();

        $entity1 = $this->getValidEntity(1);
        $entity2 = $this->getValidEntity(2);

        $registry->add(1, $entity1);
        $registry->add(2, $entity2);

        $this->assertInstanceOf(ValidEntity::class, $registry->findByKey(2));
    }

    public function test_ArrayRegistryAddTwoGetTwo()
    {
        $registry = new ArrayRegistry();

        $entity1 = $this->getValidEntity(1);
        $entity2 = $this->getValidEntity(2);

        $registry->add(1, $entity1);
        $registry->add(2, $entity2);

        $this->assertEquals(2, count($registry->findByKeys([1, 2])));
    }

    public function test_ArrayRegistryAddTwoGetTwoInstance()
    {
        $registry = new ArrayRegistry();

        $entity1 = $this->getValidEntity(1);
        $entity2 = $this->getValidEntity(2);

        $registry->add(1, $entity1);
        $registry->add(2, $entity2);

        $this->assertContainsOnlyInstancesOf(ValidEntity::class, $registry->findByKeys([1, 2]));
    }

    public function test_ArrayRegistryGetTwoSecondName()
    {
        $registry = new ArrayRegistry();

        $entity1 = $this->getValidEntity(1);
        $entity2 = $this->getValidEntity(2);

        $registry->add(1, $entity1);
        $registry->add(2, $entity2);

        $this->assertEquals('ValidEntity 2', $registry->findByKeys([1, 2])[1]->getName());
    }
}
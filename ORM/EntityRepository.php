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

namespace Thuata\FrameworkTestBundle\ORM;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * <b>EntityRepository</b><br>
 *
 *
 * @package thuata\frameworktestbundle\ORM
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class EntityRepository implements ObjectRepository, Selectable
{
    private $registry = [];

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object The object.
     */
    public function find($id)
    {
        return $this->registry[ $id ];
    }

    /**
     * Finds all objects in the repository.
     *
     * @return array The objects.
     */
    public function findAll()
    {
        return $this->registry;
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     *
     * @throws \UnexpectedValueException
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $parsed = 0;
        $accessor = PropertyAccess::createPropertyAccessor();

        if (!empty($criteria)) {
            $result = array_values(array_filter($this->registry, function ($value) use ($criteria, $limit, $parsed, $accessor) {

                foreach ($criteria as $prop => $filter) {
                    $objectValue = $accessor->getValue($value, $prop);
                    if (is_array($filter)) {
                        if (!in_array($objectValue, $filter)) {
                            return false;
                        }
                    } else {
                        if ($objectValue !== $filter) {
                            return false;
                        }
                    }
                }

                return true;
            }));
        } else {
            $result = $this->findAll();
        }

        if (is_array($orderBy)) {
            foreach ($orderBy as $prop => $direction) {
                $dirInt = $direction === 'ASC' ? 1 : -1;
                usort($result, function ($a, $b) use ($prop, $dirInt, $accessor) {
                    $valueA = $accessor->getValue($a, $prop);
                    $valueB = $accessor->getValue($b, $prop);
                    if ($valueA === $valueB) {
                        return 0;
                    }

                    if ($valueA > $valueB) {
                        return $dirInt;
                    } else {
                        return -1 * $dirInt;
                    }
                });
            }
        }

        return array_slice($result, $offset ?: 0, $limit ?: count($result));
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria The criteria.
     *
     * @return object The object.
     */
    public function findOneBy(array $criteria)
    {
        $found = $this->findBy($criteria, null, 1);

        if (count($found) > 0) {
            return $found[0];
        }
        return null;
    }

    /**
     * Returns the class name of the object managed by the repository.
     *
     * @todo implement this
     *
     * @return string
     */
    public function getClassName()
    {
        trigger_error('Not implemented', E_WARNING);

        return '';
    }

    /**
     * Selects all elements from a selectable that match the expression and
     * returns a new collection containing these elements.
     *
     * @todo implemnt this
     *
     * @param Criteria $criteria
     *
     * @return Collection
     */
    public function matching(Criteria $criteria)
    {
        trigger_error('Not implemented', E_WARNING);
    }
}
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

namespace Thuata\FrameworkTestBundle\Repository\Registry;

/**
 * <b>RegistryTestableTrait</b><br>
 * Methods to test registries
 *
 * @package thuata\frameworktestbundle\Repository\Registry
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
trait RegistryTestableTrait
{
    /**
     * @var bool
     */
    private $calledFindByKey;

    /**
     * @var bool
     */
    private $calledFindByKeys;

    /**
     * @var bool
     */
    private $calledAdd;

    /**
     * @var bool
     */
    private $calledRemove;

    /**
     * @var bool
     */
    private $calledUpdate;

    /**
     * is called FindByKey
     *
     * @return boolean
     */
    public function isCalledFindByKey()
    {
        return $this->calledFindByKey;
    }

    /**
     * sets called FindByKey
     *
     * @param boolean $calledFindByKey
     */
    public function setCalledFindByKey($calledFindByKey)
    {
        $this->calledFindByKey = $calledFindByKey;
    }

    /**
     * is called FindByKeys
     *
     * @return boolean
     */
    public function isCalledFindByKeys()
    {
        return $this->calledFindByKeys;
    }

    /**
     * sets called FindByKeys
     *
     * @param boolean $calledFindByKeys
     */
    public function setCalledFindByKeys($calledFindByKeys)
    {
        $this->calledFindByKeys = $calledFindByKeys;
    }

    /**
     * is called Add
     *
     * @return boolean
     */
    public function isCalledAdd()
    {
        return $this->calledAdd;
    }

    /**
     * sets called Add
     *
     * @param boolean $calledAdd
     */
    public function setCalledAdd($calledAdd)
    {
        $this->calledAdd = $calledAdd;
    }

    /**
     * is called Remove
     *
     * @return boolean
     */
    public function isCalledRemove()
    {
        return $this->calledRemove;
    }

    /**
     * sets called Remove
     *
     * @param boolean $calledRemove
     */
    public function setCalledRemove($calledRemove)
    {
        $this->calledRemove = $calledRemove;
    }

    /**
     * is called Update
     *
     * @return boolean
     */
    public function isCalledUpdate()
    {
        return $this->calledUpdate;
    }

    /**
     * sets called Update
     *
     * @param boolean $calledUpdate
     */
    public function setCalledUpdate($calledUpdate)
    {
        $this->calledUpdate = $calledUpdate;
    }

    /**
     * Inits the tests
     */
    public function initTests()
    {
        $this->setCalledAdd(false);
        $this->setCalledFindByKey(false);
        $this->setCalledFindByKeys(false);
        $this->setCalledRemove(false);
        $this->setCalledUpdate(false);
    }

    /**
     * {@inheritdoc}
     */
    public function findByKey($key)
    {
        $this->setCalledFindByKey(true);

        return parent::findByKey($key);
    }

    /**
     * {@inheritdoc}
     */
    public function findByKeys(array $keys)
    {
        $this->setCalledFindByKeys(true);

        return parent::findByKeys($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $data)
    {
        $this->setCalledAdd(true);

        parent::add($key, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        $this->setCalledRemove(true);

        parent::remove($key);
    }

    /**
     * {@inheritdoc}
     */
    public function update($key, $data)
    {
        $this->setCalledUpdate(true);

        parent::update($key, $data);
    }
}
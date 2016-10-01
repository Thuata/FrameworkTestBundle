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
 * <b>ArrayRegistry</b><br>
 * Extends array registry to test it
 *
 * @package thuata\frameworktestbundle\Registry
 *
 * @author  Anthony Maudry <anthony.maudry@thuata.com>
 */
class ArrayRegistry extends \Thuata\FrameworkBundle\Repository\Registry\ArrayRegistry
{
    use RegistryTestableTrait;

    /**
     * Gets the registry
     *
     * @return mixed
     */
    public function getRegistry()
    {
        $rf = new \ReflectionClass(\Thuata\FrameworkBundle\Repository\Registry\ArrayRegistry::class);

        $property = $rf->getProperty('registry');

        $property->setAccessible(true);
        $val = $property->getValue($this);
        $property->setAccessible(false);

        return $val;
    }
}
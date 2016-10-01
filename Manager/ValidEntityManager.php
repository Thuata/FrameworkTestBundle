<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Thuata\FrameworkTestBundle\Manager;

use Thuata\FrameworkBundle\Manager\AbstractManager;
use Thuata\FrameworkTestBundle\Entity\ValidEntity;

/**
 * Class ValidEntityManager.
 */
class ValidEntityManager extends AbstractManager
{
    /**
     * Returns the class name for the entity
     *
     * @return string
     */
    public function getEntityClassName()
    {
        return ValidEntity::class;
    }
}

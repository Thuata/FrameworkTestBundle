<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Thuata\FrameworkTestBundle\Repository;

use Thuata\FrameworkBundle\Repository\AbstractRepository;
use Thuata\FrameworkTestBundle\Entity\ValidEntity;

/**
 * Class ValidEntityRepository.
 */
class ValidEntityRepository extends AbstractRepository
{
    public function getEntityClass()
    {
        ValidEntity::class;
    }
}

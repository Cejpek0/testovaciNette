<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Entity\ImageEntity;
use App\Model\Database\Repository\ImageRepository;

/**
 * @mixin EntityManager
 */
trait TRepositories
{

    public function getUserRepository(): ImageRepository
    {
        return $this->getRepository(ImageEntity::class);
    }

}
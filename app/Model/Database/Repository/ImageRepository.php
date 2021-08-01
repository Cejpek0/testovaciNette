<?php declare(strict_types = 1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\ImageEntity;
use mysql_xdevapi\Collection;

/**
 * Class ImageRepository
 * @package App\Model\Database\Repository
 */
class ImageRepository extends AbstractRepository
{
    public function findOneByFile_name(string $file_name): ?ImageEntity
    {
        return $this->findOneBy(['file_name' => $file_name]);
    }

    public function getImages(string $type = ''): ?array
    {
        $data = $this->database
            ->table('image_control')
            ->where('do_show',true)
            ->order('id DESC');
        if($type !== '')
        {
            $data->where('type',$type);
        }
        return $data;

        return $this->findBy(['file_name' => $file_name]);
    }
}

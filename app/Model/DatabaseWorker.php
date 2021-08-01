<?php

declare(strict_types=1);

namespace App\Model;
use App\Model\Database\Repository\ImageRepository;
use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

class DatabaseWorker
{


    public function __construct()
    {
        //$this->database = $database;
    }
    public function insertInto($data):void
    {/*
            $this->database->table('image_control')->insert([
                'name' => $data->name,
                'file_name' => $data->image->getName(),
                'type' => $data->type,
                'do_show' => $data->do_show
            ]);*/
    }

    /**
     * @param \stdClass $images
     * @return array
     */
    public function sortImagesToGallery(Selection $images):array
    {
        $arrayCol1 = array();
        $arrayCol2 = array();
        $arrayCol3 = array();
        $dataToReturn = array();

        $i = 1;
        foreach ($images as $line) {
            switch ($i) {
                case 1:
                    $arrayCol1[] = $line;
                    break;
                case 2:
                    $arrayCol2[] = $line;
                    break;
                case 3:
                    $arrayCol3[] = $line;
                    break;
            }

            $i++;
            if($i === 4) {
                $i = 1;
            }
        }
        $dataToReturn[] = $arrayCol1;
        $dataToReturn[] = $arrayCol2;
        $dataToReturn[] = $arrayCol3;
        return $dataToReturn;
    }

    /**
     * @param string $type
     * @return \stdClass
     */
    public function getAvaliableImages(string $type = ''):Selection{
        $data = $this->database
            ->table('image_control')
            ->where('do_show',true)
            ->order('id DESC');
        if($type !== '')
        {
            $data->where('type',$type);
        }
        return $data;
    }
}
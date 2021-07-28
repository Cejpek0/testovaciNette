<?php


namespace App\Model;
use Nette\SmartObject;
use Nette\Database\Explorer;
use function Sodium\add;

class DatabaseWorker
{
    private Explorer $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }
    public function insertInto($data):void
    {
            $this->database->table('image_control')->insert([
                'name' => $data->name,
                'file_name' => $data->image->getName(),
                'description' => $data->description,
                'type' => $data->type,
                'do_show' => $data->do_show
            ]);
    }
    public function returnAvaliableImages():array
    {
        $tempArray = array();
        $arrayToReturn = array();
        $data = (array)$this->database->table('image_control')->where('do_show',true)->order('id DESC')->fetchPairs('id');
        return array_chunk($data,3);
    }
}
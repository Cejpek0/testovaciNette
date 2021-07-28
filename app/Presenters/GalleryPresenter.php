<?php


namespace App\Presenters;

use App\Model\DatabaseWorker;
use Nette;


final class GalleryPresenter extends BasePresenter
{
    private DatabaseWorker $databaseWorker;
    public function __construct(DatabaseWorker $databaseWorker)
    {
        parent::__construct();
        $this->databaseWorker = $databaseWorker;
    }

    public function renderDefault(string $type = 'all'): void
    {
        $this->template->images=$this->databaseWorker->returnAvaliableImages();
    }
}
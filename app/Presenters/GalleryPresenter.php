<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\DatabaseWorker;


final class GalleryPresenter extends BasePresenter
{
    public string $type;
    private DatabaseWorker $databaseWorker;

    public function __construct(DatabaseWorker $databaseWorker)
    {
        parent::__construct();
        $this->databaseWorker = $databaseWorker;
    }

    public function renderDefault(string $type = ''): void
    {
        $this->type = $type;
        $this->template->images=$this->databaseWorker->getAvaliableImages($type);
    }
}
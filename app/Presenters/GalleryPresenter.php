<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Database\Repository\ImageRepository;
use App\Model\DatabaseWorker;


final class GalleryPresenter extends BasePresenter
{
    public string $type;
    private DatabaseWorker $databaseWorker;
    private ImageRepository $imageRepository;

    public function __construct(DatabaseWorker $databaseWorker, ImageRepository $imageRepository)
    {
        parent::__construct();
        $this->databaseWorker = $databaseWorker;
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param string $type
     *
     */
    public function renderDefault(string $type = ''): void
    {
        $data = $this->imageRepository->findBy(['do_show'=>true]);
        $this->template->images = $data;
        /*$this->type = $type;
        $this->template->images=$this->databaseWorker->sortImagesToGallery($this->databaseWorker->getAvaliableImages($type));*/
    }
}
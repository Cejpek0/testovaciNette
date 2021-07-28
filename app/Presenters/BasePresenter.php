<?php

declare(strict_types=1);

namespace App\Presenters;


use Nette;

class BasePresenter extends Nette\Application\UI\Presenter
{
    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->menuItems = [
            'Domů' => 'Homepage:',
            'Zakázky' => 'Contract:',
            'Kontakt' => 'Contact:',
            'Podmínky' => 'Terms:'
        ];
        $this->template->galleryItems = [
            'Akryl' => 'Gallery:acrylic',
            'Uhel/hrudka' => 'Gallery:graphite',
            'Tužka' => 'Gallery:pencil',
            'Vodovky' => 'Gallery:watercolour',
            'Tempery' => 'Gallery:tempera'
        ];
    }
}
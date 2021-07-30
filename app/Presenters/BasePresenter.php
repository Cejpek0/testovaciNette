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
            'Akryl' => $this->link('Gallery:default', 'acrylic'),
            'Uhel/hrudka' => $this->link('Gallery:default', 'graphite'),
            'Tužka' => $this->link('Gallery:default', 'pencil'),
            'Vodovky' => $this->link('Gallery:default', 'watercolour'),
            'Tempery' => $this->link('Gallery:default', 'tempera'),
            'Ostatní' => $this->link('Gallery:default', 'other'),
        ];
    }
}
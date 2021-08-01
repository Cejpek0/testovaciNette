<?php

declare(strict_types=1);

namespace App\Presenters;
use App\Model\DatabaseWorker;
use mysql_xdevapi\Exception;
use Nette\Application\UI\Form;

final class AdminPresenter extends BasePresenter
{
    private DatabaseWorker $databaseWorker;

    /**
     * AdminPresenter constructor.
     * @param DatabaseWorker $databaseWorker
     *
     */
    public function __construct(DatabaseWorker $databaseWorker)
    {
        parent::__construct();
        $this->databaseWorker = $databaseWorker;
    }
    public function actionDefault(): void
    {
        if(!$this -> getUser()->isLoggedIn())
        {
            $this->redirect('Sign:login');
        }
    }

    /**
     * @return Form
     *
     */
    protected function createComponentFormAddImage(): Form
    {
        $types = [
            'acrylic' => 'Akryl',
            'graphite' => 'Uhel/hrudka',
            'pencil' => 'Tužka',
            'watercolour' => 'Vodovky',
            'tempera' => 'Tempery',
            'other' => 'Ostatní'
        ];

        $form = new Form;
        $form->addText('name', 'Název:');
        $form->addSelect('type', 'Typ:', $types)
            ->setDefaultValue('other')
            ->setRequired('Je potřeba zadat typ');
        $form->addCheckbox('do_show', ' Viditelný')
            ->setDefaultValue(true);
        $form->addUpload('image','Obrázek:')
            ->setRequired('Je nutné vybrat obrázek')
            ->addRule($form::IMAGE, 'Avatar musí být JPEG, PNG, GIF or WebP.');
        $form->addSubmit('send', 'Přidat');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    /**
     * @param Form $form
     * @param $data
     * @throws \Nette\Application\AbortException
     *
     */
    public function formSucceeded(Form $form, $data): void
    {
        if($this->getUser()->isLoggedIn())
        {
            try
            {
                $img = $data->image->toImage();
                $img->save('images/gallery/'.$data->image->getName());
            }
            catch (Exception $ex)
            {
                $form->addError('Obrázek se neuložil, nejspíše již existuje.');
            }
            $this->databaseWorker->insertInto($data);
            $this->flashMessage('Obrázek byl úspěšně přidán ♥');

            $this->redirect('Admin:');
        }

    }
}
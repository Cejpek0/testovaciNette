<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class SignPresenter extends BasePresenter
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;

    }

    public function renderLogin(): void
    {
    }

    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('username','Uživatelské jméno:')
            ->setRequired('Musíte vyplnit uživatelské jméno');
        $form->addPassword('password','Heslo:')
            ->setRequired('Musíte vyplnit heslo');
        $form->addSubmit('send', 'Přihlásit');
        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }
    public function signInFormSucceeded(Form $form, \stdClass $data):void
    {
        try {
            $this->getUser()->login($data->username, $data->password);
            $this->redirect('Admin:');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Nesprávné přihlašovací jméno nebo heslo.');
        }
    }

    public function actionLogOut(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Odhlášení bylo úspěšné.');
        $this->redirect('Homepage:');
    }
}

<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class SignPresenter extends BasePresenter
{
    public function renderLogin(): void
    {
    }

    /**
     * @return Form
     */
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
    public function signInFormSucceeded(Form $form):void
    {
        $data = $form->values;
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

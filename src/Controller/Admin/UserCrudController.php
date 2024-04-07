<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractCrudController
{

    public const USERS_BASE_PATH = 'upload/images/users';
    public const USERS_UPLOAD_DIR = 'public/upload/images/users';

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural('Uživatelé')
            ->setEntityLabelInSingular('Uživatelé')
            ->setPageTitle('index', 'Seznam uživatelů')
            ->setPageTitle('new', 'Přidat uživatele')
            ->setPageTitle('edit', 'Upravit uživatele')
            ->setPageTitle('detail', 'Detail uživatele')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['username', 'email']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')
                ->setLabel('Foto')
                ->setBasePath(self::USERS_BASE_PATH)
                ->setUploadDir(self::USERS_UPLOAD_DIR),
            EmailField::new('email'),
            TextField::new('username')
                ->setLabel('Jméno'),
            TimeField::new('created_at', $label = 'Registrace'),
            BooleanField::new('banned', $label = 'Ban')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural('Klienti')
            ->setEntityLabelInSingular('Klienta')
            ->setEntityLabelInPlural('Klienti')
            ->setPageTitle('index', 'Seznam klientů')
            ->setPageTitle('new', 'Přidat klienta')
            ->setPageTitle('edit', 'Upravit klienta')
            ->setPageTitle('detail', 'Detail klienta')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['firstName', 'lastName', 'address', 'email']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('lastName')
                ->setLabel('Jméno'),
            TextField::new('firstName')
                ->setLabel('Příjmení'),
            TextField::new('address')
                ->setLabel('Adresa'),
            TextField::new('phone')
                ->setLabel('Telefon'),
            TextField::new('email')
                ->setLabel('Email'),
            TextEditorField::new('note')
                ->setLabel('Poznámka'),
            TimeField::new('createdAt')
                ->setLabel('Vytvořeno')
                ->hideOnForm(),
            TimeField::new('updatedAt')
                ->setLabel('Změněno')
                ->hideOnForm(),
            TextField::new('createdBy')
                ->setLabel('Vytvořil')
                ->hideOnForm(),
            TextField::new('updatedBy')
                ->setLabel('Editoval')
                ->hideOnForm(),

        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Client) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);

        $user = $this->getUser();

        if ($user instanceof User) {
            $entityInstance->setCreatedBy($user->getUsername());
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Client) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        $user = $this->getUser();

        if ($user instanceof User) {
            $entityInstance->setUpdatedBy($user->getUsername());
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}

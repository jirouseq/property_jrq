<?php

namespace App\Controller\Admin;

use App\Entity\TransactionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TransactionTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TransactionType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name')
                ->setLabel('Typ transakce'),
            BooleanField::new('active')
                ->setLabel('Aktivní')
        ];
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural('Typy transakcí')
            ->setEntityLabelInSingular('Transakci')
            ->setEntityLabelInPlural('Transakce')
            ->setPageTitle('index', 'Seznam transakcí')
            ->setPageTitle('new', 'Přidat transakci')
            ->setPageTitle('edit', 'Upravit transakci')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);
    }
}

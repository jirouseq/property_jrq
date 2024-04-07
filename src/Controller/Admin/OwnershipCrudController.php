<?php

namespace App\Controller\Admin;

use App\Entity\Ownership;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OwnershipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ownership::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('vlastnictví')
            ->setEntityLabelInPlural('Typy vlastnictví')
            ->setPageTitle('index', 'Seznam typů vlastictví')
            ->setPageTitle('new', 'Přidat typ')
            ->setPageTitle('edit', 'Upravit typ')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type')
                ->setLabel('Typ vlastnictví')
        ];
    }
}

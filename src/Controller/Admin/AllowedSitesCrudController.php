<?php

namespace App\Controller\Admin;

use App\Entity\AllowedSites;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AllowedSitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AllowedSites::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Povolené weby')
            ->setPageTitle(Crud::PAGE_NEW, 'Přidat web')
            ->setEntityLabelInSingular('web')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Web')
        ];
    }
}

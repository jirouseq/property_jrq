<?php

namespace App\Controller\Admin;

use App\Entity\Energy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnergyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Energy::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Štítek')
            ->setEntityLabelInPlural('Energetické štítky')
            ->setPageTitle('index', 'Seznam štítků')
            ->setPageTitle('new', 'Přidat štítek')
            ->setPageTitle('edit', 'Upravit štítek')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Energetický štítek')
        ];
    }
}

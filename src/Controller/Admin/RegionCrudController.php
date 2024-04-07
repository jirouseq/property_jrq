<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RegionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Region::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $type = new Region();

        $user = $this->getUser();

        if ($user instanceof User) {
            $type->setCreatedBy($user->getUsername());
        }
        return $type;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural('Regiony')
            ->setPageTitle(Crud::PAGE_NEW, 'Přidat nový region')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name')
                ->setLabel('Region'),
            BooleanField::new('active')
                ->setLabel('Aktivní'),
            TextField::new('createdBy')
                ->setLabel('Autor')
                ->hideOnForm()
        ];
    }
}

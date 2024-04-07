<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class TypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Type::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $type = new Type();

        $user = $this->getUser();

        if ($user instanceof User) {
            $type->setCreatedBy($user->getUsername());
        }
        return $type;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Typy nemovitostí')
            ->setPageTitle(Crud::PAGE_NEW, 'Přidat nový typ nemovitosti')
            ->setEntityLabelInSingular('typ')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setSearchFields(['name']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name')
                ->setLabel('Typ nemovitosti'),
            BooleanField::new('active')
                ->setLabel('Aktivní'),
            TextField::new('createdBy')
                ->setLabel('Autor')
        ];
    }
}

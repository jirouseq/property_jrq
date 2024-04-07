<?php

namespace App\Controller\Admin;

use App\Entity\ConditionProperty;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConditionPropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConditionProperty::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Stav nemovitosti'),
        ];
    }
}

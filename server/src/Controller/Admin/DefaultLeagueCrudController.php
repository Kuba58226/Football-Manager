<?php

namespace App\Controller\Admin;

use App\Entity\DefaultLeague;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DefaultLeagueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DefaultLeague::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
        ];
    }
}

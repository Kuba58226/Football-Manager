<?php

namespace App\Controller\Admin;

use App\Entity\League;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class LeagueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return League::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('defaultLeague'),
            AssociationField::new('teams'),
        ];
    }
}

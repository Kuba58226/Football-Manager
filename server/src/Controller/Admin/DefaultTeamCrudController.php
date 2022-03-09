<?php

namespace App\Controller\Admin;

use App\Entity\DefaultTeam;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DefaultTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DefaultTeam::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('budget'),
            AssociationField::new('defaultLeague'),
        ];
    }
}

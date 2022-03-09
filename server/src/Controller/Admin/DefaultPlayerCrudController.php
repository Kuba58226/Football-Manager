<?php

namespace App\Controller\Admin;

use App\Entity\DefaultPlayer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DefaultPlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DefaultPlayer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('country'),
            IntegerField::new('age'),
            TextField::new('position'),
            AssociationField::new('defaultTeam'),
            IntegerField::new('goalkeeper'),
            IntegerField::new('defender'),
            IntegerField::new('midfielder'),
            IntegerField::new('attacker'),
        ];
    }
}

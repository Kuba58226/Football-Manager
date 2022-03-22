<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('defaultPlayer'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('country'),
            IntegerField::new('age'),
            TextField::new('position'),
            IntegerField::new('goalkeeper'),
            IntegerField::new('defender'),
            IntegerField::new('midfielder'),
            IntegerField::new('attacker'),
            IntegerField::new('stamina'),
            IntegerField::new('goals'),
            DateTimeField::new('suspendedTo'),
            DateTimeField::new('injuredTo'),
            AssociationField::new('team'),
        ];
    }
}

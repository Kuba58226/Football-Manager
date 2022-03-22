<?php

namespace App\Controller\Admin;

use App\Entity\MatchResult;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MatchResultCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MatchResult::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('league'),
            AssociationField::new('homeTeam'),
            AssociationField::new('awayTeam'),
            DateTimeField::new('date'),
            TextField::new('state'),
            IntegerField::new('homeTeamGoals'),
            IntegerField::new('awayTeamGoals'),
            IntegerField::new('matchday'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('league')
            ->add('homeTeam')
            ->add('awayTeam')
            ->add('date')
            ->add('state')
            ->add('homeTeamGoals')
            ->add('awayTeamGoals')
            ->add('matchday')
            ;
    }
}

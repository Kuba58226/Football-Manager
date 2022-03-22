<?php

namespace App\Controller\Admin;

use App\Entity\DefaultLeague;
use App\Entity\DefaultPlayer;
use App\Entity\DefaultTeam;
use App\Entity\League;
use App\Entity\MatchResult;
use App\Entity\Player;
use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Server');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Default Data');
        yield MenuItem::linkToCrud('Default League', 'fas fa-trophy', DefaultLeague::class);
        yield MenuItem::linkToCrud('Default Team', 'fas fa-users', DefaultTeam::class);
        yield MenuItem::linkToCrud('Default Player', 'fas fa-user', DefaultPlayer::class);
        yield MenuItem::section('Players Data');
        yield MenuItem::linkToCrud('Leagues', 'fas fa-trophy', League::class);
        yield MenuItem::linkToCrud('Teams', 'fas fa-users', Team::class);
        yield MenuItem::linkToCrud('Players', 'fas fa-user', Player::class);
        yield MenuItem::linkToCrud('Matches', 'fa fa-handshake-o', MatchResult::class);
        yield MenuItem::linkToRoute('Create League', 'fas fa-plus', 'admin_league');
    }
}

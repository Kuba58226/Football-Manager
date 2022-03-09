<?php

namespace App\Controller\Admin;

use App\Entity\DefaultLeague;
use App\Entity\DefaultPlayer;
use App\Entity\DefaultTeam;
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
        yield MenuItem::linkToCrud('Default League', 'fas fa-list', DefaultLeague::class);
        yield MenuItem::linkToCrud('Default Team', 'fas fa-list', DefaultTeam::class);
        yield MenuItem::linkToCrud('Default Player', 'fas fa-list', DefaultPlayer::class);
    }
}

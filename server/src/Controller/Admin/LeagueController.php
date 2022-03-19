<?php

namespace App\Controller\Admin;

use App\Entity\League;
use App\Form\Type\Admin\LeagueType;
use App\Service\Admin\LeagueCreator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends AbstractDashboardController
{
    /**
     * @var LeagueCreator
     */
    private $leagueCreator;

    public function __construct(LeagueCreator $leagueCreator)
    {
        $this->leagueCreator = $leagueCreator;
    }

    public function createLeague(Request $request)
    {
        $form = $this->createForm(LeagueType::class);

        $form->handleRequest($request);

        /** @var League $league */
        $league = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            ($this->leagueCreator)($league);
        }

        return $this->render('bundles/EasyAdminBundle/createLeague.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
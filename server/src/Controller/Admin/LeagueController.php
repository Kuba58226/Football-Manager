<?php

namespace App\Controller\Admin;

use App\Entity\League;
use App\Form\Type\Admin\LeagueType;
use App\Service\Admin\LeagueCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LeagueController extends AbstractController
{
    /**
     * @var LeagueCreator
     */
    private $leagueCreator;

    public function __construct(LeagueCreator $leagueCreator)
    {
        $this->leagueCreator = $leagueCreator;
    }

    /**
     * @Route("/admin/league", name="admin_league")
     */
    public function createLeague(Request $request)
    {
        $form = $this->createForm(LeagueType::class);

        $form->handleRequest($request);

        /** @var League $league */
        $league = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            ($this->leagueCreator)($league);
        }

        return $this->renderForm('admin/league/form.html.twig', [
            'form' => $form,
        ]);
    }
}
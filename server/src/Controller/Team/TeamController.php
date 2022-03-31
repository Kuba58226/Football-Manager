<?php

namespace App\Controller\Team;

use App\Service\Team\LeaveTeamService;
use App\Service\Team\TakeOverTeamService;
use App\Shared\Controller\AppController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends AppController
{
    /**
     * @var TakeOverTeamService $takeOverTeamService
     */
    private $takeOverTeamService;

    /**
     * @var LeaveTeamService $takeOverTeamService
     */
    private $leaveTeamService;

    public function __construct(
        TakeOverTeamService $takeOverTeamService,
        LeaveTeamService $leaveTeamService
    ) {
        $this->takeOverTeamService = $takeOverTeamService;
        $this->leaveTeamService = $leaveTeamService;
    }

    public function takeOverTeam(int $id): Response
    {
        $user = $this->getUser();

        ($this->takeOverTeamService)($id, $user);

        return $this->jsonResponse(
            'Team succesfully taken over',
            null,
            Response::HTTP_OK
        );
    }

    public function leaveTeam(int $id): Response
    {
        $user = $this->getUser();

        ($this->leaveTeamService)($id, $user);

        return $this->jsonResponse(
            'Team succesfully left',
            null,
            Response::HTTP_OK
        );
    }
}
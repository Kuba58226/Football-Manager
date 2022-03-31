<?php

namespace App\Service\Team;

use App\Entity\User;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class LeaveTeamService
{
    /**
     * @var TeamRepository $teamRepository
     */
    private $teamRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(
        TeamRepository $teamRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->teamRepository = $teamRepository;
        $this->entityManager = $entityManager;
    }

    public function __invoke(int $id, User $user)
    {
        $team = $this->teamRepository->findOneBy([
            'id' => $id,
            'user' => $user
        ]);

        if (!$team) {
            throw new Exception('Team not found');
        }

        $team->setUser(null);
        $user->removeTeam($team);
        $this->entityManager->persist($team);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
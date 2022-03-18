<?php


namespace App\Service\Admin;

use App\Entity\DefaultTeam;
use App\Entity\League;
use App\Entity\Team;

class TeamCloner
{
    public function __invoke(DefaultTeam $defaultTeam, League $league): Team
    {
        $team = new Team();

        $team->setBudget($defaultTeam->getBudget());
        $team->setDefaultTeam($defaultTeam);
        $team->setLeague($league);

        return $team;
    }
}
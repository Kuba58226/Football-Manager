<?php

namespace App\Service\Admin;

use App\Entity\DefaultTeam;
use App\Entity\League;
use App\Entity\Team;

class TeamCreator
{
    public function __invoke(DefaultTeam $defaultTeam, League $league): Team
    {
        $team = new Team();

        $team->setDefaultTeam($defaultTeam);
        $team->setLeague($league);
        $team->setBudget($defaultTeam->getBudget());

        $league->addTeam($team);

        return $team;
    }
}
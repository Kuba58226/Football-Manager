<?php

namespace App\Service\Admin;

use App\Entity\DefaultPlayer;
use App\Entity\Player;
use App\Entity\Team;

class PlayerCreator
{
    public function __invoke(DefaultPlayer $defaultPlayer, Team $team): Player
    {
        $player = new Player();

        $player->setDefaultPlayer($defaultPlayer);
        $player->setTeam($team);
        $player->setFirstName($defaultPlayer->getFirstName());
        $player->setLastName($defaultPlayer->getLastName());
        $player->setCountry($defaultPlayer->getCountry());
        $player->setAge($defaultPlayer->getAge());
        $player->setPosition($defaultPlayer->getPosition());
        $player->setGoalkeeper($defaultPlayer->getGoalkeeper());
        $player->setDefender($defaultPlayer->getDefender());
        $player->setMidfielder($defaultPlayer->getMidfielder());
        $player->setAttacker($defaultPlayer->getAttacker());

        return $player;
    }
}
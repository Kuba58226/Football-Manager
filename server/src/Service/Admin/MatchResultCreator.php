<?php

namespace App\Service\Admin;

use App\Entity\League;
use App\Entity\MatchResult;
use App\Entity\Team;
use DateTime;

class MatchResultCreator
{
    public const AWAITING = 'awaiting';

    public const PLAYED = 'played';

    public function __invoke(League $league, Team $homeTeam, Team $awayTeam, DateTime $date): MatchResult
    {
        $matchResult = new MatchResult();

        $matchResult->setLeague($league);
        $matchResult->setDate($date);
        $matchResult->setState(self::AWAITING);
        $matchResult->setHomeTeam($homeTeam);
        $matchResult->setAwayTeam($awayTeam);

        return $matchResult;
    }
}
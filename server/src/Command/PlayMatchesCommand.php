<?php

namespace App\Command;

use App\Repository\MatchResultRepository;
use App\Service\Match\PlayMatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PlayMatchesCommand extends Command
{
    protected static $defaultName = 'app:play-matches';

    /**
     * @var MatchResultRepository $matchResultRepository
     */
    private $matchResultRepository;

    /**
     * @param PlayMatchService $playMatchService
     */
    private $playMatchService;

    public function __construct(
        MatchResultRepository $matchResultRepository,
        PlayMatchService $playMatchService,
        string $name = null
    ) {
        $this->matchResultRepository = $matchResultRepository;
        $this->playMatchService = $playMatchService;

        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $matches = $this->matchResultRepository->findMatchResultsOlderThanCurrentDate();

        foreach ($matches as $match) {
            ($this->playMatchService)($match);
        }

        return Command::SUCCESS;
    }
}

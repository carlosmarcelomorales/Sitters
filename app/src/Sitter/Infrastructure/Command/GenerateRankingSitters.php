<?php

namespace App\Sitters\Infrastructure\Command;

use App\Sitters\Application\UseCase\RankingSitters\GenerateRankingSittersUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRankingSitters extends Command
{
    private GenerateRankingSittersUseCase $generateRankingSittersUseCase;
    public function __construct(
        ?string $name = null,
        GenerateRankingSittersUseCase $generateRankingSittersUseCase
    )
    {
        parent::__construct($name);
        $this->generateRankingSittersUseCase = $generateRankingSittersUseCase;

    }

    protected function configure(): void
    {
        $this
            ->setName('app:generate-ranking-sitters')
            ->setDescription('Generate a file with the ranking of sitters');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->generateRankingSittersUseCase->__invoke();
        return Command::SUCCESS;
    }
}
<?php

namespace App\Sitter\Infrastructure\Command;

use App\Sitter\Application\UseCase\RankingSitters\GenerateRankingSittersUseCase;
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
        $result = $this->generateRankingSittersUseCase->__invoke();

        if ($result) {
            $output->writeln('Ranking of sitters was successfully created!!!');
            return Command::SUCCESS;
        }

        $output->writeln('There was a problem with creating ranking sitters');
        return Command::FAILURE;
    }
}
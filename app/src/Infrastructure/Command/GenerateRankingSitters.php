<?php

namespace App\Infrastructure\Command;

use App\Application\UseCase\RankingSitters\GenerateRankingSittersUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


//#[AsCommand(name: 'app:generate-ranking-sitters')]
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

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
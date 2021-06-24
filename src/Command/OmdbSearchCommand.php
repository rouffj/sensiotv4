<?php

namespace App\Command;

use App\Omdb\OmdbClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\Exception\TransportException;

class OmdbSearchCommand extends Command
{
    protected static $defaultName = 'app:omdb:search';
    protected static $defaultDescription = 'Add a short description for your command';
    private $omdbClient;

    public function __construct(OmdbClient $omdbClient)
    {
        parent::__construct(null);

        $this->omdbClient = $omdbClient;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('movie_name', InputArgument::REQUIRED, 'Search all movies matching the movie_name given.')
            //->addOption('all', null, InputOption::VALUE_NONE, '--all allows to display movies, series, games...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $movieName = $input->getArgument('movie_name');

        $io->title(sprintf('Search all movies from OMDB matching: %s.', $movieName));

        $parameters = [];
        if ($movieType = $io->choice('Are you sure to display all items or only one of the following?', ['all', 'movie', 'series', 'game'])) {
            if ('all' !== $movieType) {
                $parameters['type'] = $movieType;
            }
        }

        try {
            $rows = $this->omdbClient->requestBySearch($movieName, $parameters);

            $lines = []; 
            foreach ($rows['Search'] as $row) {
                $lines[] = [$row['Title'], $row['Year'], $row['Type'], 'https://www.imdb.com/title/' . $row['imdbID']];
            }

            //https://www.imdb.com/title/tt0120737/
            $io->table(['Title', 'Year', 'Type', 'URL'], $lines);
            //dump($rows);

        } catch (TransportException $e) {
            $io->warning(sprintf('The entertainment "%s" could not be found, please try with an other search.', $movieName));
        }

        return Command::SUCCESS;
    }
}

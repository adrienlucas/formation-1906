<?php

namespace App\Command;

use App\Entity\Genre;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:export-movies',
    description: 'Export movies as CSV.',
)]
class ExportMoviesCommand extends Command
{
    private const ALLOWED_COLUMNS = ['id', 'title' , 'plot', 'releasedAt', 'genres'];

    public function __construct(
        private MovieRepository $movieRepository,
        private PropertyAccessorInterface $propertyAccessor,
        private SerializerInterface $serializer,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file_path', InputArgument::REQUIRED, 'Output file path.')
            ->addArgument('genres', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'List of genres name to include.')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
            ->addOption('separator', null, InputOption::VALUE_REQUIRED, 'CSV seperator (default is comma).', ',')
            ->addOption('column', null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'List of included columns.',
                self::ALLOWED_COLUMNS
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->error('You have a new command! Now make it your own! Pass --help to see your options.');

        $filePath = $input->getArgument('file_path');
        if(!is_writable(dirname($filePath))) {
            throw new \RuntimeException('Output file path is not writable.');
        }

        $includedGenres = $input->getArgument('genres');
        if(empty($includedGenres)) {
            $movies = $this->movieRepository->findAll();
        } else {
            $movies = $this->movieRepository->findByGenreNames($includedGenres);
        }

        $csvContent = '';
        $csvSeparator = $input->getOption('separator');

        $includedColumns = $input->getOption('column');
//        $allowedColumns = ;
        $header = [];
        foreach($movies as $movie) {

            $csvColumns = [];
            foreach(self::ALLOWED_COLUMNS as $allowedColumn) {
                if(!in_array($allowedColumn, $includedColumns)) {
                    continue;
                }
                if(!in_array($allowedColumn, $header)) {
                    $header[] = $allowedColumn;
                }

                $columnValue = $this->propertyAccessor->getValue($movie, $allowedColumn);
                if($columnValue instanceof \DateTimeInterface) {
                    $columnValue = $columnValue->format('d/m/Y');
                }

                if($columnValue instanceof Collection) {
                    $columnValue = implode(',',array_map(fn(Genre $genre) => $genre->getName(), $columnValue->toArray()));
                }

                $csvColumns[] .= '"'.addcslashes($columnValue, '"').'"';
            }

            $csvContent .= implode($csvSeparator, $csvColumns)."\n";
        }

        file_put_contents($filePath, implode($csvSeparator, $header)."\n".$csvContent);

        $io->success('Movies exported.');
        return Command::SUCCESS;
    }
}

// console app:export-movies --separator=";" movies.csv
// console app:export-movies --column=id --column=title --column=plot movies.csv
// console app:export-movies movies.csv drama comedy

// console app:export-movies --separator=";" --column=id --column=title --column=plot movies.csv drama comedy action

// Première ligne contient les noms des colones

//
//$i = 1;
//(string) $i; // '1'
//
//
//$i = new class {
//    public function __toString(): string
//    {
//        return $this->name;
//    }
//}
//
//(string) $i; // 'i'

# 1 console make:command
# 2 commenter les parties auto-générées
# 3 Définir l'argument "file_path"
# 4 Faire l'injection du MovieRepository
# 5 Ecrire le code de la méthode execute
    // utiliser findAll
    // utiliser https://www.php.net/manual/en/function.fputcsv.php sur le fichier
    // OU utiliser implode + addslaches()
# 6 Ajouter l'option "seperator"
# 7 Ajouter l'arguments "genres" (déclarer une méthode sur MovieRepository findMoviesByGenreNames)
# 8 Ajouter l'option "column" (utiliser le property accessor)

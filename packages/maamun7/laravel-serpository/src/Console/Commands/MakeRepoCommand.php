<?php

namespace Serpository\Console\Commands;

use Exception;
use Serpository\Console\Command;
use Serpository\Generators\RepositoryGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class MakeRepoCommand extends SymfonyCommand
{
    use Command;
    /**
     * The console command name.
     *
     * @var string
     */
    protected string $name = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Create a new Repository.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $generator = new RepositoryGenerator();
        $repositoryName = $this->argument('repo');

        try {
            $repository = $generator->generate($repositoryName);

            $this->info(
                "Repository class created successfully." .
                "\n" .
                "\n" .
                "Find it at <comment>" . $repository->path . "</comment>" . "\n"
            );
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    public function getArguments(): array
    {
        return [
            ['repo', InputArgument::REQUIRED, 'The Repository\'s name.']
        ];
    }
}

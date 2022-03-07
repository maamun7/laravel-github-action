<?php

namespace Serpository\Console\Commands;

use Exception;
use Serpository\Console\Command;
use Serpository\Generators\ServiceGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class MakeServiceCommand extends SymfonyCommand
{
    use Command;
    /**
     * The console command name.
     *
     * @var string
     */
    protected string $name = 'moon:service!';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Create a new Service.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $generator = new ServiceGenerator();
        $serviceName = $this->argument('service');

        try {
            $service = $generator->generate($serviceName);

            $this->info(
                "Service class created successfully." .
                "\n" .
                "\n" .
                "Find it at <comment>" . $service->path . "</comment>" . "\n"
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
            ['service', InputArgument::REQUIRED, 'The Service\'s name.']
        ];
    }
}

<?php

namespace Serpository\Generators;

use Exception;
use Serpository\Str;
use Serpository\Entities\Repositoy;

class RepositoryGenerator extends Generator
{
    /**
     * Generate the file.
     *
     * @param $name
     *
     * @return Repositoy
     * @throws Exception
     */
    public function generate($name): Repositoy
    {
        $repository = Str::repository($name);
        $interface = Str::repositoryInterface($name);
        $filePath = $this->getRepositoriesFilePath($repository);

        if ($this->exists($filePath)) {
            throw new Exception('Repository already exists');
        }

        $reposDirectories = [
            $this->getRepositoriesRootPath(),
            $this->getInterfacesRootPath(),
        ];

        foreach ($reposDirectories as $dir) {
            if (!$this->exists($dir)) {
                $this->createDirectory($dir);
                $this->createFile($dir . '/.gitkeep');
            }
        }

        $namespace = $this->getRepositoryNamespace();
        $interfaceNamespace = $this->getInterfaceNamespace();

        $this->createRepository($namespace, $repository, $filePath, $interface, $interfaceNamespace);
        $this->createInterface($interface, $interfaceNamespace);

        return new Repositoy(
            $repository,
            $this->relativeFromReal($filePath),
            $namespace,
        );
    }

    public function createRepository($namespace, $repository, $filePath, $interface, $interfaceNamespace): void
    {
        $modelStub = $this->findModel($repository);
        $content = file_get_contents($this->getStub());
        $content = str_replace(
            [
                '{{namespace}}',
                '{{repository}}',
                '{{interface}}',
                '{{interfaceNamespace}}',
                '{{modelType}}',
                '{{modelNamespace}}',
                '{{modelProperty}}',
                '{{bindProperty}}',
                '{{paramName}}',
            ],

            [
                $namespace,
                $repository,
                $interface,
                $interfaceNamespace,
                ...$modelStub
            ],

            $content
        );

        $this->createFile($filePath, $content);
    }

    public function findModel(string $repositoryName): array
    {
        $modelName = Str::model($repositoryName);
        $modelFilePath = $this->getModelsRootPath();

        foreach (['', 's', 'Model', '_model'] as $concatStr) {
            $model = $modelName . $concatStr;

            if ($this->exists($modelFilePath . '/' . $model . '.php')) {
                $modelName = $model;
                break;
            }
        }

        return [
            $modelName,
            'use ' . $this->getModelNamespace() . '\\' . $modelName,
            'protected ' . $modelName . ' $' . strtolower($modelName),
            '$this->' . strtolower($modelName),
            '$' . strtolower($modelName),
        ];
    }

    public function createInterface($interface, $namespace): void
    {
        $filePath = $this->getInterfacesFilePath($interface);
        $content = file_get_contents($this->getInterfaceStub());

        $content = str_replace(
            ['{{namespace}}', '{{interface}}'],
            [$namespace, $interface],
            $content
        );

        $this->createFile($filePath, $content);
    }

    /**
     * Get the stub file for generation Service.
     *
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../Generators/stubs/repository.stub';
    }

    /**
     * Get the stub file for generation Service.
     *
     * @return string
     */
    public function getInterfaceStub(): string
    {
        return __DIR__ . '/../Generators/stubs/interface.stub';
    }
}

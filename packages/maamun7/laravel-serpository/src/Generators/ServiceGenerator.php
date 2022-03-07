<?php

namespace Serpository\Generators;

use Exception;
use Serpository\Entities\Repositoy;
use Serpository\Str;
use Serpository\Entities\Service;

class ServiceGenerator extends Generator
{
    /**
     * Description
     *
     * @param $name
     * @param Repositoy|null $repositoy
     *
     * @return Service
     * @throws Exception
     */
    public function generate($name, Repositoy|null $repositoy): Service
    {
        $service = Str::service($name);
        $filePath = $this->getServiceFilePath($service);

        if ($this->exists($filePath)) {
            throw new Exception('Service already exists');
        }

        $serviceRootDir = $this->getServicesRootPath();

        if (!$this->exists($serviceRootDir)) {
            $this->createDirectory($serviceRootDir);
            $this->createFile($serviceRootDir . '/.gitkeep');
        }

        $namespace = $this->getServiceNamespace();
        $stub = !$repositoy ? $this->getStub() : $this->getRepoInjectedService();

        $content = file_get_contents($stub);
        $content = str_replace(
            [
                '{{namespace}}',
                '{{service}}'
            ],

            [
                $namespace,
                $service
            ],

            $content
        );

        $this->createFile($filePath, $content);

        return new Service(
            $service,
            $this->relativeFromReal($filePath),
            $namespace,
        );
    }

    /**
     * Get the stub file for generation Service.
     *
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../Generators/stubs/service.stub';
    }

    public function getRepoInjectedService(): string
    {
        return __DIR__ . '/../Generators/stubs/injectedService.stub';
    }
}

<?php

namespace Versoo\LarapiFast\Command;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ProviderMakeCommand extends LarapiFastGeneratorCommand
{
    protected static $excludedNames = ['Service', 'service', 'Provider', 'provider'];
    protected $name = "larapi:provider";
    protected $type = "Provider";
    protected $suffix = "ServiceProvider";
    protected $description = "Create a service for API Resource";

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return;
        }
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyModel'],
            [$this->getModel()],
            $stub
        );

        return parent::replaceNamespace($stub, $name);
    }

    protected function getModel()
    {
        $name = str_replace(static::$excludedNames, '', $this->getNameInput());
        if ($this->hasOption('model') && $this->option('model')) {
            $name = $this->qualifyClass($this->option('model'));
        }

        return Str::singular($name);
    }

    protected function getNameInput()
    {
        $name = parent::getNameInput();

        return str_replace(static::$excludedNames, '', $name);
    }

    protected function getStub()
    {
        return $this->resolveStubsPath() . '/provider.stub';
    }

    protected function getArguments()
    {
        $modelArguments = [
            ['name', InputArgument::OPTIONAL, 'Custom name of the ServiceProvider (Default: ResourceName)'],
        ];

        return array_merge(parent::getArguments(), $modelArguments);
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force to create service - overwrite if exists'],
        ];
    }
}

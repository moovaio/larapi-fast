<?php

namespace Versoo\LarapiFast\Command;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends LarapiFastGeneratorCommand
{
    protected $name = "larapi:model";

    protected $type = "Model";

    protected $description = "Create a model for API Resource";

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return;
        }

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller')) {
            $this->createController();
        }
    }

    protected function createFactory()
    {
        $this->call('make:factory', [
            'name' => $this->resolveClassName() . 'Factory',
        ]);
    }

    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->qualifyClass($this->getNameInput()))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    protected function createController()
    {
        $controller = Str::studly(class_basename($this->qualifyClass($this->getNameInput())));

        $this->call('larapi:controller', [
            'resource' => $this->argument('resource'),
            'name' => "{$controller}Controller",
        ]);
    }

    protected function getStub()
    {
        return $this->resolveStubsPath() . '/model.stub';
    }

    protected function getArguments()
    {
        $modelArguments = [
            ['name', InputArgument::OPTIONAL, 'Custom name of the Model (Default: ResourceName)'],
        ];

        return array_merge(parent::getArguments(), $modelArguments);
    }

    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, factory, and resource controller for the model'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],

        ];
    }
}

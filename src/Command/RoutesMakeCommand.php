<?php

namespace Versoo\LarapiFast\Command;


use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RoutesMakeCommand extends LarapiFastGeneratorCommand {

	protected $name = "larapi:routes";

	protected $type = "Routes";

	public function handle() {
		$name = "routes";
		if ( $this->option( 'public' ) ) {
			$name = "routes_public";
		}

		$path = $this->getPath( $name );

		if ( ( ! $this->hasOption( 'force' ) ||
		       ! $this->option( 'force' ) ) &&
		     $this->alreadyExists( $this->getNameInput() ) ) {
			$this->error( $this->type . ' already exists!' );

			return false;
		}

		$this->makeDirectory( $path );

		$this->files->put( $path, $this->buildClass( $name ) );

		$this->info( $this->type . ' created successfully.' );
	}

	protected function getStub() {
		if ( $this->option( 'public' ) ) {
			return $this->resolveStubsPath() . '/routes_public.stub';
		}

		return $this->resolveStubsPath() . '/routes.stub';
	}

	protected function replaceNamespace( &$stub, $name ) {
		$stub = str_replace(
			[ 'DummyController', 'dummyname' ],
			[
				$this->getControllerName(),
				$this->getResourceName()
			],
			$stub
		);

		return parent::replaceNamespace( $stub, $name );
	}

	protected function getResourceName() {
		$resourceName = Str::lower( Str::plural( $this->getNameInput() ) );

		return $resourceName;
	}

	protected function getControllerName() {
		$controllerName = Str::singular( $this->getNameInput() ) . 'Controller';

		return $controllerName;
	}

	protected function getArguments() {
		$modelArguments = [
			[ 'name', InputArgument::OPTIONAL, 'Custom name of the Controller (Default: ResourceName)' ]
		];

		return array_merge( parent::getArguments(), $modelArguments );
	}

	protected function getOptions() {
		return [
			[ 'public', '', InputOption::VALUE_NONE, 'Generate public routes file' ],
		];
	}
}
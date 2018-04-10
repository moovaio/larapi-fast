<?php

namespace Versoo\LarapiFast\Command;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use function array_merge;

class EventMakeCommand extends LarapiFastGeneratorCommand {
	static protected $excludedNames = [];
	protected $name = "larapi:event";
	protected $type = "Event";
	protected $description = "Create a event for API Resource";

	public function handle() {
		if ( parent::handle() === false && ! $this->option( 'force' ) ) {
			return;
		}
	}

	protected function replaceNamespace( &$stub, $name ) {
		$stub = str_replace(
			[ 'DummyModel', 'modelname' ],
			[ $this->getModel(), $this->getModelName() ],
			$stub
		);

		return parent::replaceNamespace( $stub, $name );
	}

	protected function getModel() {
		$name = Str::singular( $this->argument( 'resource' ) );
		if ( $this->option( 'model' ) ) {
			$name = $this->qualifyClass( $this->option( 'model' ) );
		}

		return $name;
	}

	protected function getModelName() {
		return Str::lower( $this->getModel() );
	}

	protected function getStub() {
		return $this->resolveStubsPath() . '/event.stub';
	}

	protected function getArguments() {
		$modelArguments = [
			[ 'name', InputArgument::REQUIRED, 'Name of event class for resource' ],
		];

		return array_merge( parent::getArguments(), $modelArguments );
	}

	protected function getOptions() {
		return [
			[ 'model', null, InputOption::VALUE_OPTIONAL, 'Name of custom model for event. Default value is name of resource' ],

			[ 'force', null, InputOption::VALUE_NONE, 'Force to create service - overwrite if exists' ],
		];
	}
}
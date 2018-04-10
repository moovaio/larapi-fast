<?php


namespace Versoo\LarapiFast\Command;


use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use function array_merge;
use function str_replace;

class RepositoryMakeCommand extends LarapiFastGeneratorCommand {
	static protected $excludedNames = [ 'Repository', 'repository' ];
	protected $name = "larapi:repository";
	protected $type = "Repository";
	protected $suffix = "Repository";

	protected $description = "Create a repository for API Resource";

	public function handle() {
		if ( parent::handle() === false && ! $this->option( 'force' ) ) {
			return;
		}
	}

	protected function replaceNamespace( &$stub, $name ) {
		$stub = str_replace(
			[ 'DummyModel', 'dummyname' ],
			[ $this->getModel(), $this->getModelName() ],
			$stub
		);

		return parent::replaceNamespace( $stub, $name );
	}

	protected function getModel() {
		$name = Str::singular( str_replace( static::$excludedNames, '', $this->getNameInput() ) );
//		$name         = $this->qualifyClass( $resourceName );
		if ( $this->option( 'model' ) ) {
			$name = $this->qualifyClass( $this->option( 'model' ) );
		}

		return $name;
	}

	protected function getNameInput() {
		$name = parent::getNameInput();

		return str_replace( static::$excludedNames, '', $name );
	}

	protected function getModelName() {
		return Str::lower( $this->getModel() );
	}

	protected function getModelNamespace() {
		$resourceName = str_replace( static::$excludedNames, '', $this->getNameInput() );
		$name         = $this->qualifyClass( $resourceName );
		if ( $this->option( 'model' ) ) {
			$name = $this->option( 'model' );
		}

		return $this->getNamespace( $name, 'Model' );
	}

	protected function getStub() {
		return $this->resolveStubsPath() . '/repository.stub';
	}

	protected function getArguments() {
		$modelArguments = [
			[ 'name', InputArgument::OPTIONAL, 'Custom name of the Repository (Default: ResourceName)' ]
		];

		return array_merge( parent::getArguments(), $modelArguments );
	}

	protected function getOptions() {
		return [
			[ 'model', 'm', InputOption::VALUE_OPTIONAL, 'Namespace to custom model for repository' ],

			[ 'force', null, InputOption::VALUE_NONE, 'Force to create repository - overwrite if exists' ],
		];
	}
}
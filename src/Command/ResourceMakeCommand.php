<?php


namespace Versoo\LarapiFast\Command;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ResourceMakeCommand extends LarapiFastGeneratorCommand {
	protected $name = "larapi:resource";

	protected $type = "Resource";

	protected $description = "Create a new API resource";

	public function handle() {
		if ( $this->option( 'all' ) ) {
			$this->input->setOption( 'controller', true );
			$this->input->setOption( 'routes', true );
			$this->input->setOption( 'model', true );
			$this->input->setOption( 'repository', true );
			$this->input->setOption( 'service', true );
			$this->input->setOption( 'provider', true );
			$this->input->setOption( 'request', true );
			$this->input->setOption( 'events', true );
			$this->input->setOption( 'exception', true );

		}
		if ( $this->option( 'routes' ) ) {
			$this->createRoutes();
		}
		if ( $this->option( 'model' ) ) {
			$this->createModel();
		}
		if ( $this->option( 'repository' ) ) {
			$this->createRepository();
		}
		if ( $this->option( 'service' ) ) {
			$this->createService();
		}
		if ( $this->option( 'controller' ) ) {
			$this->createController();
		}
		if ( $this->option( 'provider' ) ) {
			$this->createServiceProvider();
		}
		if ( $this->option( 'request' ) ) {
			$this->createRequest();
		}
		if ( $this->option( 'events' ) ) {
			$this->createEvents();
		}
		if ( $this->option( 'exception' ) ) {
			$this->createException();
		}
	}

	protected function createRoutes() {
		$this->call( 'larapi:routes', [ 'resource' => $this->argument( 'resource' ) ] );
	}

	protected function createModel() {

		$this->call( 'larapi:model', [ 'resource' => $this->argument( 'resource' ), '--migration' => true ] );
	}

	protected function createRepository() {
		$this->call( 'larapi:repository', [ 'resource' => $this->argument( 'resource' ) ] );
	}

	protected function createService() {
		$this->call( 'larapi:service', [ 'resource' => $this->argument( 'resource' ) ] );
	}

	protected function createController() {
		$this->call( 'larapi:controller', [ 'resource' => $this->argument( 'resource' ) ] );
	}

	protected function createServiceProvider() {
		$this->call( 'larapi:provider', [ 'resource' => $this->argument( 'resource' ) ] );
	}

	protected function createRequest() {
		$model = Str::singular( Str::ucfirst( $this->argument( 'resource' ) ) );
		$this->call( 'larapi:request', [ 'resource' => $this->argument( 'resource' ), 'name' => 'Create' . $model ] );
	}

	protected function createEvents() {
		$model = Str::singular( Str::ucfirst( $this->argument( 'resource' ) ) );
		$this->call( 'larapi:event', [ 'resource' => $this->argument( 'resource' ), 'name' => $model . 'WasCreated' ] );
		$this->call( 'larapi:event', [ 'resource' => $this->argument( 'resource' ), 'name' => $model . 'WasUpdated' ] );
		$this->call( 'larapi:event', [ 'resource' => $this->argument( 'resource' ), 'name' => $model . 'WasDeleted' ] );
	}

	protected function createException() {
		$model = Str::singular( Str::ucfirst( $this->argument( 'resource' ) ) );
		$this->call( 'larapi:exception', [ 'resource' => $this->argument( 'resource' ), 'name' => $model . 'NotFound' ] );
	}


	protected function getStub() {
		return;
	}

	protected function getOptions() {
		return [
			[ 'all', 'a', InputOption::VALUE_NONE, 'Command will created whole basic Resource folder structure' ],

			[ 'controller', null, InputOption::VALUE_NONE, 'Create Resource folder with Controller' ],

			[ 'routes', null, InputOption::VALUE_NONE, 'Create Resource folder with Routes' ],

			[ 'model', null, InputOption::VALUE_NONE, 'Create Resource folder with Model' ],

			[ 'repository', null, InputOption::VALUE_NONE, 'Create Resource folder with Repository' ],

			[ 'service', null, InputOption::VALUE_NONE, 'Create Resource folder with Service' ],

			[ 'provider', null, InputOption::VALUE_NONE, 'Create Resource folder with Provider' ],

			[ 'events', null, InputOption::VALUE_NONE, 'Create Resource folder with basic Events' ],

			[ 'request', null, InputOption::VALUE_NONE, 'Create Resource folder with basic Request' ],

			[ 'exception', null, InputOption::VALUE_NONE, 'Create Resource folder with basic Exception' ]
		];
	}
}
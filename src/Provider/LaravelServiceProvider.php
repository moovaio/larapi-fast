<?php

namespace Versoo\LarapiFast\Provider;

use Illuminate\Support\ServiceProvider;
use Versoo\LarapiFast\Command\ControllerMakeCommand;
use Versoo\LarapiFast\Command\EventMakeCommand;
use Versoo\LarapiFast\Command\ExceptionMakeCommand;
use Versoo\LarapiFast\Command\ModelMakeCommand;
use Versoo\LarapiFast\Command\ProviderMakeCommand;
use Versoo\LarapiFast\Command\RepositoryMakeCommand;
use Versoo\LarapiFast\Command\RequestMakeCommand;
use Versoo\LarapiFast\Command\ResourceMakeCommand;
use Versoo\LarapiFast\Command\RoutesMakeCommand;
use Versoo\LarapiFast\Command\ServiceMakeCommand;

class LaravelServiceProvider extends ServiceProvider {


	protected $commands = [
		ModelMakeCommand::class,
		RepositoryMakeCommand::class,
		ServiceMakeCommand::class,
		ControllerMakeCommand::class,
		RoutesMakeCommand::class,
		ProviderMakeCommand::class,
		EventMakeCommand::class,
		RequestMakeCommand::class,
		ExceptionMakeCommand::class,
		ResourceMakeCommand::class
	];

	public function register() {
		$this->mergeConfigFrom(
			__DIR__ . '/../Config/versoo.larapi-fast.php', 'versoo.larapi-fast'
		);

		$this->commands( $this->commands );
	}

	public function boot() {
		$this->createConfig();
	}

	public function createConfig() {
		$this->publishes( [
			__DIR__ . '/../Config/versoo.larapi-fast.php' => config_path( 'versoo.larapi-fast.php' ),
		], 'LarapiFast' );
	}
}
<?php

namespace Versoo\LarapiFast\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use function array_merge;

class RequestMakeCommand extends LarapiFastGeneratorCommand {
	static protected $excludedNames = [ 'Request', 'request' ];
	protected $name = "larapi:request";
	protected $type = "Request";
	protected $suffix = "Request";

	protected $description = "Create a request for API Resource";

	public function handle() {
		if ( parent::handle() === false && ! $this->option( 'force' ) ) {
			return;
		}
	}

	protected function getStub() {
		return $this->resolveStubsPath() . '/request.stub';
	}

	protected function getArguments() {
		$modelArguments = [
			[ 'name', InputArgument::REQUIRED, 'Name of request class for resource' ],
		];

		return array_merge( parent::getArguments(), $modelArguments );
	}

	protected function getOptions() {
		return [
			[ 'force', null, InputOption::VALUE_NONE, 'Force to create service - overwrite if exists' ],
		];
	}
}
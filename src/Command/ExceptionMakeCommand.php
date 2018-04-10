<?php

namespace Versoo\LarapiFast\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use function array_merge;

class ExceptionMakeCommand extends LarapiFastGeneratorCommand {
	static protected $excludedNames = [ 'Exception', 'exception' ];
	protected $name = "larapi:exception";
	protected $type = "Exception";
	protected $suffix = "Exception";

	protected $description = "Create a request for API Resource";

	public function handle() {
		if ( parent::handle() === false && ! $this->option( 'force' ) ) {
			return;
		}
	}

	protected function getStub() {
		return $this->resolveStubsPath() . '/exception.stub';
	}

	protected function getArguments() {
		$modelArguments = [
			[ 'name', InputArgument::REQUIRED, 'Name of exception class for resource' ],
		];

		return array_merge( parent::getArguments(), $modelArguments );
	}

	protected function getOptions() {
		return [
			[ 'force', null, InputOption::VALUE_NONE, 'Force to create exception - overwrite if exists' ],
		];
	}
}
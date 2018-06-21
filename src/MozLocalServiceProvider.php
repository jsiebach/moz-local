<?php
/**
 * Created by PhpStorm.
 * User: lsm
 * Date: 6/20/18
 * Time: 10:24 AM
 */

namespace JSiebach\MozLocal;

use Illuminate\Support\ServiceProvider;

class MozLocalServiceProvider extends ServiceProvider {
	public function boot(  ) {

		$this->app->singleton(MozLocal::class, function () {
			return new MozLocal(config('mozlocal.access_token'));
		});

		$this->app->alias(MozLocal::class, 'moz-local');


		$this->publishes([
			__DIR__.'/mozlocal.php' => config_path('mozlocal.php'),
		]);
	}
}
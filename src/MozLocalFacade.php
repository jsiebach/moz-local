<?php
/**
 * Created by PhpStorm.
 * User: lsm
 * Date: 6/20/18
 * Time: 10:31 AM
 */

namespace JSiebach\MozLocal;

use Illuminate\Support\Facades\Facade;

class MozLocalFacade extends Facade {
	protected static function getFacadeAccessor()
	{
		return 'moz-local';
	}
}
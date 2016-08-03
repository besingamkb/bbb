<?php 

use Illuminate\Support\Collection;


if (! function_exists('dprint')) {
	function dprint($array, $die = false) {

		if ($array instanceof Collection ) {
			$array = $array->toArray();
		}

		echo "<pre>";
		print_r($array);
		echo "</pre>";

		if ($die) {
			die(1);
		}
	}
}

?>
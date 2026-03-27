<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Route;
Use DB;


class CommonHelper {

	const ACTIVE = 'Active';
	const INACTIVE = 'Inactive';

	const AVAILABLE = 'Available';
	const BOOKED = 'Booked';
	const MAINTENANCE = 'Maintenance';

	public static function getLimitOption(){
		return [
			'10' => '10',
			'20' => '20',
			'30' => '30',
			'50' => '50',
			'70' => '70',
			'100' => '100'
		];
	}

	public static function getStatusOption(){
		return [
			self::ACTIVE   => self::ACTIVE,
			self::INACTIVE => self::INACTIVE
		];
	}

	public static function getRoomStatusOption(){
		return [
			self::AVAILABLE   => self::AVAILABLE,
			self::BOOKED      => self::BOOKED,
			self::MAINTENANCE => self::MAINTENANCE
		];
	}
}

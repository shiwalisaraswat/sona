<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Route;
Use DB;


class CommonHelper {

	const ACTIVE = 'Active';
	const INACTIVE = 'Inactive';

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

	public static function getstatusOption(){
		return [
			self::ACTIVE => self::ACTIVE,
			self::INACTIVE => self::INACTIVE
		];
	}

	public static function getStatus($routeName, $status, $id){
		if ($status == self::ACTIVE) {
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE) {
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		}
	}

}

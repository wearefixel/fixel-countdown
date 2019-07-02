<?php

use Carbon\Carbon;

function fxc_get_default_start() {
	return apply_filters('fxc_default_start', 'sunday 9am');
}

function fxc_get_default_end() {
	return apply_filters('fxc_default_end', 'sunday 12:30pm');
}

function fxc_get_now() {
	return $now = Carbon::now(fxc_get_timezone());
}

function fxc_get_timezone() {
	return get_option('timezone_string');
}

function fxc_get_countdown_mode() {
	return get_field('fxc_mode', 'option');
}

function fxc_get_live_start() {
	$datetime = 'custom' == fxc_get_countdown_mode()
		? get_field('fxc_start', 'option')
		: (
			Carbon::parse(fxc_get_default_end(), fxc_get_timezone())->gt(fxc_get_now())
				? 'this ' . fxc_get_default_start()
				: 'next ' . fxc_get_default_start()
		);

	return Carbon::parse($datetime, fxc_get_timezone());
}

function fxc_get_live_end() {
	$datetime = 'custom' == fxc_get_countdown_mode()
		? get_field('fxc_end', 'option')
		: (
			Carbon::parse(fxc_get_default_end(), fxc_get_timezone())->gt(fxc_get_now())
				? 'this ' . fxc_get_default_end()
				: 'next ' . fxc_get_default_end()
		);

	return Carbon::parse($datetime, fxc_get_timezone());
}

function fxc_is_live() {
	$now = fxc_get_now()->format('Y-m-d H:i:s');

	return fxc_get_live_start() < $now && fxc_get_live_end() > $now;
}

function fxc_can_show_countdown() {
	return fxc_get_live_end()->isFuture();
}

function fxc_get_formatted_countdown($d = true, $h = true, $m = true) {
	$now = fxc_get_now();
	$start = fxc_get_live_start();

	$days = $now->diffInDays($start);
	$hours = $now->copy()->addDays($days)->diffInHours($start);
	$minutes = $now->copy()->addDays($days)->addHours($hours)->diffInMinutes($start);

	$format = [];

	if ($days && $d) {
		$format[] = $days;
		$format[] = $days > 1 ? 'days' : 'day';
	}

	if ($hours && $h) {
		$format[] = $hours;
		$format[] = $hours > 1 ? 'hours' : 'hour';
	}

	if ($minutes && $m) {
		$format[] = $minutes;
		$format[] = $minutes > 1 ? 'minutes' : 'minute';
	}

	return join(' ', $format);
}

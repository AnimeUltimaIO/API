<?php
use LaravelBook\Ardent\Ardent;

class Anime extends Ardent {
	
	protected $table = 'anime';


	public function episodes()
	{
		return $this->hasMany('Episode', 'channelid');
	}

}
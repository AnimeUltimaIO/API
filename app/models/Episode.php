<?php
use LaravelBook\Ardent\Ardent;

class Episode extends Ardent {
	
	protected $table = 'episodes';

	public function anime()
	{
		return $this->belongsTo('Anime');
	}


}
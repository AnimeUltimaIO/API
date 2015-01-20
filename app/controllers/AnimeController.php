<?php


class AnimeController extends BaseController {
	


	public function index() {

		$anime = Anime::select(['id','title','description','status','genre','slug','timestamp'])->get();

		return Response::json([
			'count' => '1', 
		]);
	}

	public function listEpisodes($anime_id) {

		$episodes = Episodes::where('anime_id', $anime_id);
	}


}
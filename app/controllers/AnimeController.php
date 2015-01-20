<?php


class AnimeController extends BaseController {
	


	public function index($status = null) {

		if(is_null($status))
		{
			if(Cache::has('animelist_all'))
			{	

				$data = Cache::get('animelist_all');
				return Response::json([
					'count' => $data['count'], 
					'anime'	=> $data['anime']
				]);
			}			
		} else {

			if(Cache::has('animelist_'. $status))
			{
				$data = Cache::get('animelist_'. $status);
				dd('has '. $status);
				return Response::json([
					'count' => $data['count'], 
					'anime'	=> $data['anime']
				]);
			}				
		}

		if(is_null($status))
			$anime = Anime::select(['id','title','description','status','genre','slug','timestamp'])
				->orderBy('title', 'ASC')
				->get();

		else
			$anime = Anime::select(['id','title','description','status','genre','slug','timestamp'])
				->orderBy('title', 'ASC')
				->where('status', $status)
				->get();

		$expires = \Carbon\Carbon::now()->addHours(3);
		$data['count'] = $anime->count();
		$data['anime'] = $anime;

		if(!is_null($status))
			Cache::put('animelist_all', $data, $expires);

		else
			Cache::put('animelist_'. $status, $data, $expires);

		return Response::json([
			'count' => $data['count'], 
			'anime'	=> $data['anime']
		]);
	}

	public function view($anime_id) {

		if(Cache::has('viewanime_'. $anime_id))
		{
			$anime = Cache::get('viewanime_'. $anime_id);
			return Response::json([$anime]);
		}

		$anime = Anime::select(['id','title','description','status','genre','slug','timestamp'])
				->where('id', $anime_id)
				->firstOrFail();

		$expires = \Carbon\Carbon::now()->addDays(1);
		Cache::put('viewanime_'. $anime_id, $anime, $expires);

		return Response::json([$anime]);

	}




}
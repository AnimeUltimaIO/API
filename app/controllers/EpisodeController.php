<?php


class EpisodeController extends BaseController {
	

	public function listEpisode($anime_id) {

		if(Cache::has('listepisode_'. $anime_id))
		{

			$episodes = Cache::get('listepisode_'. $anime_id);
			return Response::json([$episodes]);	

		}

		$anime 		= Anime::findOrFail($anime_id);
		$episodes	= Episode::select(['id','episode_num','status','timestamp','views','airdate'])
						->orderByRaw('CAST(episode_num AS UNSIGNED) ASC')
						->where('channelid', $anime->id)
						->get();

		$expires = \Carbon\Carbon::now()->addMinutes(30);
		Cache::put('listepisode_'. $anime_id, $episodes, $expires);
		return Response::json([$episodes]);		
	}




}
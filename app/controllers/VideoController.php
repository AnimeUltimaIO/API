<?php

class VideoController extends BaseController {
	


	public function view($anime_id, $episode_num) {

		if(Cache::has('video_'. $anime_id .'_'. $episode_num))
		{
			$response = Cache::get('video_'. $anime_id .'_'. $episode_num);
			return Response::json([$response]);
		}


		$video = Video::select(['servicevideoid'])
				->where('channelid', $anime_id)
				->where('episode_num', $episode_num)
				->where('service', 'auengine')
				->where('status', '!=', 'deleted')
				->firstOrFail();
			

		$response = file_get_contents('http://www.auengine.com/api.php?file=' . $video->servicevideoid);

		if(!empty($response) AND !is_null($response))
		{
			
			$expires = \Carbon\Carbon::now()->addHours(3);
			Cache::put('video_'. $anime_id .'_'. $episode_num, $response, $expires);

			return Response::json([$response]);
		}
		else
			return Response::json(['status' => 'Could not communicate with AUEngine']);
	}


}
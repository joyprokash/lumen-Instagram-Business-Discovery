<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class InstagramController extends Controller
{
    
    public function __construct()
    {
        //
    }
	
	public function get_instagram_media_of_user(Request $request)
	{
		$endpointFormat = config('service.facebook.ENDPOINT_BASE') . '{ig-user-id}?fields=business_discovery.username({ig-username}){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}&access_token={access-token}';
		$endpoint = config('service.facebook.ENDPOINT_BASE') . config('service.facebook.INSTA_ACCOUNT_ID');
		$username = $request->username;
		$fields   = 'business_discovery.username(' . $username . '){media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}';
		if ($request->has('cursor_type') && $request->has('cursor')) { // if cursor and cursor type exists the add them onto the params
			$fields   = 'business_discovery.username(' . $username . '){media_count,media.'.$request->cursor_type.'('.$request->cursor.'){caption,like_count,comments_count,media_url,permalink,media_type}}';
		}
		
		$igParams =['fields' => $fields,'access_token' => config('service.facebook.ACCESS_TOKEN')];
		$endpoint .= '?' . http_build_query( $igParams );
		$client = new Client();
		$res = $client->request('GET', $endpoint);
		$decodedResponse = json_decode($res->getBody() , true);
		
		return response()->json(['status' => 'success', 'data' => $decodedResponse['business_discovery']['media']]);
	}
	
	public function get_instagram_follower(Request $request)
	{
		$endpointFormat = config('service.facebook.ENDPOINT_BASE') . '{ig-user-id}?fields=business_discovery.username({ig-username}){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}&access_token={access-token}';
		$endpoint = config('service.facebook.ENDPOINT_BASE') . config('service.facebook.INSTA_ACCOUNT_ID');
		$username = $request->username;
		$fields   = 'business_discovery.username(' . $username . '){username,name,profile_picture_url,follows_count,followers_count}';
		$igParams =['fields' => $fields,'access_token' => config('service.facebook.ACCESS_TOKEN')];
		$endpoint .= '?' . http_build_query( $igParams );
		$client = new Client();
		$res = $client->request('GET', $endpoint);
		$decodedResponse = json_decode($res->getBody() , true);
		return response()->json(['status' => 'success', 'data' => $decodedResponse['business_discovery']]);
	}
}

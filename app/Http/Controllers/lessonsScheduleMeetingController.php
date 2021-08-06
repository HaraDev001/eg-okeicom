w<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Builder;
use App\Schedule;

const BASE_URI = 'https://api.zoom.us/v2/';
const API_KEY = ''; // TODO: APIキーを設定
const API_SECRET = '';  // TODO: APIシークレットキーを設定


class ScheduleMeetingController extends Controller
{
    public function index()
    {
//        $schedules = Schedule::all();

        return view('schedule_meeting',
        [
            'schedules' => $schedules
        ]);
    }

    public function store(Request $request)
    {
        // zoomでミーティングのスケジュールを作成する。
        $meetingInfo = createMeeting($request);
/*        Schedule::insert([
            'topic' => $meetingInfo->$topic,
            'agenda' => $meetingInfo->$agenda,
            'start_time' => $meetingInfo->$start_time,
            'duration' => $meetingInfo->$duration,
            'schedule_for' => $meetingInfo->schedule_for,
            'start_url' => $meetingInfo->start_url,
            'join_url' => $meetingInfo->join_url,
            'password' => $meetingInfo->password,
        ]);

        $schedules = Schedule::all();
*/
    var_dump($meetingInfo);

        return view('schedule_meeting',
                [
                    'schedules' => $schedules
                ]);
    }

    private function createJwtToken()
    {
        $signer = new Sha256;
        $key = new Key(API_SECRET);
        $time = time();
        $jwt_token = (new Builder())->setIssuer(API_KEY)
                                ->expiresAt($time + 3600)
                                ->sign($signer, $key)
                                ->getToken();
        return $jwt_token;
    }

    private function getUserId()
    {
        $method = 'GET';
        $path = 'users';
        $client_params = [
          'base_uri' => BASE_URI,
        ];
        $result = sendRequest($method, $path, $client_params);
        $user_id = $result['users'][0]['id'];
        return $user_id;
    }

    private function createMeeting(Request $request)
    {
        $user_id = getUserId();
        $params = [
          'topic' => $request->topic,
          'type' => 2,
          'start_time' => $request->startTime,
          'duration' => $request->duration,
          'time_zone' => 'Asia/Tokyo',
          'agenda' => $request->agenda,
          'schedule_for' => $request->schedulFor,
          'settings' => [
            'host_video' => true,
            'participant_video' => true,
            'approval_type' => 0,
            'audio' => 'both',
            'enforce_login' => false,
            'waiting_room' => false,
            'registrants_email_notification' => false
          ]
        ];
        $method = 'POST';
        $path = 'users/'. $user_id .'/meetings';
        $client_params = [
          'base_uri' => BASE_URI,
          'json' => $params
        ];
        $result = sendRequest($method, $path, $client_params);
        return $result;
    }

    private function sendRequest($method, $path, $client_params)
    {
        $client = new Client($client_params);
        $jwt_token = createJwtToken();
        $response = $client->request($method,
                        $path,
                        [
                          'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer ' . $jwt_token,
                          ]
                        ]);
        $result_json = $response->getBody()->getContents();
        $result = json_decode($result_json, true);
        return $result;
    }

}

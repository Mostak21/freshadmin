<?php


namespace App\Http\Controllers;

use Aws\PersonalizeRuntime\PersonalizeRuntimeClient;
use Aws\PersonalizeEvents\PersonalizeEventsClient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use Cookie;
use Jenssegers\Agent\Agent;
use Adrianorosa\GeoLocation\GeoLocation;

class AWSPersonalizeController
{
    public function location(){
        $geoLocation = GeoLocation::lookup($_SERVER['REMOTE_ADDR'])->getCity();
        Session::put('location', $geoLocation);
        Session::save();

        return $geoLocation;
    }

    public function device(){
        $agent = new Agent;
        $deviceType=$agent->deviceType();
        Session::put('device', $deviceType);

        Session::save();

        return $deviceType;
    }

    public function config(){
        $config= [
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' =>  [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
        ];
        return $config;
    }

    public function getRecommendations(Request $request){
        $config = $this->config();
        $client = new PersonalizeRuntimeClient($config);

        $result = $client->getRecommendations([
            'numResults' => 10,
            'recommenderArn' => 'arn:aws:personalize:ap-south-1:091253265099:recommender/bh-recommended-for-you',
            'userId' => $request->AWSuser
        ]);
        return $result;
    }

    public function putUsers(){
        $eventClient = new PersonalizeEventsClient($this->config());



        $result = $eventClient->putUsers([
            'datasetArn' => 'arn:aws:personalize:ap-south-1:091253265099:dataset/brandhook-dataset-group/USERS', // REQUIRED
            'users' => [ // REQUIRED
                [
                    'userId' => 'fghjksadjvas121hbxcd757', // REQUIRED
                    'properties' => "{
                    \"gender\": \"Female\",
                    \"ageGroup\": \"Adult\"
                    }"
                ],

            ],
        ]);
        dd($result);



        return 0;
    }

    public function putItems($itemdata){
        $eventClient = new PersonalizeEventsClient($this->config());

        $itemId="";
        $price="";
        $categoryL1="";
        $categoryL2="";
        $categoryL3="";
        $itemeName="";
        $gender=""??"Unisex";
        $productDescription=""??"";



        $result = $eventClient->putItems([
            'datasetArn' => 'arn:aws:personalize:ap-south-1:091253265099:dataset/brandhook-dataset-group/ITEMS', // REQUIRED
            'items' => [ // REQUIRED
                [
                    'itemId' => '<string>', // REQUIRED, // REQUIRED
                    'properties' => "{
                    \"price\": \"Female\",
                    \"categoryL1\": \"Adult\",
                    \"categoryL2\": \"Adult\",
                    \"categoryL3\": \"Adult\",
                    \"gender\": \"Adult\",
                    \"itemeName\": \"Adult\",
                    \"productDescription\": \"Adult\",
                    }"
                ],

            ],
        ]);


        dd($result);
        return 0;
    }

    public function putEvents(Request $request, $eventdata){
        $geoLocation = GeoLocation::lookup($_SERVER['REMOTE_ADDR'])->getCity();

        $eventClient = new PersonalizeEventsClient($this->config());
        $result = $eventClient->putEvents([
            'eventList' => [ // REQUIRED
                    [
//                        'eventId' => '<string>',
                        'eventType' => 'View', // REQUIRED
//                        'eventValue' => 0,
                        'impression' => ['1117','1090','1092','1116','1094','1095','5411','1858','161','5335'],
                        'itemId' => '1185',
                        'recommendationId' => 'RID-1c3a2179-85a4-4147-9b44-db27cf422db7',
                        'sentAt' => Carbon::now()->timestamp, // REQUIRED
                    ],
                    // ...
                ],
                'location'=>Session::get('location')??$this->device()??'',
                'device'=>Session::get('device')??$this->device()??'',
                'channel'=>'server',
                'sessionId' => $request->session()->getId(), // REQUIRED
                'trackingId' => '912716e2-3028-4738-a0a3-a7fa302d6ff9', // REQUIRED
                'userId' => Auth::user()->id??"",

            ]);
    }

    public function index(Request $request){
//        $result =  $this->getRecommendations();
//        $result =  $this->putUsers($userdata);
//        $result =  $this->putItems($itemdata);
//        $result =  $this->putEvents($request, $eventdata);

        $service = false;
        if ($service){
            if ($request->AWSdataset=="user-dataset"){
                dd($request->AWSdata,$request->session()->getId());
            }
            elseif($request->AWSdataset=="item-dataset-v2"){
                dd($request->AWSdata,$request->session()->getId());
            }
            elseif($request->AWSdataset=="interactions-dataset"){
                dd($request->AWSdata,$request->session()->getId());
            }
            elseif($request->AWSdataset=="getRecommandation"){
                $result = $this->getRecommendations($request);
                $result->toArray();
//                dd($result);
            }

            return dd($request);
        }
        else{
            return 0 ;
        }

    }
}

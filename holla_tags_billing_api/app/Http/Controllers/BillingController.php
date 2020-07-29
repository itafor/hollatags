<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billUsers(Request $request){

    	     $client = new Client();

                $res = $client->request('POST', 'https://dummy.xyz/MAS/billingapi/auth/login', [
                    'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'userName' => 'hollatags1',
                'password' => '$6HerHg+s189e'
            ]
        ]);
                
                $res = json_decode($res->getBody()->getContents(), true);

	           $users = User::all()->take(10000)->get();

    	if (count($users) >=1) {

    		foreach ($users as $key => $user) {

    		$bill_user = $client->post('https://dummy.xyz/MAS/billingapi/billuser/consume', [
                    'headers' => [
                        'Authorization' => 'Bearer '.$res['token'],
                    ],
                    'form_params' => [
                        'username' => $user->username,
                        'mobile_number' => $user->mobile_number,
                        'amount_to_bill' => '1500']
                    ]);

        	if($bill_user){
    			User::updateUserDetailAfterBill($bill_user);
        	}

    		}

    		return 'Done';
    	}

       }          
}

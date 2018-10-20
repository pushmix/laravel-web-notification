<?php

namespace Pushmix\WebNotification;



class Message{



	/**
	 * Retreive Topics id and mames
	 *
	 * @return     array  The topics.
	 */
	public function getTopics(){

		$url = config('pushmix.topics_url');

		if( empty($url) ){
			abort(503, 'Pushmix API Endpoint not defined. Try php artisan vendor:publish  ');
		}

		$msg_data = [
			'subscription_id' => config('pushmix.subscription_id')
		];

		return $this->call($url, $msg_data);
	}
	/***/



	public function push($msg_data){

		$url = config('pushmix.push_url', null);

		if( empty($url) ){
			abort(503, 'Pushmix API Endpoint not defined. Try php artisan vendor:publish  ');
		}		
		

		$subscription_id = config('pushmix.subscription_id', null);

		if( empty($subscription_id) ){
			abort(503, 'Pushmix subscription_id is not defined. Try php artisan vendor:publish  ');
		}		
		
		$msg_data['key_id'] = $subscription_id;

		return $this->call( $url, $msg_data);
	}
	/***/


	/**
	 * Making API Call
	 *
	 * @param      string  $url       The API endpoint url
	 * @param      array   $msg_data  The message data
	 *
	 * @return     string  JSON encoded
	 */
	protected function call( $url, $msg_data ){
		#dd($url);

		$ch = curl_init( $url );
		# Setup request to send json via POST.
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $msg_data ) );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);

		
		return json_decode($result);

	}

}

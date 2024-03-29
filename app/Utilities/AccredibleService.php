<?php

namespace App\Utilities;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AccredibleService {

	private $api_key = "e3e51444a4e2d2f0ae988942af129052";

	private $api_endpoint = "https://api.accredible.com/v1/";


    public function getAPIKey() {
        return $this->api_key;
    }

    public function __construct($test = null){
        if (null !== $test) {
    	    $this->api_endpoint = "https://staging.accredible.com/v1/";
    	}
    }

    public function strip_empty_keys($object){

		$json = json_encode($object);
		$json = preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', $json);
		$object = json_decode($json);

		return $object;
    }

	public function get_credential($id){
		$client = new \GuzzleHttp\Client();

		$params = array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'));

		$response = $client->get($this->api_endpoint . 'credentials/' . $id, $params);

		$result = json_decode($response->getBody(), true);
		return $result;
	}

	public function get_credentials($group_id = null, $email = null, $page_size = null, $page = 1){
		$client = new \GuzzleHttp\Client();

		$params = array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'));

		$response = $client->get($this->api_endpoint. 'all_credentials?group_id=' . $group_id . '&email=' . rawurlencode($email) . '&page_size=' . $page_size . '&page=' . $page, $params);

		$result = json_decode($response->getBody(), true);
		return $result;
	}

	public function create_credential($recipient_name, $recipient_email, $course_id, $issued_on = null, $expired_on = null, $custom_attributes = null){

		$data = array(
		    "credential" => array(
		    	"group_id" => $course_id,
		        "recipient" => array(
		            "name" => $recipient_name,
		            "email" => $recipient_email
		        ),
		        "issued_on" => $issued_on,
		        "expired_on" => $expired_on,
		        "custom_attributes" => $custom_attributes
		    )
		);

		$client = new \GuzzleHttp\Client();

		$params = array('Authorization' => 'Token token="'.$this->getAPIKey().'"');

		$response = $client->post($this->api_endpoint.'credentials', array(
		    'headers' => $params,
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

    public function create_credential_legacy($recipient_name, $recipient_email, $achievement_name, $issued_on = null, $expired_on = null, $course_name = null, $course_description = null, $course_link = null, $custom_attributes = null){

        $data = array(
            "credential" => array(
                "group_name" => $achievement_name,
                "recipient" => array(
                    "name" => $recipient_name,
                    "email" => $recipient_email
                ),
                "issued_on" => $issued_on,
                "expired_on" => $expired_on,
                "custom_attributes" => $custom_attributes,
                "name" => $course_name,
                "description" => $course_description,
                "course_link" => $course_link
            )
        );

        $client = new \GuzzleHttp\Client();

        $params = array('Authorization' => 'Token token="'.$this->getAPIKey().'"');

        $response = $client->post($this->api_endpoint.'credentials', array(
            'headers' => $params,
            'json' => $data
        ));

        $result = json_decode($response->getBody(), true);

        return $result;
    }

	public function update_credential($id, $recipient_name = null, $recipient_email = null, $course_id = null, $issued_on = null, $expired_on = null, $custom_attributes = null){

		$data = array(
		    "credential" => array(
		    	"group_id" => $course_id,
		        "recipient" => array(
		            "name" => $recipient_name,
		            "email" => $recipient_email
		        ),
		        "issued_on" => $issued_on,
		        "expired_on" => $expired_on,
		        "custom_attributes" => $custom_attributes
		    )
		);
		$data = $this->strip_empty_keys($data);

		$client = new \GuzzleHttp\Client();

        $params = array('Authorization' => 'Token token="'.$this->getAPIKey().'"');

		$response = $client->put($this->api_endpoint.'credentials/'.$id, array(
		    'headers' =>  $params,
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function expire_credential($id, $recipient_name, $recipient_email, $course_id, $expired_on){
		$data = array(
		    "credential" => array(
		    	"group_id" => $course_id,
		        "recipient" => array(
		            "name" => $recipient_name,
		            "email" => $recipient_email
		        ),
		        "expired_on" => $expired_on,
		    )
		);

		$client = new \GuzzleHttp\Client();

		$params = array('Authorization' => 'Token token="'.$this->getAPIKey().'"');

		$response = $client->post($this->api_endpoint.'credentials/' . $id, array(
		    'headers' => $params,
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function delete_credential($id){
		$client = new \GuzzleHttp\Client();

		$response = $client->delete($this->api_endpoint.'credentials/' . $id, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function create_group($name, $course_name, $course_description, $course_link = null){
		$data = array(
		    "group" => array(
		    	"name" => $name,
		    	"course_name" => $course_name,
				"course_description" => $course_description,
    			"course_link" => $course_link,
                'certificate_design_id' => 248128
		    )
		);

		$client = new \GuzzleHttp\Client();

		$response = $client->post($this->api_endpoint.'issuer/groups', array(
		    'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function get_group($id){
		$client = new \GuzzleHttp\Client();

		$response = $client->get($this->api_endpoint.'issuer/groups/' . $id, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

		$result = json_decode($response->getBody(), true);
		return $result;
	}

	public function get_groups($page_size = nil, $page = 1){
		$client = new \GuzzleHttp\Client();

		$response = $client->get($this->api_endpoint.'issuer/all_groups?page_size=' . $page_size . '&page=' . $page, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

		$result = json_decode($response->getBody(), true);
		return $result;
	}

	public function update_group($id, $name = null, $course_name = null, $course_description = null, $course_link = null, $design_id = null){

		$data = array(
		    "group" => array(
		    	"name" => $name,
		    	"course_name" => $course_name,
				"course_description" => $course_description,
    			"course_link" => $course_link,
                "design_id" => $design_id
		    )
		);
		$data = $this->strip_empty_keys($data);

		$client = new \GuzzleHttp\Client();

		$response = $client->put($this->api_endpoint.'issuer/groups/'.$id, array(
		    'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function delete_group($id){
		$client = new \GuzzleHttp\Client();

		$response = $client->delete($this->api_endpoint.'issuer/groups/' . $id, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

	public function get_design($id){
        $client = new \GuzzleHttp\Client();

        $response = $client->get($this->api_endpoint.'designs/'. $id, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

        $result = json_decode($response->getBody(), true);
        return $result;
    }

    public function get_designs($page_size = nil, $page = 1){
        $client = new \GuzzleHttp\Client();

        $response = $client->get($this->api_endpoint.'issuer/all_designs?page_size=' . $page_size . '&page=' . $page, array('headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"')));

        $result = json_decode($response->getBody(), true);
        return $result;
    }

    public function create_evidence_item($evidence_item, $credential_id){

        $client = new \GuzzleHttp\Client();

        $response = $client->post($this->api_endpoint.'credentials/'.$credential_id.'/evidence_items', array(
            'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
            'json' => $evidence_item
        ));

        $result = json_decode($response->getBody(), true);

        return $result;
    }


    public function create_evidence_item_grade($grade, $description, $credential_id, $hidden = false){

        if(is_numeric($grade) && intval($grade) >= 0 && intval($grade) <= 100){

            $evidence_item = array(
                "evidence_item" => array(
                    "description" => $description,
                    "category" => "grade",
                    "string_object" => (string) $grade,
                    "hidden" => $hidden
                )
            );

            $result = $this->create_evidence_item($evidence_item, $credential_id);

            return $result;

        } else {
            throw new \InvalidArgumentException("$grade must be a numeric value between 0 and 100.");
        }
    }

    public function create_evidence_item_duration($start_date, $end_date, $credential_id, $hidden = false){

        $duration_info = array(
            'start_date' =>  date("Y-m-d", strtotime($start_date)),
            'end_date' => date("Y-m-d", strtotime($end_date)),
            'duration_in_days' => floor( (strtotime($end_date) - strtotime($start_date)) / 86400)
        );

        // multi day duration
        if($duration_info['duration_in_days'] && $duration_info['duration_in_days'] != 0){

            $evidence_item = array(
                "evidence_item" => array(
                    "description" => 'Completed in ' . $duration_info['duration_in_days'] . ' days',
                    "category" => "course_duration",
                    "string_object" => json_encode($duration_info),
                    "hidden" => $hidden
                )
            );

            $result = $this->create_evidence_item($evidence_item, $credential_id);

            return $result;
        // it may be completed in one day
        } else if($duration_info['start_date'] != $duration_info['end_date']){
            $duration_info['duration_in_days'] = 1;

            $evidence_item = array(
                "evidence_item" => array(
                    "description" => 'Completed in 1 day',
                    "category" => "course_duration",
                    "string_object" => json_encode($duration_info),
                    "hidden" => $hidden
                )
            );

            $result = $this->create_evidence_item($evidence_item, $credential_id);

            return $result;

        } else {
            throw new \InvalidArgumentException("Enrollment duration must be greater than 0.");
        }
    }

    public function create_evidence_item_transcript($transcript, $credential_id, $hidden = false){

        $transcript_items = array();

        foreach ($transcript as $key => $value) {
            array_push($transcript_items, array(
                'category' => $key,
                'percent' => $value
                )
            );
        }

        $evidence_item = array(
            "evidence_item" => array(
                "description" => 'Course Transcript',
                "category" => "transcript",
                "string_object" => json_encode($transcript_items),
                "hidden" => $hidden
            )
        );

        $result = $this->create_evidence_item($evidence_item, $credential_id);

        return $result;
    }

    public function recipient_sso_link($credential_id = null, $recipient_id = null, $recipient_email = null, $wallet_view = null, $group_id = null, $redirect_to = null){

        $data = array(
            "credential_id" => $credential_id,
            "recipient_id" => $recipient_id,
            "recipient_email" => $recipient_email,
            "wallet_view" => $wallet_view,
            "group_id" => $group_id,
            "redirect_to" => $redirect_to,
        );

        $data = $this->strip_empty_keys($data);

        $client = new \GuzzleHttp\Client();

        $response = $client->post($this->api_endpoint.'sso/generate_link', array(
            'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
            'json' => $data
        ));

        $result = json_decode($response->getBody(), true);

        return $result;
    }

	public function send_batch_requests($requests){
		$client = new \GuzzleHttp\Client();

		$response = $client->post($this->api_endpoint.'batch', array(
		    'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
		    'json' => array( "ops" => $requests, "sequential" => true )
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

    public function create_department($name, $url, $logo, $description = null){
		$data = array(
		    "department" => array(
		    	"name" => $name,
		    	"url" => $url,
				"logo" => $logo,
    			"description" => $description
		    )
		);

		$client = new \GuzzleHttp\Client();

		$response = $client->post($this->api_endpoint.'departments', array(
		    'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

    public function initialize_certificate($design_id, $department_id){
		$data = array(
            "name" => $name,
            "course_name" => $course_name,
            "course_description" => $course_description,
            "course_link" => $course_link
		);

		$client = new \GuzzleHttp\Client();

		$response = $client->post($this->api_endpoint.'issuer/groups', array(
		    'headers' =>  array('Authorization' => 'Token token="'.$this->getAPIKey().'"'),
		    'json' => $data
		));

		$result = json_decode($response->getBody(), true);

		return $result;
	}

}
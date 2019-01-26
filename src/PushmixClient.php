<?php

namespace Pushmix\WebNotification;

use GuzzleHttp\Client;
use Pushmix\WebNotification\Exceptions\InvalidConfiguration;

class PushmixClient
{
    protected $api_url;
    protected $client;
    protected $headers;
    protected $additionalParams;

    /**
     * @var bool
     */
    public $requestAsync = false;

    /**
     * Class Constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->headers = ['headers' => []];
        $this->headers['headers']['Content-Type'] = 'application/json';
    }

    /***/

    /**
     * Turn on, turn off async requests.
     *
     * @param bool $on
     * @return $this
     */
    public function async($on = true)
    {
        $this->requestAsync = $on;

        return $this;
    }

    /**
     * Get requestAsync.
     * @return bool
     */
    public function getRequestAsync()
    {
        return $this->requestAsync;
    }

    /***/

    /**
     * Initialize API URL Parameter.
     * @return string [description]
     */
    public function initApiUrl()
    {
        if (is_null(config('pushmix.api_url', null))) {
            throw InvalidConfiguration::configurationNotSet();
        }

        $this->api_url = config('pushmix.api_url');

        return $this;
    }

    /***/

    /**
     * Set APi URL Parameter.
     * @param string $api_url [description]
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;

        return $this;
    }

    /***/

    /**
     * Get API URL Parameter.
     * @return string [description]
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /***/

    /**
     * Initialize additional parameters.
     */
    public function initKey()
    {
        if (is_null(config('pushmix.subscription_id', null))) {
            throw InvalidConfiguration::configurationNotSet();
        }

        $this->additionalParams = [

        'key_id'    => config('pushmix.subscription_id'),
      ];

        return $this;
    }

    /***/

    /**
     * Set SUbscription ID.
     * @param string $key_id [description]
     */
    public function setKey($key_id)
    {
        $this->additionalParams = [

        'key_id'    => $key_id,
      ];

        return $this;
    }

    /***/

    /**
     * Get Subscription ID from config file.
     *
     * @throw  InvalidConfiguration exception
     * @return string subscription id
     */
    public function getKey()
    {
        if (is_null(config('pushmix.subscription_id', null))) {
            throw InvalidConfiguration::configurationNotSet();
        }

        return $this->additionalParams['key_id'];
    }

    /***/

    /**
     * Get an array of additional parameters.
     * @return array
     */
    public function getAdditionalParams()
    {
        return $this->additionalParams;
    }

    /***/

    /**
     * Merge Notification Parameters and Send Notification to Pushmix API.
     *
     * @param array $parameters notification parameters
     * @return mixed
     */
    public function sendNotification($parameters)
    {
        $parameters = array_merge($parameters, $this->additionalParams);
        $this->headers['body'] = json_encode($parameters);
        $this->headers['verify'] = false;

        return $this->post();
    }

    /**
     * POST Call to Pushmix API.
     * @param  string $endPoint API endpoint
     * @return mixed
     */
    public function post()
    {
        if ($this->requestAsync === true) {
            return $this->client->postAsync($this->api_url, $this->headers);
        }

        return $this->client->post($this->api_url, $this->headers);
    }

    /***/
}

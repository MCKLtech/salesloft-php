<?php

namespace SalesLoft;

use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\UriFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use stdClass;

class SalesLoftClient
{
    /**
     * @var HttpClient $httpClient
     */
    public $httpClient;

    /**
     * @var RequestFactory $requestFactory
     */
    public $requestFactory;

    /**
     * @var UriFactory $uriFactory
     */
    public $uriFactory;

    /**
     * @var string Access Token
     */
    public $accessToken;

    /**
     * @var array $extraRequestHeaders
     */
    private $extraRequestHeaders;

    /**
     * @var array $rateLimitDetails
     */
    protected $rateLimitDetails = [];

    /**
     * @var SalesLoftUsers $users
     */
    public $users;

    /**
     * @var SalesLoftPeoples $people
     */
    public $people;

    /**
     * @var SalesLoftPersonStages $personStages
     */
    public $personStages;

    /**
     * @var SalesLoftCadences $cadences
     */
    public $cadences;

    /**
     * @var SalesLoftCadenceMemberships $cadenceMemberships
     */
    public $cadenceMemberships;

    /**
     * @var SalesLoftNotes $notes;
     */
    public $notes;

    const SALESLOFT_API_URL = 'https://api.salesloft.com/v2';

    /**
     * DriftClient constructor.
     *
     * @param string $accessToken Access Token
     * @param array $extraRequestHeaders Extra request headers to be sent in every api request
     */
    public function __construct(string $accessToken, array $extraRequestHeaders = [])
    {
        $this->users = new SalesLoftUsers($this);
        $this->people = new SalesLoftPeoples($this);
        $this->personStages = new SalesLoftPersonStages($this);
        $this->cadences = new SalesLoftCadences($this);
        $this->cadenceMemberships = new SalesLoftCadenceMemberships($this);
        $this->notes = new SalesLoftNotes($this);

        $this->accessToken = $accessToken;

        $this->extraRequestHeaders = $extraRequestHeaders;

        $this->httpClient = $this->getDefaultHttpClient();

        $this->requestFactory = MessageFactoryDiscovery::find();
        $this->uriFactory = UriFactoryDiscovery::find();

    }

    /**
     * Sets the HTTP client.
     *
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Sets the request factory.
     *
     * @param RequestFactory $requestFactory
     */
    public function setRequestFactory(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * Sets the URI factory.
     *
     * @param UriFactory $uriFactory
     */
    public function setUriFactory(UriFactory $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    /**
     * Determines if a response has more pages
     *
     * @param stdClass $response
     * @return bool
     */
    public function hasMore(stdClass $response)
    {
        return isset($response->pagination->more) ? $response->pagination->more : false;
    }

    /**
     * Returns the next page number of a response
     *
     * @param string $path
     * @param stdClass $response
     * @return int
     * @throws ClientExceptionInterface
     */
    public function nextPage(stdClass $response)
    {
        return isset($response->pagination->next) ? $response->pagination->next : 1;
    }

    /**
     * Sends POST request to Drift API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function post($endpoint, $json)
    {
        $response = $this->sendRequest('POST', self::SALESLOFT_API_URL . "/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Drift API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function put($endpoint, $json)
    {
        $response = $this->sendRequest('PUT', self::SALESLOFT_API_URL . "/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends PATCH request to Drift API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function patch($endpoint, $json)
    {
        $response = $this->sendRequest('PATCH', self::SALESLOFT_API_URL . "/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Drift API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function delete($endpoint, $json = [])
    {
        $response = $this->sendRequest('DELETE', self::SALESLOFT_API_URL . "/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends GET request to Drift API.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return stdClass
     */
    public function get($endpoint, $queryParams = [])
    {

        $uri = $this->uriFactory->createUri(self::SALESLOFT_API_URL . "/$endpoint");

        if (!empty($queryParams)) {
            $uri = $uri->withQuery(http_build_query($queryParams));
        }

        $response = $this->sendRequest('GET', $uri);

        return $this->handleResponse($response);
    }

    /**
     * Gets the rate limit details.
     *
     * @return array
     */
    public function getRateLimitDetails()
    {
        return $this->rateLimitDetails;
    }

    /**
     * @return HttpClient
     */
    private function getDefaultHttpClient()
    {
        return new PluginClient(
            HttpClientDiscovery::find(),
            [new ErrorPlugin()]
        );
    }

    /**
     * @return array
     */
    private function getRequestHeaders()
    {
        return array_merge(
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            $this->extraRequestHeaders
        );
    }

    /**
     * @return array
     */
    private function getRequestAuthHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken
        ];

    }

    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array|string|null $body
     *
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    private function sendRequest($method, $uri, $body = null)
    {
        $headers = $this->getRequestHeaders();

        $authHeaders = $this->getRequestAuthHeaders();

        $headers = array_merge($headers, $authHeaders);

        $body = is_array($body) ? json_encode($body) : $body;

        $request = $this->requestFactory->createRequest($method, $uri, $headers, $body);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return stdClass
     */
    public function handleResponse(ResponseInterface $response)
    {
        $this->setRateLimitDetails($response);

        $stream = $response->getBody()->getContents();

        return json_decode($stream);
    }

    /**
     * @param ResponseInterface $response
     */
    private function setRateLimitDetails(ResponseInterface $response)
    {
        $this->rateLimitDetails = [
            'reset_at' => $response->hasHeader('RateLimit-Reset')
                ? (int)$response->getHeader('RateLimit-Reset')
                : null,
        ];
    }


}

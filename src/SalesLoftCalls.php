<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftCalls extends SalesLoftResource
{

    /**
     * Lists Calls
     *
     * @see    https://developers.salesloft.com/api.html#!/Calls/get_v2_activities_calls_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('activities/calls.json', $options);
    }

    /**
     * Gets a single Call based on the SalesLoft ID.
     *
     * @see    https://developers.salesloft.com/api.html#!/Calls/get_v2_activities_calls_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("activities/calls/$id.json");
    }

    /**
     * Create a Call in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Calls/post_v2_activities_calls_json
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("activities/calls.json", $options);
    }


}

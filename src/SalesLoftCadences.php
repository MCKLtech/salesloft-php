<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftCadences extends SalesLoftResource
{

    /**
     * Lists Cadences
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadences/get_v2_cadences_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('cadences.json', $options);
    }

    /**
     * Gets a single Cadence by ID
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadences/get_v2_cadences_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("cadences/$id.json");
    }



}

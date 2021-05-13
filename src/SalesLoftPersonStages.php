<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftPersonStages extends SalesLoftResource
{

    /**
     * Lists Person Stages
     *
     * @see    https://developers.salesloft.com/api.html#!/Person_Stages/get_v2_person_stages_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('person_stages.json', $options);
    }

    /**
     * Create a Person Stage
     *
     * @see    https://developers.salesloft.com/api.html#!/Person_Stages/get_v2_person_stages_json
     * @param $name
     * @return stdClass
     */
    public function create(string $name)
    {
        return $this->client->post('person_stages.json', ['name' => $name]);
    }

    /**
     * Delete a Person Stage
     *
     * @see    https://developers.salesloft.com/api.html#!/Person_Stages/delete_v2_person_stages_id_json
     * @param $name
     * @return stdClass
     */
    public function delete($id)
    {
        return $this->client->delete("person_stages/$id.json");
    }

    /**
     * Get a Person Stage
     *
     * @see    https://developers.salesloft.com/api.html#!/Person_Stages/get_v2_person_stages_id_json
     * @param $name
     * @return stdClass
     */
    public function get($id)
    {
        return $this->client->get("person_stages/$id.json");
    }

    /**
     * Create a Person Stage
     *
     * @see    https://developers.salesloft.com/api.html#!/Person_Stages/get_v2_person_stages_json
     * @param $name
     * @return stdClass
     */
    public function update($id, string $name)
    {
        return $this->client->post("person_stages/$id.json", ['name' => $name, 'id' => $id]);
    }



}

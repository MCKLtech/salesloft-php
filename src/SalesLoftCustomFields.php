<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftCustomFields extends SalesLoftResource
{
    /**
     * Lists Custom Fields
     *
     * @see    https://developers.salesloft.com/api.html#!/Custom_Fields/get_v2_custom_fields_json
     * @param array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('custom_fields.json', $options);
    }

    /**
     * Gets a single Custom Field based on the SalesLoft ID.
     *
     * @see    https://developers.salesloft.com/api.html#!/Custom_Fields/get_v2_custom_fields_id_json
     * @param string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("custom_fields/$id.json");
    }

    /**
     * Create a Custom Field in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Custom_Fields/post_v2_custom_fields_json
     * @param string $name
     * @param string $type e.g. person, company or opportunity
     * @return stdClass
     */
    public function create(string $name, string $type)
    {
        return $this->client->post("custom_fields.json", ['name' => $name, 'field_type' => $type]);
    }

    /**
     * Delete a Custom Field in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Custom_Fields/delete_v2_custom_fields_id_json
     * @param string $id
     * @return stdClass
     */
    public function delete($id)
    {
        return $this->client->delete("custom_fields/$id.json");
    }

    /**
     * Update a Custom Field in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Custom_Fields/post_v2_custom_fields_json
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update($id, array $options)
    {
        return $this->client->put("custom_fields/$id.json", $options);
    }

}

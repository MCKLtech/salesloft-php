<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftNotes extends SalesLoftResource
{

    /**
     * Lists Notes
     *
     * @see    https://developers.salesloft.com/api.html#!/Notes/get_v2_notes_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('notes.json', $options);
    }

    /**
     * Gets a single Note by ID
     *
     * @see    https://developers.salesloft.com/api.html#!/Notes/get_v2_notes_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("notes/$id.json");
    }

    /**
     * Create a Note in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Notes/post_v2_notes_json
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("notes.json", $options);
    }

    /**
     * Delete a Note in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Notes/delete_v2_notes_id_json
     * @param string $id
     * @return stdClass
     */
    public function delete($id) {

        return $this->client->delete("notes/$id.json");
    }

    /**
     * Update a Note in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Notes/put_v2_notes_id_json
     * @param string $id
     * @param $options
     * @return stdClass
     */
    public function update($id, $options) {

        return $this->client->put("people/$id.json", $options);
    }

}

<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftPeoples extends SalesLoftResource
{

    /**
     * Lists People
     *
     * @see    https://developers.salesloft.com/api.html#!/People/get_v2_people_json
     * @param array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('people.json', $options);
    }

    /**
     * Gets a single Person based on the SalesLoft ID.
     *
     * @see    https://developers.salesloft.com/api.html#!/People/get_v2_people_id_json
     * @param string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("people/$id.json");
    }

    /**
     * Create a Person in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/People/post_v2_people_json
     * @param array $options
     * @return stdClass
     */
    public function create(array $options)
    {

        return $this->client->post("people.json", $options);
    }

    /**
     * Delete a Person in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/People/post_v2_people_json
     * @param string $id
     * @return stdClass
     */
    public function delete($id)
    {

        return $this->client->delete("people/$id.json");
    }

    /**
     * Update a Person in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/People/put_v2_people_id_json
     * @param string $id
     * @param $options
     * @return stdClass
     */
    public function update($id, $options)
    {

        return $this->client->put("people/$id.json", $options);
    }

    /**
     * Upsert a Person in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Person_Upsert/post_v2_person_upserts_json
     * @param string $id
     * @param $options
     * @return stdClass
     */
    public function upsert($id_or_email, array $options)
    {
        if (filter_var($id_or_email, FILTER_VALIDATE_EMAIL)) {
            $upsert_key = ['upsert_key' => 'email_address', 'email_address' => $id_or_email];
        } else {
            $upsert_key = ['upsert_key' => 'id', 'id' => $id_or_email];
        }

        return $this->client->post("person_upserts.json", array_merge($upsert_key, $options));
    }

    /**
     * Get a Persons Calls
     *
     * @param $id
     * @param array $options
     * @return stdClass
     */
    public function calls($id, array $options = [])
    {

        $options = array_merge(["person_id[]" => $id], $options);

        return $this->client->get("activities/calls.json", $options);

    }

    /**
     * Get a Persons Cadences
     *
     * @param $id
     * @param array $options
     * @return stdClass
     */
    public function cadences($id, array $options = [])
    {

        $options = array_merge(["person_id" => $id], $options);

        return $this->client->get("cadence_memberships.json", $options);

    }

    /**
     * Get a Persons Notes
     *
     * @param $id
     * @param array $options
     * @return stdClass
     */
    public function notes($id, array $options = [])
    {

        $options = array_merge(["associated_with_type" => "person", "associated_with_id" => $id], $options);

        return $this->client->get("notes.json", $options);

    }

    /**
     * Search Persons by Email
     *
     * @param string $email
     * @param bool $single
     * @return stdClass
     * @throws Exception
     */
    public function searchByEmail(string $email, $single = true)
    {

        $options = ['email_addresses' => $email];

        if ($single) $options['per_page'] = 1;

        return $this->list($options);
    }


}

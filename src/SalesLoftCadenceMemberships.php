<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftCadenceMemberships extends SalesLoftResource
{

    /**
     * Lists Cadence Memberships
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadence_Memberships/get_v2_cadence_memberships_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('cadence_memberships.json', $options);
    }

    /**
     * Gets a single Cadence Membership by ID
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadence_Memberships/get_v2_cadence_memberships_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get('cadence_memberships/$id.json');
    }

    /**
     * Create a Cadence Membership
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadence_Memberships/post_v2_cadence_memberships_json
     * @param $personId
     * @param $cadenceId
     * @param bool $userId
     * @return stdClass
     */
    public function create($personId, $cadenceId, $userId = false)
    {
        $options = ['person_id' => $personId, 'cadence_id' => $cadenceId];

        if($userId) $options['user_id'] = $userId;

        return $this->client->post('cadence_memberships.json', $options);
    }

    /**
     * Create a Delete Membership
     *
     * @see    https://developers.salesloft.com/api.html#!/Cadence_Memberships/delete_v2_cadence_memberships_id_json
     * @param $personId
     * @param $cadenceId
     * @param bool $userId
     * @return stdClass
     */
    public function delete($id)
    {
        return $this->client->delete("cadence_memberships/$id.json");
    }



}

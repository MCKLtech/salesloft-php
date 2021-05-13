<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftUsers extends SalesLoftResource
{

    /**
     * Lists Users
     *
     * @see    https://developers.salesloft.com/api.html#!/Users/get_v2_users_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('users.json', $options);
    }

    /**
     * Gets a single User based on the SalesLoft ID.
     *
     * @see    https://developers.salesloft.com/api.html#!/Users/get_v2_users_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("users/$id.json");
    }

    /**
     * Returns the currently logged in User
     * @see https://developers.salesloft.com/api.html#!/Me/get_v2_me_json
     *
     * @return stdClass
     */
    public function me() {

        return $this->client->get("me.json");
    }

    /**
     * Returns the currently logged in User's team
     * @see https://developers.salesloft.com/api.html#!/Team/get_v2_team_json
     *
     * @return stdClass
     */
    public function team() {

        return $this->client->get("team.json");
    }


}

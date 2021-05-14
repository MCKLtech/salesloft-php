<?php

namespace SalesLoft;

use Http\Client\Exception;
use stdClass;

class SalesLoftAccounts extends SalesLoftResource
{
    /**
     * Lists Accounts
     *
     * @see    https://developers.salesloft.com/api.html#!/Accounts/get_v2_accounts_json
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('accounts.json', $options);
    }

    /**
     * Gets a single Account based on the SalesLoft ID.
     *
     * @see    https://developers.salesloft.com/api.html#!/Accounts/get_v2_accounts_id_json
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get("accounts/$id.json");
    }

    /**
     * Create an Account in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Accounts/post_v2_accounts_json
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("accounts.json", $options);
    }

    /**
     * Delete an Account in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Accounts/delete_v2_accounts_id_json
     * @param string $id
     * @return stdClass
     */
    public function delete($id) {

        return $this->client->delete("accounts/$id.json");
    }

    /**
     * Update an Account in SalesLoft
     *
     * @see https://developers.salesloft.com/api.html#!/Accounts/put_v2_accounts_id_json
     * @param string $id
     * @param $options
     * @return stdClass
     */
    public function update($id, $options) {

        return $this->client->put("accounts/$id.json", $options);
    }

}

<?php


namespace SalesLoft;

abstract class SalesLoftResource
{
    /**
     * @var SalesLoftClient
     */
    protected $client;

    /**
     * DriftResource constructor.
     *
     * @param SalesLoftClient $client
     */
    public function __construct(SalesLoftClient $client)
    {
        $this->client = $client;
    }
}

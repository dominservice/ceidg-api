<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice;

use Dominservice\Contracts\CeidgApiContract;
use Dominservice\Contracts\CeidgEnvelopeContract;
use Dominservice\Contracts\XmlParserContract;
use Dominservice\Envelopes\GetId;
use Dominservice\Envelopes\GetMigrationData;
use Dominservice\Envelopes\GetMigrationData201901;
use Dominservice\Parsers\BaseParser as XmlParser;
use Exception;
use SoapClient;

/**
 * Class CeidgApi
 *
 * @method GetId getId()
 * @method GetMigrationData getMigrationData()
 * @method GetMigrationData201901 getMigrationData201901()
 */
class CeidgApi implements CeidgApiContract
{
    /**
     * Production webservice URL.
     *
     * @var string
     */
    protected $productionUrl = 'https://datastore.ceidg.gov.pl/CEIDG.DataStore/services/DataStoreProvider201901.svc?wsdl';

    /**
     * Sandbox webservice URL.
     *
     * @var string
     */
    protected $sandboxUrl = 'https://datastoretest.ceidg.gov.pl/CEIDG.DataStore/services/DataStoreProvider201901.svc?wsdl';

    /**
     * SOAP Client instance.
     *
     * @var SoapClient
     */
    protected $client;

    /**
     * Authorization token / API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Class constructor.
     *
     * @param string $apiKey
     * @param bool   $sandbox
     */
    public function __construct($apiKey, $sandbox = false)
    {
        $apiUrl = !$sandbox ? $this->productionUrl : $this->sandboxUrl;

        $this->client = new SoapClient($apiUrl);

        $this->apiKey = $apiKey;
    }

    /**
     * Magic __call method used to set SOAP function class.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return CeidgEnvelopeContract
     */
    public function __call($name, $value): CeidgEnvelopeContract
    {
        $className = '\\Dominservice\\Envelopes\\'.ucfirst($name);

        if (class_exists($className)) {
            return new $className($this);
        }

        throw new Exception('Class '.$className.' does not exist');
    }

    /**
     * Get SoapClient instance.
     *
     * @return SoapClient
     */
    public function getClient(): SoapClient
    {
        return $this->client;
    }

    /**
     * Merge query params with api key / authorization token.
     *
     * @param array $params
     *
     * @return array
     */
    public function makeParams($params = []): array
    {
        return array_merge($params, ['AuthToken' => $this->apiKey]);
    }

    /**
     * Return XML parser, depending on called function.
     *
     * @param string $callFunctionName
     *
     * @throws Exception
     *
     * @return XmlParserContract
     */
    public function getParser($callFunctionName): XmlParserContract
    {
        return XmlParser::make($callFunctionName);
    }
}

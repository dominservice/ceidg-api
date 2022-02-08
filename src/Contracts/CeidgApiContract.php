<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Contracts;

use SoapClient;

interface CeidgApiContract
{
    /**
     * Class constructor.
     *
     * @param string $apiKey
     * @param bool   $sandbox
     */
    public function __construct($apiKey, $sandbox = false);

    /**
     * Magic __call method used to set SOAP function class.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return CeidgEnvelopeContract
     */
    public function __call($name, $value): CeidgEnvelopeContract;

    /**
     * Get SoapClient instance.
     *
     * @return SoapClient
     */
    public function getClient(): SoapClient;

    /**
     * Merge query params with api key / authorization token.
     *
     * @param array $params
     *
     * @return array
     */
    public function makeParams($params = []): array;

    /**
     * Return XML parser, depending on called function.
     *
     * @param string $callFunctionName
     *
     * @throws \Exception
     *
     * @return XmlParserContract
     */
    public function getParser($callFunctionName): XmlParserContract;
}

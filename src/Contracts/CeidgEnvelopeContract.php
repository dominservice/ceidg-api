<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Contracts;

interface CeidgEnvelopeContract
{
    /**
     * Class constructor.
     *
     * @param CeidgApiContract $ceidgApi
     */
    public function __construct(CeidgApiContract $ceidgApi);

    /**
     * Magic __call method used to set query params.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return CeidgEnvelopeContract
     */
    public function __call($name, $value): self;

    /**
     * Return query params with or without auth token. Auth token would be
     * returned when $merged param is true.
     *
     * @param bool $merged
     *
     * @return array
     */
    public function getParams($merged = false): array;

    /**
     * Send SOAP envelope and (optionally) parse it immediately
     * Return string with raw XML response or parsed array/object.
     *
     * @param bool $parse
     *
     * @throws \Exception
     *
     * @return array|object|string
     */
    public function send($parse = true);

    /**
     * Validate value against param name.
     * Return false on entirely negative validation, or validated content
     * if some values could be left.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return array|bool|string
     */
    public function validate($name, $value);
}

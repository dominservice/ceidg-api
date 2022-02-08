<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Contracts;

interface ValidatorContract
{
    /**
     * Return validator for given param name.
     *
     * @param string $paramName
     *
     * @return ValidatorContract
     */
    public static function getValidator($paramName): self;

    /**
     * Validate $value, return false on entirely false validation
     * or validated content if part of it could be left.
     *
     * @param array|string $value
     *
     * @return array|bool|string
     */
    public function validate($value);

    /**
     * Sanitize multiple types of input values into an array.
     *
     * @param array|string $value
     *
     * @return array
     */
    public function sanitize($value): array;
}

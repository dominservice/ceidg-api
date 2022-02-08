<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Validators;

use Dominservice\Contracts\ValidatorContract;

abstract class BaseValidator implements ValidatorContract
{
    /**
     * Return validator for given param name.
     *
     * @param string $paramName
     *
     * @return ValidatorContract
     */
    public static function getValidator($paramName): ValidatorContract
    {
        $validatorClassName = '\\Dominservice\\Validators\\'.$paramName.'Validator';

        return class_exists($validatorClassName) ? new $validatorClassName() : new EmptyValidator();
    }

    /**
     * Sanitize multiple types of input values into an array.
     *
     * @param array|string $value
     *
     * @return array
     */
    public function sanitize($value): array
    {
        if (!\is_array($value)) {
            return [(string) $value];
        }

        return $value;
    }
}

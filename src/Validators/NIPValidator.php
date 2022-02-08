<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Validators;

class NIPValidator extends BaseValidator
{
    /**
     * Validate $value, return false on entirely false validation
     * or validated content if part of it could be left.
     *
     * @param array|string $value
     *
     * @return array|bool|string
     */
    public function validate($value): array
    {
        $validated = [];
        foreach ($value as $singleValue) {
            if (false !== ($validatedSingleValue = $this->nip($singleValue))) {
                $validated[] = $validatedSingleValue;
            }
        }

        return $validated;
    }

    /**
     * Validate NIP.
     *
     * @param string $value
     *
     * @return bool|string
     */
    public function nip($value)
    {
        $value = preg_replace('/[^0-9]+/', '', $value);

        if (10 !== \strlen($value)) {
            return false;
        }

        $arrSteps = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $intSum = 0;

        for ($i = 0; $i < 9; $i++) {
            $intSum += $arrSteps[$i] * $value[$i];
        }

        $int = $intSum % 11;
        $intControlNr = 10 === $int ? 0 : $int;

        if ($intControlNr === (int) $value[9]) {
            return $value;
        }

        return false;
    }
}

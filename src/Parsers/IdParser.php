<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Parsers;

use Exception;

class IdParser extends BaseParser
{
    /**
     * Parse raw XML SOAP response.
     *
     * @param string $data
     *
     * @return array|object
     */
    public function parse($data)
    {
        try {
            return (array) $this->xmlToStructure($data->GetIDResult)->IdentyfikatorWpisu;
        } catch (Exception $e) {
            throw new Exception('Data cannot be converted to array');
        }
    }
}

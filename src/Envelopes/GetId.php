<?php

/*
 * This file is a part of dominservice/ceidg-api package, a PHP library for to deal
 * with the CEIDG (https://datastore.ceidg.gov.pl) SOAP webservice.
 *
 * @author DSO-IT Mateusz Domin <biuro@dso.biz.pl>
 * @copy (C)2022 DSO-IT Mateusz Domin All rights reserved.
 */

namespace Dominservice\Envelopes;

/**
 * Class GetId
 *
 * @method self setDateTo(string $date)
 * @method self setDateFrom(string $date)
 * @method self setMigrationDateFrom(string $date)
 * @method self setMigrationDateTo(string $date)
 */
class GetId extends CeidgEnvelope
{
    /**
     * {@inheritdoc}
     */
    protected $allowedParams = [
        'DateTo' => 'single',
        'DateFrom' => 'single',
        'MigrationDateFrom' => 'single',
        'MigrationDateTo' => 'single',
    ];

    /**
     * {@inheritdoc}
     */
    protected $callFunctionName = 'GetId';
}

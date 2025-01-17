<?php

namespace Scienta\DoctrineJsonFunctions\Tests\Query\Functions\Sqlite;

use Scienta\DoctrineJsonFunctions\Tests\Query\SqliteTestCase;

class JsonExtractTest extends SqliteTestCase
{
    public function testJsonExtractSpace()
    {
        $this->assertDqlProducesSql(
            "SELECT JSON_EXTRACT('{ \"a b\": 10, \"b\": false}', '$.\"a b\"') FROM Scienta\DoctrineJsonFunctions\Tests\Entities\Blank b",
            "SELECT JSON_EXTRACT('{ \"a b\": 10, \"b\": false}', '$.\"a b\"') AS sclr_0 FROM Blank b0_"
        );
    }

    public function testJsonExtractMultipleParameters()
    {
        $this->assertDqlProducesSql(
            "SELECT JSON_EXTRACT('{\"a\": 10,\"b\": false}', '$.a', '$.b') FROM Scienta\DoctrineJsonFunctions\Tests\Entities\Blank b",
            "SELECT JSON_EXTRACT('{\"a\": 10,\"b\": false}', '$.a', '$.b') AS sclr_0 FROM Blank b0_"
        );
    }

    public function testJsonExtractQuotes()
    {
        $this->expectException(\Doctrine\ORM\Query\QueryException::class);

        $this->assertDqlProducesSql(
            'SELECT JSON_EXTRACT(d.jsonData, "$.a") FROM Scienta\DoctrineJsonFunctions\Tests\Entities\JsonData d',
            "QueryException"
        );
    }
}

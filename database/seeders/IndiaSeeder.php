<?php

namespace Database\Seeders;

use Database\Seeders\FlexibleSeeder;

class IndiaSeeder extends FlexibleSeeder
{
    protected $dataSources = [
        [
            "url" => "http://localhost:3000/local/terriory/india/regions",
            "tableName" => "regions",
            "fieldMapping" => [
                "id" => "id",
                "name" => "name",
                "translations" => "translations",
                "wikiDataId" => "wikiDataId",
            ],
        ],
        [
            "url" => "http://localhost:3000/local/terriory/india/subregions",
            "tableName" => "subregions",
            "fieldMapping" => [
                "id" => "id",
                "name" => "name",
                "region_id" => "region_id",
                "translations" => "translations",
                "wikiDataId" => "wikiDataId",
            ],
        ],
        [
            "url" => "http://localhost:3000/local/terriory/india/countries",
            "tableName" => "countries",
            "fieldMapping" => [
                "id" => "id",
                "region_id" => "region_id",
                "subregion_id" => "subregion_id",
                "name" => "name",
                "iso3" => "iso3",
                "iso2" => "iso2",
                "numeric_code" => "numeric_code",
                "phonecode" => "phone_code",
                "capital" => "capital",
                "currency" => "currency",
                "currency_name" => "currency_name",
                "currency_symbol" => "currency_symbol",
                "tld" => "tld",
                "native" => "native",
                "region_name" => "region",
                "subregion_name" => "subregion",
                "nationality" => "nationality",
                "timezones" => "timezones",
                "translations" => "translations",
                "longitude" => "longitude",
                "latitude" => "latitude",
                "emoji" => "emoji",
                "emojiU" => "emojiU",
            ],
        ],
        [
            "url" => "http://localhost:3000/local/terriory/india/states",
            "tableName" => "states",
            "fieldMapping" => [
                "id" => "id",
                "country_id" => "country_id",
                "name" => "name",
                "country_name" => "country_name",
                "country_code" => "country_code",
                "state_code" => "state_code",
                "type" => "type",
                "latitude" => "latitude",
                "longitude" => "longitude",
            ],
        ],
        [
            "url" => "http://localhost:3000/local/terriory/india/cities",
            "tableName" => "cities",
            "fieldMapping" => [
                "id" => "id",
                "state_id" => "state_id",
                "country_id" => "country_id",
                "name" => "name",
                "state_name" => "state_name",
                "country_name" => "country_name",
                "state_code" => "state_code",
                "country_code" => "country_code",
                "latitude" => "latitude",
                "longitude" => "longitude",
                "wikiDataId" => "wikiDataId",
            ],
        ],
    ];
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

abstract class FlexibleSeeder extends Seeder
{
    /**
     * The data sources to fetch the data from.
     *
     * @var array
     */
    protected $dataSources = [];

    /**
     * The unique identifier field name.
     *
     * @var string
     */
    protected $uniqueIdField = 'id';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->dataSources as $source) {
            $data = Http::get($source['url'])->json();

            // Ensure the response contains an array of data
            if (is_array($data)) {
                foreach ($data as $item) {
                    DB::table($source['tableName'])->updateOrInsert(
                        [$this->uniqueIdField => $item[$this->uniqueIdField]],
                        $this->mapData($source['fieldMapping'], $item)
                    );
                }
            } else {
                // Log an error if the response is not an array
                Log::error('Expected an array of data from ' . $source['url'] . ', but got: ' . print_r($data, true));
            }
        }
    }

    /**
     * Map the data to the table columns based on the field mapping.
     *
     * @param array $fieldMapping
     * @param array $item
     * @return array
     */
    protected function mapData(array $fieldMapping, array $item): array
    {
        $mappedData = [];

        foreach ($fieldMapping as $field => $itemKey) {
            $value = $item[$itemKey] ?? null;

            // Convert arrays or objects to JSON strings
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }

            $mappedData[$field] = $value;
        }

        $mappedData['created_at'] = $item['created_at'] ?? now();
        $mappedData['updated_at'] = $item['updated_at'] ?? now();

        return $mappedData;
    }
}

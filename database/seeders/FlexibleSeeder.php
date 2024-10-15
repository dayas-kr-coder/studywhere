<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

abstract class FlexibleSeeder extends Seeder
{
    protected $dataSources = [];
    protected $uniqueIdField = 'id';

    public function run(): void
    {
        foreach ($this->dataSources as $source) {
            $data = Http::get($source['url'])->json();

            if (is_array($data)) {
                foreach ($data as $item) {
                    $mappedData = $this->mapData($source['fieldMapping'], $item, $source['slug'] ?? false, $source['tableName']);

                    DB::table($source['tableName'])->updateOrInsert(
                        [$this->uniqueIdField => $item[$this->uniqueIdField]],
                        $mappedData
                    );
                }
            } else {
                Log::error('Expected an array of data from ' . $source['url'] . ', but got: ' . print_r($data, true));
            }
        }
    }

    protected function mapData(array $fieldMapping, array $item, bool $slug = false, string $tableName = ''): array
    {
        $mappedData = [];

        foreach ($fieldMapping as $field => $itemKey) {
            $value = $item[$itemKey] ?? null;

            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }

            $mappedData[$field] = $value;
        }

        if ($slug && $tableName) {
            $mappedData['slug'] = $this->generateUniqueSlug($item['name'], $tableName, $mappedData['id']);
        }

        $mappedData['created_at'] = $item['created_at'] ?? now();
        $mappedData['updated_at'] = $item['updated_at'] ?? now();

        return $mappedData;
    }

    protected function generateUniqueSlug(string $name, string $tableName, $id): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Check for duplicates on the specific table, appending a number if needed
        while (DB::table($tableName)
            ->where('slug', $slug)
            ->where($this->uniqueIdField, '!=', $id)
            ->exists()
        ) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}

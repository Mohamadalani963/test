<?php

namespace App\Filament\Resources\MarketResource\Pages;

use App\Filament\Resources\MarketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarket extends CreateRecord
{
    protected static string $resource = MarketResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Transform the contact_information array into a key-value JSON object
        $data['contact_information'] = collect(value: $data['contact_information'])
            ->mapWithKeys(function ($item) {
                return [$item['contact_type'] => $item['contact_detail']];
            })
            ->toArray();
        if (isset($data['branches'])) {
            foreach ($data['branches'] as &$branch) {
                $branch['contact_information'] = collect($branch['contact_information'])
                    ->mapWithKeys(function ($item) {
                        return [$item['contact_type'] => $item['contact_detail']];
                    })
                    ->toArray();
            }
        }
        return $data;
    }
}

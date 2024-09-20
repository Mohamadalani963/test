<?php

namespace App\Filament\Resources\MarketResource\Pages;

use App\Filament\Resources\MarketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarket extends EditRecord
{
    protected static string $resource = MarketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        // Transform the contact_information array into a key-value JSON object
        $data['contact_information'] = collect($data['contact_information'])
            ->mapWithKeys(function ($item) {
                return [$item['contact_type'] => $item['contact_detail']];
            })
            ->toArray();
        if (isset($data['branch'])) {
            foreach ($data['branch'] as &$branch) {
                $branch['contact_information'] = collect($branch['contact_information'])
                    ->mapWithKeys(function ($item) {
                        return [$item['contact_type'] => $item['contact_detail']];
                    })
                    ->toArray();
            }
        }
        return $data;
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Transform the contact_information JSON object back into an array of key-value pairs
        if (isset($data['contact_information'])) {
            $data['contact_information'] = collect($data['contact_information'])
                ->map(function ($value, $key) {
                    return [
                        'contact_type' => $key,
                        'contact_detail' => $value,
                    ];
                })
                ->values()
                ->toArray();
        }

        return $data;
    }
}

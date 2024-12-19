<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    public function afterCreate()
    {
        $tenant = $this->getRecord();

        // Acesse os dados diretamente do registro
        $domain = $tenant->domain; // Certifique-se de que 'domain' é um atributo do modelo Tenant

        // Verifique se o domínio está presente
        if ($domain) {
            $tenant->domains()->create([
                'domain' => $domain
            ]);
        }
    }
}

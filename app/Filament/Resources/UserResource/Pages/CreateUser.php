<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = static::getModel()::create($data);

        if (auth()->user()->hasRole('Manager')) {
            // Set company_id to manager's company
            $user->company_id = auth()->user()->company_id;
            // Assign Employee role
            $user->assignRole('Employee');
        } else {
            // For administrators, handle role assignment from form data
            if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }
        }

        $user->save();
        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

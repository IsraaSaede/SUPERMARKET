<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LocalDailyRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalDailyRecordPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LocalDailyRecord');
    }

    public function view(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('View:LocalDailyRecord');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LocalDailyRecord');
    }

    public function update(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('Update:LocalDailyRecord');
    }

    public function delete(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('Delete:LocalDailyRecord');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:LocalDailyRecord');
    }

    public function restore(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('Restore:LocalDailyRecord');
    }

    public function forceDelete(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('ForceDelete:LocalDailyRecord');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LocalDailyRecord');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LocalDailyRecord');
    }

    public function replicate(AuthUser $authUser, LocalDailyRecord $localDailyRecord): bool
    {
        return $authUser->can('Replicate:LocalDailyRecord');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LocalDailyRecord');
    }

}
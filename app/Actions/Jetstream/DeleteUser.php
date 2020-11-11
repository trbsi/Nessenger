<?php

namespace App\Actions\Jetstream;

use App\Code\User\Services\DeleteUserDataFromIndex;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    private DeleteUserDataFromIndex $deleteUserDataFromIndex;

    public function __construct(DeleteUserDataFromIndex $deleteUserDataFromIndex)
    {
        $this->deleteUserDataFromIndex = $deleteUserDataFromIndex;
    }

    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        /** @var User $user */
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $this->deleteUserDataFromIndex->deleteDataFromIndex($user->getId());
        $user->delete();
    }
}

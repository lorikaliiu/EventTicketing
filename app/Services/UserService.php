<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function updateUserProfile($userId, array $data)
    {
        $user = User::findOrFail($userId);
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $user->update($data);
        
        return $user;
    }

    public function getUserProfile($userId)
    {
        return User::findOrFail($userId);
    }
}
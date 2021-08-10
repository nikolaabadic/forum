<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Topic $topic){
        return $user -> id === $topic -> user_id;      
    }
}

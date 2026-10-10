<?php

namespace App\Policies;

use App\Models\Bb;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BbPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Bb $bb) {
        // Владелец объявления ИЛИ администратор могут редактировать.
        // $bb->user_id читаем из столбца — безопаснее, чем связь $bb->user->id.
        return $user->isAdmin() || $bb->user_id === $user->id;
    }
    public function destroy(User $user, Bb $bb) {
        return $this->update($user, $bb);
    }
}

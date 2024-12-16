<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = new BaseRepository($user);
    }
    public function allUserInfo()
    {
        return $this->user->all();
    }
}
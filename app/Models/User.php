<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Hobby;
// <!-- app/model/user -->
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    protected $guarded = [
        //semua boleh diisi karena kosong
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function hobbies()
    {
        return $this->hasMany(Hobby::class);
    }

    // Cast friends to an array
    protected $casts = ['friends' => 'array'];
    public function addFriend($friendId)
    {
        $friends = $this->friends ?? [];
        if (!in_array($friendId, $friends)) {
            $friends[] = $friendId;
            $this->friends = $friends;
            $this->save();
        }
    }

    public function removeFriend($friendId)
    {
        $friends = $this->friends ?? [];
        if (($key = array_search($friendId, $friends)) !== false) {
            unset($friends[$key]);
            $this->friends = array_values($friends); // Reindex array
            $this->save();
        }
    }

    public function isFriend($friendId)
    {
        return in_array($friendId, $this->friends ?? []);
    }
}

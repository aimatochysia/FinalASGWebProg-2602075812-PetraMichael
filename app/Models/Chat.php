<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// app/Models/Chat.php

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['id_sender', 'id_receiver', 'message'];


    // Define the relationships to the User model
    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id_receiver');
    }
}

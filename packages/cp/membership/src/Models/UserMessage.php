<?php

namespace Cp\Membership\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;
    protected $fillable = [

        'userfrom_id',
        'userto_id',
        'message',
        'read',
        'last',
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'userfrom_id');
    }
    public function userTo()
    {
        return $this->belongsTo(User::class, 'userto_id');
    }
}

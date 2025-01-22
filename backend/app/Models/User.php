<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BorrowRecord;
use App\Models\Fine;
use App\Models\Reservation;
use App\Models\Review;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Loan;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

 
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

  


    // Define a one-to-many relationship with the Loan model
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

}

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

  

    // public function borrowRecords()
    // {
    //     return $this->hasMany(BorrowRecord::class);
    // }

    // check how many loans a user has from the loans table using the id of the user


    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

}

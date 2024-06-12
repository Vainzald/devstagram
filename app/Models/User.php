<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',  
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    // Almacena los seguidores de un usuario

    public function followers()
    {
        //En este caso de muchos a muchos, donde la funcion se trata mas que nada de traer los resultados
        //de
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
        
    }

    public function isFollowing($user)
    {
        return $this->followers->contains($user->id);

    }

    public function following(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    

    //Almacenar los que seguimos
}

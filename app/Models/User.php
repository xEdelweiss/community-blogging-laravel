<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like(Post|Comment $likeable): self
    {
        if ($this->hasLike($likeable)) {
            return $this;
        }

        $like = new Like();
        $like->user()->associate($this);
        $like->likeable()->associate($likeable);
        $like->save();

        return $this;
    }

    public function unlike(Post|Comment $likeable): self
    {
        if (!$this->hasLike($likeable)) {
            return $this;
        }

        $likeable->likes()
            ->whereUserId($this->id)
            ->delete();

        return $this;
    }

    public function hasLike(Post|Comment $likeable): bool
    {
        if (!$likeable->exists) {
            return false;
        }

        return $this->likes()
            ->whereLikeableId($likeable->id)
            ->whereLikeableType($likeable->getMorphClass())
            ->exists();
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function uploadAvatar(UploadedFile $file): self
    {
        $path = $file->storePublicly('avatars', 'public');
        $this->avatar = '/storage/' . $path;

        return $this;
    }
}

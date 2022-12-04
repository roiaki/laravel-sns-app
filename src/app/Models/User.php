<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
    ];

    /**
     *  1 to Many
     * main(User) -> sub(Article)
     */
    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * Many to Many
     * 相手からフォローされている
     */
    public function followers(): BelongsToMany
    {
        // 3param:リレーション元モデル  4param:リレーション先モデル
        return $this->belongsToMany('App\Models\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    /**
     * Many to Many
     * 相手をフォローしている
     */
    public function followings(): BelongsToMany
    {
        // 3th param リレーション元、4th param リレーション先
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    /**
     * Many to Many
     * User(main) -> likes(sub)
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Article', 'likes')->withTimestamps();
    }


    /**
     * フォローしているかどうか確認する
     */
    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    /**
     * フォロワー数を求める
     */
    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    /**
     * フォロー数を求める
     */
    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }

}

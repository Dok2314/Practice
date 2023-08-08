<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hash', 'user_id'];

    public function getUrlAttribute(): string
    {
        return \Asset(self::getPathOfImage($this->hash, $this->user_id));
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function getPathOfImage(string $fileName = null, ?string $userId = null): string
    {
        $path = null;

        if(!is_null($userId)) {
            $path = $userId . '/';
        }

        return 'uploads/' . $path . $fileName;
    }
}

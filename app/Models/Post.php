<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'slug',
        'title',
        'content',
        'status',
    ];

    protected $appends = [
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDescriptionAttribute()
    {
        return Str::substr($this->attributes['content'], 0, 130);
    }

    public function getImageAttribute()
    {
        if (str_contains($this->attributes['image'], 'http://') || str_contains($this->attributes['image'], 'https://')) {
            return $this->attributes['image'];
        }

        return asset(Storage::url("{$this->attributes['image']}"));
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = explode('storage/', $value)[1];
        $this->attributes['image'] = $value;
    }

    public function uploadImage($data)
    {
        $fileName = $this->getFileName($data);
        $data['image']->storeAs('posts', $fileName, 'public');

        return "posts/{$fileName}";
    }

    public function uploadImageUpdate($data)
    {
        $fileName = $this->getFileName($data);
        Storage::delete(storage_path('app/public/'.$this->attributes['image']));
        $data['image']->storeAs('posts', $fileName, 'public');

        return "posts/{$fileName}";
    }

    protected function getFileName($data)
    {
        return Str::slug($data['title'], '_') . '.' .$data['image']->extension();
    }
}

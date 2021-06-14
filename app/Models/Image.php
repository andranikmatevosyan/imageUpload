<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * getRules
     *
     * @return void
     */
    public static function getRules()
    {
        return [
            'name' => 'required|string|max:190|unique:images,name',
            'slug' => 'required|string|max:190|unique:images,slug',
            'short_path' => 'required|string|max:190|unique:images,short_path',
            'full_path' => 'required|string|max:190|unique:images,full_path',
            'extension' => 'required|in:jpg,png,jpeg,gif,svg',
            'original_url' => 'required|url',
            'life_time' => 'nullable|integer'
        ];
    }

    /**
     * get_unique_name
     *
     * @param  mixed $extension
     * @return void
     */
    public static function get_unique_name($extension)
    {
        $name = Str::random(8);
        $full_name = implode('.', [$name, $extension]);

        $image_exists = self::where(['name' => $full_name])->exists();

        if ($image_exists):
            return self::get_unique_name($extension);
        endif;

        return $full_name;
    }

    /**
     * get_unique_slug
     *
     * @return void
     */
    public static function get_unique_slug()
    {
        $slug = Str::random(4);

        $image_exists = self::where(['slug' => $slug])->exists();

        if ($image_exists):
            return self::get_unique_slug();
        endif;

        return $slug;
    }

    /**
     * get_life_time
     *
     * @param  mixed $life_time
     * @return void
     */
    public static function get_life_time($life_time)
    {
        return $life_time * 60;
    }

    /**
     * get_image_url
     *
     * @param  mixed $slug
     * @return void
     */
    public static function get_image_url($slug)
    {
        return "<a href='". route('image.show', $slug) ."' target='_blank'>". route('image.show', $slug) ."</a>";
    }
}

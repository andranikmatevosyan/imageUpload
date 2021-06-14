<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckImage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $images = Image::whereNotNull('life_time')->get();

        foreach ($images as $image):
            $passed = $image->created_at->diffInSeconds(Carbon::now(), false);

            if ($passed > $image->life_time):
                if (Storage::delete($image->short_path)):
                    $image->delete();
                endif;
            endif;
        endforeach;

        return $next($request);
    }
}

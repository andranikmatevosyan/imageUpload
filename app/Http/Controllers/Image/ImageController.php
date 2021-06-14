<?php

namespace App\Http\Controllers\Image;

use Exception;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('image.index');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'image_url' => 'required|url|max:190',
                'life_time' => 'nullable|integer'
            ]);

            if ($validator->fails()):
                return response()->json([
                    'status' => 'validate',
                    'errors' => $validator->errors()
                ], 200);
            endif;

            $file_headers = get_headers($request->get('image_url'));
            $file_headers_change = array_change_key_case(get_headers($request->get('image_url'), 1));

            switch (true):
                case (substr($file_headers[0], 9, 3) != "200"):
                case (substr($file_headers_change['content-type'], 0, 5) != 'image'):
                    return response()->json([
                        'status' => 'validate',
                        'errors' => [
                            'image_url' => [
                                'Ссылка не содержит изоброжение'
                            ]
                        ]
                    ], 200);
            endswitch;

            $image = file_get_contents($request->get('image_url'));
            $original_url = strtok($request->get('image_url'), "?");
            $original_name = substr($original_url, strrpos($original_url, '/') + 1);
            $extension = substr($original_name, strrpos($original_name, '.') + 1);
            $name = Image::get_unique_name($extension);
            $slug = Image::get_unique_slug();
            $short_path = implode('/', ['images', $name]);
            $full_path = implode('/', ['app', $short_path]);
            $image_data = compact('name', 'slug', 'short_path', 'full_path', 'extension', 'original_url');
            $life_time = Image::get_life_time($request->get('life_time'));
            $image_full_data = array_merge($image_data, compact('life_time'));

            $validator = Validator::make($image_full_data, Image::getRules());

            if ($validator->fails()):
                return response()->json([
                    'status' => 'error',
                    'message' => 'Что-то пошло не так, попробуйте другое изоброжение',
                    'errors' => $validator->errors()
                ], 200);
            endif;

            if (!Storage::put($short_path, $image)):
                return response()->json([
                    'status' => 'error',
                    'message' => 'Что-то пошло не так, попробуйте другое изоброжение'
                ], 200);
            endif;

            $image = Image::create($image_full_data);

            if (!$image):
                return response()->json([
                    'status' => 'error',
                    'message' => 'Что-то пошло не так, попробуйте другое изоброжение'
                ], 200);
            endif;

            $image_url = Image::get_image_url($image->slug);
        } catch (Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Что-то пошло не так, попробуйте другое изоброжение',
                'exception' => $exception->getMessage()
            ], 200);
        }

        DB::commit();

        return response()->json([
            'status' => 'success',
            'action' => 'reset',
            'message' => 'Загрузка прошла удачна, увидеть изоброжение можно по ссылке слева',
            'display' => $image_url
        ], 200);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $response = $this->display($slug);

        if (!$response):
            abort(404);
        endif;

        return view('image.show', compact('slug'));
    }

    /**
     * display
     *
     * @param  mixed $slug
     * @return void
     */
    public function display($slug)
    {
        $image = Image::where(['slug' => $slug])->first();

        if (!$image):
            return null;
        endif;

        $path = storage_path($image->full_path);

        if (!File::exists($path)):
            return null;
        endif;

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}

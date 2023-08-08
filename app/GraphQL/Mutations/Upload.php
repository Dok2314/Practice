<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

final class Upload
{
    /**
     * Upload users image and save to storage
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $validator = Validator::make($args, [
            'file' => 'required|image'
        ]);

        if($validator->fails()) {
            throw new Error("Invalid image!");
        }

        $file = $args['file'];

        Storage::put(Image::getPathOfImage(), $file);

        $image = Image::create([
            'name' => $file->getFilename(),
            'hash' => $file->hashName()
        ]);

//        $image->user_id =

        $image->save();

        return $image;
    }
}

<?php
namespace App\Helpers;


use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Log;
class Uploader
{




    public static function uploadImage($file, $model)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/media');

        // Create directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true); // recursive
        }

        // Move uploaded file
        $file->storeAs('media', $filename);

        // Return relative path for database


        $size = $file->getSize();
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();

        $media = new Media();
        $media->mediable_type = get_class($model);
        $media->mediable_id = $model->id;
        $media->type = "image";
        $media->category = 'image';
        $media->filename = $originalName;
        $media->original_name = $originalName;
        $media->path = 'media/' . $filename;
        $media->size = $size;
        $media->extension = $extension;
        $media->mime_type = $mimeType;
        $media->user_id = auth()->id();
        $media->save();
        return 'media/' . $filename;


    }
    public static function updateOrUploadImage($file, $model)
    {
        if($model->media->count() > 0){
            //delete old file
           foreach($model->media as $media){
            if (file_exists(public_path('uploads/' . $media->path))) {
                unlink(public_path('uploads/' . $media->path));
            }
            $media->delete();
           }

        }

        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/media');

        // Create directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true); // recursive
        }


        // Move uploaded file
        // $file->storeAs('media', $filename);
        copy($file->getRealPath(), $destinationPath . '/' . $filename);

        // Return relative path for database


        $size = $file->getSize();
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();

        $media = new Media();
        $media->mediable_type = get_class($model);
        $media->mediable_id = $model->id;
        $media->type = "image";
        $media->category = 'image';
        $media->filename = $originalName;
        $media->original_name = $originalName;
        $media->path = 'media/' . $filename;
        $media->size = $size;
        $media->extension = $extension;
        $media->mime_type = $mimeType;
        $media->user_id = auth()->id();
        $media->save();
        return 'media/' . $filename;


    }

    //     public static function generateImageSizes($filePath, $originalFileName, $mediaFileId, $fileFor, $folder_path, $model_type = null)
// {
//     $sizeConfig = config("filesizes.{$model_type}.{$fileFor}");
//     // Log::info("File size config model type:{$model_type} file for: {$fileFor}: ", $sizeConfig);

    //     if (!$sizeConfig) {
//         return;
//     }
//     foreach ($sizeConfig as $type => $size) {
//         [$width, $height] = explode('x', $size);
//         $folderPath = $folder_path . "{$size}/";

    //         // Ensure Directory Exists
//         if (!file_exists(public_path($folderPath))) {
//             mkdir(public_path($folderPath), 0777, true);
//         }

    //         if (!file_exists($filePath)) {
//             // Log::error("File not found at: " . $filePath);
//             return response()->json(['error' => 'File not found'], 400);
//         }

    //         // Resize Image
//         $image = Image::read($filePath);
//         $image->cover($width, $height, 'top');
//         $image->resize($width, $height);
//         $image->save($folderPath . $originalFileName);

    //         // Save in Database
//         MediaFileVariant::create([
//             'media_file_id' => $mediaFileId,
//             'size' => "{$size}",
//             'file' => "{$folderPath}{$originalFileName}",
//         ]);
//     }
// }

}

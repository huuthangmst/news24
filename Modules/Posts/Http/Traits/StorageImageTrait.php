<?php

namespace Modules\Posts\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * function storageTraitUpload ($request, $fieldName, $foderName)
 * @return data: file_name and file_path
 */
trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $foderName)
    {
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            // file gốc = get file in client (Lấy tên file)
            $filenameOrigin = $file->getClientOriginalName();

            // hash file name
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension(); // lấy đuôi file

            // đường dẫn
            $filePath = $request->file($fieldName)->storeAs('public/' . $foderName, $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $filenameOrigin,  // Đã lấy được tên file gốc ở phía trên
                'file_path' => Storage::url($filePath), // Đường dẫn ảnh lấy url đã được định nghĩa ở trên
            ];
            return $dataUploadTrait; // Giá trị đã được trả về
        }
        return null;
    }
}
<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachmentFilesTrait
{
    public function uploadFile($request, $name, $file)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/'.$file.'/',$file_name,'upload-attachments');
    }

    public function deleteFile($name, $file)
    {
        $exist = Storage::disk('upload-attachments')->exists('attachments/'.$file.'/'.$name);
        if (isset($exist))
        {
            Storage::disk('upload-attachments')->delete('attachments/'.$file.'/'.$name);
        }
    }
}

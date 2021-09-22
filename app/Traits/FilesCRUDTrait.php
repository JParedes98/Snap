<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FilesCRUDTrait {

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function storeFile(Request $request, $user) {
        return File::create([
            'title'         => $request->title,
            'name'          => $request->pdf->getClientOriginalName(),
            'location'      => $request->pdf->store('files'),
            'size'          => $request->pdf->getSize(),
            'mime'          => $request->pdf->getMimeType(),
            'is_private'    => $request->isPrivate,
            'user_id'       => $user->id
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @param $fileId
     * @return mixed
     */
    public function updateFile(Request $request, $user, $fileId) {

        $file = File::where('id', $fileId)->where('user_id', $user->id)->firstOrFail();
        Storage::delete('files', $file->location);

        return $file->update([
            'title'         => $request->title,
            'name'          => $request->pdf->getClientOriginalName(),
            'location'      => $request->pdf->store('files'),
            'size'          => $request->pdf->getSize(),
            'mime'          => $request->pdf->getMimeType(),
            'is_private'    => $request->isPrivate,
            'user_id'       => $user->id
        ]);
    }

    /**
     * @param $user
     * @param $fileId
     * @return mixed
     */
    public function deleteFile($user, $fileId) {
        $file = File::where('id', $fileId)->where('user_id', $user->id)->firstOrFail();
        Storage::delete('files', $file->location);
        return $file->delete();
    }
}


?>

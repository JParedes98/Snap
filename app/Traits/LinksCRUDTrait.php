<?php

namespace App\Traits;

use App\Models\Link;
use Illuminate\Http\Request;

trait LinksCRUDTrait {

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function createLink(Request $request, $user) {
        return Link::create([
            'title'             => $request->title,
            'url'               => $request->url,
            'is_private'        => $request->isPrivate,
            'open_in_new_tab'   => $request->openNewTab,
            'user_id'           => $user->id
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @param $linkId
     * @return mixed
     */
    public function updateLink(Request $request, $user, $linkId) {
        return Link::where('id', $linkId)->where('user_id', $user->id)->firstOrFail()->update([
            'title'             => $request->title,
            'url'               => $request->url,
            'is_private'        => $request->isPrivate,
            'open_in_new_tab'   => $request->openNewTab,
        ]);
    }

    /**
     * @param $user
     * @param $linkId
     * @return mixed
     */
    public function deleteLink($user, $linkId) {
        return Link::where('id', $linkId)->where('user_id', $user->id)->firstOrFail()->delete();
    }
}


?>

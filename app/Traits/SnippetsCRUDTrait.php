<?php

namespace App\Traits;

use App\Models\Snippet;
use Illuminate\Http\Request;

trait SnippetsCRUDTrait {

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function createSnippet(Request $request, $user) {
        return Snippet::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'html'          => $request->html,
            'is_private'    => $request->isPrivate ? true : false,
            'user_id'       => $user->id
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @param $snippetId
     * @return mixed
     */
    public function updateSnippet(Request $request, $user, $snippetId) {
        return Snippet::where('id', $snippetId)->where('user_id', $user->id)->firstOrFail()->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'html'          => $request->html,
            'is_private'    => $request->isPrivate ? true : false,
            'user_id'       => $user->id
        ]);
    }

    /**
     * @param $user
     * @param $snippetId
     * @return mixed
     */
    public function deleteSnippet($user, $snippetId) {
        return Snippet::where('id', $snippetId)->where('user_id', $user->id)->firstOrFail()->delete();
    }
}


?>

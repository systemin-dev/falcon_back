<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::with('posts')->latest()->paginate(15);
        return view('post.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.tag.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create();

        foreach ($request->translations as $locale => $translation) {
            $tag->translations()->create([
                'locale' => $locale,
                'name' => $translation['name'],
            ]);
        }
        return redirect()->route('post.tag.index')->with('message', trans('post.tag_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('post.tag.edit', compact('tag'));
    }
    
    public function show(Tag $tag){
        return redirect()->route('post.tag.edit', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        foreach ($request->translations as $locale => $translation) {
            $tagTranslation = $tag->translations()->where('locale', $locale)->first();
            if ($tagTranslation) {
                $tagTranslation->update(['name' => $translation['name']]);
            } else {
                $tag->translations()->create([
                    'locale' => $locale,
                    'name' => $translation['name'],
                ]);
            }
        }

        return redirect()->route('post.tag.index')->with('message',  trans('post.tag_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('post.tag.index')->with('message', 'Tag Deleted !');
    }
}

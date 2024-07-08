<?php
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = App::currentLocale();
        $posts = Post::with([
            'category.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'user:id,name',
            'tags.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])->latest()->paginate(15);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('translations')->get();
        $tags = Tag::with('translations')->get();
        $locales = config('app.langages');

        return view('post.edit', compact('categories', 'tags', 'locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\post\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post_data = $request->safe()->except('image');

        if ($request->hasfile('image')) {
            $get_file = $request->file('image')->store('images/posts');
            $post_data['image'] = $get_file;
        }

        $post = Post::create($post_data);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        foreach ($request['translations'] as $locale => $translationData) {
            PostTranslation::create([
                'post_id' => $post->id,
                'locale' => $locale,
                'title' => $translationData['title'],
                'slug' => $translationData['slug'],
                'content' => $translationData['content'],
                'excerpt' => PostTranslation::generateExcerpt($translationData['content']),
            ]);
        }

        return redirect()->route('post.index')->with('message', trans('post.post_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::with('translations')->get();
        $tags = Tag::with('translations')->get();
        $locales = config('app.langages');
        
        return view('post.edit', compact('post', 'categories', 'tags', 'locales'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\post\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    public function update(PostRequest $request, Post $post)
    {
        $post_data = $request->safe()->except('image');

        if ($request->hasfile('image')) {
            Storage::delete($post->image);
            $get_file = $request->file('image')->store('images/posts');
            $post_data['image'] = $get_file;
        }

        $post->update($post_data);
        $post->tags()->sync($request->tags);

        foreach ($request['translations'] as $locale => $translationData) {
            $postTranslation = $post->translations()->where('locale', $locale)->first();
            $excerpt = PostTranslation::generateExcerpt($translationData['content']);
            $translationData['excerpt'] = $excerpt;

            if ($postTranslation) {
                $postTranslation->update($translationData);
            } else {
                PostTranslation::create([
                    'post_id' => $post->id,
                    'locale' => $locale,
                    'title' => $translationData['title'],
                    'slug' => $translationData['slug'],
                    'content' => $translationData['content'],
                    'excerpt' => $translationData['excerpt'],
                ]);
            }
        }

        return redirect()->route('post.index')->with('message', trans('post.post_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if ($post->image != null) {
            Storage::delete($post->image);
        }
        $post->delete();

        return back()->with('message', trans('post.post_deleted'));
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Post::class);

        return response()->json(['slug' => $slug]);
    }

    public function search(Request $request)
{
    $searched_text = $request->input('query');
    $locale = app()->getLocale(); // Récupérer la langue actuelle

    $posts = Post::query()
        ->with([
            'category.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'tags.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->whereHas('translations', function ($query) use ($searched_text, $locale) {
            $query->where('locale', $locale)
                ->where(function ($query) use ($searched_text) {
                    $query->where('title', 'LIKE', "%{$searched_text}%")
                          ->orWhere('content', 'LIKE', "%{$searched_text}%");
                });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    if ($request->ajax()) {
        $html = '';
        
        foreach ($posts as $post) {
            
            $html .= view('post.lign', compact('post'))->render();
        }
        return response()->json(['html' => $html]);
    }

    return view('post.index', compact('posts'));
}

}

<?php

namespace App\Http\Controllers\Post;

use App\Traits\SlugCreater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\CategoryTranslationRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class CategoryController extends Controller
{
    use SlugCreater;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('user:id,name')->latest()->paginate(15);

        return view('post.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.category.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        foreach ($request->translations as $locale => $translation) {
            $category->translations()->create([
                'locale' => $locale,
                'name' => $translation['name'],
                'slug' => $translation['slug'],
            ]);
        }
        return redirect()->route('category.index')->with('message', trans('post.category_created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return redirect()->route('post.category.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Charger les traductions associées à cette catégorie
        $category->load('translations');

        return view('post.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        foreach ($request->translations as $locale => $translation) {
            $categoryTranslation = $category->translations()->where('locale', $locale)->first();
            if ($categoryTranslation) {
                $categoryTranslation->update([
                    'name' => $translation['name'],
                    'slug' => $translation['slug'],
                ]);
            } else {
                $category->translations()->create([
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'slug' => $translation['slug'],
                ]);
            }
        }

        return redirect()->route('post.category.index')->with('message',  trans('post.category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('post.category.index')->with('message', trans('post.category_deleted'));
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Category::class);

        return response()->json(['slug' => $slug]);
    }
}

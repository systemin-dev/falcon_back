<?php
namespace App\Http\Controllers\Post;

use App\Traits\SlugCreater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use SlugCreater;

    public function index()
    {
        $pages = Page::with('user:id,name')->orderBy('id', 'desc')->paginate(15);

        return view('post.page.index', compact('pages'));
    }

    public function create()
    {

        return view('post.page.create');
    }

    public function store(PageRequest $request)
    {
        Page::create($request->validated());

        return to_route('post.page.index')->with('message', trans('post.page_created'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return to_route('post.page.index')->with('message', trans('post.page_updated'));
    }

    public function edit(Page $page)
    {

        return view('post.page.edit', compact('page'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('message', trans('post.page_deleted'));
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Page::class);

        return response()->json(['slug' => $slug]);
    }
}

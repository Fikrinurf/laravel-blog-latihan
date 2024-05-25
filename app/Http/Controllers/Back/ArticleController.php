<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $articles = Article::with('Category')->latest()->get();

            return DataTables::of($articles)
                ->addIndexColumn()
                ->addColumn('category_id', function ($articles) {
                    return $articles->Category->name;
                })
                ->addColumn('status', function ($articles) {
                    if ($articles->status == 0) {
                        return '<span class="badge bg-danger">Private</span>';
                    } else {
                        return '<span class="badge bg-success">Published</span>';
                    }
                })
                ->addColumn('button', function ($articles) {
                    return '
                <div>
                        <a href="article/' . $articles->id . '" class="btn btn-secondary text-white">Detail</a>
                        <a href="article/' . $articles->id . '/edit" class="btn btn-primary text-white">Edit</a>
                        <a href="" class="btn btn-danger text-white">Delete</a>
                </div>';
                })
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }

        return view('back.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', ['categories' => Category::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('img'); // ini fotonya
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension(); //memngambil extensi
        $file->storeAs('public/back/', $fileName); //masuk ke folder public/back

        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect(url('article'))->with('success', 'Data article has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.article.show', [
            'article' => Article::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.article.update', [
            'article' => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img'); // ini fotonya
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension(); //memngambil extensi
            $file->storeAs('public/back/', $fileName); //masuk ke folder public/back

            //menghapus gambar lama
            Storage::delete('public/back' . $request->oldImg);
            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }

        $data['slug'] = Str::slug($data['title']);

        Article::find($id)->update($data);

        return redirect(url('article'))->with('success', 'Data article has been created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

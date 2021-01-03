<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\resources\Article as ArticleResource;
use App\Http\resources\ArticleCollection;


use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return new ArticleCollection(Article::paginate(50));
    }

    public function show(Article $article)
    {
        return response()->json( new ArticleResource($article));
    }

    public function store(Request $request)
    {
        return Article::create($request->all());
        return response()->json($article,201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response() ->json($article,200);
    }

    public function delete(Request $request, Article $article)
    {
        $article->delete();
        return response() ->json(null,204);
    }

}

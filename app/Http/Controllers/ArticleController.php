<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\resources\Article as ArticleResource;
use App\Http\resources\ArticleCollection;


use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private static $rules=[
        'title' => 'required|string|unique:articles|max:255',
        'body' => 'required'
    ];
    private static $messages=[
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'Campo body no valido.',
    ];

    public function index()
    {
        return new ArticleCollection(Article::paginate(50));
        //return response()->json(new ArticleCollection(Article::all()),200);
    }

    public function show(Article $article)
    {
        return response()->json( new ArticleResource($article),200);
    }

    public function store(Request $request)
    {

        $request->validate(self::$rules, self::$messages);
        $article = Article::create($request->all());
        return response()->json(new ArticleResource($article), 201);
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

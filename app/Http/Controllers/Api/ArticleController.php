<?php

namespace App\Http\Controllers\Api;

use App\Models\article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\articleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
   
    public function index()
    {
        $data = article::with('user')->get();
        return response()->json(new ArticleCollection($data));
    }


    public function store(articleRequest $request)
    {
       $article = article::with('user')->create($request->all());
       if($article){
           return response()->json(['data'=>new ArticleResource($article) ,'status'=>'success','message'=>'article was created'],200);
       }else{
        return response()->json(['data'=>[] ,'status'=>'error','message'=>'article not created'],405);

       }
    }

    public function show($id)
    {
       $article = article::findOrFail($id);
       if($article){
           return response()->json(['data'=>new ArticleResource($article) ,'status'=>'success','message'=>'article '],200);
       }else{
        return response()->json(['data'=>[] ,'status'=>'error','message'=>'article not created'],405);

       }
    }


    public function update(Request $request ,$id)
    {
        $article = article::findOrFail($id);
        $article->update($request->all());
            return response()->json(['data'=>new ArticleResource($article) ,'status'=>'success','message'=>'article was updated'],200);
    
    }

    
    public function destroy(article $article)
    {
        if($article->delete()){
            return response()->json(['data'=>[] ,'status'=>'success','message'=>'article was deleted'],200);
        }else{
         return response()->json(['status'=>'error','message'=>' not delete'],405);
 
        }
    }
}

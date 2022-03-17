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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = article::with('user')->get();
        return response()->json(new ArticleCollection($data));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(articleRequest $request)
    {
       $article = article::with('user')->create($request->all());
       if($article){
           return response()->json(['data'=>new ArticleResource($article) ,'status'=>'success','message'=>'article was created'],200);
       }else{
        return response()->json(['data'=>[] ,'status'=>'error','message'=>'article not created'],405);

       }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(articleRequest $request , article $article)
    {
        if($article->update($request->all())){
            return response()->json(['status'=>'success','message'=>'article was updated'],200);
        }else{
         return response()->json(['status'=>'error','message'=>' not update'],405);
 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        if($article->delete()){
            return response()->json(['data'=>[] ,'status'=>'success','message'=>'article was deleted'],200);
        }else{
         return response()->json(['status'=>'error','message'=>' not delete'],405);
 
        }
    }
}

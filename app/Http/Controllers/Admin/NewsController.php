<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsEditRequest;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    private const page_name = "news";

    private function MyUploadFile($file){
        $extension = $file->extension();
        $imgName = time().'_'.Str::slug($file->getClientOriginalName()).'.'.$extension ;
    
        $file->move(public_path().'/site/news', $imgName);
        return '/site/news/'.$imgName;
    }

    public function list()
    {
        $news = News::orderBy('id','desc')->get();

        return view("adminView.news.list",[
            "news"=>$news,
            "page"=>self::page_name
        ]);
    }
    public function create_view()
    {
        return view("adminView.news.create",[
            "page"=>self::page_name
        ]);
    }
    public function create(NewsRequest $newsRequest)
    {
        $news = new News();
        $news->slug = Str::slug(($newsRequest->title).'-'.time(),'-');
        $news->description = $newsRequest->description;
        $news->content = $newsRequest->content;
        $news->title = $newsRequest->title;
        $news->keywords = $newsRequest->keywords;
        // traiter l'image
        $n = $this->MyUploadFile($newsRequest->file('image'));
        $news->image = $n;
        $news->save();
        // send email for newsletter subscribers
        flash("Actualité créé avec succès")->success();
        
        return redirect()->route("admin.news.home");
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view("adminView.news.show",[
            "page"=>self::page_name,
            "news"=>$news
        ]);
    }

    public function edit_view($id)
    {
        $news = News::findOrFail($id);
        return view("adminView.news.edit",[
            "page"=>self::page_name,
            "news"=>$news
        ]);
    }
    public function edit($id,NewsEditRequest $request)
    {
        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->content = $request->content;
        $news->keywords = $request->keywords;
        if($request->hasFile('image')){
            $n = $this->MyUploadFile($request->file('image'));
            $old = $news->image;
            $news->image = $n;
            if(File::exists(public_path().$old)){
                File::delete(public_path().$old);
            }
        }
        $news->save();

        flash("Actualité modifié avec succès")->info();
        
        return redirect()->route("admin.news.home");
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        $image = $news->image;
        if(File::exists(public_path().$image)){
            File::delete(public_path().$image);
        }
        flash("Actualité supprimé avec succès")->warning();
        return redirect()->route("admin.news.home");
    }
}

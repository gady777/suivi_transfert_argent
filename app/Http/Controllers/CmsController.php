<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Cms;
use App\Models\CmsFaq;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    public function about(){
        $ab = Cms::where('name','about')->first();
        return view('about',[
            "about"=>$ab
        ]);
    }

    public function faq(Request $r){
        $q = $r->query->get('q');
        if($q){
            $f = CmsFaq::where('question','LIKE','%'.$q.'%')->get();
        }else{
            $f = CmsFaq::all();
        }
        return view('faq',[
            "faqs"=>$f,
            "q"=>$q
        ]);
    }

    public function news(){
        $news = News::all();
        return view('blog',[
            "news"=>$news
        ]);
    }
    public function news_detail($slug){
        $news = News::where('slug',$slug)->first();
        if(!$news){
            abort(404);
        }
        return view('blog_detail',[
            "news"=>$news
        ]);
    }
    public function terms(){
        $terms = Cms::where('name','terms')->first();
        return view('terms',[
            "terms"=>$terms,
        ]);
    }
    public function conditions(){
        $terms = Cms::where('name','conditions')->first();
        return view('conditions',[
            "conditions"=>$terms,
        ]);
    }
    public function privacy(){
        $priv = Cms::where('name','privacy')->first();
        return view('privacy',[
            'privacy'=>$priv,
        ]);
    }
    public function services(){
        $priv = Cms::where('name','services')->first();
        return view('services',[
            "about"=>$priv
        ]);
    }
    public function contact_view(){
        return view('contact',[
            
        ]);
    }
    public function contact_post(Request $request){
        $inp = $request->all();
        $val = Validator::make($inp,[
            "name"=>['required'],
            "fname"=>["required"],
            "email"=>["required"],
            "message"=>['required'],
        ]);
        if($val->fails()){
            return back()->withErrors($val);
        }
        //
        Mail::to("hello@transfertunion.com")
              ->send(new ContactMail(
                  $request
              ));

        return redirect()->route('contact')->with("success","Message envoyé avec succès");
    }

    public function security(){
        $priv = Cms::where('name','security')->first();
        return view('security',[
            "about"=>$priv
        ]);
    }
    public function emploi(){
        $priv = Cms::where('name','emploi')->first();
        return view('emploi',[
            "about"=>$priv
        ]);
    }
}


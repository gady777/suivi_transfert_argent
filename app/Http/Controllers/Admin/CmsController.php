<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CmsFaqRequest;
use App\Http\Requests\CmsRequest;
use App\Models\Cms;
use App\Models\CmsFaq;
use Illuminate\Support\Facades\File;

class CmsController extends Controller
{
    private const page = "cms";

    private function MyUploadFile($file,$name){
        $extension = $file->extension();
        $imgName = time().'_'.$name.'.'.$extension ;
    
        $file->move(public_path().'/assets/images', $imgName);
        return '/assets/images/'.$imgName;
    }

    public function index_all()
    {
        $cms = Cms::all();
        return view("adminView.cms.list",[
            "pages"=>$cms,
            "page"=>self::page
        ]);
    }
    public function create_view()
    {
        return view("adminView.cms.create",[
            "page"=>self::page
        ]);
    }
    public function create(CmsRequest $request)
    {
        $cms = new Cms();

        $cms->name = $request->name;
        $cms->slug = $request->slug;
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->content = $request->content;
        // les images
        if($request->hasFile('image')){
            $n = $this->MyUploadFile($request->file('image'),'image');
            $cms->image = $n;
        }else{
            flash("Vous devez ajouter une image")->error();
            return back()->withInput($request->all()); 
        }
        $cms->save();

        flash("Les informations sont modifiées avec succès")->success();

        return redirect()->route("admin.cms.home");
    }
    public function edit_view($id)
    {
        $cms = Cms::findOrFail($id);
        return view("adminView.cms.edit",[
            "cms"=>$cms,
            "page"=>self::page
        ]);
    }
    public function show($id){
        $cms = Cms::findOrFail($id);
        return view("adminView.cms.show",[
            "page"=>self::page,
            "cms"=>$cms
        ]);
    }
    public function edit(CmsRequest $request,$id)
    {
        $cms = Cms::findOrFail($id);
        $cms->name = $request->name;
        $cms->slug = $request->slug;
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->content = $request->content;
        // les images
        if($request->hasFile('image')){
            $n = $this->MyUploadFile($request->file('image'),'image');
            $old = $cms->image;
            $cms->image = $n;
            if(File::exists(public_path().$old)){
                File::delete(public_path().$old);
            }
        }
        $cms->save();

        flash("Les informations sont modifiées avec succès")->success();

        return redirect()->route("admin.cms.home");
    }
    public function delete($id)
    {
        $cms = Cms::findOrFail($id);
        $cms->delete();
        flash("Page supprimée avec succès")->error();
        return redirect()->route("admin.cms.home");
    }
    public function list_faq()
    {
        $faqs = CmsFaq::orderBy('id','DESC')->get();
        return view("adminView.cms.faq.list",[
            "faqs"=>$faqs,
            "page"=>"faq"
        ]);
    }

    public function create_faq_view()
    {
        return view("adminView.cms.faq.create",[
            "page"=>"faq"
        ]);
    }

    public function create_faq(CmsFaqRequest $request)
    {
        $faq = new CmsFaq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->save();
        flash("FAQ mise à jour avec succès")->success();
        return redirect()->route("admin.cms.faq.home");
    }

    public function edit_faq_view($id)
    {
        $faq = CmsFaq::findOrFail($id);
        return view("adminView.cms.faq.edit",[
            "faq"=>$faq,
            "page"=>"faq"
        ]);
    }

    public function edit_faq(CmsFaqRequest $request,$id)
    {
        $faq = CmsFaq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->save();
        flash("FAQ mise à jour avec succès")->success();
        return redirect()->route("admin.cms.faq.home");
    }

    public function delete_faq($id)
    {
        $faq = CmsFaq::findOrFail($id);
        $faq->delete();
        flash("FAQ supprimée avec succès")->error();
        return redirect()->route("admin.cms.faq.home");
    }
    
}

@extends('layout.templateNo1')
@section ('title')
{{$news->title}} | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<div class="uk-section uk-margin-small-top">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center in-blog-1 in-article">
                    <div class="uk-width-1-1 in-figure-available">
                        <img class="uk-width-1-1 uk-border-rounded img-fluid" 
                        src="{{asset($news->image)}}" alt="sample-image">
                    </div>
                    <div class="uk-width-3-4@m">
                        <article class="uk-card uk-card-default uk-border-rounded">
                            <div class="uk-card-body">
                                <div class="uk-flex uk-flex-middle uk-margin-remove-bottom">
                                    <div class="uk-margin-small-right">
                                        <img class="uk-border-pill uk-background-muted" 
                                        src="{{asset('assets/img/in-team-5.png')}}" alt="image-team"
                                         width="24" height="24">
                                    </div>
                                    <div>
                                        <p class="uk-text-small uk-text-muted uk-margin-remove-bottom">
                                            <a href="javascript:void(0)">Transfert Union</a>
                                            <span class="uk-margin-small-left 
                                            uk-margin-small-right">•</span>
                                            {{date('d M Y',strtotime($news->created_at))}}
                                        </p>
                                    </div>
                                </div>
                                <h2 class="uk-margin-top uk-margin-medium-bottom">
                                    {{$news->title}}
                                </h2>
                                {!! $news->content !!}
                            </div>
                            <div class="uk-card-footer uk-clearfix">
                                <div class="uk-float-left in-article-tags">
                                    <i class="fas fa-tags"></i>
                                    <span class="uk-margin-small-left uk-text-bold">Mots clés: &nbsp;</span>
                                    @php $ks = explode(',',$news->keywords) ; @endphp
                                    @foreach($ks as $k)
                                    <a href="javascript:void(0)" class="uk-link-muted badge badge-default">{{$k}}</a>
                                    @endforeach
                                </div>
                                <div class="uk-float-right in-article-share">
                                    <a href="https://www.facebook.com/sharer.php?u={{route('news.detail',['slug'=>$news->slug],true)}}" data-uk-tooltip="Partager sur Facebook" 
                                    class="uk-label uk-border-pill in-brand-facebook"><i class="fab fa-facebook-f fa-sm"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{route('news.detail',['slug'=>$news->slug],true)}}&text={{$news->title}}" data-uk-tooltip="Partager sur Twitter" 
                                    class="uk-label uk-border-pill in-brand-twitter"><i class="fab fa-twitter fa-sm"></i></a>
                                    <a href="https://www.pinterest.com/pin/create/button?url={{route('news.detail',['slug'=>$news->slug],true)}}&description={{$news->title}}" data-uk-tooltip="Partager sur Pinterest" 
                                    class="uk-label uk-border-pill in-brand-pinterest"><i class="fab fa-pinterest-p fa-sm"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
@endsection

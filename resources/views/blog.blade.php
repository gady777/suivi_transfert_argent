@extends('layout.templateNo1')
@section ('title')
Notre blog | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<div class="uk-section uk-margin-small-top">
            <div class="uk-container">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-2-3@m">
                        <div class="uk-child-width-1-2@m in-blog-1" data-uk-grid>
                            @forelse ($news as $n)
                            <div class="uk-width-1-1">
                                <article class="uk-card uk-card-default uk-border-rounded">
                                    <div class="uk-card-media-top">
                                        <img src="{{asset($n->image)}}" alt="sample-image">
                                    </div>
                                    <div class="uk-card-body">
                                        <h3>
                                            <a href="{{route('news.detail',['slug'=>$n->slug])}}">
                                                {{$n->title}}</a>
                                        </h3>
                                        <p>
                                            {{$n->description}}
                                        </p>
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="uk-margin-small-right">
                                                <img class="uk-border-pill uk-background-muted" 
                                                src="{{asset('assets/img/in-team-5.png')}}" alt="image-team" 
                                                width="24" height="24">
                                            </div>
                                            <div>
                                                <p class="uk-text-small uk-text-muted uk-margin-remove-bottom">
                                                    <a href="javascript:void(0)">Transfert Union</a>
                                                    <span class="uk-margin-small-left uk-margin-small-right">•</span>
                                                    {{date('d-m-Y',strtotime($n->created_at))}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-card-footer uk-clearfix">
                                       {{-- <div class="uk-float-left">
                                            <a href="#"><span class="uk-label uk-label-success uk-text-small
                                             uk-border-pill">Automotive</span></a>
                                        </div>--}}
                                        <div class="uk-float-right">
                                            <a href="{{route('news.detail',['slug'=>$n->slug])}}" 
                                            class="uk-button uk-button-text">Lire plus<i class="fas fa-long-arrow-alt-right uk-margin-small-left"></i></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @empty 
                                Aucun élément pour le moment
                            @endforelse
                        </div>
                        <!-- module pagination begin -->
                        {{--<ul class="uk-pagination uk-flex-center uk-margin-medium-top">
                            <li class="uk-active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fas fa-angle-right fa-xs"></i></a></li>
                        </ul>--}}
                        <!-- module pagination end -->
                    </div>
                    <div class="uk-width-expand@m">
                        {{--
                        <!-- widget content begin -->
                        <aside class="uk-margin-medium-bottom">
                            <form class="uk-search uk-search-default uk-width-1-1">
                                <a href="" class="uk-search-icon-flip" data-uk-search-icon></a>
                                <input class="uk-input uk-border-pill" type="search" placeholder="Search here...">
                            </form>
                        </aside>
                        <!-- widget content end -->
                        <!-- widget content begin -->
                        <aside class="uk-margin-medium-bottom">
                            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                                <h5 class="uk-heading-bullet uk-text-uppercase uk-margin-remove-bottom">Categories</h5>
                                <ul class="uk-list in-widget-category">
                                    <li><a href="#">Top stories<span class="uk-label uk-label-success uk-text-small uk-border-pill uk-float-right">2</span></a></li>
                                    <li><a href="#">Investments<span class="uk-label uk-label-success uk-text-small uk-border-pill uk-float-right">6</span></a></li>
                                    <li><a href="#">Opinions<span class="uk-label uk-label-success uk-text-small uk-border-pill uk-float-right">3</span></a></li>
                                    <li><a href="#">Community<span class="uk-label uk-label-success uk-text-small uk-border-pill uk-float-right">4</span></a></li>
                                    <li><a href="#">News<span class="uk-label uk-label-success uk-text-small uk-border-pill uk-float-right">7</span></a></li>
                                </ul>
                            </div>
                        </aside>
                        <!-- widget content end -->
                        <!-- widget content begin -->
                        <aside class="uk-margin-medium-bottom">
                            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                                <h5 class="uk-heading-bullet uk-text-uppercase uk-margin-remove-bottom">Popular</h5>
                                <ul class="uk-list in-widget-popular">
                                    <li>
                                        <div class="uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                                            <div class="uk-width-auto">
                                                <img class="uk-border-rounded" src="img/in-widget-image-1.jpg" alt="sample-image" width="74" height="74">
                                            </div>
                                            <div class="uk-width-expand uk-margin-left">
                                                <a href="#">Brexit effects may reflect in business ...
                                                    <span class="uk-article-meta uk-text-small"><br><i class="fas fa-clock fa-sm uk-margin-small-right"></i>Wed Apr 5, 2019</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                                            <div class="uk-width-auto">
                                                <img class="uk-border-rounded" src="img/in-widget-image-2.jpg" alt="sample-image" width="74" height="74">
                                            </div>
                                            <div class="uk-width-expand uk-margin-left">
                                                <a href="#">Investors bet on a quiet tech revolu ...
                                                    <span class="uk-article-meta uk-text-small"><br><i class="fas fa-clock fa-sm uk-margin-small-right"></i>Tue Apr 15, 2019</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                                            <div class="uk-width-auto">
                                                <img class="uk-border-rounded" src="img/in-widget-image-3.jpg" alt="sample-image" width="74" height="74">
                                            </div>
                                            <div class="uk-width-expand uk-margin-left">
                                                <a href="#">Destructive weed threatens U.S. corn ...
                                                    <span class="uk-article-meta uk-text-small"><br><i class="fas fa-clock fa-sm uk-margin-small-right"></i>Mon Apr 4, 2019</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                        <!-- widget content end -->
                        <!-- widget content begin -->
                        <aside class="uk-margin-medium-bottom">
                            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                                <h5 class="uk-heading-bullet uk-text-uppercase uk-margin-remove-bottom">Tags</h5>
                                <div class="uk-margin-top in-widget-tag">
                                    <a href="#"><span class="uk-label uk-border-pill">Asia</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Business</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Startups</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Automotive</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Travels</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Politics</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Marketing</span></a>
                                    <a href="#"><span class="uk-label uk-border-pill">Technology</span></a>
                                </div>
                            </div>
                        </aside>
                        --}}
                        <!-- widget content end -->
                    </div>
                </div>
            </div>
        </div>
@endsection

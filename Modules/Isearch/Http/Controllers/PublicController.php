<?php

namespace Modules\Isearch\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iblog\Entities\Post;
use Modules\Isearch\Http\Requests\IsearchRequest;
use Modules\Setting\Contracts\Setting;
use Illuminate\Support\Facades\Input;
use Modules\Page\Entities\Page;

use Log;

class PublicController extends BasePublicController
{

    /**
     * @var Application
     */
    private $search;
    /**
     * @var setingRepository
     */
    private $seting;
    private $post;


    public function __construct(Setting $setting)
    {
        parent::__construct();

        $this->seting = $setting;
        $this->post = Post::query();
        $this->page = Page::query();

    }


    public function search(Request $request)
    {

        $searchphrase = $request->input('q');
        $take=12;
        if(config('asgard.isearch.config.queries.iblog')){
            $posts=app('Modules\Iblog\Repositories\PostRepository');
            $items=$posts->getItemsBy(json_decode(json_encode(['filter'=>['search'=>$searchphrase],'page'=>$request->page??1, 'take'=> $take, 'include'=>['user']])));
            $result['post']=["title"=>trans('iblog::post.title.posts'),'items'=>$items];
        }


        if(config('asgard.isearch.config.queries.page')){
            $pages=app('Modules\Page\Repositories\PageRepository');
            $items=$pages->getItemsBy(json_decode(json_encode(['filter'=>['search'=>$searchphrase],'page'=>$request->page??1, 'take'=> $take])));
            $result['page']=["title"=>trans('page::pages.title'),'items'=>$items];
        }


        if(config('asgard.isearch.config.queries.iplaces')){
            $posts=app('Modules\Iplaces\Repositories\PlaceRepository');
            $items=$posts->getItemsBy(json_decode(json_encode(['filter'=>['search'=>$searchphrase],'page'=>$request->page??1, 'take'=> $take, 'include'=>['user']])));
            $result['places']=["title"=>trans('iplaces::places.title.places'),'items'=>$items];
        }
        if(config('asgard.isearch.config.queries.iperformers')){
            $posts=app('Modules\Iplaces\Repositories\PlaceRepository');
            $items=$posts->getItemsBy(json_decode(json_encode(['filter'=>['search'=>$searchphrase],'page'=>$request->page??1, 'take'=> $take, 'include'=>['user']])));
            $result['places']=["title"=>trans('iplaces::places.title.places'),'items'=>$items];
        }
        $tpl = 'isearch::index';
        $ttpl = 'isearch.index';
        if (view()->exists($ttpl)) $tpl = $ttpl;

        return view($tpl, compact('result', 'searchphrase'));


    }

}

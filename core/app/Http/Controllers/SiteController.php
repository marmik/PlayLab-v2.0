<?php

namespace App\Http\Controllers;
use App\Models\AdminNotification;
use App\Models\Advertise;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Frontend;
use App\Models\History;
use App\Models\Item;
use App\Models\Language;
use App\Models\LiveTelevision;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function index(){
        $pageTitle = 'Home';
        $sliders = Slider::orderBy('id','desc')->where('status',1)->with('item','item.category','item.video')->get();
        $featuredMovies = Item::active()->hasVideo()->where('featured',1)->orderBy('id','desc')->get(['title','image','id','version','item_type', 'category_id', 'sub_category_id', 'view']);
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sliders', 'featuredMovies'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact',compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug,$id)
    {
        $policy = Frontend::where('id',$id)->where('data_keys','policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate.'policy',compact('policy','pageTitle'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    public function blogDetails($slug,$id){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle'));
    }


    public function cookieAccept(){
        $general = gs();
        Cookie::queue('gdpr_cookie',$general->site_name , 43200);
        return back();
    }

    public function cookiePolicy(){
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys','cookie.data')->first();
        return view($this->activeTemplate.'cookie',compact('pageTitle','cookie'));
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general = gs();
        if($general->maintenance_mode == 0){
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys','maintenance.data')->first();
        return view($this->activeTemplate.'maintenance',compact('pageTitle','maintenance'));
    }

    public function getSection(Request $request){
       
        if ($request->sectionName == 'end') {
            return response('end');
        }

        if ($request->sectionName == 'recent_added') {
            // $data['recent_added'] = Item::hasVideo()->orderBy('id','desc')->where('item_type',1)->limit(18)->get(['title','image','id','version','item_type']);
            $data['recent_added'] = Item::hasVideo()->where('item_type',1)->limit(18)->get(['title','image','id','version','item_type']);

        }elseif($request->sectionName == 'latest_series'){

            $data['latestSerieses'] = Item::hasVideo()->orderBy('id','desc')->where('item_type',2)->limit(12)->get(['title','image','id','version','item_type']);

        }elseif($request->sectionName == 'single'){

            $data['single'] = Item::hasVideo()->orderBy('id','desc')->where('single',1)->with('category')->first(['image','title','ratings','preview_text','view','ratings','id','version','item_type']);

        }elseif($request->sectionName == 'latest_trailer'){

            $data['latest_trailers'] = Item::hasVideo()->where('item_type',3)->orderBy('id','desc')->limit(12)->get(['image','title','ratings','id']);

        }elseif($request->sectionName == 'free_zone'){

            $data['frees'] = Item::hasVideo()->free()->orderBy('id','desc')->limit(12)->get(['image','title','id']);

        }elseif($request->sectionName == 'top'){

            $data['mostViewsTrailer'] = Item::hasVideo()->where('item_type',3)->orderBy('view','desc')->first();
            $data['topRateds'] = Item::hasVideo()->orderBy('ratings','desc')->limit(4)->get(['image','title','ratings','view','id','version','item_type']);
            $data['trendings'] = Item::hasVideo()->orderBy('view','desc')->where('trending',1)->limit(4)->get(['image','title','ratings','view','id','version','item_type']);

        }elseif($request->sectionName == 'single1' || $request->sectionName == 'single2' || $request->sectionName == 'single3'){
            $data['single'] = Item::hasVideo()->orderBy('id','desc')->where('single',1)->with('category')->get(['image','title','ratings','preview_text','view','ratings','id','version','item_type']);

        }
        return view($this->activeTemplate.'sections.'.$request->sectionName,$data);
    }

    public function watchVideo($id, $episodeId=null){
        $item = Item::where('status',1)->where('id',$id)->firstOrFail();
        $item->increment('view');

        if ($item->item_type == 2) {
            $episodes = Episode::hasVideo()->with('video')->where('item_id',$item->id)->get();
            $relatedEpisodes = Item::hasVideo()->orderBy('id','desc')->where('item_type',2)->where('id', '!=', $id)->limit(6)->get(['image','id','version','item_type']);
            $pageTitle = 'Episode Details';

            if ($episodes->count() <= 0) {
                $notify[] = ['error','Oops! There is no video'];
                return back()->withNotify($notify);
            }

            $subscribedUser = auth()->check() && (auth()->user()->exp > now());

            if($episodeId){
                $episode = Episode::hasVideo()->findOrFail($episodeId);
                $firstVideo = $episode->video;
                $firstVideoImg = $episode->image;
                $watch = !$episode->version ? 1 : ($subscribedUser ?? 0);
                $activeEpisode = $episode;
            }else{
                $watch = 1;
                $firstVideo = $episodes[0]->video;
                $firstVideoImg = $episodes[0]->image;
                $activeEpisode = $episodes[0];
    
                if(!$subscribedUser){
                    $firstEpisode = $episodes->where('version', 0)->first();
                    if($firstEpisode){
                        $firstVideo = $episodes->where('version', 0)->first()->video;
                        $firstVideoImg = $episodes->where('version', 0)->first()->image;
                        $activeEpisode = $firstEpisode;
                    }else{
                        $watch = 0;
                    }
                }
            }
            
            $firstVideoFile = getVideoFile($firstVideo);
            $watch ? $this->storeHistory(null, $activeEpisode->id) : '';

            return view($this->activeTemplate.'watch_episode',compact('pageTitle','item','episodes', 'relatedEpisodes', 'firstVideoFile', 'firstVideoImg', 'watch', 'activeEpisode'));
        }
        $video = $item->video;
        $videoFile = getVideoFile($video);
        
        $watch = !$item->version ? 1 : ((auth()->check() && auth()->user()->exp > now()) ? 1 : 0);
        $watch ? $this->storeHistory($item->id) : '';

        $pageTitle = 'Movie Details';
        $relatedItems = Item::hasVideo()->orderBy('id','desc')->where('item_type',1)->where('id', '!=', $id)->limit(6)->get(['image','id','version','item_type']);
        
        
        $seoContents['keywords']           = $item->meta_keywords ?? [];
        $seoContents['social_title']       = $item->title;
        $seoContents['description']        = strLimit(strip_tags($item->description), 150);
        $seoContents['social_description'] = strLimit(strip_tags($item->description), 150);
        $seoContents['image']              = getImage(getFilePath('item_landscape').'/'.$item->image->landscape);
        $seoContents['image_size']         = '900x600';

        
        return view($this->activeTemplate.'watch',compact('pageTitle','item','videoFile', 'relatedItems', 'watch', 'seoContents'));
    }

    private function storeHistory($itemId=null, $episodeId=null)
    {
        if(auth()->check()){
            
            if($itemId){
                $history = History::where('user_id', auth()->id())->orderBy('id', 'desc')->limit(1)->first();
                if(!$history || ($history && $history->item_id != $itemId)){
                    $history          = new History();
                    $history->user_id = auth()->id();
                    $history->item_id = $itemId;
                    $history->save();
                }
            }
            if($episodeId){
                $history = History::where('user_id', auth()->id())->orderBy('id', 'desc')->limit(1)->first();
                if(!$history || ($history && $history->episode_id != $episodeId)){
                    $history             = new History();
                    $history->user_id    = auth()->id();
                    $history->episode_id = $episodeId;
                    $history->save();
                }
            }
        }
    }
    
    public function category($id){
        $category = Category::findOrFail($id);
        $items = Item::hasVideo()->where('category_id',$id)->where('status', 1)->orderBy('id','desc')->limit(12)->get();
        $pageTitle = $category->name;
        return view($this->activeTemplate.'items',compact('pageTitle','items','category'));
    }

    public function subCategory($id){
        $subcategory = SubCategory::findOrFail($id);
        $items = Item::hasVideo()->where('sub_category_id',$id)->orderBy('id','desc')->limit(12)->get();
        $pageTitle = $subcategory->name;
        return view($this->activeTemplate.'items',compact('pageTitle','items','subcategory'));
    }

    public function search(Request $request){
        $search = $request->search;
        if (!$search) {
            return redirect()->route('home');
        }
        $items = Item::search($search)->where('status',1)->where(function($query){
            $query->orWhereHas('video')->orWhereHas('episodes',function($video){
                $video->where('status',1)->whereHas('video');
            });
        })->orderBy('id','desc')->limit(12)->get();
        $pageTitle = "Result Showing For ".$search;
        return view($this->activeTemplate.'items',compact('pageTitle','items','search'));
    }
    public function loadMore(Request $request){
        if (isset($request->category_id)) {
            $data['category'] = Category::find($request->category_id);
            $data['items'] = Item::hasVideo()->where('category_id',$request->category_id)->orderBy('id','desc')->where('id','<',$request->id)->take(6)->get();
        }elseif(isset($request->subcategory_id)){
            $data['sub_category'] = SubCategory::find($request->subcategory_id);
            $data['items'] = Item::hasVideo()->where('sub_category_id',$request->subcategory_id)->orderBy('id','desc')->where('id','<',$request->id)->take(6)->get();
        }elseif(isset($request->search)){
            $data['search'] = $request->search;
            $data['items'] = Item::hasVideo()->search($request->search)->orderBy('id','desc')->where('id','<',$request->id)->take(6)->get();
        }else{
            return response('end');
        }

        if ($data['items']->count() <= 0) {
            return response('end');
        }

        return view($this->activeTemplate.'item_ajax',$data);
    }

    public function policy($id,$slug)
    {
        $item = Frontend::where('id',$id)->where('data_keys','policy_pages.element')->firstOrFail();
        $pageTitle = $item->data_values->title;
        return view($this->activeTemplate.'links_details',compact('pageTitle','item'));
    }

    public function links($id,$slug)
    {
        $item = Frontend::where('id',$id)->where('data_keys','short_links.element')->firstOrFail();
        $pageTitle = $item->data_values->title;
        return view($this->activeTemplate.'links_details',compact('pageTitle','item'));
    }

    public function subscribe(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:40|unique:subscribers',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $subscribe        = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->save();
        return response()->json(['success'=>'Subscribe successfully']);
    }

    public function liveTelevision($id=0)
    {
        $pageTitle = 'Live TV list';
        $tvs = LiveTelevision::where('status', 1)->get();
        return view($this->activeTemplate.'live_tvs',compact('pageTitle','tvs'));
    }

    public function watchTelevision($id)
    {
        $tv = LiveTelevision::active()->findOrFail($id);
        $pageTitle = $tv->title;
        $otherTv = LiveTelevision::active()->where('id','!=',$id)->get();
        return view($this->activeTemplate.'watch_tv',compact('pageTitle','tv','otherTv'));
    }

    public function addWishList(Request $request)
    {
        if(!auth()->check()){
            $notify = 'You must be login to add an item to wishlist';
            return response()->json([
                'status'=>'error',
                'message'=>$notify,
            ]);
        }

        $wishlist = new Wishlist();

        if($request->item_id){
            $item = Item::findOrFail($request->item_id);
            $exits = Wishlist::where('item_id', $item->id)->where('user_id', auth()->id())->first();
            $wishlist->item_id = $item->id;
            
        }else{
            $episode = Episode::findOrFail($request->episode_id);
            $exits = Wishlist::where('episode_id', $episode->id)->where('user_id', auth()->id())->first();
            $wishlist->item_id = $episode->item_id;
            $wishlist->episode_id = $episode->id;
        }

        if(!$exits){
            $wishlist->user_id = auth()->id();
            $wishlist->save();
    
            $notify = 'Video added to wishlist successfully';
            return response()->json([
                'status'=>'success',
                'message'=>$notify,
            ]);
        }

        $notify = 'Already in wishlist';
        return response()->json([
            'status'=>'error',
            'message'=>$notify,
        ]);
    }
    
    

    public function removeWishlist(Request $request)
    {
        if(!auth()->check()){
            $notify = 'Something wrong';
            return response()->json([
                'status'=>'error',
                'message'=>$notify,
            ]);
        }

        if($request->item_id){
            $wishlist = Wishlist::where('item_id', $request->item_id)->where('user_id', auth()->id());
        }

        if($request->episode_id){
            $wishlist = Wishlist::where('episode_id', $request->episode_id)->where('user_id', auth()->id());
        }

        $wishlist = $wishlist->first();

        if($wishlist){
            $wishlist->delete();
            $notify = 'Video removed from wishlist successfully';
            return response()->json([
                'status'=>'success',
                'message'=>$notify,
            ]);
        }

        $notify = 'Something wrong';
        return response()->json([
            'status'=>'error',
            'message'=>$notify,
        ]);
    }

    public function addClick(Request $request){
        $ad = Advertise::find($request->id);
        $ad->increment('click');
        return response()->json("Success");
    }

}

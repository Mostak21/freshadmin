<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\Brand;
use App\Models\Product;
use App\Models\PickupPoint;
use App\Models\CustomerPackage;
use App\Models\User;
use App\Models\Seller;
use App\Utility\CategoryUtility;
use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\BusinessSetting;
use App\Models\Coupon;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use Illuminate\Auth\Events\PasswordReset;
use Cache;
use App\Http\Controllers\Auth\RegisterController;


class HomeController extends Controller
{
    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $value = Cache::get('key');

        $featured_categories = Cache::rememberForever('featured_categories', function () {
            return Category::where('featured', 1)->get();
        });

        $todays_deal_products = Cache::rememberForever('todays_deal_products', function () {
            return filter_products(Product::where('published', 1)->where('todays_deal', '1'))->get();
        });

        return view('frontend.index', compact('featured_categories', 'todays_deal_products'));
    }

    public function login()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('frontend.user_login');
    }

    public function registration(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        if($request->has('referral_code') &&
            \App\Models\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
            \App\Models\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {

            try {
                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }

                Cookie::queue('referral_code', $request->referral_code, $cookie_minute);
                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            } catch (\Exception $e) {

            }
        }
        return view('frontend.user_registration');
    }

    public function cart_login(Request $request)
    {
        $user = null;
//        if($request->get('phone') != null){
//            $user = User::whereIn('user_type', ['customer', 'seller'])->where('phone', "+{$request['country_code']}{$request['phone']}")->first();
//        }
//        elseif($request->get('email') != null){
//            $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
//        }

        if($request->get('email') != null){

          $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
          if($user == null){
            if(strlen($request->email)==14 && strpos($request->email,"+88")==0 && is_numeric($request->email)){

                $user = User::whereIn('user_type', ['customer', 'seller'])->where('phone', $request->email)->first();
            }
            elseif (strlen($request->email)==11 && strpos($request->email,"01")==0  && is_numeric($request->email)){
                $user = User::whereIn('user_type', ['customer', 'seller'])->where('phone', "+88".$request->email)->first();
            }
          }
        }

        if($user != null){
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }
                else{
                    auth()->login($user, false);
                }
            }
            else {
                flash(translate('Invalid email or password!'))->warning();
            }
        }
        else{
            flash(translate('Invalid email or password!'))->warning();
        }
        return back()->withInput();
    }

 /**
 * Create a new controller instance.
 *
 * @return void
 */

 public function cart_login_guest(Request $request){
    $user = null;

    if($request->get('email') != null){
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
        if($user == null){
            $user = User::where('phone', '+88'.$request->email)->orWhere('phone', $request->email)->first();
        }

        if ($user != null && $user->password != null && password_verify(null, $user->password) && $user->email_verified_at != null){
            $user->email_verified_at = null;
            $user->save();
        }
        if ($user != null && $user->password != null && password_verify(null, $user->password) && $user->email_verified_at == null){
            $user->verification_code = rand(100000, 999999);
            $user->verification_code_sending_at = date('Y-m-d h:m:s');
            $user->save();
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
            if($user->email != null){
                event(new Registered($user));
            }
            auth()->login($user, false);
        }
    }

    $registration = null;
    if ($user == null){
        $request->guest = 1;
        $registerController = new RegisterController;
        $registration = $registerController->register($request);
        $registration = json_decode($registration->content());
        if (!isset($registration->errors)){
            $user = Auth::user();
        }
    }

    return  view('frontend.partials.cart_login_guest',compact('user','registration'))->render();
}


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::user()->user_type == 'seller'){
            return view('frontend.user.seller.dashboard');
        }
        elseif(Auth::user()->user_type == 'customer'){
            return view('frontend.user.customer.dashboard');
        }
        elseif(Auth::user()->user_type == 'delivery_boy'){
            return view('delivery_boys.frontend.dashboard');
        }
        else {
            abort(404);
        }
    }

    public function profile(Request $request)
    {
        if(Auth::user()->user_type == 'delivery_boy'){
            return view('delivery_boys.frontend.profile');
        }
        else{
            return view('frontend.user.profile');
        }
    }

    public function customer_update_profile(Request $request)
    {
        if(env('DEMO_MODE') == 'On'){
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        if($user->save()){
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }


    public function userProfileUpdate(Request $request)
    {
        if(env('DEMO_MODE') == 'On'){
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }

        $user->avatar_original = $request->photo;

        $seller = $user->seller;

        if($seller){
            $seller->cash_on_delivery_status = $request->cash_on_delivery_status;
            $seller->bank_payment_status = $request->bank_payment_status;
            $seller->bank_name = $request->bank_name;
            $seller->bank_acc_name = $request->bank_acc_name;
            $seller->bank_acc_no = $request->bank_acc_no;
            $seller->bank_routing_no = $request->bank_routing_no;

            $seller->save();
        }

        $user->save();
        flash(translate('Your Profile has been updated successfully!'))->success();
        return back();
    }

    public function flash_deal_details($slug)
    {
        $flash_deal = FlashDeal::where('slug', $slug)->first();
        if($flash_deal != null)
            return view('frontend.flash_deal_details', compact('flash_deal'));
        else {
            abort(404);
        }
    }

//    Home Custom section product list with banner

    public function load_custom_section_1(Request $request){
        $category_id =null;
        $hour=date("H");
        $day=date("j");
        $month=date("n");
        $seed=($hour+$day+$month);

        $section_data = (object) array();

                dd(Cache::get('home_custom_section1'));


        if (str_contains($request->getUri(), 'custom_section1')){
            $section_data = Cache::rememberForever('home_custom_section1', function ($request) {
                $section_data_c = (object) array();
                $category_id =607;
                $category_ids = CategoryUtility::children_ids($category_id);
                $category_ids[] = $category_id;

                $template = "left";
                $section_data_c->template_view = "frontend.partials.home_custom_section_".$template;
                $section_data_c->title= "Fragrance";
                $section_data_c->link= $request->getBaseUrl()."/category/fragrance";
                $section_data_c->banner_image_link= json_decode(get_setting('home_banner1_images'));
                $section_data_c->poster_image_link= "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/707VCGinE8G9p80x5Bv6xHolGXDuZPoZO3I6kp5p.webp";

                $section_data_c->products = Product::whereIn('category_id', $category_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();

                dd($section_data_c);
            return $section_data_c;
            });
        }
        elseif (str_contains($request->getUri(), 'custom_section2')){
            $section_data = Cache::rememberForever('home_custom_section2', function ($request) {
                $section_data_c = (object) array();
                $category_id =467;
                $category_ids = CategoryUtility::children_ids($category_id);
                $category_ids[] = $category_id;

                $template = "right";
                $section_data_c->template_view = "frontend.partials.home_custom_section_".$template;
                $section_data_c->title= "For Women";
                $section_data_c->link= $request->getBaseUrl()."/category/womens-fashion";
                $section_data_c->banner_image_link= json_decode(get_setting('home_banner2_images'));
                $section_data_c->poster_image_link= "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3HIsQ1ePljkYPv9ZZ0TuQKptmFBarj43AgznjAYX.webp";

                $section_data_c->products = Product::whereIn('category_id', $category_ids)->where('published', 1)->where('unit_price','<',5000)->inRandomOrder($seed)->take(18)->get();

                return $section_data_c;
            });
        }
        elseif (str_contains($request->getUri(), 'custom_section3')){
            $section_data = Cache::rememberForever('home_custom_section3', function ($request) {
                $section_data_c = (object) array();
                $category_id =88;
                $category_ids = CategoryUtility::children_ids($category_id);
                $category_ids[] = $category_id;

                $template = "left";
                $section_data_c->template_view = "frontend.partials.home_custom_section_".$template;
                $section_data_c->title= "For Skin Care";
                $section_data_c->link= $request->getBaseUrl()."/category/skincare-bath-body";
                $section_data_c->banner_image_link= json_decode(get_setting('home_banner3_images'));
                $section_data_c->poster_image_link= "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/xrHmac35BGmvU0uFf90x4bSDymlXV9twIR3BK5ot.webp";

                $section_data_c->products = Product::whereIn('category_id', $category_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();

                return $section_data_c;
            });
        }
        elseif (str_contains($request->getUri(), 'custom_section4')){
            $section_data = Cache::rememberForever('home_custom_section3', function ($request) {
                $section_data_c = (object) array();
                $category_id =69;
                $category_ids = CategoryUtility::children_ids($category_id);
                $category_ids[] = $category_id;

                $template = "right";
                $section_data_c->template_view = "frontend.partials.home_custom_section_".$template;
                $section_data_c->title= "Gadgets";
                $section_data_c->link= $request->getBaseUrl()."/category/gadgets";
                $section_data_c->banner_image_link= json_decode(get_setting('home_banner4_images'));
                $section_data_c->poster_image_link= "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/Wk2t2DRROfge5DyCLSpz3PWVyvu45iHIIScaNtBq.webp";

                $section_data_c->products = Product::whereIn('category_id', $category_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();

                return $section_data_c;
            });
        }



        return view($section_data->template_view ,compact('section_data'));
    }

    public function load_custom_section(){

        $category_id =607;
        $category_ids = CategoryUtility::children_ids($category_id);
        $category_ids[] = $category_id;

        $wcategory_id =467;
        $wcategory_ids = CategoryUtility::children_ids($wcategory_id);
        $wcategory_ids[] = $wcategory_id;

        $kcategory_id =88;
        $kcategory_ids = CategoryUtility::children_ids($kcategory_id);
        $kcategory_ids[] = $kcategory_id;

		$gcategory_id =69;
        $gcategory_ids = CategoryUtility::children_ids($gcategory_id);
        $gcategory_ids[] = $gcategory_id;

//		$ip=$_SERVER['REMOTE_ADDR'];
        $hour=date("H");
        $day=date("j");
        $month=date("n");
//        $ip=str_replace(".","",$ip);
//        $seed=($ip+$hour+$day+$month);
        $seed=($hour+$day+$month);

        $perfumeproducts=Product::whereIn('category_id', $category_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();
        $womensproducts=Product::whereIn('category_id', $wcategory_ids)->where('published', 1)->where('unit_price','<',5000)->inRandomOrder($seed)->take(18)->get();
        $kidsproducts=Product::whereIn('category_id', $kcategory_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();
        $gadgetproducts=Product::whereIn('category_id', $gcategory_ids)->where('published', 1)->inRandomOrder($seed)->take(18)->get();

        return view('frontend.partials.custom_section',compact('perfumeproducts','womensproducts','kidsproducts','gadgetproducts'));
    }

    //    Home Custom section product list with banner

    public function load_featured_section(){
        return view('frontend.partials.featured_products_section');
    }

    public function load_best_selling_section(){
        return view('frontend.partials.best_selling_section');
    }

    public function load_auction_products_section(){
        if(!addon_is_activated('auction')){
            return;
        }
        return view('auction.frontend.auction_products_section');
    }

    public function load_home_categories_section(){
        return view('frontend.partials.home_categories_section');
    }

    public function load_best_sellers_section(){
        return view('frontend.partials.best_sellers_section');
    }

    public function trackOrder(Request $request)
    {
        if($request->has('order_code')){
            $order = Order::where('code', $request->order_code)->first();
            if($order != null){
                return view('frontend.track_order', compact('order'));
            }
        }
        return view('frontend.track_order');
    }

    public function product(Request $request, $slug)
    {
        $detailedProduct  = Product::with('reviews','category', 'brand', 'stocks', 'user', 'user.shop')->where('auction_product', 0)->where('slug', $slug)->where('approved', 1)->first();

        if($detailedProduct != null && $detailedProduct->published){
            if($request->has('product_referral_code') && addon_is_activated('affiliate_system')) {

                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                Cookie::queue('product_referral_code', $request->product_referral_code, $cookie_minute);
                Cookie::queue('referred_product_id', $detailedProduct->id, $cookie_minute);

                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            }




//                AWS Personalize inport interactions
            $personalize = new AWSPersonalizeController;
//            $request1= (object)[];
            $userClient = Auth::user()->id??$request->session()->get('temp_user_id')??"";
            $request->AWSdataset = "getRecommandation"??"";
            $request->AWSuser = $userClient;
            $request->AWSitem = $detailedProduct->id??"";
            $personalize->index($request);

//            $personalize->getRecommendations();
//
//            $request->AWSdataset = "interactions-dataset"??"";
//            $request->AWSdata = $productId??"";
//            $personalize->index($request);
//                Aws Personalize



            if($detailedProduct->digital == 1){
                return view('frontend.digital_product_details', compact('detailedProduct'));
            }
            else {
                return view('frontend.product_details', compact('detailedProduct'));
            }
        }
        abort(404);
    }

    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null){
            $seller = Seller::where('user_id', $shop->user_id)->first();
            if ($seller->verification_status != 0){
                return view('frontend.seller_shop', compact('shop'));
            }
            else{
                return view('frontend.seller_shop_without_verification', compact('shop', 'seller'));
            }
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null && $type != null){
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }

    public function all_categories(Request $request)
    {
//        $categories = Category::where('level', 0)->orderBy('name', 'asc')->get();
        $categories = Category::where('level', 0)->orderBy('order_level', 'desc')->get();
        return view('frontend.all_category', compact('categories'));
    }
    public function all_brands(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_brand', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        if(addon_is_activated('seller_subscription')){
            if(Auth::user()->seller->remaining_uploads > 0){
                $categories = Category::where('parent_id', 0)
                    ->where('digital', 0)
                    ->with('childrenCategories')
                    ->get();
                return view('frontend.user.seller.product_upload', compact('categories'));
            }
            else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_upload', compact('categories'));
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_edit', compact('product', 'categories', 'tags', 'lang'));
    }

    public function seller_product_list(Request $request)
    {
        $search = null;
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%'.$search.'%');
        }
        $products = $products->paginate(30);
        return view('frontend.user.seller.products', compact('products', 'search'));
    }

    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if(is_array($request->top_categories) && in_array($category->id, $request->top_categories)){
                $category->top = 1;
                $category->save();
            }
            else{
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if(is_array($request->top_brands) && in_array($brand->id, $request->top_brands)){
                $brand->top = 1;
                $brand->save();
            }
            else{
                $brand->top = 0;
                $brand->save();
            }
        }

        flash(translate('Top 10 categories and brands have been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;
        $tax = 0;
        $max_limit = 0;

        if($request->has('color')){
            $str = $request['color'];
        }

        if(json_decode($product->choice_options) != null){
            foreach (json_decode($product->choice_options) as $key => $choice) {
                if($str != null){
                    $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
                else{
                    $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
            }
        }

        $product_stock = $product->stocks->where('variant', $str)->first();
        $price = $product_stock->price;

        if($product->wholesale_product){
            $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
            if($wholesalePrice){
                $price = $wholesalePrice->price;
            }
        }

        $quantity = $product_stock->qty;
        $max_limit = $product_stock->qty;

        if($quantity >= 1 && $product->min_qty <= $quantity){
            $in_stock = 1;
        }else{
            $in_stock = 0;
        }

        //Product Stock Visibility
        if($product->stock_visibility_state == 'text') {
            if($quantity >= 1 && $product->min_qty < $quantity){
                $quantity = translate('In Stock');
            }else{
                $quantity = translate('Out Of Stock');
            }
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        // taxes
        foreach ($product->taxes as $product_tax) {
            if($product_tax->tax_type == 'percent'){
                $tax += ($price * $product_tax->tax) / 100;
            }
            elseif($product_tax->tax_type == 'amount'){
                $tax += $product_tax->tax;
            }
        }

        $price += $tax;

        return array(
            'price' => single_price($price*$request->quantity),
            'quantity' => $quantity,
            'digital' => $product->digital,
            'variation' => $str,
            'max_limit' => $max_limit,
            'in_stock' => $in_stock
        );
    }

    public function sellerpolicy(){
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy(){
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy(){
        return view("frontend.policies.supportpolicy");
    }

    public function terms(){
        return view("frontend.policies.terms");
    }

    public function privacypolicy(){
        return view("frontend.policies.privacypolicy");
    }

    public function get_pick_up_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function get_category_items(Request $request){
        $category = Category::findOrFail($request->id);
        return view('frontend.partials.category_elements', compact('category'));
    }

    public function premium_package_index()
    {
        $customer_packages = CustomerPackage::all();
        return view('frontend.user.customer_packages_lists', compact('customer_packages'));
    }

    public function seller_digital_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.user.seller.digitalproducts.products', compact('products'));
    }
    public function show_digital_product_upload_form(Request $request)
    {
        if(addon_is_activated('seller_subscription')){
            if(Auth::user()->seller->remaining_digital_uploads > 0){
                $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
                $categories = Category::where('digital', 1)->get();
                return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
            }
            else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }

        $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
        $categories = Category::where('digital', 1)->get();
        return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
    }

    public function show_digital_product_edit_form(Request $request, $id)
    {
        $categories = Category::where('digital', 1)->get();
        $lang = $request->lang;
        $product = Product::find($id);
        return view('frontend.user.seller.digitalproducts.product_edit', compact('categories', 'product', 'lang'));
    }

    // Ajax call
    public function new_verify(Request $request)
    {
        $email = $request->email;
        if(isUnique($email) == '0') {
            $response['status'] = 2;
            $response['message'] = 'Email already exists!';
            return json_encode($response);
        }

        $response = $this->send_email_change_verification_mail($request, $email);
        return json_encode($response);
    }


    // Form request
    public function update_email(Request $request)
    {
        $email = $request->email;
        if(isUnique($email)) {
            $this->send_email_change_verification_mail($request, $email);
            flash(translate('A verification mail has been sent to the mail you provided us with.'))->success();
            return back();
        }

        flash(translate('Email already exists!'))->warning();
        return back();
    }

    public function send_email_change_verification_mail($request, $email)
    {
        $response['status'] = 0;
        $response['message'] = 'Unknown';

        $verification_code = Str::random(32);

        $array['subject'] = 'Email Verification';
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Verify your account';
        $array['link'] = route('email_change.callback').'?new_email_verificiation_code='.$verification_code.'&email='.$email;
        $array['sender'] = Auth::user()->name;
        $array['details'] = "Email Second";

        $user = Auth::user();
        $user->new_email_verificiation_code = $verification_code;
        $user->save();

        try {
            Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));

            $response['status'] = 1;
            $response['message'] = translate("Your verification mail has been Sent to your email.");

        } catch (\Exception $e) {
            // return $e->getMessage();
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function email_change_callback(Request $request){
        if($request->has('new_email_verificiation_code') && $request->has('email')) {
            $verification_code_of_url_param =  $request->input('new_email_verificiation_code');
            $user = User::where('new_email_verificiation_code', $verification_code_of_url_param)->first();

            if($user != null) {

                $user->email = $request->input('email');
                $user->new_email_verificiation_code = null;
                $user->save();

                auth()->login($user, true);

                flash(translate('Email Changed successfully'))->success();
                return redirect()->route('dashboard');
            }
        }

        flash(translate('Email was not verified. Please resend your mail!'))->error();
        return redirect()->route('dashboard');

    }

    public function reset_password_with_code(Request $request){
        if (($user = User::where('email', $request->email)->where('verification_code', $request->code)->first()) != null) {
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('Password updated successfully'))->success();

                if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('home');
            }
            else {
                flash("Password and confirm password didn't match")->warning();
                return redirect()->route('password.request');
            }
        }
        else {
            flash("Verification code mismatch")->error();
            return redirect()->route('password.request');
        }
    }


    public function all_flash_deals() {
        $today = strtotime(date('Y-m-d H:i:s'));

        $data['all_flash_deals'] = FlashDeal::where('status', 1)
            ->where('start_date', "<=", $today)
            ->where('end_date', ">", $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("frontend.flash_deal.all_flash_deal_list", $data);
    }

    public function all_seller(Request $request) {
        $shops = Shop::whereIn('user_id', verified_sellers_id())->orderBy('name', 'ASC')
            ->paginate(50);

        return view('frontend.shop_listing', compact('shops'));
    }

    public function all_coupons(Request $request) {
        $coupons = Coupon::where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->paginate(15);
        return view('frontend.coupons', compact('coupons'));
    }

    public function inhouse_products(Request $request) {
        $products = filter_products(Product::where('added_by', 'admin'))->with('taxes')->paginate(12)->appends(request()->query());
        return view('frontend.inhouse_products', compact('products'));
    }

	public function perfumecustom(){

       // $orderidlist= OrderDetail::where('seller_id',178)->pluck('product_id')->toArray();
       // $brandlist= array('118','98','89');
       // $orderproduct=Product::whereIn('id',$orderidlist)->pluck('id');
       // $bbrands=array('276','39','119','106','105','264','270','18','40','70','121','277','99','110','72','103','253','285','21','95','96','104','254','255','16','259','256','286','260','261','76','111','250','251','265');

        //$product3=Product::where('user_id',178)->count();
		//$product3=Product::where('brand_id',null)->where('user_id',178)->pluck('id')->toArray();
        //$product3=Product::wherenotIN('brand_id',$bbrands)->where('user_id',864)->pluck('id')->toArray();
        //$product2=Product::where('user_id',864)->count();

      //  return $product3;

        // foreach($product3 as $p){
        //     $product = Product::find($p);
        //     $product->user_id = 864;
        //     $product->save();

        // }

     // Product::destroy($product3);

        //foreach($product4 as $p){
        //   $product = Product::find($p);
        //    $product->user_id = 864;
        //   $product->save();

      //  }

      // return [ $product2,$product3,];
    }


}

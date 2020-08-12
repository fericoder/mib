<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Shop;
use App\Tag;
use App\Brand;
use App\ErrorLog;
use App\Color;
use App\Specification;
use App\Value;
use App\Facility;
use App\Dashboard;
use App\ProductCategory;
use App\Feature;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\SpecificationItem;
use App\SpecificationItemGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $products = Product::all();
        $specifications = Specification::whereHas('items')->orderBy('order', 'DESC')->get();
        return view('dashboard.product.index', compact('categories','products', 'brands', 'colors', 'specifications'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // if($request->off_price == null){
        //     $request->merge(['off_price_started_at' => null]);
        //     $request->merge(['off_price_expired_at' => null]);
        // }
        // else{
        //     $request->validate([
        //         'off_price_started_at' => 'required_with:off_price',
        //         'off_price_expired_at' => 'required_with:off_price|gt:off_price_started_at',
        //     ]);
            //check for started and and expired for off_price
        //     if($request->off_price_started_at != null){
        //         $realTimestampStart = substr($request->off_price_started_at,0,10);
        //         $request->off_price_started_at = date('Y-m-d H:i:s', (int)$realTimestampStart);
        //     }
        //     if($request->off_price_expired_at != null){
        //         $realTimestampExpire = substr($request->off_price_expired_at,0,10);
        //         $request->off_price_expired_at = date('Y-m-d H:i:s', (int)$realTimestampExpire);
        //     }
        // }

        //check if product category is null
        if($request->productCat_id == "null"){
            $request->merge(['productCat_id' => null]);
        }
        if($request->brand_id == "null"){
            $request->merge(['brand_id' => null]);
        }
        //validate product category if is null or not
        $request->validate(['productCat_id' => 'required']);
        //check if product is file to calculate size of uploaded file
        // if($request->type == 'file') {
        //     $file_size = $request->file('attachment')->getSize();
        // }
        // else{
        //     $file_size = null;
        // }

        if($request->file('catalog') == null){
            $catalog = '';
        }
        else{
            $request->validate(['catalog' => 'mimes:pdf']);
            $catalog = $this->uploadFile($request->file('catalog'), false, false);
        }


        $image = $this->uploadFile($request->file('image'), false, true);
        //check if product is file to save attachment file
        // if($request->type == 'file')
        //     $attachment = Storage::putFileAs('attachment', $request->file('attachment'), \Auth::user()->id."_".time()."_".$request->file('attachment')->getClientOriginalName());
        // else
        //     $attachment = null;
        //check if enable if off to change enable to 0
        if ($request->enable != "on")
            $request->enable = 0;
        else
            $request->enable = 1;

        //check options of products
        // if (!isset($request->fast_sending))
        //     $request->fast_sending = 'off';

        // if (!isset($request->money_back))
        //     $request->money_back = 'off';

        // if (!isset($request->support))
        //     $request->support = 'off';

        // if (!isset($request->secure_payment))
        //     $request->secure_payment = 'off';

        // if (!isset($request->discount_status))
        //     $request->discount_status = 'disable';
        // else
        //     $request->discount_status = 'enable';

        //check amount of product and change fa number to en
        // if($request->color_amount == 'on' and $request->get('color_amount_number') or ($request->specification_amount == 'on' and $request->get('specification_amount_number'))){
        //     $request->merge(['amount' => null]);
        // }
        // else{
        //     if($request->amount != null){
        //         $request->amount = $this->fa_num_to_en($request->amount);
        //     }
        // }
        // if($request->color_amount == 'on' and $request->get('color_amount_number') or ($request->specification_amount == 'on' and $request->get('specification_amount_number'))){
        //     $request->merge(['min_amount' => null]);
        // }
        // else{
        //     if($request->min_amount != null){
        //         $request->min_amount = $this->fa_num_to_en($request->min_amount);
        //     }
        // }
        if($request->measure != null){
            $request->measure = $this->fa_num_to_en($request->measure);
        }
        //check weight of product and change fa number to en
        if($request->weight != null){
            $request->weight = $this->fa_num_to_en($request->weight);
        }
        //check off_price of product and change fa number to en
        // if($request->off_price != null){
        //     $request->off_price = $this->fa_num_to_en($request->off_price);
        // }

                $product = Product::create([
                    'title' => $request->title,
                    'type' => 'product',
                    'category_id' => $request->productCat_id,
                    'brand_id' => $request->brand_id,
                    // 'amount' => $request->amount,
                    // 'min_amount' => $request->min_amount,
                    'measure' => $request->measure,
                    'weight' => $request->weight,
                    'price' => $this->fa_num_to_en($request->price),
                    // 'off_price' => $request->off_price,
                    // 'fast_sending' => $request->fast_sending,
                    'shortDescription' => $request->shortDescription,
                    'country_id' => $request->country_id,
                    // 'money_back' => $request->money_back,
                    // 'support' => $request->support,
                    // 'secure_payment' => $request->secure_payment,
                    // 'discount_status' => $request->discount_status,
                    'description' => $request->description,
                    'aparat' => $request->aparat,
                    'shegeftangiz' => $request->shegeftangiz,
                    'userPrice' => $request->userPrice,
                    'image' => $image,
                    'catalog' => $catalog,
                    'shop_id' => \Auth::user()->shop_id,
                    // 'attachment' => $attachment,
                    // 'off_price_started_at' => $request->off_price_started_at,
                    // 'off_price_expired_at' => $request->off_price_expired_at,
                    'description' => $request->description,
                    // 'file_size' => $file_size,
                ]);

                if ($request->group[1]['p_id'] != null and $request->group[1]['amount'] != null and isset($request->group[1]['items'])) {
                    if (isset($request->group)) {
                        foreach ($request->group as $group) {
                            $groupItem = new SpecificationItemGroup;
                            $groupItem->specification_items = $group['items'];
                            $groupItem->product_id = $product->id;
                            $groupItem->amount = $group['amount'];
                            $groupItem->p_id = $group['p_id'];
                            $groupItem->save();
                        }
                    }
                }

                //add facilities
            //    if($request->facility[0] != null){
            //        foreach(array_slice($request->facility, 0, 50) as $facility){
            //            DB::table('facilities')->insert(['name' => $facility, 'product_id' => $product->id]);
            //        }
            //    }


                // if($request->specification_amount == 'on' and $request->get('specification_amount_number')){
                //     foreach($request->specification_amount_number as $specification_amount_number_id => $specification_amount_number){
                //         DB::table('product_specificationItem')->insertOrIgnore([
                //             ['product_id' => $product->id, 'specification_item_id' => $specification_amount_number_id, 'amount' => $specification_amount_number]
                //         ]);
                //     }
                //     $product->update([
                //         'specification_amount_status' => 'enable'
                //     ]);
                // }


                //add tags and colors and features and specifications to the product
                if($product)
                {
                    DB::transaction(function () use ($request, $product) {

                        $tagIds = [];
//                         $colorIds = [];
//                         $featureIds = [];
                        $sepecificationIds = [];

                        //get all tags of product
                        $tagNames = explode(',',$request->get('tags'));
                        foreach($tagNames as $tagName)
                        {
                            $tag = Tag::firstOrCreate(['name'=>$tagName]);
                            // $tag = Tag::firstOrCreate(['name'=>$tagName, 'shop_id' =>Auth::user()->shop()->first()->id]);
                            if($tag)
                            {
                                $tagIds[] = $tag->id;
                            }
                        }
                        $product->tags()->sync($tagIds);

//                         // get all colors of product
//                         if($request->get('color') and !$request->get('color_amount_number')){

//                             foreach($request->get('color') as $colorName)
//                             {
//                                 $color = Color::firstOrCreate(['id'=>$colorName]);
//                                 if($color)
//                                 {
//                                     $colorIds[] = $color->id;
//                                 }
//                             }
//                             $product->colors()->sync($colorIds);
//                         }


//                         //get all color and color Amount of product
//                         if($request->get('color') and $request->get('color_amount_number')){

//                             foreach($request->get('color_amount_number') as $colorId=>$colorAmount)
//                             {
//                                 $color = Color::find($colorId);
//                                 if($color){
//                                     $colorIds[$color->id] = ['amount'=>$colorAmount];
//                                 }
//                             }

//                             $product->colors()->sync($colorIds);
//                             $product->update([
//                                 'color_amount_status' => 'enable'
//                             ]);
//                         }




                        // if($request->get('specifications')){
                        //     foreach($request->get('specifications') as $specificationName)
                        //     {
                        //         $specification = Specification::firstOrCreate(['id'=>$specificationName]);
                        //         if($specification)
                        //         {
                        //             $sepecificationIds[] = $specification->id;
                        //         }
                        //     }
                        //     $product->specifications()->sync($sepecificationIds);
                        // }


                        //get all features of product
                        // if($request->get('value')){
                        //     foreach($request->get('value') as $featureId=>$featureValue)
                        //     {
                        //         $feature = Feature::find($featureId);
                        //         if($feature){
                        //             $featureIds[$feature->id] = ['value'=>$featureValue];
                        //         }
                        //     }

                        //     $product->features()->sync($featureIds);
                        // }


                    });
                }


                alert()->success('محصول جدید شما باموفقیت اضافه شد.', 'ثبت شد');
                return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $shop = \Auth::user()->shop()->first();
        $tags = [];
        foreach($product->tags as $tag){
            $tags[] = $tag->name;
        }
        $specifications = Specification::whereHas('items')->orderBy('order', 'DESC')->get();
        $tags = implode(',', $tags);
        $categories = \Auth::user()->shop()->first()->categories()->doesntHave('children')->get();
        $brands = \Auth::user()->shop()->first()->brands()->get();
        $colors = Color::all();
        $lastGroupId = SpecificationItemGroup::latest('id')->first()->id;
        return view('dashboard.product.edit', compact('product','categories','brands','colors','tags', 'shop', 'specifications','lastGroupId'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        //off price timing
        // if($request->off_price == null){
        //     $request->merge(['off_price_started_at' => null]);
        //     $request->merge(['off_price_expired_at' => null]);
        // }
        // else{
        //     $request->validate([
        //         'off_price_started_at' => 'required_with:off_price',
        //         'off_price_expired_at' => 'required_with:off_price|gt:off_price_started_at',
        //     ]);

            //check for started and and expired for off_price
            // if($request->off_price_started_at != null){
            //     $realTimestampStart = substr($request->off_price_started_at,0,10);
            //     $request->off_price_started_at = date('Y-m-d H:i:s', (int)$realTimestampStart);
            // }
            // if($request->off_price_expired_at != null){
            //     $realTimestampExpire = substr($request->off_price_expired_at,0,10);
            //     $request->off_price_expired_at = date('Y-m-d H:i:s', (int)$realTimestampExpire);
            // }
        // }

        // if ($request->type == 'product') {
        //     if($request->specification_amount != 'on' and $request->color_amount != 'on'){
        //         $request->validate([
        //             'amount' => 'required_unless:specification_amount,on|required_unless:color_amount,on|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:999999','min:0',
        //             'min_amount' => 'required_unless:specification_amount,on|required_unless:color_amount,on|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:999999','min:0',
        //         ]);
        //     }
        //     elseif($request->specification_amount == 'on' or $request->color_amount == 'on'){
        //         $request->validate([
        //             'amount' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:999999','min:0',
        //             'min_amount' => 'nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:999999','min:0',
        //         ]);
        //     }
        // }
        // if($request->specification_amount != 'on'){
        //     $request->merge(['specification_amount' => '']);
        //     $specification_amount_status = 'disable';
        // }
        // else{
        //     $specification_amount_status = 'enable';
        // }
        // if($request->color_amount != 'on'){
        //     $request->merge(['color_amount' => '']);
        //     $color_amount_status = 'disable';
        // }
        // else{
        //     $color_amount_status = 'enable';

        // }

        // if($request->type == 'file' and $request->file('attachment') == null){
        //     $attachment = $product->attachment;
        //     $file_size = $product->file_size;
        // }
        // elseif($request->type == 'file'){
        //     $request->validate(['attachment' => 'required|mimes:doc,docx,pdf,zip,mp4,avi,webm,3gp,rar|max:50000']);
        //     $file_size = $request->file('attachment')->getSize();
        //     $attachment = Storage::putFileAs('attachment', $request->file('attachment'), \Auth::user()->id."_".time()."_".$request->file('attachment')->getClientOriginalName());
        // }
        // else{
        //     $attachment = null;
        //     $file_size = null;
        // }
        if($request->file('image') == null){
            $image = $product->image;
        }
        else{
            $request->validate(['image' => 'mimes:jpeg,png,jpg,gif|max:2048']);
            $image = $this->uploadFile($request->file('image'), false, true);
        }
        if($request->file('catalog') == null){
            $catalog = $product->catalog;
        }
        else{
            $request->validate(['catalog' => 'mimes:pdf']);
            $catalog = $this->uploadFile($request->file('catalog'), false, false);
        }

        if($request->brand_id == "null"){
            $request->merge(['brand_id' => null]);
        }

        if ( $request->enable != "on")
            $request->enable = 0;
        else
            $request->enable = 1;


        //check options of products
        // if (!isset($request->fast_sending))
        //     $request->fast_sending = 'off';

        // if (!isset($request->money_back))
        //     $request->money_back = 'off';

        // if (!isset($request->support))
        //     $request->support = 'off';

        // if (!isset($request->secure_payment))
        //     $request->secure_payment = 'off';

        // if (!isset($request->discount_status))
        //     $request->discount_status = 'disable';
        // else
        //     $request->discount_status = 'enable';

        //check amount of product and change fa number to en
        // if($request->color_amount == 'on' and $request->get('color_amount_number') or ($request->specification_amount == 'on' and $request->get('specification_amount_number'))){
        //     $request->merge(['amount' => null]);
        //     $request->merge(['min_amount' => null]);
        // }
        // else{
        //     if($request->amount != null){
        //         $request->amount = $this->fa_num_to_en($request->amount);
        //     }
        //     if($request->min_amount != null){
        //         $request->min_amount = $this->fa_num_to_en($request->min_amount);
        //     }
        // }
        if($request->weight != null){
            $request->weight = $this->fa_num_to_en($request->weight);
        }
        // if($request->off_price != null){
        //     $request->off_price = $this->fa_num_to_en($request->off_price);
        // }
        $updatedProduct = $product->update([
            'title' => $request->title,
            'type' => $request->type,
            'category_id' => $request->productCat_id,
            'brand_id' => $request->brand_id,
            // 'amount' => $request->amount,
            // 'min_amount' => $request->min_amount,
            'measure' => $request->measure,
            'weight' => $request->weight,
            'aparat' => $request->aparat,
            'price' => $this->fa_num_to_en($request->price),
            'shegeftangiz' => $request->shegeftangiz,
            'userPrice' => $request->userPrice,
            // 'off_price' => $request->off_price,
            // 'fast_sending' => $request->fast_sending,
            'shortDescription' => $request->shortDescription,
            'country_id' => $request->country_id,
            // 'money_back' => $request->money_back,
            // 'support' => $request->support,
            // 'secure_payment' => $request->secure_payment,
            // 'discount_status' => $request->discount_status,
            'description' => $request->description,
            'image' => $image,
            'catalog' => $catalog,
            // 'attachment' => $attachment,
            // 'specification_amount_status' => $specification_amount_status,
            // 'color_amount_status' => $color_amount_status,
            // 'attachment' => $attachment,
            // 'off_price_started_at' => $request->off_price_started_at,
            // 'off_price_expired_at' => $request->off_price_expired_at,
            // 'description' => $request->description,
            // 'file_size' => $file_size,
        ]);




        if (isset($request->group)){
            $gp_request = [];
            $gp_product = [];
            foreach($request->group as $groupId => $group)
            {
                if(strpos($groupId, 'new') === false){
                    $gp_request[] = $groupId;
                }
            }

            foreach($product->groups as $gp){
                $gp_product[] = $gp->id;
            }

            if ((count(array_diff($gp_product, $gp_request))) != 0) {
                foreach(array_diff($gp_product,$gp_request) as $gp_id){
                    $specificationGroup = SpecificationItemGroup::find($gp_id);
                    $specificationGroup->delete();
            }
            }

            foreach($request->group as $groupId => $group)
            {
                if(strpos($groupId, 'new') !== false){
                    $groupItem = new SpecificationItemGroup;
                    $groupItem->specification_items = $group['items'];
                    $groupItem->product_id = $product->id;
                    $groupItem->amount = $group['amount'];
                    $groupItem->p_id = $group['p_id'];
                    $groupItem->save();
                }
                else{
                    SpecificationItemGroup::updateOrCreate(['id' => $groupId],
                    ['specification_items' => $group['items'], 'product_id' => $product->id, 'amount' => $group['amount'], 'p_id' => $group['p_id']]);
                }
            }

        }
        else{
            $product->groups()->delete();
        }




        //add facilities
//        foreach(array_slice($request->facility, 0, 50, true) as $facility_id => $facility){
//            if($facility != null){
//                if($product->facilities->count() != 0){
//                    Facility::updateOrCreate(['id' => $facility_id],['name' => $facility, 'product_id' => $product->id]);
//                }
//                else{
//                    Facility::create(['name' => $facility, 'product_id' => $product->id]);
//                }
//            }
//            else{
//                if(Facility::where('id', $facility_id)->get()->first() != null){
//                    Facility::where('id', $facility_id)->get()->first()->delete();
//                }
//            }
//        }

        // if($request->specification_amount == 'on' and $request->get('specification_amount_number')){
        //     foreach($request->specification_amount_number as $specification_amount_number_id => $specification_amount_number){
        //         DB::table('product_specificationItem')->updateOrInsert(
        //             ['product_id' => $product->id, 'specification_item_id' => $specification_amount_number_id],
        //             ['amount' => $specification_amount_number],
        // );
        //     }
        // }


        if($updatedProduct)
        {
            $tagIds = [];
            // $colorIds = [];
            // $featureIds = [];
            $sepecificationIds = [];


            //get all tags of product
            $tagNames = explode(',',$request->get('tags'));
            foreach($tagNames as $tagName)
            {
                $tag = Tag::firstOrCreate(['name'=>$tagName]);
                if($tag)
                {
                    $tagIds[] = $tag->id;
                }
            }
            // get all color of product
            // if($request->get('color') and !$request->get('color_amount_number')){
            //     foreach($request->get('color') as $colorName)
            //     {
            //         $color = Color::firstOrCreate(['id'=>$colorName]);
            //         if($color)
            //         {
            //             $colorIds[] = $color->id;
            //         }
            //     }
            //     \Auth::user()->shop()->first()->products()->where('id',$id)->get()->first()->colors()->sync($colorIds);
            // }


            //get all color and color Amount of product
            // if($request->get('color') and $request->color_amount == 'on' and $request->get('color_amount_number')){
            //     foreach($request->get('color_amount_number') as $colorId=>$colorAmount)
            //     {

            //         $color = Color::find($colorId);
            //         if($color){
            //             $colorIds[$color->id] = ['amount'=>$colorAmount];
            //         }
            //     }
            //     $product->colors()->sync($colorIds);
            // }

            if($request->get('specifications')){
                foreach($request->get('specifications') as $specificationName)
                {
                    $specification = Specification::firstOrCreate(['id'=>$specificationName]);
                    if($specification)
                    {
                        $sepecificationIds[] = $specification->id;
                    }
                }
                $product->specifications()->sync($sepecificationIds);
            }

            //get all features of product
            // if($request->get('value')){
            //     foreach($request->get('value') as $featureId=>$featureValue)
            //     {

            //         $feature = Feature::find($featureId);
            //         if($feature){
            //             $featureIds[$feature->id] = ['value'=>$featureValue];
            //         }
            //     }

            //     $product->features()->sync($featureIds);
            // }


            $product->tags()->sync($tagIds);
            // $product->colors()->sync($colorIds);
            $product->specifications()->sync($sepecificationIds);
        }
        alert()->success('محصول شما باموفقیت ویرایش شد.', 'ثبت شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id' , $request->id)->first()->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();

    }

    public function getSpecificationItems(Request $request){
        $request->validate([
            'selected_specificationIds.*' => 'required|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
        ]);
        $items = [];
        foreach ($request->selected_specificationIds as $specificationId) {
            $items[] = Specification::find($specificationId)->items;
        }

        return response()->json($items);
    }

}

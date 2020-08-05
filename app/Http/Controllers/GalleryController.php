<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $shop = \Auth::user()->shop()->first();
        $galleries = $product->galleries;

        return view('dashboard.product.gallery', compact('product', 'galleries'));
    }


    public function fileStore(Request $request)
    {

        if($_SERVER['REMOTE_ADDR'] != '127.0.0.1'){
            $folder = public_path() . '_html';
        }else{
            $folder = public_path();
        }


        $image = $request->file('file');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($folder . '/' . 'images/product-galleries/' . \Auth::user()->id, $imageName);
        if(strtolower(@end(explode(".",$imageName))) == "mp4" or strtolower(@end(explode(".",$imageName))) == "avi" or strtolower(@end(explode(".",$imageName))) =="wma"){
            $type = 'video';
        }else{
            $type = 'picture';
        }

        $imageAddress = 'images/product-galleries/' . \Auth::user()->id . '/' . $imageName;
        $imageUpload = new Gallery();
        $imageUpload->filename = $imageAddress;
        $imageUpload->type = $type;
        $imageUpload->product_id = $request->product;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $imageAddress = implode('/', array_slice(explode('/', $filename), -4, 4, true));
        Gallery::where('filename', $imageAddress)->delete();
        $path = public_path() . '/images/product-galleries/' . \Auth::user()->id . '/' . @end(explode("/",$filename));

        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }




}

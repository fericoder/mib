<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $parentCategories = Category::where('parent_id', null)->get();
        return view('dashboard.category.index', compact('categories','parentCategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if($request->file('icon') == null){
            $image = null;
        }
        else{
            $image = $this->uploadFile($request->file('icon'), false, true);
        }
        $category = new Category;
        $category->name = $request->name;
        if($request->parent_id == 'null')
            $category->parent_id = null;
        else
            $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->priority = $request->priority;
        $category->icon = $image;
        $category->shop_id = \Auth::user()->shop_id;
        $category->save();
        alert()->success('دسته بندی جدید شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('categories.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $shop = \Auth::user()->shop()->first();
        $categories = \Auth::user()->shop()->first()->categories()->get()->whereNotIn('id', $category->id);
        $parentCategories = \Auth::user()->shop()->first()->categories()->get()->where('parent_id', null);

        return view('dashboard.category.edit', compact('category', 'categories','shop', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if($this->getAllSubCategories($id)->contains('id', $request->parent_id)){
            return redirect()->back()->withErrors(['خطا' => 'دسته بندی شاخه نمیتواند دسته بندی فرزند باشد']);

        }

        //check if icon is null or not
        if($request->file('icon') == null){
            $image = \Auth::user()->shop()->first()->categories()->where('id',$id)->get()->first()->icon;
        }
        else{
            $image = $this->uploadFile($request->file('icon'), false, true);
        }
        if($request->parent_id == 'null'){
            $request->parent_id = null;
        }

        $productCategory = \Auth::user()->shop()->first()->categories()->where('id',$id)->get()->first()->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'priority' => $request->priority,
            'icon' => $image
        ]);


        alert()->success(' دسته بندی شما با موفقیت ویرایش شد.', 'ثبت شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id' , $request->id)->first()->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();

    }


    public static function getAllSubCategories($cat_id) {
        $allSubCategories = collect();
        if (Category::find($cat_id)->children()->exists()) {
            foreach (Category::find($cat_id)->children()->get() as $subCategory) {
                $allSubCategories[] = $subCategory;
                if ($subCategory->children()->exists()) {
                    foreach ($subCategory->children()->get() as $subSubCategory) {
                        $allSubCategories[] = $subSubCategory;

                        if ($subSubCategory->children()->exists()) {
                            foreach ($subSubCategory->children()->get() as $subSubSubCategory) {
                                $allSubCategories[] = $subSubSubCategory;
                                if ($subSubSubCategory->children()->exists()) {
                                    foreach ($subSubSubCategory->children()->get() as $subSubSubSubCategory) {
                                        $allSubCategories[] = $subSubSubSubCategory;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $allSubCategories;
    }


}

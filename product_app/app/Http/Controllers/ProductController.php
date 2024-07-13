<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // احمي ال controller -> by constructor
    // public function __construct() {
    //     $this->middleware('auth'); // -> لازم اعمل login عشان ادخل الموقع
    // }
        // لو عاوز اخلي ال controller كله محمي يعني محدش يقدر يشوف الموقع ولا حتى ال home page
        
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
        // $this->middleware('auth')->only(['store', 'create', 'edit', 'delete', 'update']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // يجيب ال data from database 
        $products = Product::latest(); // جيب البيانات من الاخر
        // controller يرسل البيانات دي لل view
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1)-1) * 5); // i = index بتاع ال pagination 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // يحولني ل page view
        return view('products.create'); // لازم ياخد المعلومات من ال store 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store data 

        // check data => validation 
        $request->validate([
            'name'=>'required',
            'details'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // save in DB
        $input = $request->all();
        // مسار حفظ الصورة
        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            // ممكن اسامي الصور تكون زي بعض = ده الحل
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension(); // => Year , Mounth , Day , Hours , ..
            $image->move($destinationPath, $profileImage);
            // لازم اعرف ال input بال image بتاعته
            $input['image'] = "$profileImage"; // -> يتحفظ ف ال DB 
        }
        // Save 
        Product::create($input);
        // ارجع ال user to index file = ( Home page )
        return redirect()->route('products.index')
            ->with('success', 'Product added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // اشوف one product 
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // تعديل ع product 
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // لازم احدد البيانات 
        $request->validate([
            'name'=>'required',
            'details'=>'required',
        ]);
        $input = $request->all();
        if($image = $request->file('image')) {
            $destinationPath = '/images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']); // not updated image
        }

        $product->update($input);
        return redirect()->route('products.index')
            ->with('Success', 'Products updated Succeccfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('Success', 'Products Deleted Successfully');
    }
}

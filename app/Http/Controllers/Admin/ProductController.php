<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::get();

        return view('Admin.Products.product', $data);
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
    public function store(Request $request)
    {
        // ✅ 1. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id'   => 'required',
            'price'   => 'required',
            'qty'   => 'required',
            'description'   => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🖼️ 2. ถ้ามีรูปให้บันทึกและ resize ก่อน
        $imagePath = null;

        if ($request->hasFile('image')) {
            // 1) เตรียมโฟลเดอร์และชื่อไฟล์ (หลีกเลี่ยงชื่อไทย)
            $dir = 'uploads/product';
            Storage::disk('public')->makeDirectory($dir); // สร้างถ้ายังไม่มี

            $ext = strtolower($request->file('image')->getClientOriginalExtension() ?: 'jpg');
            // ตั้งชื่อให้ปลอดภัยต่อระบบไฟล์ (เลี่ยงอักขระพิเศษ/ไทย)
            $filename = time() . '_' . Str::random(8) . '.' . $ext;

            // 2) ประมวลผลรูป (orientate + resize + compress)
            $image = Image::make($request->file('image')->getRealPath())
                ->orientate()
                ->resize(800, 800, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                })
                ->encode($ext, 85); // บีบอัด 85%

            // 3) เขียนผ่าน Storage (เลี่ยง path ปัญหาบน Windows)
            Storage::disk('public')->put($dir . '/' . $filename, (string) $image);

            $imagePath = $dir . '/' . $filename; // เก็บใน DB
        }


        // 💾 3. บันทึกลงฐานข้อมูล
        $product = new Product();
        $product->name = $validated['name'];
        $product->category_id = $validated['category_id'];
        $product->price = $validated['price'];
        $product->qty = $validated['qty'];
        $product->user_id = Auth::user()->id;
        $product->description = $validated['description'] ?? null;
        $product->image = $imagePath;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
            'data'    => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list(Request $request)
    {
        $product = Product::select(['products.*','categories.name as category_name'])
            ->join('categories','categories.id','products.category_id')
            ->latest()
            ->get()
            ->map(function ($c) {
                return [
                    'id'          => $c->id,
                    'name'        => $c->name,
                    'description' => $c->description,
                    'category_name' => $c->category_name,
                    'image' => $c->image,
                    'price' => $c->price,
                    'qty' => $c->qty,
                    'created_at'  => $c->created_at,
                    'action' => '
                        <button class="btn btn-sm btn-warning edit-btn" data-id="' . $c->id . '">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $c->id . '">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    '
                ];
            });

        return response()->json(['data' => $product]);
    }
}

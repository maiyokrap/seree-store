<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.Categories.category');
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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description'   => 'nullable|string'
            ]);

            $category = Category::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
                'data' => $category,
            ], 201);
        } catch (\Exception $e) {
            // จับทุก error เช่น DB ล่ม, permission เขียนไฟล์ไม่ได้, model ผิด
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category.',
                'error'   => $e->getMessage(), // dev เท่านั้น — ถ้า prod ควรซ่อนไว้
            ], 500);
        }
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
        $cats = Category::query()
            ->select(['id','name','description','created_at'])
            ->latest()
            ->get()
            ->map(function ($c) {
                return [
                    'id'          => $c->id,
                    'name'        => $c->name,
                    'description' => $c->description,
                    'created_at'  => $c->created_at,
                    'action' => '
                        <button class="btn btn-sm btn-warning edit-btn" data-id="'.$c->id.'">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="'.$c->id.'">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    '
                ];
            });

        return response()->json(['data' => $cats]);
    }
}

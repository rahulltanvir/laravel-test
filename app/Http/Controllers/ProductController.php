<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Models\ProductImage;
use App\Models\ProductSpecification;

class ProductController extends Controller
{
    /**
     * CREATE PAGE
     */
    public function index()
    {
        return view('admin.products.index', [
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'units'      => Unit::all(),
        ]);
    }

    /**
     * AJAX SUBCATEGORY
     */
    public function getSubcategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();

        return response()->json([
            'status' => true,
            'data'   => $subcategories
        ]);
    }

    /**
     * STORE PRODUCT
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'subcategory_id'    => 'required',
            'name'              => 'required|unique:products,name',
            'regular_price'     => 'required|numeric',
            'sale_price'        => 'nullable|numeric',
            'discount'          => 'nullable|numeric',
            'stock'             => 'nullable|integer',
            'thumbnail'         => 'required|image|mimes:jpg,jpeg,png,webp',
            'images.*'          => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'            => 'required',
        ]);

        DB::beginTransaction();

        try {

            $product = new Product();

            $product->category_id    = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id       = $request->brand_id;
            $product->unit_id        = $request->unit_id;

            $product->name = $request->name;
            $product->slug = Str::slug($request->name);

            $product->sku          = $request->sku;
            $product->product_code = $request->product_code;

            $product->stock = $request->stock ?? 0;

            $product->regular_price = $request->regular_price;
            $product->sale_price    = $request->sale_price;
            $product->discount      = $request->discount;

            $product->short_description = $request->short_description;
            $product->long_description  = $request->long_description;

            $product->featured = $request->featured ?? 0;
            $product->status   = $request->status;

            /**
             * THUMBNAIL UPLOAD
             */
            if ($request->hasFile('thumbnail')) {

                $file = $request->file('thumbnail');

                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/products'), $fileName);

                $product->thumbnail = 'uploads/products/' . $fileName;
            }

            $product->save();

            /**
             * GALLERY IMAGES
             */
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $img) {

                    $imgName = time() . '_' . rand() . '.' . $img->getClientOriginalExtension();

                    $img->move(public_path('uploads/products/gallery'), $imgName);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => 'uploads/products/gallery/' . $imgName,
                    ]);
                }
            }

            /**
             * SPECIFICATIONS
             */
            if ($request->spec_key) {

                foreach ($request->spec_key as $key => $value) {

                    if (!empty($request->spec_key[$key])) {

                        ProductSpecification::create([
                            'product_id' => $product->id,
                            'spec_key'   => $request->spec_key[$key],
                            'spec_value' => $request->spec_value[$key],
                        ]);
                    }
                }
            }

            DB::commit();

            return back()->with('success', 'Product Created Successfully');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * MANAGE PRODUCTS
     */
    public function manage()
    {
        $products = Product::with([
            'category',
            'subcategory',
            'brand'
        ])->latest()->get();

        return view('admin.products.manage', compact('products'));
    }

    /**
     * SHOW PRODUCT DETAILS
     */
    public function show($slug)
    {
        $product = Product::with([
            'images',
            'specifications',
            'category',
            'subcategory',
            'brand'
        ])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view('admin.products.manage', compact(
            'product',
            'relatedProducts'
        ));
    }

    /**
     * EDIT PAGE
     */
    public function edit($id)
    {
        $product = Product::with([
            'images',
            'specifications'
        ])->findOrFail($id);

        return view('admin.products.edit', [
            'product'    => $product,
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'units'      => Unit::all(),
        ]);
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'       => 'required',
            'subcategory_id'    => 'required',
            'name'              => 'required|unique:products,name,' . $id,
            'regular_price'     => 'required|numeric',
            'sale_price'        => 'nullable|numeric',
            'discount'          => 'nullable|numeric',
            'stock'             => 'nullable|integer',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images.*'          => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'            => 'required',
        ]);

        $product = Product::findOrFail($id);

        DB::beginTransaction();

        try {

            $product->category_id    = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id       = $request->brand_id;
            $product->unit_id        = $request->unit_id;

            $product->name = $request->name;
            $product->slug = Str::slug($request->name);

            $product->sku          = $request->sku;
            $product->product_code = $request->product_code;

            $product->stock = $request->stock ?? 0;

            $product->regular_price = $request->regular_price;
            $product->sale_price    = $request->sale_price;
            $product->discount      = $request->discount;

            $product->short_description = $request->short_description;
            $product->long_description  = $request->long_description;

            $product->featured = $request->featured ?? 0;
            $product->status   = $request->status;

            /**
             * UPDATE THUMBNAIL
             */
            if ($request->hasFile('thumbnail')) {

                if ($product->thumbnail &&
                    file_exists(public_path($product->thumbnail))) {

                    unlink(public_path($product->thumbnail));
                }

                $file = $request->file('thumbnail');

                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/products'), $fileName);

                $product->thumbnail = 'uploads/products/' . $fileName;
            }

            $product->save();

            /**
             * ADD NEW GALLERY IMAGES
             */
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $img) {

                    $imgName = time() . '_' . rand() . '.' . $img->getClientOriginalExtension();

                    $img->move(public_path('uploads/products/gallery'), $imgName);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => 'uploads/products/gallery/' . $imgName,
                    ]);
                }
            }

            /**
             * UPDATE SPECIFICATIONS
             */
            ProductSpecification::where('product_id', $product->id)->delete();

            if ($request->spec_key) {

                foreach ($request->spec_key as $key => $value) {

                    if (!empty($request->spec_key[$key])) {

                        ProductSpecification::create([
                            'product_id' => $product->id,
                            'spec_key'   => $request->spec_key[$key],
                            'spec_value' => $request->spec_value[$key],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('product.manage')
                ->with('success', 'Product Updated Successfully');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * DELETE PRODUCT
     */
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        DB::beginTransaction();

        try {

            /**
             * DELETE THUMBNAIL
             */
            if ($product->thumbnail &&
                file_exists(public_path($product->thumbnail))) {

                unlink(public_path($product->thumbnail));
            }

            /**
             * DELETE GALLERY IMAGES
             */
            foreach ($product->images as $image) {

                if ($image->image &&
                    file_exists(public_path($image->image))) {

                    unlink(public_path($image->image));
                }

                $image->delete();
            }

            /**
             * DELETE SPECIFICATIONS
             */
            ProductSpecification::where('product_id', $product->id)->delete();

            /**
             * DELETE PRODUCT
             */
            $product->delete();

            DB::commit();

            return back()->with('success', 'Product Deleted Successfully');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //tampil data subkategori
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);

    }

    //mengirim data kategori ke view create dari kategori
    public function create()
    {
        //mengambil data icon dari tabel icon_bootstrap
        //ini digunakan agar user dapat memilih icon tanpa memasukkan code
        $link = DB::table('icon_bootstrap')->get();

        return view('dashboard.categories.create', [
            'categories' => Category::all(),
            'links' => $link
        ]);
    }

    //mengirim data kategori dari form request untuk membuat satu data kategori
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cat_name' => 'required|unique:categories|max:255',
            'icon_parent' => 'required',
            'icon_child' => 'required',
        ]);

        Category::create($validatedData);
        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/categories')->with('success','New category has been added!');
    }

    public function show(Category $category)
    {
        //
    }

    //mengirim data kategori ke view edit dari subkategori
    public function edit(Category $category)
    {
        $link = DB::table('icon_bootstrap')->get();

        return view('dashboard.categories.edit', [
            'category' => $category,
            'categories' => Category::all(),
            'links' => $link
        ]);
    }

    //melakukan update dari data yang dipilih
    public function update(Request $request, Category $category)
    {
        $rules = [
            'icon_parent' => 'required',
            'icon_child' => 'required',
        ];

        //edit jika nama kategori diubah, cek agar namanya unik
        if($request->cat_name != $category->cat_name){
            $rules['cat_name'] = 'required|unique:categories|max:255';
        }

        $validatedData = $request->validate($rules);

        Category::where('id', $category->id)
            ->update($validatedData);
        //kembali ke halaman kategori dengan alert sucess
        return redirect('/dashboard/categories')->with('success','Category has been Updated!');
    }

    //menghapus data kategori
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        //kembali ke halaman kategori dengan alert sucess
        return redirect('/dashboard/categories')->with('success','Category Berhasil Dihapus!');
    }
}

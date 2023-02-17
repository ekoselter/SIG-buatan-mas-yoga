<?php

namespace App\Http\Controllers;

use App\Models\CategoryChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryChildrenController extends Controller
{
    //tampil data subkategori
    public function index()
    {
        $categorychild = DB::table('category_children')
            ->join('categories', 'category_children.parent_id', '=', 'categories.id')
            ->select('category_children.*', 'categories.cat_name')
            ->get();

        return view('dashboard.subcategory.index', [
            'child_cats' => $categorychild
        ]);
    }

    //mengirim data kategori dan subkategori ke view create dari subkategori
    public function create()
    {
        return view('dashboard.subcategory.create', [
            'child_cats' => CategoryChild::all(),
            'categories' => Category::all(),
        ]);
    }

    //mengirim data subkategori dari form request untuk membuat satu data subkategori
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catchild_name' => 'required|unique:category_children|max:255',
            'parent_id' => 'required',
            'icon_mark' => 'image|file|mimes:png,jpg,jpeg|max:1024',
        ]);

        //jika ada yang masukkin file gambar maka taruh filenya di folder storage di folder icon-markers
        if($request->file('icon_mark')) {
            $validatedData['icon_mark'] = $request->file('icon_mark')->store('icon-markers');
        }

        //mendefinisikan id
        $count= DB::table('category_children')->count() +1;

        CategoryChild::create([
            'id' => $count,
            'catchild_name' => $validatedData['catchild_name'],
            'parent_id' => $validatedData['parent_id'],
            'icon_mark' => $validatedData['icon_mark']
        ]);
        
        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/categoryChildren')->with('success','New sub-category has been added!');
    }

    public function show(CategoryChild $categoryChild)
    {

    }

    //mengirim data kategori dan subkategori ke view edit dari subkategori
    public function edit(CategoryChild $categoryChild)
    {
        return view('dashboard.subcategory.edit', [
            'child_cat' => $categoryChild,
            'categories' => Category::all(),
        ]);
    }

    //melakukan update dari data yang dipilih
    public function update(Request $request, CategoryChild $categoryChild)
    {
        $rules = [
            'parent_id' => 'required',
            'icon_mark' => 'image|mimes:png,jpg,jpeg|file|max:1024',
        ];

        //edit jika nama subkategori diubah, cek agar namanya unik
        if($request->catchild_name != $categoryChild->catchild_name){
            $rules['catchild_name'] = 'required|unique:category_children|max:255';
        }

        $validatedData = $request->validate($rules);

        //pastikan dibawah validasi
        //jika ada perubahan gambar maka delete gambar sebelumnya yang ada distorage dan ganti dengan gambar yang baru
        if($request->file('icon_mark')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['icon_mark'] = $request->file('icon_mark')->store('icon-markers');
        }

        CategoryChild::where('id', $categoryChild->id)
            ->update($validatedData);

        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/categoryChildren')->with('success','Sub-Category has been Updated!');
    }

    //menghapus data subkategori
    public function destroy(CategoryChild $categoryChild)
    {
        if($categoryChild->icon_mark){
                Storage::delete($categoryChild->icon_mark);
            }

        CategoryChild::destroy($categoryChild->id);
        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/categoryChildren')->with('success','Sub-category Berhasil Dihapus!');
    }
}

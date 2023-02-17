<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Category;
use App\Models\CategoryChild;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //menampilkan data kategori, subkategori, dan map lalu mengirimnya ke view maps
    public function index()
    {
        $maps = DB::table('maps')
            ->join('category_children', 'maps.child_id', '=', 'category_children.id')
            ->select('maps.*', 'category_children.parent_id')
            ->get();

        return view('maps.main',[
            'maps' => $maps,
            'categories' => Category::all(),
            'category_children' => CategoryChild::all(),
            'count' => Map::all()->count(),
            'title' => 'Peta',
            'active' => 'peta'
        ]);
    }
}

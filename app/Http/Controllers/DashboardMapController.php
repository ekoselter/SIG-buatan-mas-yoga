<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryChild;

class DashboardMapController extends Controller
{
    //tampil data map dari dashboard
    public function index()
    {
        $maps = DB::table('maps')
            ->join('category_children', 'maps.child_id', '=', 'category_children.id')
            ->select('maps.*', 'category_children.catchild_name')
            ->get();

        return view('dashboard.map.index', [
            'maps' => $maps
        ]);
    }

    //engirim data map dan subkategori ke view create dari map dashboard
    public function create()
    {
        return view('dashboard.map.create', [
            'child_cats' => CategoryChild::all(),
            'maps' => Map::all(),
        ]);
    }

    //mengirim data kategori dari form request untuk membuat satu data lokasi
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id',
            'map_title' => 'required|unique:maps|max:255',
            'child_id' => 'required',
            'map_address' => 'nullable',
            'map_img' => 'image|file|mimes:png,jpg,jpeg|max:2048',
            'map_latitude' => 'required',
            'map_longitude' => 'required',
            'map_desc' => 'nullable',
            'map_url' => 'nullable',
            'map_postcode' => 'nullable',
            'map_telp' => 'nullable',
            'map_email' => 'nullable',
            'map_jambuka' => 'nullable',
            'map_pimpinan' => 'nullable',
            'pend_akredit' => 'nullable',
            'pend_kurikulum' => 'nullable',
            'pend_waktu' => 'nullable',
            'kes_rawatinap',
            'kes_igd' => 'nullable',
            'kes_harilayanan' => 'nullable',
            'kes_pasien' => 'nullable',
            'perd_luas' => 'nullable',
            'perd_statustanah' => 'nullable',
            'perd_haripasaran' => 'nullable',
            'perd_komoditas' => 'nullable',
            'perd_jmlpedagang' => 'nullable',
            'perd_jmlkios' => 'nullable',
            'sosmed_fb' => 'nullable',
            'sosmed_ig' => 'nullable',
            'sosmed_twit' => 'nullable',
        ]);

        //jika ada yang masukkin file gambar maka taruh filenya di folder storage di folder image
        if($request->file('map_img')) {
            $validatedData['map_img'] = $request->file('map_img')->store('image');
        }

        $validatedData['id'] = DB::table('maps')->count() +1;

        Map::create($validatedData);
        //kembali ke halaman map dari dashboard dengan alert sucess
        return redirect('/dashboard/maps')->with('success','New map has been added!');
    }

    public function show(Map $map)
    {
        //
    }

    //mengirim data map dan subkategori ke view edit dari map dashboard
    public function edit(Map $map)
    {
        return view('dashboard.map.edit', [
            'map' => $map,
            'child_cats' => CategoryChild::all(),
        ]);
    }

    //melakukan update dari data yang dipilih
    public function update(Request $request, Map $map)
    {
        $rules = [
            'child_id' => 'required',
            'map_address' => 'nullable',
            'map_img' => 'image|file|mimes:png,jpg,jpeg|max:2048',
            'map_latitude' => 'required',
            'map_longitude' => 'required',
            'map_desc' => 'nullable',
            'map_url' => 'nullable',
            'map_postcode' => 'nullable',
            'map_telp' => 'nullable',
            'map_email' => 'nullable',
            'map_jambuka' => 'nullable',
            'map_pimpinan' => 'nullable',
            'pend_akredit' => 'nullable',
            'pend_kurikulum' => 'nullable',
            'pend_waktu' => 'nullable',
            'kes_rawatinap',
            'kes_igd' => 'nullable',
            'kes_harilayanan' => 'nullable',
            'kes_pasien' => 'nullable',
            'perd_luas' => 'nullable',
            'perd_statustanah' => 'nullable',
            'perd_haripasaran' => 'nullable',
            'perd_komoditas' => 'nullable',
            'perd_jmlpedagang' => 'nullable',
            'perd_jmlkios' => 'nullable',
            'sosmed_fb' => 'nullable',
            'sosmed_ig' => 'nullable',
            'sosmed_twit' => 'nullable',
        ];

        //edit jika nama map diubah, cek agar namanya unik
        if($request->map_title != $map->map_title){
            $rules['map_title'] = 'required|unique:maps|max:255';
        }

        $validatedData = $request->validate($rules);

        //pastikan dibawah validasi
        //jika ada perubahan gambar maka delete gambar sebelumnya yang ada distorage dan ganti dengan gambar yang baru
        if($request->file('map_img')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['map_img'] = $request->file('map_img')->store('image');
        }

        Map::where('id', $map->id)
            ->update($validatedData);
        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/maps')->with('success','Map has been Updated!');
    }

    //menghapus data subkategori
    public function destroy(Map $map)
    {
        if($map->map_img){
                Storage::delete($map->map_img);
        }

        Map::destroy($map->id);
        //kembali ke halaman subkategori dengan alert sucess
        return redirect('/dashboard/maps')->with('success','Data Map Berhasil Dihapus!');
    }
}

<?php

namespace App\Http\Controllers\office;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() ){
            $collection = Galeri::paginate(5);
            return view('pages.office.gallery.list',compact('collection'));
        }
        return view('pages.office.gallery.main');
    }

    public function create()
    {
        return view('pages.office.gallery.input', ['galeri' => new Galeri]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required',
            'keterangan' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('foto')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('keterangan')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('keterangan'),
                ]);
            }
        }
        $galeri = new Galeri;
        $galeri->id_user = $request->id_user;
        $foto = request()->file('foto')->store("galeri");
        $galeri->foto = $foto;
        $galeri->keterangan = $request->keterangan;
        $galeri->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Tersimpan',
        ]);
    }

    public function show(Galeri $galeri)
    {
        //
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.office.gallery.input', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('foto')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('keterangan')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('keterangan'),
                ]);
            }
        }
        if($request->foto){
            Storage::delete($galeri->foto);
            $file = request()->file('foto')->store("galeri");
             $galeri->foto = $file;
        }
        $galeri->keterangan = $request->keterangan;
        $galeri->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Terubah',
        ]);
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        Storage::delete($galeri->foto);
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Terhapus',
        ]);
    }
}

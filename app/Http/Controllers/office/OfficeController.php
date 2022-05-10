<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCategory;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    public function dashboard()
    {
        $user = User::where('role','member')->count();
        $book = Book::count();
        $totalbook = DB::table('buku')->sum('jumlah_buku');
        $newBook = Book::where('edisi_buku','baru')->count();
        $category = BookCategory::count();
        $borrowers = Borrow::count();
        $oldBook = Book::where('edisi_buku','bekas')->count();
        $grafik = Borrow::select(DB::raw('count(id) as total , MONTH(created_at) as month , YEAR(created_at) as year'))
        ->groupbyRaw('MONTH(created_at)')
        ->groupbyRaw('YEAR(created_at)')
        ->get();
        $arrv = array();
        foreach($grafik as $gr){
            $monthname = date("F", mktime(0, 0, 0, $gr->month, 10));
            $format = $gr->monthname;
            $temp=array(
                "id" => $gr->id,
                "month" => $gr->month,
                "monthname" => $monthname,
                "format" => $format,
                "year" => $gr->year,
                "total" => $gr->total,
            ); 
            array_push($arrv,$temp);
        }
        $grafik = json_encode($arrv);
        return view('pages.office.dashboard',compact('user', 'book', 'category','newBook', 'oldBook','totalbook','grafik','borrowers'));
    }

    public function home()
    {
        return view('pages.office.home');
    }
    
    public function info()
    {
        return view('pages.office.info');
    }
   
    public function shoawall(Request $request)
    {
        if($request->ajax())
        {
            $keywords = $request->keywords;
            $collection = BookCategory::where('nama_kategori','like','%'.$keywords.'%')->paginate(12);
            return view('pages.office.group-category.list',compact('collection'));
        }
        return view('pages.office.group-category.main');
    }

}

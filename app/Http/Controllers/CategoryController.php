<?php

namespace App\Http\Controllers;

use App\Models\Category;
//use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){

//        $categories = DB::table('categories')->get();
        $categories = Category::all();

        //        $conditional_categories = DB::table('categories')
//            ->select('title', 'slug','created_at')
//            ->whereDate('created_at', '!=','2025-07-22')
//            ->orWhere(function (Builder $query) {
//                $query->whereIn('slug', ['drama', 'romance']);
//            })
//            ->get();

//        $conditional_categories = Category::select('id','title', 'created_at')
//            ->whereDate('created_at', '!=','2025-07-23')
//            ->orWhere(function (Builder $query) {
//                $query->whereIn('slug', ['drama', 'romance']);
//            })
//            ->get();

//        return $conditional_categories;
        return $categories;
    }

    public function show($id){

//        $category = DB::table('categories')->find($id);

//        $category = DB::table('categories')->where('id', $id)
//                   ->select('id', 'slug', 'created_at')->first();

//        $category = Category::select('id', 'slug', /* 'created_at' , */ 'updated_at')
//                    ->where('id', $id)->first();

        $category = Category::select('id', 'title', 'slug') // pilih kolom di sini
                            ->findOrFail($id);

        return $category;
    }

    public function store(Request $request){

        $category = DB::table('categories')->insert([
            'title' => $request['title'],
            'slug' => Str::slug($request['title']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $category;

//        $categories = DB::table('categories')->insert([
//            ['title' => 'Komedi', 'slug' => Str::of('komedi')->slug('-')],
//            ['title' => 'Hantu', 'slug' => Str::of('hantu')->slug('-')],
//            ['title' => 'Dokumenter', 'slug' => Str::of('dokumenter')->slug('-')],
//        ]);
//
//        return $categories;


//        $category = new Category();
//
//        $category->title = $request['title'];
//        $category->slug = Str::of($request['title'])->slug('-');
//
//        $category->save();

        // must match the $fillable
//        $category = Category::create([
//            'title' => $request['title'],
//            'slug' => Str::of($request['title'])->slug('-')
//        ]);

//        $categories = Category::insert([
//            ['title' => 'Kocak', 'slug' => Str::of('kocak')->slug('-')],
//            ['title' => 'Wali', 'slug' => Str::of('wali')->slug('-')],
//        ]);
//
//        return $categories;
    }

    public function update(Request $request, $id){

//        $category  = DB::table('categories')->where('id', $id)->update([
//            'title' => $request['title'],
//            'slug' => Str::of($request['title'])->slug('-'),
//            'updated_at' => now(),
//        ]);


        //using Eloquent
//        $category = Category::findOrFail($id);
//
//        if ($category){
//            $category->title = $request['title'];
//            $category->slug = Str::of($request['title'])->slug('-');
//            $category->save();
//        }

        $category = Category::where('id', $id)->update([
            'title' => $request['title'],
            'slug' => Str::of($request['title'])->slug('-'),
            'updated_at' => now(),
        ]);

        return $category;
    }

    public function destroy($id){

//        DB::table('categories')->where('id', $id)->delete();

//        $category = Category::find($id);
//        if ($category){
//            $category->delete();
//        }
        Category:: destroy($id);

        return true;
    }


}

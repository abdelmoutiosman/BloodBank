<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Post::all();
        return view('posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id')->toArray();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required|unique:posts,title',
                'body'=>'required',
                'image'=>'required',
                'category_id'=>'required'
            ]);
            $post=Post::create($request->all());
            if($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path.'/images/'; // upload path
                $logo = $request->file('image');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time().''. rand(11111, 99999).'.'.$extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $post->update(['image' => 'images/'.$name]);
            }
            $post->save();
            flash()->success("Added Successfuly");
            return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Post::findOrFail($id);
        return view('posts.edit',compact('model'));
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
        $post=Post::find($id);
        $this->validate($request, [
            'title' => 'required',Rule::unique('products', 'name')->ignore($post->id),
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);
        $post->update($request->except('image'));
        if($request->hasFile('image')) {
            if(file_exists($post->image))
                unlink($post->image);
            $path = public_path();
            $destinationPath = $path.'/images/'; // upload path
            $logo = $request->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time().''.rand(11111, 99999).'.'.$extension; // renameing imag
            $logo->move($destinationPath, $name);// uploading file to given path
            $post->image = 'images/'.$name;
        }
        $post->save();
        flash()->success("Edited Successfuly");
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::find($id);
        if (!$record) {
            return response()->json([
                    'status'  => 0,
                    'message' => 'تعذر الحصول على البيانات'
                ]);
        }
        if(file_exists($record->image))
            unlink($record->image);
        $record->delete();
        return response()->json([
                'status'  => 1,
                'message' => 'تم الحذف بنجاح',
                'id'      => $id
        ]);
    }
}

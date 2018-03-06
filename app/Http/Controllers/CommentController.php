<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Sadala;
use App\Comment;
use SoftDelete;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'comment' => 'required|max:100'
        ]);

        $data = $request->all();
        $comment = new Comment;
        $comment->fill($data);
        $comment->save();
        $request->session()->flash('success', 'Комментарий размещен!');
      return redirect()->route('articleShow', $id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Post::find($id);
        $comments = Comment::select()->where('post_id', $id)->get();
        return view('admins.article_show')->with(['show' => $show,

            'comments' => $comments]);
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
    public function destroy($commentid, $postid)
    {
        $comment=Comment::find($commentid);
       $comment->delete();
       
       return redirect()->route('AdminArticleShow', $postid)->with('success', 'Комментарий удалён');;
        }
}

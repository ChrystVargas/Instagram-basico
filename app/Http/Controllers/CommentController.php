<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        //Recoger datos del formulario
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asigno los valores al nuevo obj
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();

        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'Has publicado tu comentario correctamente.']);
    }

    public function delete($id){
        //Conseguir datos del usuario identificado
        $user = Auth::user();
        //Conseguir obj del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueno del comentario o de la publicacion
        if ($user && ($comment->user_id == $user->id || $comment->image->user->id == $user->id)) {
            $comment->delete();
            return redirect()->route('image.detail',['id'=>$comment->image->id])->with(['message'=>'Comentario eliminado correctamente.']);
        } else {
            return redirect()->route('image.detail',['id'=>$comment->image->id])->with(['message'=>'El comentario no se a eliminado.']);
        }

    }
}

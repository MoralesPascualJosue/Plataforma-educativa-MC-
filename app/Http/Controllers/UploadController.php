<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function uploadFileimage(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('images/'.$id,$fileName,'public');
            return $ruta;
        }

        abort(402,"Archivo no seleccionado");

    }

    public function uploadFilevideo(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|mimes:mpeg,mp4,webm,mov,flv,avi,wmv|max:307200'
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('media/'.$id,$fileName,'public');
            return asset($ruta);
        }

        abort(402,"Archivo no seleccionado");

    }

    public function uploadFiledoc(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|mimes:pdf|max:30720'
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('archivos/'.$id,$fileName,'public');
            return asset($ruta);
        }

        abort(402,"Archivo no seleccionado");

    }

    public function uploadFile(Request $request){
        if ($files = $request->file('fileToUpload')) {
            $data;            
            $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|max:51200',
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('archivos/'.$id,$fileName,'public');            

            $data['url'] = asset($ruta);
            $data['type'] = request()->fileToUpload->getClientOriginalExtension();
            $data['name'] = request()->fileToUpload->getClientOriginalName();
            $data['icon'] = "../resources/icons/work.svg";
            return $data;
        }

        abort(402,"Archivo no seleccionado");
    }

    public function uploadFilee(Request $request){

        $types = array('jpeg','png','jpg','gif','svg');      
        if ($files = $request->file('file')) {
            $data;            
            $id = Auth::user()->id;
            request()->validate([
                'file' => 'required|max:51200',
            ]);
            $fileName = "file".time().request()->file->getClientOriginalName();
            $ruta = request()->file->storeAs('archivos/'.$id,$fileName,'public');            

            $data['url'] = $ruta;
            $data['name'] = request()->file->getClientOriginalName();
            $data['type'] = request()->file->getClientOriginalExtension();
            $data['icon'] = "resources/icons/work.svg";

            if (in_array($data['type'],$types)) {
                $data['icon'] = $ruta;
            }
            return $data;
        }

        abort(402,"Archivo no seleccionado");

    }

    public function remove($id,Request $request){

        $input = $request->all();
        $message;
        if(is_File($input["path"])){
            Storage::delete($input["path"]);
            $message = "Archivo eliminado";
        }else{
            $message = "Archivo no encontrado";
        }

       return $message;

    }
}


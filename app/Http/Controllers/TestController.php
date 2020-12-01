<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Curso;
use App\Models\Test;
use App\Models\Test_questions;
use App\Models\Test_question_options;
use App\Models\Test_result;
use App\Models\Test_question_answered;
use App\Events\TestEvent;

class TestController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeTest($id,Request $request){
        $input =  [];
        $miusuario = Auth::user();

        if(!$miusuario->hasPermissionTo('edit cursos')){
            abort(404,"No disponible");
        }

        $date = date("Y-m-d");
        $mod_date = strtotime($date."+ 2 days");

        $input['title'] = "Nueva prueba  $date ";        
        $input['instructions'] = "";
        $input['fecha_inicio'] = $date;
        $input['fecha_final'] = date("Y-m-d",$mod_date); 
        $input['visible'] = 0;
        $input['type'] = "test";
        $input['result_release'] = 0;
        $input['num_takes'] = 1;
        $input['curso_id'] = $id;

        $test = Test::create($input);

        return $test;
    }

     public function updateTest($id, Request $request)
    {   
        $miusuario = Auth::user();

        if ($miusuario->cannot("edit cursos")) {
            abort(404,"No disponible");
        }
        $input = $request->all();

        $input["result_release"] = 0;
        $input["end_date"] = $request["fecha_final"];
        $input["start_date"] = $request["fecha_inicio"];
        $input["title"] = $request["title"];
        $input["num_takes"] = $request["intentos"];

        if($request["visible"] == "true"){
            $input["visible"] = 1;
        }else{
            $input["visible"] = 0;
        }

        $test = Test::find($id);
        $curso = Curso::find($test->curso_id);

        
        if($input["start_date"] > $input["end_date"]){
            abort(403,"fechas no validas");
        } 
        
        if (empty($test)) {
           abort(404,'Prueba no disponible');
        }

        if ($test->visible == 0 and $input['visible'] == 1) {
            $test->update($input);
            event(new TestEvent($test,$curso));
        }else{
            $test->update($input);
        }

         return $test;
    }

     public function destroyTest($id,Request $request)
    {
        
        $miusuario = Auth::user();

        if ($miusuario->cannot("edit cursos")) {
            abort(404,"No disponible");
        }

        $test = Test::find($id);

        if (empty($test)) {
            return 'Prueba no encontrada';
        }

        $test->delete();

        if($request->ajax()){
            return "Prueba eliminada";
        }

       return "No disponible";
    }

    public function showTest($id,Request $request)
    {
        $miusuario = Auth::user();
        $test = Test::find($id);      
        $contestado = false;
        $calificacion = 0;
        
        if (empty($test)) {
            abort(404,'No disponible');
        }        
        
       if(!$miusuario->hasPermissionTo('edit cursos')){
           $estado = Test::find($id)->results()->where("estudiante_id",Auth::user()->estudiante()->get()[0]->id)->count();
            if ($estado > 0) {
                $test["result"] = Test::find($id)->results()->where("estudiante_id",Auth::user()->estudiante()->get()[0]->id)->get();
                $contestado = true;
            }
        }
        
        $test['questions'] = $test->questions()->get();

        foreach ($test['questions'] as $question) {
            $question['options'] =Test_question_options::where('question_id',$question->id)->get();
            if ($contestado) {
                $question["respuesta"] = Test_question_answered::where('question_id',$question->id)->where('estudiante_id',Auth::user()->estudiante()->get()[0]->id)->get();
                $question["calificacion"] = Test_question_answered::select("qualification")->where('question_id',$question->id)->where('estudiante_id',Auth::user()->estudiante()->get()[0]->id)->sum("qualification");
                $calificacion+=$question["calificacion"];
            }
        }

        $test["estado"] = $contestado;
        $test["calificacion"] = $calificacion;

        return $test;

    }

    public function storeQuestion($id,Request $request)
    {
        $miusuario = Auth::user();
        $input = $request->all();
        $inputquestion['test_id'] = $id;
        $inputquestion['question'] = $input['label'];
        $inputquestion['type'] = $input['type'];
        $inputquestion['feedback'] = "";        

        $test = Test::find($id);
        
        if(!$miusuario->hasPermissionTo('edit cursos')){
            abort(404,'No disponible');
        }

        if (empty($test)) {
            abort(404,"No disponible");
        }

        $inputquestion['curso_id'] = $test->curso_id;        
        
        $question = Test_questions::create($inputquestion);

        if (empty($question)) {
            abort(404,'No disponible');
        }

        if (!empty($input['options'])) {
            foreach($input["options"] as $option){
                $in['option'] = $option[0];                
                $in['answer'] = 0;
                $in['question_id'] = $question->id;

                Test_question_options::create($in);    
            }
        }

        return "Pregunta creada";
    }

    public function deleteQuestion($id,Request $request)
    {
        $question = Test_questions::find($id);

        if(!$miusuario->hasPermissionTo('edit cursos')){
            abort(404,'No disponible');
        }

        if (empty($question)) {
            abort(404,'No disponible');
        }

        $question->delete();

        return "Eliminado";

    }

    public function resultTest($id,Request $request)
    {
        $input = $request->all();        
        $estado = Test::find($id)->results()->where("estudiante_id",Auth::user()->estudiante()->get()[0]->id)->count();

        if ($estado > 0) {
            abort(404,"Contestado");
        }

        foreach ($input["preguntas"] as $question) {
            $aux = Test_questions::where("id",$question)->get()[0];               

            if(is_array($input["respuestas"][$question])){
                
                foreach ($input["respuestas"][$question] as $answer) {
                    $inputanswe["answer"] = $answer;
                    $inputanswe["qualification"] = 0;
                    $inputanswe["notes"] = "";
                    $inputanswe["question_id"] = $aux->id;
                    $inputanswe["estudiante_id"] = Auth::user()->estudiante()->get()[0]->id;
                    
                    Test_question_answered::create($inputanswe);            
                }
            }else{
                $inputanswe["answer"] = $input["respuestas"][$question];
                $inputanswe["qualification"] = 0;
                $inputanswe["notes"] = "";
                $inputanswe["question_id"] = $aux->id;
                $inputanswe["estudiante_id"] = Auth::user()->estudiante()->get()[0]->id;
                
                Test_question_answered::create($inputanswe);            
            }            
        }
        $inputresult["state"]=1;
        $inputresult["result"] = 0;
        $inputresult["taken_date"] =  date("Y-m-d");;
        $inputresult["test_id"] = $id;
        $inputresult["estudiante_id"] = Auth::user()->estudiante()->get()[0]->id;
        

        $result = Test_result::create($inputresult);

        return $result;
    }

     public function trabajos($id, Request $request)
    {
        $test = Test::find($id);

        if(empty($test)){
            abort(404,'No disponible');
        }

        $curso = Curso::find($test->curso_id);
        
        $estudiantes = $curso->estudiantes()->orderBy("name")->get();
        $numeroentregas = 0;
        $enrevision = 0;
        foreach($estudiantes as $estudiante){
            $qua = $estudiante->tests()->where("test_id","=",$id)->get();
            if(empty($qua['0'])){
                $estudiante["qualificationestado"] = "Sin entregas";
                $estudiante["qualificationqualification"] = "NA";
            }else{
                $estudiante["qualificationestado"] =$qua['0']->state;
                $estudiante["qualificationqualification"] = $qua['0']->result;
                
                if($qua['0']->state == 1){
                    $enrevision++;
                }

                $numeroentregas++;
            }
        }

        $works = [];      
        if($request->ajax()){
            $data["activitie"] = $test;
            $data["estudiantes"] = $estudiantes;
            $data["curso"] = $curso;
            $data["works"] = $works;
            $data["numeroentregas"] = $numeroentregas;
            $data["enrevision"] = $enrevision;
            $data["type"] = "test";

            return $data;
        }          
        
        return "No disponible";
    }    

    public function showworks($activitie,$estudiante)
    {
        if(!(Auth::user()->hasPermissionTo('edit cursos'))){
            abort(404,"No disponible");
        }

        $test = Test::find($activitie);      
        $contestado = false;
        $calificacion = 0;
        
        if (empty($test)) {
            abort(404,'No disponible');
        }        
        
        $estado = Test::find($activitie)->results()->where("estudiante_id",$estudiante)->count();
        if ($estado > 0) {
            $test["result"] = Test::find($activitie)->results()->where("estudiante_id",$estudiante)->get();
            $contestado = true;
        }
        
        $test['questions'] = $test->questions()->get();

        foreach ($test['questions'] as $question) {
            $question['options'] =Test_question_options::where('question_id',$question->id)->get();
            if ($contestado) {
                $question["respuesta"] = Test_question_answered::where('question_id',$question->id)->where('estudiante_id',$estudiante)->get();
                $question["calificacion"] = Test_question_answered::select("qualification")->where('question_id',$question->id)->where('estudiante_id',$estudiante)->sum("qualification");
                $calificacion+=$question["calificacion"];
            }
        }

        $test["estado"] = $contestado;
        $test["calificacion"] = $calificacion;

        return $test;
    }

    public function puntajes($activitie,$estudiante,Request $request)
    {
        if(!(Auth::user()->hasPermissionTo('edit cursos'))){
            abort(404,"No disponible");
        }

        $input = $request->all();
        $calificacion = 0;

         foreach ($input["puntajes"] as $question) {
            $aux = Test_questions::find($question["question"]);
            foreach ($question["calificacion"] as $answer) {                
                $respuesta = Test_question_answered::find($answer['pregunta']);
                $inputanswe["qualification"] = $answer["valor"];
                $respuesta->update($inputanswe);
                $calificacion += $answer["valor"];
            }
        }

        $result = Test_result::where("test_id",$activitie)->where("estudiante_id",$estudiante)->limit(1);
        $inputresult["state"] = 2;
        $inputresult["result"] = $calificacion;
        
        $result->update($inputresult); 

        $data["calificacion"] = $calificacion;

        return $data;
    }
}

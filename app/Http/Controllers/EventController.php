<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventoNuevo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class EventController extends Controller
{
    //
    public function index(Request $request){
        if($request->ajax()) {
        
            $data = Event::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('full_calender');
    }

    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

    public function prueba(){
        $fechaCreacion = Carbon::now();
        return view('prueba', compact('fechaCreacion'));
    }

    public function mostrarEventos(){
        
        $eventos = EventoNuevo::all()->map(function($evento){
            return [
                'title' => $evento->nombre,
                'start' => $evento->fecha_inicio,
                'end' => $evento->fecha_fin,
                'grupo' => $evento->grupo,
                'responsable' => $evento->responsable,
                'estado' => $evento->estado,
                'fecha_creacion' => $evento->fecha_creacion,
                'prioridad' => $evento->prioridad,
            ];
        });

        return response()->json($eventos);
    }

    public function registrarEvento(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'grupo' => 'required|string|min:3|max:255',
            'responsable' => 'required|string|min:3|max:255',
            'estado' => 'required|string|min:3|max:255',
            'prioridad' => 'required|string|min:3|max:255',
            // 'Fecha_creacion' => 'required|date',
            // 'Fecha_inicio' => 'required|date',
            // 'Fecha_fin' => 'required|date',
        ]);

        EventoNuevo::create($request->all());

        return response()->json(['success' => 'Elemento creado exitosamente']);
    }
}

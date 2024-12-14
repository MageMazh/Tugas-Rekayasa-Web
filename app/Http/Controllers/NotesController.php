<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class NotesController extends Controller
{

    public function home() {
        $data = Redis::get('notes');
    
        if (!$data) {
            $data = DB::table('notes')->get();
            Redis::set('notes', json_encode($data));
        } else {
            $data = json_decode($data);
        }

        return Inertia::render('Home', compact('data'));
    }

    public function addNote(Request $request) {
        $title = $request->input('title');
        $description = $request->input('description');
    
        Notes::create([
            'title' => $title,
            'description' => $description,
        ]);
    
        Redis::del('notes');
    
        $data = DB::table('notes')->get();
        Redis::set('notes', json_encode($data));
    
        return to_route('note.index');
    }

    public function deleteNote($id) {
        $note = Notes::find($id);
    
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }
    
        $note->delete();
    
        Redis::del('notes');

        $data = DB::table('notes')->get();
        Redis::set('notes', json_encode($data));
    
        return to_route('note.index')->with('success', 'Note deleted successfully');
    }

    public function editNoteStore(Request $request) {
        $id = $request->input('id');
        $title = $request->input('title');
        $description = $request->input('description');
        
        $note = Notes::where('id', $id)->first();

        if ($note) {
            $note->update([
                'title' => $title,
                'description' => $description,
            ]);
        }

        Redis::del('notes');

        $data = DB::table('notes')->get();
        Redis::set('notes', json_encode($data));

        return to_route('note.index');
    }

}

<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NotesController;

Route::get('/', [NotesController::class, 'home'])->name('note.index');
Route::post('/addNote', [NotesController::class, 'addNote']);
Route::post('/deleteNote/{id}', [NotesController::class, 'deleteNote']);
Route::post('/editNoteStore', [NotesController::class, 'editNoteStore']);

<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $forms = Form::all();
    return view('forms.index', compact('forms'));
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'fields' => 'required|array',
      'fields.*.label' => 'required|string|max:255',
      'fields.*.type' => 'required|string|in:text,textarea,radio,checkbox,select,date',
    ]);

    $form = Form::create([
      'title' => $request->title,
      'slug' => Str::slug($request->title),
    ]);

    foreach ($request->fields as $field) {
      $form->fields()->create([
        'label' => $field['label'],
        'type' => $field['type'],
        'placeholder' => $field['placeholder'] ?? null,
        'required' => isset($field['required']) ? true : false,
        'options' => $field['options'] ?? null,
      ]);
    }

    return redirect()->route('forms.index')->with('success', 'Form created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Form $form)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($slug)
  {
    $form = Form::where('slug', $slug)->with('fields')->firstOrFail();
    return view('forms.edit', compact('form'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $slug)
  {
    $form = Form::where('slug', $slug)->firstOrFail();

    $request->validate([
      'title' => 'required|string|max:255',
      'fields' => 'required|array',
      'fields.*.label' => 'required|string|max:255',
      'fields.*.type' => 'required|string|in:text,textarea,radio,checkbox,select,date',
    ]);

    $form->update([
      'title' => $request->title,
      'slug' => Str::slug($request->title),
    ]);

    foreach ($request->fields as $field) {
      if (isset($field['id'])) {
        $existingField = FormField::find($field['id']);
        $existingField->update([
          'label' => $field['label'],
          'type' => $field['type'],
          'placeholder' => $field['placeholder'] ?? null,
          'required' => isset($field['required']) ? true : false,
          'options' => $field['options'] ?? null,
        ]);
      } else {
        $form->fields()->create([
          'label' => $field['label'],
          'type' => $field['type'],
          'placeholder' => $field['placeholder'] ?? null,
          'required' => isset($field['required']) ? true : false,
          'options' => $field['options'] ?? null,
        ]);
      }
    }

    return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($slug)
  {
    $form = Form::where('slug', $slug)->firstOrFail();
    $form->delete();
    return redirect()->back()->with('success', 'Form deleted successfully.');
  }


  public function showResponses($slug)
  {
    $form = Form::with('responses.fields.formField')->where('slug', $slug)->firstOrFail();
    $responses = $form->responses;
    return view('forms.responses', compact('form', 'responses'));
  }


  public function preview($slug)
  {
    $form = Form::where('slug', $slug)->with('fields')->first();

    if (!$form) {
      abort(404, 'Form not found');
    }

    return view('forms.preview', compact('form'));
  }
}

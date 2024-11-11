<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Response;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function show($slug)
    {
        $form = Form::where('slug', $slug)->firstOrFail();
        return view('public.form', compact('form'));
    }

    public function store(Request $request, $slug)
    {
        $form = Form::with('fields')->where('slug', $slug)->firstOrFail();
        $validatedData = $request->validate($this->getValidationRules($form));
        $response = new Response();
        $response->form_id = $form->id;
        $response->save();
        foreach ($form->fields as $field) {
            $fieldValue = $validatedData['fields'][$field->id] ?? null;
            if (is_array($fieldValue)) {
                $fieldValue = implode(',', $fieldValue);
            }

            $response->fields()->create([
                'response_id' => $response->id,
                'form_field_id' => $field->id,
                'value' => $fieldValue,
            ]);
        }

        return redirect()->route('forms.show', $slug)->with('success', 'Your response has been saved successfully.');
    }

    private function getValidationRules($form)
    {
        $rules = [];

        foreach ($form->fields as $field) {
            $rules['fields.' . $field->id] = $field->required ? 'required' : 'nullable';

            if ($field->type == 'email') {
                $rules['fields.' . $field->id] .= '|email';
            }

            if ($field->type == 'date') {
                $rules['fields.' . $field->id] .= '|date';
            }
        }

        return $rules;
    }
}

@props(['disabled' => false, 'checked' => false])

<input type="checkbox" 
       {{ $attributes->merge(['class' => 'form-checkbox rounded text-blue-600']) }} 
       @checked($checked) 
       @disabled($disabled)>

@props(['disabled' => false, 'rows' => 4])

<textarea {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }} 
          rows="{{ $rows }}" 
          @disabled($disabled)>
    {{ $slot ?? '' }}
</textarea>

@guest
    <x-guest-layout>
    @endguest
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Form: ' . $form->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">{{ $form->title }}</h3>

                    <form action="{{ route('form.submit', ['slug' => $form->slug]) }}" method="POST">
                        @csrf
                        <fieldset class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach ($form->fields as $field)
                                <div className="mb-4">
                                    <x-input-label :for="'field_' . $field->id" :value="__($field->label)" class="mt-4 font-semibold" />

                                    <!-- Text/Date -->
                                    @if ($field->type == 'text' || $field->type == 'date')
                                        <input id="field_{{ $field->id }}" class="block mt-2 w-full" type="{{ $field->type }}" name="fields[{{ $field->id }}]" placeholder="{{ $field->placeholder }}" value="{{ old('fields.' . $field->id) }}" {{ $field->required ? 'required' : '' }} />

                                        <!-- Textarea -->
                                    @elseif ($field->type == 'textarea')
                                        <textarea id="field_{{ $field->id }}" class="block mt-2 w-full" name="fields[{{ $field->id }}]" placeholder="{{ $field->placeholder }}" {{ $field->required ? 'required' : '' }}>{{ old('fields.' . $field->id) }}</textarea>

                                        <!-- Radio -->
                                    @elseif ($field->type == 'radio')
                                        <div class="mt-2">
                                            @foreach (explode(',', $field->options) as $option)
                                                <label class="inline-flex items-center mr-4">
                                                    <input type="{{ $field->type }}" name="fields[{{ $field->id }}]" value="{{ $option }}" class="form-radio" {{ $field->required ? 'required' : '' }}>
                                                    <span class="ml-2">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Checkbox -->
                                    @elseif ($field->type == 'checkbox')
                                        <div class="mt-2">
                                            @foreach (explode(',', $field->options) as $option)
                                                <label class="inline-flex items-center mr-4">
                                                    <input type="{{ $field->type }}" name="fields[{{ $field->id }}][]" value="{{ $option }}" class="form-checkbox" {{ $field->required ? 'required' : '' }}>
                                                    <span class="ml-2">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Select -->
                                    @elseif ($field->type == 'select')
                                        <div class="mt-2">
                                            <select name="fields[{{ $field->id }}]" class="block mt-2 w-full" {{ $field->required ? 'required' : '' }}>
                                                <option value="" disabled selected>Select an option</option>
                                                @foreach (explode(',', $field->options) as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <x-input-error :messages="$errors->get('fields.' . $field->id)" class="mt-2" />
                                </div>
                            @endforeach
                        </fieldset>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @guest
    </x-guest-layout>
@endguest

@auth
    <x-app-layout>
    @endauth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Form: ' . $form->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">{{ $form->title }}</h3>

                    <form action="{{ route('form.submit', ['slug' => $form->slug]) }}" method="POST">
                        @csrf
                        <fieldset class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach ($form->fields as $field)
                                <div className="mb-4">
                                    <x-input-label :for="'field_' . $field->id" :value="__($field->label)" class="mt-4 font-semibold" />

                                    <!-- Text/Date -->
                                    @if ($field->type == 'text' || $field->type == 'date')
                                        <input id="field_{{ $field->id }}" class="block mt-2 w-full" type="{{ $field->type }}" name="fields[{{ $field->id }}]" placeholder="{{ $field->placeholder }}" value="{{ old('fields.' . $field->id) }}" {{ $field->required ? 'required' : '' }} />

                                        <!-- Textarea -->
                                    @elseif ($field->type == 'textarea')
                                        <textarea id="field_{{ $field->id }}" class="block mt-2 w-full" name="fields[{{ $field->id }}]" placeholder="{{ $field->placeholder }}" {{ $field->required ? 'required' : '' }}>{{ old('fields.' . $field->id) }}</textarea>

                                        <!-- Radio -->
                                    @elseif ($field->type == 'radio')
                                        <div class="mt-2">
                                            @foreach (explode(',', $field->options) as $option)
                                                <label class="inline-flex items-center mr-4">
                                                    <input type="{{ $field->type }}" name="fields[{{ $field->id }}]" value="{{ $option }}" class="form-radio" {{ $field->required ? 'required' : '' }}>
                                                    <span class="ml-2">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Checkbox -->
                                    @elseif ($field->type == 'checkbox')
                                        <div class="mt-2">
                                            @foreach (explode(',', $field->options) as $option)
                                                <label class="inline-flex items-center mr-4">
                                                    <input type="{{ $field->type }}" name="fields[{{ $field->id }}][]" value="{{ $option }}" class="form-checkbox" {{ $field->required ? 'required' : '' }}>
                                                    <span class="ml-2">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Select -->
                                    @elseif ($field->type == 'select')
                                        <div class="mt-2">
                                            <select name="fields[{{ $field->id }}]" class="block mt-2 w-full" {{ $field->required ? 'required' : '' }}>
                                                <option value="" disabled selected>Select an option</option>
                                                @foreach (explode(',', $field->options) as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <x-input-error :messages="$errors->get('fields.' . $field->id)" class="mt-2" />
                                </div>
                            @endforeach
                        </fieldset>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @auth
    </x-app-layout>
@endauth

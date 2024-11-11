<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Responses for Form: ' . $form->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col">
                                <a href="{{ route('forms.create') }}" class="m-2 text-right"><x-success-button>Create New Form</x-success-button></a>
                                <div class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                                            <tr>
                                                @foreach ($form->fields as $field)
                                                    <th scope="col" class="px-6 py-3">
                                                        {{ $field->label }}
                                                    </th>
                                                @endforeach
                                                {{-- <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($responses as $response)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    @foreach ($form->fields as $field)
                                                        <td class="px-6 py-4">
                                                            @php
                                                                $responseField = $response->fields->firstWhere('form_field_id', $field->id);
                                                            @endphp
                                                            {{ $responseField ? $responseField->value : 'No response' }}
                                                        </td>
                                                    @endforeach
                                                    {{-- <td class="px-6 py-4 mx-auto flex flex-row gap-1">
                                                        <a href="{{ route('forms.edit', $form->slug) }}"><x-secondary-button title="Edit"><i class="fa-solid fa-edit text-gray-800"></i></x-secondary-button></a>
                                                        <a href="{{ route('forms.showResponses', $form->slug) }}"><x-secondary-button title="Responses"><i class="fa-solid fa-book text-green-800"></i></x-secondary-button></a>
                                                        <a href="{{ route('forms.preview', $form->slug) }}"><x-secondary-button title="Preview"><i class="fa-solid fa-up-right-from-square text-green-800"></i></x-secondary-button></a>
                                                        <a href="{{ route('forms.preview', $form->slug) }}"><x-secondary-button title="Delete"><i class="fa-solid fa-trash-can text-red-800"></i></x-secondary-button></a>
                                                        <x-secondary-button title="Copy Url" onclick="copiedToClipboard(`{{ route('forms.show', $form->slug) }}`)"><i class="fa-solid fa-clipboard text-blue-800"></i></x-secondary-button>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

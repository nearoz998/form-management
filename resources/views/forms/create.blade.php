<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('forms.store') }}">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Form Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2" id="fields-container">
                            <!-- Dynamic Fields -->
                        </div>

                        <x-success-button type="button" class="btn btn-secondary mt-4" id="add-field">
                            Add Field
                        </x-success-button>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Save Form') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-field').addEventListener('click', function() {
            const fieldIndex = document.querySelectorAll('.field-group').length;
            const fieldGroup = document.createElement('div');
            fieldGroup.classList.add('field-group', 'mb-4');
            fieldGroup.innerHTML = `
              <div class="mb-4">
                  <x-input-label for="field_label_${fieldIndex}" :value="__('Field Label')" />
                  <x-text-input id="field_label_${fieldIndex}" class="block mt-1 w-full" type="text" name="fields[${fieldIndex}][label]" required placeholder="Enter field label" />
              </div>

              <div class="mb-4">
                  <x-input-label for="field_type_${fieldIndex}" :value="__('Field Type')" />
                  <select id="field_type_${fieldIndex}" class="block mt-1 w-full" name="fields[${fieldIndex}][type]" required>
                      <option value="text">Text</option>
                      <option value="textarea">Textarea</option>
                      <option value="radio">Radio</option>
                      <option value="checkbox">Checkbox</option>
                      <option value="select">Select</option>
                      <option value="date">Date</option>
                  </select>
              </div>

              <div class="mb-4">
                  <x-input-label for="field_placeholder_${fieldIndex}" :value="__('Placeholder')" />
                  <x-text-input id="field_placeholder_${fieldIndex}" class="block mt-1 w-full" type="text" name="fields[${fieldIndex}][placeholder]" placeholder="Enter field placeholder (optional)" />
              </div>

              <div class="mb-4">
                  <x-input-label for="field_required_${fieldIndex}" :value="__('Required')" />
                  <input type="checkbox" name="fields[${fieldIndex}][required]" class="mt-1" />
              </div>

              <div class="mb-4 options-group" style="display: none;">
                  <x-input-label for="field_options_${fieldIndex}" :value="__('Options (for radio, checkbox, select)')" />
                  <textarea id="field_options_${fieldIndex}" class="block mt-1 w-full" name="fields[${fieldIndex}][options]" placeholder="Enter options separated by commas"></textarea>
              </div>
          `;

            document.getElementById('fields-container').appendChild(fieldGroup);
            const selectFieldType = fieldGroup.querySelector('select');
            selectFieldType.addEventListener('change', function() {
                const optionsGroup = fieldGroup.querySelector('.options-group');
                optionsGroup.style.display = (this.value === 'radio' || this.value === 'checkbox' || this.value === 'select') ? 'block' : 'none';
            });
        });
    </script>
</x-app-layout>

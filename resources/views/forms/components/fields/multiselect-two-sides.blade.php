<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>



    <div class="flex w-full transition duration-75 text-sm"
    x-data="{
        state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
        options: @js($getOptionsForJs()),
        selectedOptions: [],
        availableOptions: @js($getOptionsForJs()),
        searchAvailableOptions(value){
            if(!value){
                this.availableOptions = this.options;
                return;
            }
            this.availableOptions = this.options.filter(opt => opt.label.toLowerCase().includes(value))
        },
        searchSelectedOptions(value){
            if(!value){
                this.selectedOptions = this.state;
                return;
            }

            this.selectedOptions = this.options.filter(opt=>this.state.includes(opt.value))
                .filter(opt => opt.label.toLowerCase().includes(value))
                .map(opt => opt.value)
        },
        selectOption(value){
            this.state.push(value);
            this.state = this.state.sort((a,b)=>this.options.indexOf(this.options.find(opt=>opt.value === a)) - this.options.indexOf(this.options.find(opt=>opt.value === b)));
            this.selectedOptions = this.state;

            const searchSelectedInput = document.querySelector('#ms_input-search-selected')
            if(searchSelectedInput.value){
                this.searchSelectedOptions(searchSelectedInput.value)
            }
        },
        unselectOption(value){
            this.state.splice(this.state.indexOf(value), 1);
            this.selectedOptions = this.state;

            const searchSelectedInput = document.querySelector('#ms_input-search-selectable')
            if(searchSelectedInput.value){
                this.searchSelectedOptions(searchSelectedInput.value)
            }
        },
        unselectAll(){
            this.clearInputs();
            this.state = [];
            this.selectedOptions = this.state;
        },
        selectAll(){
            this.clearInputs();
            this.state = this.options.map(opt=> opt.value);
            this.selectedOptions = this.state;
        },
        clearInputs(){
            document.querySelector('#ms_input-search-selectable').value = '';
            document.querySelector('#ms_input-search-selected').value = '';
        }
    }">

        {{-- Selectable Options --}}
        <div class="flex-1">
            <p class="bg-gray-300 text-center w-full py-2 rounded-t-lg dark:bg-gray-600">{{$getSelectableLabel()}}</p>
            <div class="p-2 border border-gray-300 bg-white rounded-b-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                @if($hasSearch())
                    <input
                            id="ms_input-search-selectable"
                            placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                            class="w-full border-gray-300 border py-2 px-1 mb-2 rounded"
                            @keyup="searchAvailableOptions($event.target.value)"
                    />
                @endif
                <ul class="h-48 overflow-y-auto">
                    <template x-for="option in availableOptions.filter(opt=>!state.includes(opt.value))">
                        <li
                            class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            x-text="option.label"
                            @click="selectOption(option.value)"
                        />
                    </template>
                </ul>
            </div>
        </div>

        {{-- Arrow Actions --}}
        <div class="justify-center flex flex-col px-2 space-y-2 translate-y-4">
            <p
               @click="selectAll"
               class="cursor-pointer p-1 hover:bg-primary-500 group"
            >
                <x-heroicon-o-chevron-double-right class="w-5 h-5 text-primary-500 group-hover:text-white" />
            </p>
            <p @click="unselectAll" class="cursor-pointer p-1 hover:bg-primary-500 group">
                <x-heroicon-o-chevron-double-left class="w-5 h-5 text-primary-500 group-hover:text-white" />
            </p>
        </div>

        {{-- Selected Options --}}
        <div class="flex-1">
            <p class="bg-gray-300 text-center w-full py-2 rounded-t-lg dark:bg-gray-600">{{$getSelectedLabel()}}</p>
            <div class="p-2 border border-gray-300 bg-white rounded-b-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                @if($hasSearch())
                    <input
                            id="ms_input-search-selected"
                            placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selected.placeholder')}}"
                            class="w-full border-gray-300 border py-2 px-1 mb-2 rounded"
                            @keyup="searchSelectedOptions($event.target.value)"
                    />
                @endif
                <ul class="h-48 overflow-y-auto">
                    <template x-for="option in selectedOptions">
                        <li
                            class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            x-text="options.find(opt=>opt.value === option).label"
                            @click="unselectOption(option.value)"
                        />
                    </template>
                </ul>
            </div>
        </div>
    </div>

</x-dynamic-component>

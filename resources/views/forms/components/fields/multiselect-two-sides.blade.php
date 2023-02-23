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
        init(){
            this.selectedOptions = this.state;
        },
        searchAvailableOptions(value = null){
            if(!value){
                this.availableOptions = this.options;
                return;
            }
            this.availableOptions = this.options.filter(opt => opt.label.toLowerCase().includes(value))
        },
        searchSelectedOptions(value = null){
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
            if(searchSelectedInput?.value){
                this.searchSelectedOptions(searchSelectedInput.value)
            }
        },
        unselectOption(value){
            this.state = this.state.filter((opt) => opt !== value);
            this.selectedOptions = this.state;

            const searchSelectedInput = document.querySelector('#ms_input-search-selectable')
            if(searchSelectedInput?.value){
                this.searchSelectedOptions(searchSelectedInput.value)
            }
        },
        unselectAll(){
            this.clearInputs();
            this.searchAvailableOptions();
            this.selectOption();
            this.state = [];
            this.selectedOptions = this.state;
        },
        selectAll(){
            this.clearInputs();
            this.searchAvailableOptions();
            this.selectOption();
            this.state = this.options.map(opt=> opt.value);
            this.selectedOptions = this.state;
        },
        clearInputs(){
            const inputSelectable = document.querySelector('#ms_input-search-selectable')

            if(inputSelectable){
                inputSelectable.value = '';
            }

            const inputSelected =  document.querySelector('#ms_input-search-selected');
            if(inputSelected){
                inputSelected.value = '';
            }
        }
    }"
        x-init="init"
    >

        {{-- Selectable Options --}}
        <div class="flex-1 border overflow-hidden rounded-lg shadow-sm"
            :class="{
            'bg-white border-gray-300': !@js(config('filament.dark_mode')),
            'dark:bg-gray-700 dark:border-gray-600': @js(config('filament.dark_mode'))
            }"
        >
            {{-- Title --}}
            <p class='text-center w-full py-4'
                :class="{
                'bg-gray-300': !@js(config('filament.dark_mode')),
                'dark:bg-gray-600': @js(config('filament.dark_mode'))
                }"
            >
                {{$getSelectableLabel()}}
            </p>
            <div class="p-2">
                {{-- Search Input --}}
                @if($isSearchable())
                    <input
                        id="ms_input-search-selectable"
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2
                        rounded focus:outline-none focus:ring-2
                        focus:ring-primary-500"
                        :class="{
                            'bg-gray-100': !@js(config('filament.dark_mode')),
                             'dark:bg-gray-600 dark:border-gray-500': @js(config('filament.dark_mode'))
                        }"
                        @keyup="searchAvailableOptions($event.target.value)"
                    />
                @endif
                {{-- Option List --}}
                <ul class="h-48 overflow-y-auto">
                    <template x-for="option in availableOptions.filter(opt=>!state.includes(opt.value))">
                        <li class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            x-text="option.label"
                            @click="selectOption(option.value)"></li>
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
            <p @click="unselectAll"
                class="cursor-pointer p-1 hover:bg-primary-500 group">
                <x-heroicon-o-chevron-double-left class="w-5 h-5 text-primary-500 group-hover:text-white" />
            </p>
        </div>

        {{-- Selected Options --}}
        <div class="flex-1 border overflow-hidden rounded-lg shadow-sm"
            :class="{
                    'bg-white border-gray-300': ! (@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                    'dark:bg-gray-700 dark:border-gray-600': ! (@js($getStatePath()) in $wire.__instance.serverMemo.errors) && @js(config('filament.dark_mode')),
                    'bg-white border-danger-600': (@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                    'dark:bg-gray-700 dark:border-danger-400': (@js($getStatePath()) in $wire.__instance.serverMemo.errors) && @js(config('filament.dark_mode')),
                }"
        >
            {{-- Title --}}
            <p class='text-center w-full py-4 rounded-t-lg'
                :class="{
                'bg-gray-300': !@js(config('filament.dark_mode')),
                'dark:bg-gray-600': @js(config('filament.dark_mode'))
                }"
            >{{$getSelectedLabel()}}</p>
            <div class="p-2"
            >
                {{-- Search Input --}}
                @if($isSearchable())
                    <input
                        id="ms_input-search-selectable"
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2
                        rounded focus:outline-none focus:ring-2
                        focus:ring-primary-500"
                        :class="{
                            'bg-gray-100': !@js(config('filament.dark_mode')),
                            'dark:bg-gray-600 dark:border-gray-500': @js(config('filament.dark_mode'))
                        }"
                        @keyup="searchSelectedOptions($event.target.value)"
                    />
                @endif
                {{--  Options List --}}
                <ul class="h-48 overflow-y-auto">
                    <template x-for="option in selectedOptions">
                        <li
                            class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            x-text="options.find(opt=>opt.value === option).label"
                            @click="unselectOption(option)"
                        ></li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

</x-dynamic-component>

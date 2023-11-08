<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-actions="$getHintActions()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"

>
    <div
        class="flex w-full transition duration-75 text-sm"
        x-data="{
            options: @js($getOptionsForJs()),
            init(){
                let selectableOptionsSearchInput = document.getElementById('{{str($getStatePath())->remove('.')}}_ms-two-sides_selectableOptionsSearchInput')
                let selectedOptionsSearchInput = document.getElementById('{{str($getStatePath())->remove('.')}}_ms-two-sides_selectedOptionsSearchInput')
                if(selectableOptionsSearchInput && selectedOptionsSearchInput){
                    selectableOptionsSearchInput.value = ''
                    selectedOptionsSearchInput.value = ''
                }
            },
            searchSelectedOptions(elementID, value){
                let liList = document.querySelectorAll(`#${elementID} li`)
                liList.forEach(li => {
                    if(li.innerHTML.toLowerCase().includes(value.toLowerCase())){
                        li.style.display = 'block'
                    }else{
                        li.style.display = 'none'
                    }
                })
            }
        }"
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
            <div
                class="p-2">
                {{-- Search Input --}}
                @if($isSearchable())
                    <input
                        id="{{str($getStatePath())->remove('.')}}_ms-two-sides_selectableOptionsSearchInput"
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2
                        rounded focus:outline-none focus:ring-2
                        focus:ring-primary-500"
                        :class="{
                            'bg-gray-100': !@js(config('filament.dark_mode')),
                             'dark:bg-gray-600 dark:border-gray-500': @js(config('filament.dark_mode'))
                        }"
                        @keyup="searchSelectedOptions('{{str($getStatePath())->remove('.')}}_ms-two-sides_selectableOptions',$event.target.value)"
                    />
                @endif
                <ul class="h-48 overflow-y-auto"
                    id="{{str($getStatePath())->remove('.')}}_ms-two-sides_selectableOptions">
                    @foreach($getSelectableOptions() as $value => $label)
                        <li
                            class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            wire:click="dispatchFormEvent('ms-two-sides::selectOption', '{{ $getStatePath() }}', '{{ $value }}')"
                        >
                            {{$label}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Arrow Actions --}}
        <div class="justify-center flex flex-col px-2 space-y-2 translate-y-4">
            <p
                wire:click="dispatchFormEvent('ms-two-sides::selectAllOptions', '{{ $getStatePath() }}')"
                class="cursor-pointer p-1 hover:bg-primary-500 group"
            >
                <x-heroicon-o-chevron-double-right class="w-5 h-5 text-primary-500 group-hover:text-white"/>
            </p>
            <p
                wire:click="dispatchFormEvent('ms-two-sides::unselectAllOptions', '{{ $getStatePath() }}')"
                class="cursor-pointer p-1 hover:bg-primary-500 group">
                <x-heroicon-o-chevron-double-left class="w-5 h-5 text-primary-500 group-hover:text-white"/>
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
            <div
                class="p-2"
            >
                {{-- Search Input --}}
                @if($isSearchable())
                    <input
                        id="{{str($getStatePath())->remove('.')}}_ms-two-sides_selectedOptionsSearchInput"
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2
                        rounded focus:outline-none focus:ring-2
                        focus:ring-primary-500"
                        :class="{
                            'bg-gray-100': !@js(config('filament.dark_mode')),
                            'dark:bg-gray-600 dark:border-gray-500': @js(config('filament.dark_mode'))
                        }"
                        @keyup="searchSelectedOptions('{{str($getStatePath())->remove('.')}}_ms-two-sides_selectedOptions',$event.target.value)"
                    />
                @endif
                {{--  Options List --}}
                <ul class="h-48 overflow-y-auto"
                    id="{{str($getStatePath())->remove('.')}}_ms-two-sides_selectedOptions">
                    @foreach($getSelectedOptions() as $value => $label)
                        <li
                            class="cursor-pointer p-1 hover:bg-primary-500 hover:text-white transition"
                            wire:click="dispatchFormEvent('ms-two-sides::unselectOption', '{{ $getStatePath() }}', '{{ $value }}')"
                        >
                            {{$label}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-dynamic-component>

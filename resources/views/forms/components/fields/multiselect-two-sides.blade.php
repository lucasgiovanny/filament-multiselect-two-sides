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
    <div
        class="flex w-full transition duration-75 text-sm"
        x-data="{
            availableOptions: @js($getSelectableOptions()),
            init(){
                console.log(this.availableOptions)
            }
        }"
    >
        {{-- Selectable Options --}}
        <div class="flex-1">
            <p class="bg-gray-300 text-center w-full py-2 rounded-t-lg dark:bg-gray-600">{{$getSelectableLabel()}}</p>
            <div
                class="p-2 border border-gray-300 bg-white rounded-b-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                @if($isSearchable())
                    <input
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2 rounded"
                    />
                @endif
                <ul class="h-48 overflow-y-auto">
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
                wire:click="dispatchFormEvent('ms-two-sides::selectAllOptions')"
                class="cursor-pointer p-1 hover:bg-primary-500 group"
            >
                <x-heroicon-o-chevron-double-right class="w-5 h-5 text-primary-500 group-hover:text-white"/>
            </p>
            <p
                wire:click="dispatchFormEvent('ms-two-sides::unselectAllOptions')"
                class="cursor-pointer p-1 hover:bg-primary-500 group"
            >
                <x-heroicon-o-chevron-double-left class="w-5 h-5 text-primary-500 group-hover:text-white"/>
            </p>
        </div>

        {{-- Selected Options --}}
        <div class="flex-1">
            <p class="bg-gray-300 text-center w-full py-2 rounded-t-lg dark:bg-gray-600">{{$getSelectedLabel()}}</p>
            <div
                class="p-2 border border-gray-300 bg-white rounded-b-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                @if($isSearchable())
                    <input
                        id="ms_input-search-selected"
                        placeholder="{{__('filament-multiselect-two-sides::filament-multiselect-two-sides.selected.placeholder')}}"
                        class="w-full border-gray-300 border py-2 px-1 mb-2 rounded"
                        @keyup="searchSelectedOptions($event.target.value)"
                    />
                @endif
                <ul class="h-48 overflow-y-auto">
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

<!-- number input -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div> @endif
        <input
        	type="text"
        	name="{{ $field['name'] }}"
            data-init-function="bpFieldInitNumberDecimalElement"
            autocomplete="off"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::fields.inc.attributes')
        	>
        @if(isset($field['suffix'])) <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div> @endif

    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}


    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="{{ asset('vendor') }}/input-mask/jquery.inputmask.js"></script>
        <script src="{{ asset('vendor') }}/input-mask/jquery.inputmask.extensions.js"></script>
        <script src="{{ asset('vendor') }}/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="{{ asset('vendor') }}/input-mask/jquery.inputmask.numeric.extensions.js"></script>

        <script type="text/javascript">

            function bpFieldInitNumberDecimalElement(element) {
                // element will be a jQuery wrapped DOM node
                element.inputmask({
                    'alias': 'decimal',
                    'groupSeparator': '.',
                    'autoGroup': true,
                    'digits': 2,
                    'digitsOptional': false,
                    'placeholder': '0',
                    'prefix': 'VND ',
                    'rightAlignNumerics': false
                });
            }

        </script>
    @endpush

@endif

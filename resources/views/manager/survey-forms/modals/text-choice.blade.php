<x-modal :id="'text-choice'" :title="__('survey_forms.text_choice')">
    <div class="col-12">
        <x-forms.textarea-new-line id="textChoiceTitle" :value="null"
                                :name="'textChoiceTitle'"
                                :label="__('survey_forms.text_choice_label')"
                                :optionals="['required' => true]"/>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary btn-clear-search"
            data-bs-dismiss="modal">{{ __('lang.back') }}</button>
        <button type="button" class="btn btn-primary add-extra" onclick="saveTextChoiceModal()"><i class="icon-save me-1"></i>
            {{ __('lang.save') }}</button>
    </x-slot>
</x-modal>

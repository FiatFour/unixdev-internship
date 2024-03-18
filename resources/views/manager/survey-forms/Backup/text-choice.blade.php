<x-modal :id="'text-choice'" :title="'คำถามหลายตัวเลือก'">
    <div class="col-6">
        <x-forms.input-new-line id="textChoiceTitle" :value="null"
                                :name="'textChoiceTitle'"
                                :label="__('survey_forms.text_choice')"
                                :optionals="['required' => true]"/>
    </div>

    <button type="button" class="btn btn-primary mb-3 float-end add-product-btn" onclick="addTextChoiceLine()">
        <i class="icon-add-circle"></i> เพิ่ม
    </button>

    <div id="text-answer" v-cloak data-detail-uri="" data-title="">
    <div class="table-wrap db-scroll col-12 extra" style="border-radius:0px ">
        <table class="table table-striped table-vcenter">
            <thead style="background: var(--neutral-bg-03, #E2E8F0);border-radius: 0px;">
                <th style="width: 1px;">#</th>
                <th style="width: 30%;">คำตอบ</th>
                <th style="width: 20%;">คะแนน</th>
                <th style="width: 1px;"></th>
            </thead>
{{--            <tbody>--}}
{{--                <template v-if="modalTextChoices.length > 0">--}}
{{--                    <tr v-for="(modalTextChoice, modalTextChoiceIndex) in modalTextChoices">--}}
{{--                        <td>--}}
{{--                            @{{ modalTextChoiceIndex + 1 }}--}}
{{--                        </td>--}}

{{--                        <td>--}}
{{--                            <input type="text" class="form-control" :id="'name-' + modalTextChoiceIndex + '-' + modalTextChoice.textChoiceIndex"--}}
{{--                                v-bind:name="'modalTextChoices[' + modalTextChoiceIndex +'][' + modalTextChoice.textChoiceIndex +'][name]'" v-model="modalTextChoice.name" />--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <input type="number" class="form-control" :id="'score-' + modalTextChoiceIndex  + '-' + modalTextChoice.textChoiceIndex"--}}
{{--                                v-bind:name="'modalTextChoices[' + modalTextChoiceIndex +'][' + modalTextChoice.textChoiceIndex +'][score]'" v-model="modalTextChoice.score" />--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a class="btn btn-outline-light btn-mini"--}}
{{--                                v-on:click="removeTextChioceLine(textChoiceIndex)"><i--}}
{{--                                    class="fa-solid fa-trash-can" style="color:red"></i></a>--}}
{{--                        </td>--}}

{{--                        <input type="hidden" v-bind:name="'modalTextChoices[' + modalTextChoiceIndex +'][id]'" v-bind:value="modalTextChoice.id"/>--}}
{{--                    </tr>--}}

{{--                </template>--}}
{{--                <template v-else>--}}
{{--                    <tr class="table-empty add-text-choice-empty">--}}
{{--                        <td class="text-center" colspan="7">" {{ __('lang.no_list') }} "</td>--}}
{{--                    </tr>--}}
{{--                </template>--}}
{{--            </tbody>--}}
        </table>
    </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary btn-clear-search"
            data-bs-dismiss="modal">{{ __('lang.back') }}</button>
        <button type="button" class="btn btn-primary add-extra" onclick="saveTextChoiceModal()"><i class="icon-save me-1"></i>
            {{ __('lang.save') }}</button>
    </x-slot>
</x-modal>

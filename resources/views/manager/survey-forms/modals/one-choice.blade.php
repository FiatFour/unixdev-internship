<x-modal :id="'one-choice'" :title="'คำถาม 1 ตัวเลือก'">
    <div class="col-6">
        <x-forms.input-new-line id="oneChoiceTitle" :value="null"
                                :name="'oneChoiceTitle'"
                                :label="__('survey_forms.one_choice')"
                                :optionals="['required' => true]"/>
    </div>

    <div>
        <label class="text-start col-form-label form-label">แบบตั้งค่าแสดงผล</label><br>
        <div class="space-x-2">
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input col-sm-4" type="radio" name="isOrderBy" value="1" id="isOrderByTrue">
                <label class="form-check-label">เรียง</label>
            </div>
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input col-sm-4" type="radio" name="isOrderBy" value="2" id="isOrderByFalse">
                <label class="form-check-label">ไม่ใช้งาน</label>
            </div>
        </div>
        <p></p>
    </div>

    <button type="button" class="btn btn-primary mb-3 float-end add-product-btn" onclick="addOneChoiceLine()">
        <i class="icon-add-circle"></i> เพิ่ม
    </button>

    <div id="one-answer" v-cloak data-detail-uri="" data-title="">
    <div class="table-wrap db-scroll col-12 extra" style="border-radius:0px ">
        <table class="table table-striped table-vcenter">
            <thead style="background: var(--neutral-bg-03, #E2E8F0);border-radius: 0px;">
                <th style="width: 1px;">#</th>
                <th style="width: 30%;">คำตอบ</th>
                <th style="width: 20%;">คะแนน</th>
                <th style="width: 1px;"></th>
            </thead>
            <tbody>
                <template v-if="modalOneChoices.length > 0">
                    <tr v-for="(modalOneChoice, modalOneChoiceIndex) in modalOneChoices">
                        <td>
                            @{{ modalOneChoiceIndex + 1 }}
                        </td>
{{--                        <td>--}}
{{--                            <input type="text" class="form-control" :id="'name-' + modalOneChoiceIndex + '-' + modalOneChoice.OneChoiceIndex"--}}
{{--                                v-bind:name="'modalOneChoices[' + modalOneChoiceIndex +'][' + modalOneChoice.OneChoiceIndex +'][name]'" v-model="modalOneChoice.name" />--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <input type="number" class="form-control" :id="'score-' + modalOneChoiceIndex  + '-' + modalOneChoice.OneChoiceIndex"--}}
{{--                                v-bind:name="'modalOneChoices[' + modalOneChoiceIndex +'][' + modalOneChoice.OneChoiceIndex +'][score]'" v-model="modalOneChoice.score" />--}}
{{--                        </td> --}}
                        <td>
                            <input type="text" class="form-control" :id="'name-' + modalOneChoiceIndex + '-' + modalOneChoice.OneChoiceIndex"
                                v-bind:name="'modalOneChoices[' + modalOneChoiceIndex +'][' + modalOneChoice.oneChoiceIndex +'][name]'" v-model="modalOneChoice.name" />
                        </td>
                        <td>
                            <input type="number" class="form-control" :id="'score-' + modalOneChoiceIndex  + '-' + modalOneChoice.OneChoiceIndex"
                                v-bind:name="'modalOneChoices[' + modalOneChoiceIndex +'][' + modalOneChoice.oneChoiceIndex +'][score]'" v-model="modalOneChoice.score" />
                        </td>
                        <td>
                            <a class="btn btn-outline-light btn-mini"
                                v-on:click="removeOneChioceLine(oneChoiceIndex)"><i
                                    class="fa-solid fa-trash-can" style="color:red"></i></a>
                        </td>

                        <input type="hidden" v-bind:name="'modalOneChoices[' + modalOneChoiceIndex +'][id]'" v-bind:value="modalOneChoice.id"/>

{{--                            <input type="hidden" v-bind:name="'modalOneChoices['+ modalOneChoiceIndex+ '][' + modalOneChoice.OneChoiceIndex +'][id]'"--}}
{{--                                   v-bind:value="item.id">--}}
{{--                            <input type="hidden" v-bind:name="'modalOneChoices['+ modalOneChoiceIndex+ '][' + modalOneChoice.OneChoiceIndex +'][name]'"--}}
{{--                                   v-bind:value="item.name">--}}
{{--                            <input type="hidden" v-bind:name="'modalOneChoices['+ modalOneChoiceIndex+ '][' + modalOneChoice.OneChoiceIndex +'][score]'"--}}
{{--                                   v-bind:value="item.score">--}}

{{--                        <input type="hidden" v-bind:name="'modal_extra_product[' + extra_index +'][rental_line_id]'"--}}
{{--                            v-model="extra.rental_line_id" />--}}
                    </tr>

                </template>
                <template v-else>
                    <tr class="table-empty add-one-choice-empty">
                        <td class="text-center" colspan="7">" {{ __('lang.no_list') }} "</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary btn-clear-search"
            data-bs-dismiss="modal">{{ __('lang.back') }}</button>
        <button type="button" class="btn btn-primary add-extra" onclick="saveOneChoiceModal()"><i class="icon-save me-1"></i>
            {{ __('lang.save') }}</button>
    </x-slot>
</x-modal>

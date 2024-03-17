<x-modal :id="'many-choice'" :title="'คำถามหลายตัวเลือก'">
    <div class="col-6">
        <x-forms.input-new-line id="manyChoiceTitle" :value="null"
                                :name="'manyChoiceTitle'"
                                :label="__('survey_forms.many_choice')"
                                :optionals="['required' => true]"/>
    </div>

    <div>
        <label class="text-start col-form-label form-label">แบบตั้งค่าแสดงผล</label><br>
        <div class="space-x-2">
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input col-sm-4" type="radio" name="isOrderByManyChoice" value="1" id="isOrderByTrueManyChoice">
                <label class="form-check-label">เรียง</label>
            </div>
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input col-sm-4" type="radio" name="isOrderByManyChoice" value="2" id="isOrderByFalseManyChoice">
                <label class="form-check-label">ไม่ใช้งาน</label>
            </div>
        </div>
        <p></p>
    </div>

    <button type="button" class="btn btn-primary mb-3 float-end add-product-btn" onclick="addManyChoiceLine()">
        <i class="icon-add-circle"></i> เพิ่ม
    </button>

    <div id="many-answer" v-cloak data-detail-uri="" data-title="">
    <div class="table-wrap db-scroll col-12 extra" style="border-radius:0px ">
        <table class="table table-striped table-vcenter">
            <thead style="background: var(--neutral-bg-03, #E2E8F0);border-radius: 0px;">
                <th style="width: 1px;">#</th>
                <th style="width: 30%;">คำตอบ</th>
                <th style="width: 20%;">คะแนน</th>
                <th style="width: 1px;"></th>
            </thead>
            <tbody>
                <template v-if="modalManyChoices.length > 0">
                    <tr v-for="(modalManyChoice, modalManyChoiceIndex) in modalManyChoices">
                        <td>
                            @{{ modalManyChoiceIndex + 1 }}
                        </td>

                        <td>
                            <input type="text" class="form-control" :id="'name-' + modalManyChoiceIndex + '-' + modalManyChoice.manyChoiceIndex"
                                v-bind:name="'modalManyChoices[' + modalManyChoiceIndex +'][' + modalManyChoice.manyChoiceIndex +'][name]'" v-model="modalManyChoice.name" />
                        </td>
                        <td>
                            <input type="number" class="form-control" :id="'score-' + modalManyChoiceIndex  + '-' + modalManyChoice.manyChoiceIndex"
                                v-bind:name="'modalManyChoices[' + modalManyChoiceIndex +'][' + modalManyChoice.manyChoiceIndex +'][score]'" v-model="modalManyChoice.score" />
                        </td>
                        <td>
                            <a class="btn btn-outline-light btn-mini"
                                v-on:click="removeManyChioceLine(manyChoiceIndex)"><i
                                    class="fa-solid fa-trash-can" style="color:red"></i></a>
                        </td>

                        <input type="hidden" v-bind:name="'modalManyChoices[' + modalManyChoiceIndex +'][id]'" v-bind:value="modalManyChoice.id"/>
                    </tr>

                </template>
                <template v-else>
                    <tr class="table-empty add-many-choice-empty">
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
        <button type="button" class="btn btn-primary add-extra" onclick="saveManyChoiceModal()"><i class="icon-save me-1"></i>
            {{ __('lang.save') }}</button>
    </x-slot>
</x-modal>

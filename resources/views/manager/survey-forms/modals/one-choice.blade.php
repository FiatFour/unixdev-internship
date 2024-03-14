<x-modal :id="'extra'" :title="'สินค้าและบริการเพิ่มเติม'">

    <button type="button" class="btn btn-primary mb-3 float-end add-product-btn" onclick="addOneChoice()">
        <i class="icon-add-circle"></i> เพิ่ม
    </button>

    <div class="table-wrap db-scroll col-12 extra" style="border-radius:0px ">
        <table class="table table-striped table-vcenter">
            <thead style="background: var(--neutral-bg-03, #E2E8F0);border-radius: 0px;">
                <th style="width: 1px;">#</th>
                <th style="width: 30%;">คำตอบ</th>
                <th style="width: 20%;">คะแนน</th>
                <th style="width: 25%;">ราคาต่อหน่วย</th>
                <th style="width: 25%;">รวม</th>
                <th style="width: 1px;"></th>
            </thead>
            <tbody>
                <template v-if="modal_one_choice.length > 0">
                    <tr v-for="(OneChoice, OneChoiceIndex) in modalOneChoices">
                        <td>
                            @{{ OneChoiceIndex + 1 }}
                        </td>
                        <td>
                            <input type="text" class="form-control" :id="'name-' + OneChoiceIndex"
                                v-bind:name="'modalOneChoices[' + OneChoiceIndex +'][name]'" v-model="OneChoice.name" />
                        </td>
                        <td>
                            <input type="number" class="form-control" :id="'score-' + OneChoiceIndex"
                                v-bind:name="'modalOneChoices[' + OneChoiceIndex +'][score]'" v-model="OneChoice.score" />
                        </td>
                        <td>
                            <a class="btn btn-outline-light btn-mini"
                                v-on:click="removeExtraLine(extra_index, extra.rental_line_id)"><i
                                    class="fa-solid fa-trash-can" style="color:red"></i></a>
                        </td>

                        <input type="hidden" v-bind:name="'modalOneChoices[' + OneChoiceIndex +']'"
                            v-model="extra.rental_line_id" />

{{--                        <input type="hidden" v-bind:name="'modal_extra_product[' + extra_index +'][rental_line_id]'"--}}
{{--                            v-model="extra.rental_line_id" />--}}
                    </tr>
                </template>
                <template v-else-if="product_add.length == 0">
                    <tr class="table-empty add-product-empty">
                        <td class="text-center" colspan="7">" {{ __('lang.no_list') }} "</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary btn-clear-search"
            data-bs-dismiss="modal">{{ __('lang.back') }}</button>
        <button type="button" class="btn btn-primary add-extra" onclick="saveExtra()"><i class="icon-save me-1"></i>
            {{ __('lang.save') }}</button>
    </x-slot>
</x-modal>

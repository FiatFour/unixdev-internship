<div id="text-choices" v-cloak data-detail-uri="" data-title="">
    <div class="table-wrap">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('survey_forms.text_choice') }}</h1>
            <a href="#" type="button" class="btn btn-alt-primary my-2" onclick="openTextChoiceModal()"
               id="openModal">
                <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.add') . __('survey_forms.text_choice') }}
            </a>
        </div>

        <table class="table table-striped">
            <thead class="bg-body-dark">
                <th style="width: 2px;">#</th>
                <th style="width: 15%;">คำถาม</th>
                <th class="sticky-col text-center">{{ __('manage.tools') }}</th>
            </thead>

            <tbody v-if="textChoices.length > 0">
            <tr v-for="(item, index) in textChoices">
                <td>@{{ index + 1 }}</td>
                <td>@{{ item.name }}</td>
                <td class="sticky-col text-center">
                    <div class="btn-group">
                        <div class="col-sm-12">
                            <div class="dropdown dropleft">
                                <button type="button" class="btn btn-sm btn-alt-secondary dropdown-toggle"
                                        id="dropdown-dropleft-dark" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <i class="fa fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-dropleft-dark">
                                    <a class="dropdown-item" v-on:click="editTextChoice(index)"><i
                                            class="far fa-edit me-1"></i> แก้ไข</a>
                                    <a class="dropdown-item btn-delete-row"
                                       v-on:click="removeTextChoice(index)"><i
                                            class="fa fa-trash-alt me-1"></i> ลบ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <input type="hidden" v-bind:name="'textChoices['+ index+ '][id]'" v-bind:value="item.id">

                <div v-for="(item, index) in textChoices">
                    <input type="hidden" v-bind:name="'textChoices['+ index+ '][id]'"
                           v-bind:value="item.id">
                    <input type="hidden" v-bind:name="'textChoices['+ index+ '][name]'" v-bind:value="item.name">
                    <input type="hidden" v-bind:name="'textChoices['+ index+ '][isOrderBy]'" v-bind:value="item.isOrderBy">
                </div>

                <div v-for="(item, index) in modalTextChoices">
                    <input type="hidden" v-bind:name="'textChoiceQuestions[' + index +'][id]'"
                           v-bind:value="item.id">
                    <input type="hidden" v-bind:name="'textChoiceQuestions[' + index +'][name]'"
                           v-bind:value="item.name">
                    <input type="hidden" v-bind:name="'textChoiceQuestions[' + index +'][score]'"
                           v-bind:value="item.score">
                    <input type="hidden" v-bind:name="'textChoiceQuestions[' + index +'][textChoiceIndex]'"
                           v-bind:value="item.textChoiceIndex">
                </div>
            </tr>
            </tbody>
            <tbody v-else>
            <tr class="table-empty">
                <td class="text-center" colspan="8">“
                    {{ __('manage.no_list') . __('survey_forms.text_choice') }} “
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

@include('manager.survey-forms.modals.text-choice')



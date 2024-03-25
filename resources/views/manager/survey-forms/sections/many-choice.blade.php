<div id="many-choices" v-cloak data-detail-uri="" data-title="">
    <div class="table">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('survey_forms.many_choice') }}</h1>
            <a href="#" type="button" class="btn btn-alt-primary my-2" onclick="openManyChoiceModal()" data-test="manyChoice"
               id="openModal">
                <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.add') . __('survey_forms.many_choice') }}
            </a>
        </div>

        <table class="table table-striped">
            <thead class="bg-body-dark">
                <th style="width: 2px;">#</th>
                <th style="width: 80%;" class="text-center">{{__('survey_forms.question')}}</th>
                <th class="sticky-col text-center">{{ __('manage.tools') }}</th>
            </thead>

            <tbody v-if="manyChoices.length > 0">
            <tr v-for="(item, index) in manyChoices">
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
                                    <a class="dropdown-item" v-on:click="editManyChoice(index)"><i
                                            class="far fa-edit me-1"></i> แก้ไข</a>
                                    <a class="dropdown-item btn-delete-row"
                                       v-on:click="removeManyChoice(index)"><i
                                            class="fa fa-trash-alt me-1"></i> ลบ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                <div v-for="(item, index) in manyChoices">
                    <input type="hidden" v-bind:name="'manyChoices['+ index+ '][id]'"
                           v-bind:value="item.id">
                    <input type="hidden" v-bind:name="'manyChoices['+ index+ '][name]'" v-bind:value="item.name">
                    <input type="hidden" v-bind:name="'manyChoices['+ index+ '][isOrderBy]'" v-bind:value="item.isOrderBy">
                </div>

                <div v-for="(item, index) in modalManyChoices">
                    <input type="hidden" v-bind:name="'manyChoiceQuestions[' + index +'][id]'"
                           v-bind:value="item.id">
                    <input type="hidden" v-bind:name="'manyChoiceQuestions[' + index +'][name]'"
                           v-bind:value="item.name">
                    <input type="hidden" v-bind:name="'manyChoiceQuestions[' + index +'][score]'"
                           v-bind:value="item.score">
                    <input type="hidden" v-bind:name="'manyChoiceQuestions[' + index +'][manyChoiceIndex]'"
                           v-bind:value="item.manyChoiceIndex">
                </div>
            </tr>
            </tbody>
            <tbody v-else>
            <tr class="table-empty">
                <td class="text-center" colspan="8">“
                    {{ __('manage.no_list') . __('survey_forms.many_choice') }} “
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

@include('manager.survey-forms.modals.many-choice')



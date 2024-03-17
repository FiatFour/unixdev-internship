@push('scripts')
    <script>
        let addManyChoiceVue = new Vue({
            el: '#many-choices',
            data: {
                modalManyChoices: [],
                manyChoices: [],
                editManyChoiceIndex: null,
                mode: null,
            },
            watch: {},
            methods: {
                displayManyChoice: function () {
                    $("#many-choice").show();
                },
                pushManyChoiceLine(name, score, manyChoiceIndex) {
                    let data = {
                        name: name,
                        score: score,
                        manyChoiceIndex: manyChoiceIndex,
                    }
                    console.log(this.modalManyChoices);
                    this.modalManyChoices.push(data);
                },
                setLengthManyChoice: function () {
                    return this.manyChoices.length;
                },
                addManyChoiceLine() {
                    var manyChoiceIndex = this.manyChoices.length
                    this.pushManyChoiceLine(null, 0, manyChoiceIndex);
                },
                removeManyChoiceLine: function (index) {
                    this.modalManyChoices.splice(index, 1);
                    // if(surveyLineId != null && surveyLineId != ""){
                    //     this.pending_delete_extra_product_ids.push(surveyLineId);
                    // }
                },
                addManyChoice: function () {
                    this.setManyChoiceIndex(this.setLengthManyChoice());
                    this.clearManyChoiceModalData();
                    addManyAnswerVue.setManyAnswer([]);
                    this.openModalManyChoice();
                },
                openModalManyChoice: function () {
                    $('#many-choice-modal').modal('show');
                },
                editManyChoice: function (index) {
                    this.setManyChoiceIndex(index);
                    this.loadManyChoiceModalData(index);
                    this.mode = 'edit';
                    console.log(this.editManyChoiceIndex);
                    this.openModalManyChoice();
                },
                clearManyChoiceModalData: function () {
                    $("#manyChoiceTitle").val('');
                    $("#isOrderByTrueManyChoice").prop('checked', true);
                },
                loadManyChoiceModalData: function (manyChoiceIndex) {
                    var temp = this.manyChoices[manyChoiceIndex];
                    $("#manyChoiceTitle").val(temp.name);
                    if (temp.isOrderBy == 1) {
                        $("#isOrderByTrueManyChoice").prop('checked', true);
                    } else {
                        $("#isOrderByFalseManyChoice").prop('checked', true)
                    }
                    // $("#id_field").val(temp.id);
                    var _modalManyChoices = [...this.modalManyChoices];
                    var checkId = manyChoiceIndex;

                    let cloneManyAnswer = _modalManyChoices.filter(obj => obj.manyChoiceIndex == checkId);
                    addManyAnswerVue.setManyAnswer(cloneManyAnswer);

                    $('#many-choice-modal').modal('show');
                },
                hideManyChoiceModal: function () {
                    $("#many-choice-modal").modal("hide");
                },
                saveManyChoiceModal() {
                    var _modalManyChoices = [...this.modalManyChoices];
                    var manyChoices = this.getManyChoiceDataFromModal();
                    // validate name empty
                    var validate_data = _modalManyChoices.filter((item) => {
                        return (item.name == "" || item.name == null) || (parseInt(item.score) < 0);
                    });
                    if (validate_data.length > 0) {
                        warningAlert('กรุณากรอกข้อมูลให้ถูกต้อง/ครบถ้วน');
                        return false;
                    }
                    if (this.mode == 'edit') {
                        this.saveManyChoiceEdit(manyChoices, this.editManyChoiceIndex);
                    } else {
                        this.saveManyChoiceAdd(manyChoices);
                    }
                    var cloneAllAnswer = [...this.modalManyChoices]; //clone in js [...array]
                    cloneAllAnswer = cloneAllAnswer.filter(obj => obj.manyChoiceIndex !== this.editManyChoiceIndex);
                    var returnManyAnswer = addManyAnswerVue.getManyAnswer();
                    this.modalManyChoices = cloneAllAnswer.concat(returnManyAnswer);

                    this.editManyChoiceIndex = null;
                    this.displayManyChoice();
                    this.hideManyChoiceModal();
                },
                saveManyChoiceAdd: function (manyChoices) {
                    this.manyChoices.push(manyChoices);
                },
                saveManyChoiceEdit: function (manyChoices, index) {
                    addManyChoiceVue.$set(this.manyChoices, index, manyChoices);
                },
                getManyChoiceDataFromModal: function () {
                    let name = document.getElementById("manyChoiceTitle").value;
                    let isOrderBy = $('input[name="isOrderByManyChoice"]:checked').val()
                    return {
                        name: name,
                        isOrderBy: isOrderBy,
                    };
                },
                setManyChoiceIndex: function (index) {
                    this.editManyChoiceIndex = index;
                },
                getManyChoiceIndex: function () {
                    return this.editManyChoiceIndex;
                },
                number_format(number) {
                    return number_format(number);
                },
            },
            props: ['title'],
        });

        addManyChoiceVue.displayManyChoice();
        // function addManyChoiceLine() {
        //     console.log('test');
        //     addManyChoiceVue.addManyChoiceLine();
        // }

        function saveManyChoiceModal() {
            addManyChoiceVue.saveManyChoiceModal();
        }


        // function saveCar() {
        //     addRentalVue.saveCar();
        // }
        //
        // function saveProductAdditional() {
        //     addRentalVue.saveProductAdditional();
        // }
        //
        // function addExtraProduct() {
        //     addRentalVue.addExtraProduct();
        // }

        function openManyChoiceModal() {
            addManyChoiceVue.addManyChoice();
        }

        // function openExtraModal() {
        //     addRentalVue.addExtra();
        // }
    </script>
@endpush

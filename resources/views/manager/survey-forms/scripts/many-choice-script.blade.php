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

                    let clmanyManyAnswer = _modalManyChoices.filter(obj => obj.manyChoiceIndex == checkId);
                    addManyAnswerVue.setManyAnswer(clmanyManyAnswer);

                    $('#many-choice-modal').modal('show');
                },
                hideManyChoiceModal: function () {
                    $("#many-choice-modal").modal("hide");
                },
                saveManyChoiceModal() {
                    var manyChoices = this.getManyChoiceDataFromModal();

                    var cloneAllAnswer = [...this.modalManyChoices]; //clone in js [...array]
                    cloneAllAnswer = cloneAllAnswer.filter(obj => obj.manyChoiceIndex !== this.editManyChoiceIndex);
                    var returnManyAnswer = addManyAnswerVue.getManyAnswer();
                    this.modalManyChoices = cloneAllAnswer.concat(returnManyAnswer);

                    let validate_data = this.modalManyChoices.filter(item => item.manyChoiceIndex == this.editManyChoiceIndex);
                    let error = 0;

                    if (manyChoices.name == "") {
                        warningAlert('กรุณากรอกชื่อ');
                        return false;
                    }
                    if (validate_data.length <= 0) {
                        warningAlert('ไม่มีรายการ');
                        return false;
                    } else {
                        validate_data.forEach((item) => {
                            if ((item.score == "" || item.name == null) || (item.score == "" || (parseInt(item.score) <= 0))) {
                                error++;
                            }
                        });
                    }

                    if (error > 0) {
                        warningAlert('กรุณากรอกข้อมูลให้ถูกต้อง/ครบถ้วน');
                    } else {
                        if (this.mode == 'edit') {
                            this.saveManyChoiceEdit(manyChoices, this.editManyChoiceIndex);
                        } else {
                            this.saveManyChoiceAdd(manyChoices);
                        }
                        this.editManyChoiceIndex = null;
                        this.displayManyChoice();
                        this.hideManyChoiceModal();
                    }
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
            },
            props: ['title'],
        });

        addManyChoiceVue.displayManyChoice();

        function saveManyChoiceModal() {
            addManyChoiceVue.saveManyChoiceModal();
        }

        function openManyChoiceModal() {
            addManyChoiceVue.addManyChoice();
        }

    </script>
@endpush

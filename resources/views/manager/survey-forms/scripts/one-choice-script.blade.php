@push('scripts')
    <script>
        let addOneChoiceVue = new Vue({
            el: '#one-choices',
            data: {
                modalOneChoices: [],
                oneChoices: [],
                editOneChoiceIndex: null,
                mode: null,
            },
            watch: {},
            methods: {
                displayOneChoice: function () {
                    $("#one-choice").show();
                },
                pushOneChoiceLine(name, score, oneChoiceIndex) {
                    let data = {
                        name: name,
                        score: score,
                        oneChoiceIndex: oneChoiceIndex,
                    }
                    this.modalOneChoices.push(data);
                },
                setLengthOneChoice: function () {
                    return this.oneChoices.length;
                },
                // addOneChoiceLine() {
                //     var oneChoiceIndex = this.oneChoices.length
                //     this.pushOneChoiceLine(null, null, oneChoiceIndex);
                // },
                addOneChoice: function () {
                    this.setOneChoiceIndex(this.setLengthOneChoice());
                    this.clearOneChoiceModalData();
                    addOneAnswerVue.setOneAnswer([]);
                    this.openModalOneChoice();
                },
                openModalOneChoice: function () {
                    $('#one-choice-modal').modal('show');
                },
                editOneChoice: function (index) {
                    this.setOneChoiceIndex(index);
                    this.loadOneChoiceModalData(index);
                    this.mode = 'edit';
                    this.openModalOneChoice();
                },

                clearOneChoiceModalData: function () {
                    $("#oneChoiceTitle").val('');
                    $("#isOrderByTrueOneChoice").prop('checked', true);
                },
                loadOneChoiceModalData: function (oneChoiceIndex) {
                    var temp = this.oneChoices[oneChoiceIndex];
                    $("#oneChoiceTitle").val(temp.name);
                    if (temp.isOrderBy == 1) {
                        $("#isOrderByTrueOneChoice").prop('checked', true);
                    } else {
                        $("#isOrderByFalseOneChoice").prop('checked', true)
                    }
                    // $("#id_field").val(temp.id);
                    var _modalOneChoices = [...this.modalOneChoices];
                    var checkId = oneChoiceIndex;

                    let cloneOneAnswer = _modalOneChoices.filter(obj => obj.oneChoiceIndex == checkId);
                    addOneAnswerVue.setOneAnswer(cloneOneAnswer);

                    $('#one-choice-modal').modal('show');
                },
                hideOneChoiceModal: function () {
                    $("#one-choice-modal").modal("hide");
                },
                saveOneChoiceModal() {
                    var oneChoices = this.getOneChoiceDataFromModal();

                    var cloneAllAnswer = [...this.modalOneChoices]; //clone in js [...array]
                    cloneAllAnswer = cloneAllAnswer.filter(obj => obj.oneChoiceIndex !== this.editOneChoiceIndex);
                    var returnOneAnswer = addOneAnswerVue.getOneAnswer();
                    this.modalOneChoices = cloneAllAnswer.concat(returnOneAnswer);

                    let validate_data = this.modalOneChoices.filter(item => item.oneChoiceIndex == this.editOneChoiceIndex);
                    let error = 0;

                    if(oneChoices.name == ""){
                        warningAlert('กรุณากรอกชื่อ');
                        return false;
                    }
                    if(validate_data.length <= 0){
                        warningAlert('ไม่มีรายการ');
                        return false;
                    }else{
                        validate_data.forEach((item) => {
                            if ((item.score == "" || item.name == null) || (item.score == "" || (parseInt(item.score) <= 0))) {
                                error++;
                            }
                        });
                    }

                    if(error > 0){
                        warningAlert('กรุณากรอกข้อมูลให้ถูกต้อง/ครบถ้วน');
                    }else{
                        if (this.mode == 'edit') {
                            this.saveOneChoiceEdit(oneChoices, this.editOneChoiceIndex);
                        } else {
                            this.saveOneChoiceAdd(oneChoices);
                        }
                        this.editOneChoiceIndex = null;
                        this.displayOneChoice();
                        this.hideOneChoiceModal();
                    }
                },
                saveOneChoiceAdd: function (oneChoices) {
                    this.oneChoices.push(oneChoices);
                },
                saveOneChoiceEdit: function (oneChoices, index) {
                    addOneChoiceVue.$set(this.oneChoices, index, oneChoices);
                },
                getOneChoiceDataFromModal: function () {
                    let name = document.getElementById("oneChoiceTitle").value;
                    let isOrderBy = $('input[name="isOrderByOneChoice"]:checked').val()
                    return {
                        name: name,
                        isOrderBy: isOrderBy,
                    };
                },
                setOneChoiceIndex: function (index) {
                    this.editOneChoiceIndex = index;
                },
                getOneChoiceIndex: function () {
                    return this.editOneChoiceIndex;
                },
            },
            props: ['title'],
        });

        addOneChoiceVue.displayOneChoice();

        function saveOneChoiceModal() {
            addOneChoiceVue.saveOneChoiceModal();
        }

        function openOneChoiceModal() {
            addOneChoiceVue.addOneChoice();
        }

    </script>
@endpush

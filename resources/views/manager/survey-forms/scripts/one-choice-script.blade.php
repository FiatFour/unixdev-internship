@push('scripts')
    <script>
        let addOneChoiceVue = new Vue({
            el: '#one-choices',
            data: {
                modalOneChoices: [],
                oneChoices: [],
                editIndex: null,
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
                    console.log(this.modalOneChoices);
                    this.modalOneChoices.push(data);
                },
                setLengthOneChoice: function () {
                    return this.oneChoices.length;
                },
                addOneChoiceLine() {
                    var oneChoiceIndex = this.oneChoices.length
                    this.pushOneChoiceLine(null, 0, oneChoiceIndex);
                },
                removeOneChoiceLine: function (index) {
                    this.modalOneChoices.splice(index, 1);
                    // if(surveyLineId != null && surveyLineId != ""){
                    //     this.pending_delete_extra_product_ids.push(surveyLineId);
                    // }
                },
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
                    console.log(this.editIndex);
                    this.openModalOneChoice();
                },
                clearOneChoiceModalData: function () {
                    $("#oneChoiceTitle").val('');
                    $("#isOrderByTrue").prop('checked', true);
                },
                loadOneChoiceModalData: function (oneChoiceIndex) {
                    var temp = this.oneChoices[oneChoiceIndex];
                    $("#oneChoiceTitle").val(temp.name);
                    if (temp.isOrderBy == 1) {
                        $("#isOrderByTrue").prop('checked', true);
                    } else {
                        $("#isOrderByFalse").prop('checked', true)
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
                    var _modalOneChoices = [...this.modalOneChoices];
                    var oneChoices = this.getOneChoiceDataFromModal();
                    // validate name empty
                    var validate_data = _modalOneChoices.filter((item) => {
                        return (item.name == "" || item.name == null) || (parseInt(item.score) < 0);
                    });
                    if (validate_data.length > 0) {
                        warningAlert('กรุณากรอกข้อมูลให้ถูกต้อง/ครบถ้วน');
                        return false;
                    }
                    if (this.mode == 'edit') {
                        this.saveOneChoiceEdit(oneChoices, this.editIndex);
                    } else {
                        this.saveOneChoiceAdd(oneChoices);
                    }
                    var cloneAllAnswer = [...this.modalOneChoices]; //clone in js [...array]
                    cloneAllAnswer = cloneAllAnswer.filter(obj => obj.oneChoiceIndex !== this.editIndex);
                    var returnOneAnswer = addOneAnswerVue.getOneAnswer();
                    this.modalOneChoices = cloneAllAnswer.concat(returnOneAnswer);

                    this.editIndex = null;
                    this.displayOneChoice();
                    this.hideOneChoiceModal();
                },
                saveOneChoiceAdd: function (oneChoices) {
                    this.oneChoices.push(oneChoices);
                },
                saveOneChoiceEdit: function (oneChoices, index) {
                    addOneChoiceVue.$set(this.oneChoices, index, oneChoices);
                },
                getOneChoiceDataFromModal: function () {
                    let name = document.getElementById("oneChoiceTitle").value;
                    let isOrderBy = $('input[name="isOrderBy"]:checked').val()
                    return {
                        name: name,
                        isOrderBy: isOrderBy,
                    };
                },
                setOneChoiceIndex: function (index) {
                    this.editIndex = index;
                },
                getOneChoiceIndex: function () {
                    return this.editIndex;
                },
                number_format(number) {
                    return number_format(number);
                },
            },
            props: ['title'],
        });

        addOneChoiceVue.displayOneChoice();
        // function addOneChoiceLine() {
        //     console.log('test');
        //     addOneChoiceVue.addOneChoiceLine();
        // }

        function saveOneChoiceModal() {
            addOneChoiceVue.saveOneChoiceModal();
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

        function openOneChoiceModal() {
            addOneChoiceVue.addOneChoice();
        }

        // function openExtraModal() {
        //     addRentalVue.addExtra();
        // }
    </script>
@endpush

@push('scripts')
    <script>
        let addTextChoiceVue = new Vue({
            el: '#text-choices',
            data: {
                textChoices: [],
                editTextChoiceIndex: null,
                mode: null,
            },
            watch: {},
            methods: {
                displayTextChoice: function () {
                    $("#text-choice").show();
                },
                addTextChoice: function () {
                    this.setTextChoiceIndex(this.setLengthTextChoice());
                    this.clearTextChoiceModalData();
                    // addTextAnswerVue.setTextAnswer([]);
                    this.openModalTextChoice();
                },
                setLengthTextChoice: function () {
                    return this.textChoices.length;
                },
                openModalTextChoice: function () {
                    $('#text-choice-modal').modal('show');
                },
                editTextChoice: function (index) {
                    this.setTextChoiceIndex(index);
                    this.loadTextChoiceModalData(index);
                    this.mode = 'edit';
                    console.log(this.editTextChoiceIndex);
                    this.openModalTextChoice();
                },
                clearTextChoiceModalData: function () {
                    $("#textChoiceTitle").val('');
                },
                loadTextChoiceModalData: function (textChoiceIndex) {
                    var temp = this.textChoices[textChoiceIndex];
                    $("#textChoiceTitle").val(temp.name);
                    // $("#id_field").val(temp.id);
                    $('#text-choice-modal').modal('show');
                },
                hideTextChoiceModal: function () {
                    $("#text-choice-modal").modal("hide");
                },
                saveTextChoiceModal() {
                    var textChoices = this.getTextChoiceDataFromModal();
                    if (this.mode == 'edit') {
                        this.saveTextChoiceEdit(textChoices, this.editTextChoiceIndex);
                    } else {
                        this.saveTextChoiceAdd(textChoices);
                    }

                    this.editTextChoiceIndex = null;
                    this.displayTextChoice();
                    this.hideTextChoiceModal();
                },
                saveTextChoiceAdd: function (textChoices) {
                    this.textChoices.push(textChoices);
                },
                saveTextChoiceEdit: function (textChoices, index) {
                    addTextChoiceVue.$set(this.textChoices, index, textChoices);
                },
                getTextChoiceDataFromModal: function () {
                    let name = document.getElementById("textChoiceTitle").value;
                    return {
                        name: name,
                    };
                },
                setTextChoiceIndex: function (index) {
                    this.editTextChoiceIndex = index;
                },
                getTextChoiceIndex: function () {
                    return this.editTextChoiceIndex;
                },
                number_format(number) {
                    return number_format(number);
                },
            },
            props: ['title'],
        });

        addTextChoiceVue.displayTextChoice();
        // function addTextChoiceLine() {
        //     console.log('test');
        //     addTextChoiceVue.addTextChoiceLine();
        // }

        function saveTextChoiceModal() {
            addTextChoiceVue.saveTextChoiceModal();
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

        function openTextChoiceModal() {
            addTextChoiceVue.addTextChoice();
        }

        // function openExtraModal() {
        //     addRentalVue.addExtra();
        // }
    </script>
@endpush

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

                    if(textChoices.name == ""){
                        warningAlert('กรุณากรอกข้อมูลให้ถูกต้อง/ครบถ้วน');
                        return 0;
                    }
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
                removeTextChoice: function (index) {
                    this.textChoices.splice(index, 1);
                },
            },
            props: ['title'],
        });

        addTextChoiceVue.displayTextChoice();

        function saveTextChoiceModal() {
            addTextChoiceVue.saveTextChoiceModal();
        }

        function openTextChoiceModal() {
            addTextChoiceVue.addTextChoice();
        }
    </script>
@endpush

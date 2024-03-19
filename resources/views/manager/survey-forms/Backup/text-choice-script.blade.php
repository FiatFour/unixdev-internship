@push('scripts')
    <script>
        let addTextChoiceVue = new Vue({
            el: '#text-choices',
            data: {
                modalTextChoices: [],
                textChoices: [],
                editTextChoiceIndex: null,
                mode: null,
            },
            watch: {},
            methods: {
                displayTextChoice: function () {
                    $("#text-choice").show();
                },
                addTextChoice : function () {
                    this.setIndex(this.setLastIndex());
                    this.clearModalData();
                    this.mode = 'add';
                    this.openModal();
                },
                setLastIndex: function () {
                    return this.textChoices.length;
                },
                setIndex: function (index) {
                    this.editTextChoiceIndex = index;
                },
                getIndex: function () {
                    return this.editTextChoiceIndex;
                },
                clearModalData: function () {
                    $("#textChoiceTitle").val('');
                },
                openModal: function () {
                    $("#text-choice-modal").modal("show");
                },
                hideModal: function () {
                    $("#text-choice-modal").modal("hide");
                },
                editTextChoice: function (index) {
                    this.setIndex(index);
                    this.loadModalData(index);
                    this.mode = 'edit';
                    $("#order-detail-modal-label").html('แก้ไขข้อมูล');
                    this.openModal();
                },
                loadModalData: function (index) {
                    var temp = this.textChoices[index];
                    $("#name").val(temp.name);
                },
                saveTextChoiceModal: function () {
                    if (this.validateDataObject(textChoices)) {
                        if (this.mode == 'edit') {
                            var index = this.editTextChoiceIndex;
                            this.saveEdit(textChoices, index);
                        } else {
                            this.saveAdd(textChoices);
                        }
                        this.edit_index = null;
                        this.display();
                        this.hideModal();
                    } else {
                        warningAlert("{{ __('lang.required_field_inform') }}");
                    }
                },
                getDataFromModal: function () {
                    var name = document.getElementById("textChoiceTitle").value;
                    // var id = document.getElementById("id_field").value;
                    return {
                        name: name,
                        // id: id
                    };
                },
                validateDataObject: function (textChoices) {
                    if (textChoices.name != "") {
                        return true;
                    } else {
                        return false;
                    }
                },
                saveAdd: function (textChoices) {
                    this.textChoices.push(textChoices);
                },
                saveEdit: function (textChoices, index) {
                    addTextChoiceVue.$set(this.textChoices, index, textChoices);
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



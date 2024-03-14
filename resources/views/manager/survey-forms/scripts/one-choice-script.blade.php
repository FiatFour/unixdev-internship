@push('scripts')
    <script>
        let addOneChoiceVue = new Vue({
            el: '#rental-lines',
            data: {
                name: [],
                score: [],
            },
            watch: {
            },
            methods: {
                addExtraLine() {
                    this.pushExtraLine(null, null, 0, 0);
                },
                removeExtraLine: function(index2, rental_line_id) {
                    this.modal_extra_product.splice(index2, 1);
                    if(rental_line_id != null && rental_line_id != ""){
                        this.pending_delete_extra_product_ids.push(rental_line_id);
                    }
                },
                addExtra(){
                    $('input[type=checkbox][name=car_modal_extra_id]').prop('checked', true);
                    this.modal_extra_product = [];
                    $('input[type=checkbox][name=car_modal_extra_id]').unbind('click');
                    $('#extra-modal').modal('show');
                },
                editExtra: function(index, car, car_id) {
                    console.log('edit', index, car, car_id);

                    // prepare modal for edit
                    $('input[type=checkbox][name=car_modal_extra_id]').prop('checked', false);
                    $('input[type=checkbox][name=car_modal_extra_id][value="'+ car_id +'"]').prop('checked', true);
                    $('input[type=checkbox][name=car_modal_extra_id]').on('click', function(){
                        return false;
                    });

                    this.modal_extra_product = [];
                    var extras = [...car.extras];
                    extras.forEach((extra, index) => {
                        this.pushExtraLine(extra.rental_line_id, extra.extra_name, extra.amount, extra.unit_price);
                        this.setTotalExtra(index);
                    });
                    $('#extra-modal').modal('show');
                },
                number_format(number) {
                    return number_format(number);
                },
            },
            props: ['title'],
        });

        function addOneChoiceLine() {
            console.log('test');
            addOneChoiceVue.addOneChoiceLine();
        }

        // function saveExtra() {
        //     addRentalVue.saveExtra();
        // }
        //
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

        function openOneChoice() {
            addOneChoiceVue.addChoice();
        }
        // function openExtraModal() {
        //     addRentalVue.addExtra();
        // }
    </script>
@endpush

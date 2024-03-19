@push('scripts')
    <script>
        let addManyAnswerVue = new Vue({
            el: '#many-answer',
            data: {
                modalManyChoices: [],
            },
            watch: {
            },
            methods: {
                displayManyAnswer: function() {
                    $("#many-answer").show();
                },
                getManyAnswer: function(){
                  return this.modalManyChoices;
                },
                setManyAnswer: function (answerData){
                    this.modalManyChoices = answerData;
                },
                pushManyChoiceLine: function(name, score, manyChoiceIndex){
                    let data = {
                        name: name,
                        score: score,
                        manyChoiceIndex: manyChoiceIndex,
                    }
                    this.modalManyChoices.push(data);
                },
                addManyAnswerLine: function() {
                    var manyChoiceIndex = addManyChoiceVue.getManyChoiceIndex();
                    this.pushManyChoiceLine(null, 0, manyChoiceIndex);
                },
                addManyChoice: function (){
                    this.modalManyChoices = [];
                    $('#many-choice-modal').modal('show');
                },
                removeManyChoiceLine: function (index) {
                    this.modalManyChoices.splice(index, 1);
                },
            },
            props: ['title'],
        });

        addManyAnswerVue.displayManyAnswer();

        function addManyChoiceLine() {
            addManyAnswerVue.addManyAnswerLine();
        }
        function openManyChoiceModal() {
            addManyAnswerVue.addManyChoice();
        }
    </script>
@endpush

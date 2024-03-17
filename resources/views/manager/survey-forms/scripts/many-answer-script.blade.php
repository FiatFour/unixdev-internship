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
                        // surveyLineId: surveyLineId,
                        name: name,
                        score: score,
                        manyChoiceIndex: manyChoiceIndex,
                    }
                    console.log(this.modalManyChoices);
                    this.modalManyChoices.push(data);
                    // $(".add-one-choice-empty").hide();
                },
                addManyAnswerLine: function() {
                    var manyChoiceIndex = addManyChoiceVue.getManyChoiceIndex();
                    console.log(manyChoiceIndex);
                    this.pushManyChoiceLine(null, 0, manyChoiceIndex);
                },
                addManyChoice: function (){
                    this.modalManyChoices = [];
                    $('#many-choice-modal').modal('show');
                    // this.ManyChoiceIndex = this.oneChoices.length; // Update ManyChoiceIndex here
                    // console.log(this.ManyChoiceIndex);
                },
            },
            props: ['title'],
        });

        addManyAnswerVue.displayManyAnswer();

        function addManyChoiceLine() {
            console.log('test');
            addManyAnswerVue.addManyAnswerLine();
        }
        function openManyChoiceModal() {
            addManyAnswerVue.addManyChoice();
        }
    </script>
@endpush

@push('scripts')
    <script>
        let addOneAnswerVue = new Vue({
            el: '#one-answer',
            data: {
                modalOneChoices: [],
            },
            watch: {

            },
            methods: {
                displayOneAnswer: function() {
                    $("#one-answer").show();
                },
                getOneAnswer: function(){
                  return this.modalOneChoices;
                },
                setOneAnswer: function (answerData){
                    this.modalOneChoices = answerData;
                },
                pushOneChoiceLine: function(name, score, oneChoiceIndex){
                    let data = {
                        name: name,
                        score: score,
                        oneChoiceIndex: oneChoiceIndex,
                    }
                    this.modalOneChoices.push(data);
                },
                removeOneChoiceLine: function (index) {
                    this.modalOneChoices.splice(index, 1);
                },
                addOneAnswerLine: function() {
                    var oneChoiceIndex = addOneChoiceVue.getOneChoiceIndex();
                    this.pushOneChoiceLine(null, null, oneChoiceIndex);
                },
                addOneChoice: function (){
                    this.modalOneChoices = [];
                    $('#one-choice-modal').modal('show');
                },
            },
            props: ['title'],
        });

        addOneAnswerVue.displayOneAnswer();

        function addOneChoiceLine() {
            addOneAnswerVue.addOneAnswerLine();
        }
        function openOneChoiceModal() {
            addOneAnswerVue.addOneChoice();
        }
    </script>
@endpush



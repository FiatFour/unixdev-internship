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
                        // surveyLineId: surveyLineId,
                        name: name,
                        score: score,
                        oneChoiceIndex: oneChoiceIndex,
                    }
                    console.log(this.modalOneChoices);
                    this.modalOneChoices.push(data);
                    // $(".add-one-choice-empty").hide();
                },
                addOneAnswerLine: function() {
                    var oneChoiceIndex = addOneChoiceVue.getOneChoiceIndex();
                    console.log(oneChoiceIndex);
                    this.pushOneChoiceLine(null, 0, oneChoiceIndex);
                },
                addOneChoice: function (){
                    this.modalOneChoices = [];
                    $('#one-choice-modal').modal('show');
                    // this.OneChoiceIndex = this.oneChoices.length; // Update OneChoiceIndex here
                    // console.log(this.OneChoiceIndex);
                },
            },
            props: ['title'],
        });

        addOneAnswerVue.displayOneAnswer();

        function addOneChoiceLine() {
            console.log('test');
            addOneAnswerVue.addOneAnswerLine();
        }
        function openOneChoiceModal() {
            addOneAnswerVue.addOneChoice();
        }
    </script>
@endpush

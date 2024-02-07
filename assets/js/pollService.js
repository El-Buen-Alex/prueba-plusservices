var questions=[];

function getInitData(){
    const ajax_url = "index.php?c=poll&a=create";
    const ajax_request = new XMLHttpRequest();
    ajax_request.onreadystatechange = function () {
        if (ajax_request.readyState == 4) {
            const jsonObj = JSON.parse(ajax_request.responseText);
            paintControls(jsonObj);
        }
    }
    ajax_request.open("GET", ajax_url, true);

    //Enviamos la solicitud
    ajax_request.send();
}

function getQuestionsPerPoll(pollCode){
    const ajax_url = "index.php?c=poll&a=questions&poll_code="+pollCode;
    const ajax_request = new XMLHttpRequest();
    ajax_request.onreadystatechange = function () {
        if (ajax_request.readyState == 4) {
            const jsonObj = JSON.parse(ajax_request.responseText);
            paintQuestions(jsonObj);
        }
    }
    ajax_request.open("GET", ajax_url, true);

    //Enviamos la solicitud
    ajax_request.send();
}

function paintControls(response){
    const comboBoxWrapper=document.getElementById('combo-box-wrapper');
    const select=document.createElement('select');
    select.id='current-question';
    if(response.status){
        const {data}=response;
        data.polls.forEach((e, index)=>{
            const currentOption=document.createElement('option');
            currentOption.value=e.codigo_encuesta;
            currentOption.text=e.nombre_encuesta;
            if(index==0){
                currentOption.selected=true;
                getQuestionsPerPoll(e.codigo_encuesta)
            }
            select.appendChild(
                currentOption
            )
        })
    }
    select.addEventListener('change', function(e){
        getQuestionsPerPoll(e.target.value)
    });
    comboBoxWrapper.appendChild(select)
}



function paintQuestions(response){
    const questionsWrapper=document.getElementById('question-box-wrapper');
    questionsWrapper.textContent=''
    if(response.status){
        const {data}=response;
        questions=data.questions;
        data.questions.forEach((e, questionIndex)=>{
            const questionWrapper=document.createElement('div')
            const textWraper=document.createElement('p')
            textWraper.textContent=e.descripcion;

            const radioButtonGroupWrapper=document.createElement('div');
            
            for(let i=0; i<5; i++){
                const radioButtonWrapper=document.createElement('div');

                const input=document.createElement('input')
                input.type='radio'
                input.id=e.codigo_encuesta + '_'+e.num_pregunta;
                input.name=questionIndex + '_'+e.num_pregunta ;
                input.value=i+1
                const label=document.createElement('label')
                label.textContent=i+1;

                radioButtonWrapper.appendChild(input)
                radioButtonWrapper.appendChild(label)
                radioButtonGroupWrapper.appendChild(radioButtonWrapper)
            }
        
            questionWrapper.appendChild(textWraper);
            questionWrapper.appendChild(radioButtonGroupWrapper);
            questionsWrapper.appendChild(questionWrapper)
        });
    }
}




function save(){
    const currentPoll=document.getElementById('current-question')
    const codePoll=currentPoll.value
    if(codePoll===null || codePoll===undefined){
        alert('Seleccione un tipo de encuesta');
        return;
    }
    const data={
        'code_poll':codePoll,
        'rows':[]
    }
    try{
        questions.forEach((question, questionIndex)=>{
            const currentName=questionIndex+'_'+question.num_pregunta
            const currentObject=document.querySelector('input[name="'+currentName+'"]:checked');
            if(currentObject){
                const currentQuestionAnswer={
                    'question_number':question.num_pregunta,
                    'code_poll':codePoll,
                    'calification':currentObject.value,
                }
                data.rows.push(currentQuestionAnswer);
            }else{
                throw Error('Por favor conteste la pregunta ' + question.descripcion)
            }
        });
        sendToSave(data)
        console.log(data)
    }catch(err){
        alert(err.message)
    }
}

function sendToSave(data){
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const jsonObj = JSON.parse(request.responseText);
            if(jsonObj.status){

            }else{
                alert(jsonObj.message.message)
            }
        }
    };
    request.open("POST", 'index.php?c=poll&a=save', true);
    request.setRequestHeader(
        "Content-Type",
        "application/json; charset=UTF-8");
    request.send(JSON.stringify(data));
}






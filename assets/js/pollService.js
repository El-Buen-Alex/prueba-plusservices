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

function paintControls(response){
    const comboBoxWrapper=document.getElementById('combo-box-wrapper');
    const select=document.createElement('select');
    if(response.status){
        const {data}=response;
        console.log(data.polls)
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

function getQuestionsPerPoll(pollCode){
    const ajax_url = "index.php?c=poll&a=questions&id="+pollCode;
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






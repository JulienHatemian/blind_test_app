const buttons = document.querySelectorAll('[data-params]');

buttons.forEach(function(button){
    button.addEventListener('click', function(e){
        let data = button.getAttribute('data-params');
        
        console.log(data);

        e.preventDefault();
        if(data != 'quit'){
            blindtestOptions(data);
        }else{
            let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')
            if(confirmation){
                blindtestOptions(data);
            }
        }
        return;
    })
})

function blindtestOptions(param){
    let currentURL = window.location.href;
    let absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
    let url = absoluteRootPath + 'blindtestApi.php';

    ajaxRequest(url, 'POST', param, function(response){
        console.log(response);
        if(response.disconnected === true){
            window.location.href = absoluteRootPath + 'gameconfig';
        }
    })
}

function resetTimer(){

}

function startTimer(){

}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}
const buttons = document.querySelectorAll('[data-params]');
const currentURL = window.location.href;
const absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
let interval;
let timeleft = 0;

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
    let url = absoluteRootPath + 'blindtestApi.php';

    ajaxRequest(url, 'POST', param, function(response){
        if(response.disconnected === true){
            window.location.href = absoluteRootPath + 'gameconfig';
        }
    })
}

function quit(){
    let h1 = document.querySelector('h1');

    h1.addEventListener('click', function(e){
        let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')

        if(confirmation){
            window.location.href = absoluteRootPath + 'homepage';
        }else{
            e.preventDefault();
        }
    })
}

function resetTimer(){

}

function startTimer(){
    let timer = document.getElementById('timer');

    if(!interval){
        timeleft = parseInt(timer.innerHTML);

        if(timeleft > 0){
            interval = setInterval(() => {
                timeleft--
                timer.textContent = timeleft;
                if(timeleft == 0){
                    clearInterval(interval);
                    interval = null;
                }
            }, 1000);
        }
    }
}

function pauseTimer(){
    if(interval){
        clearInterval(interval);
        interval = null;
    }
}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}
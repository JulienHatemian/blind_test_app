const buttons = document.querySelectorAll('[data-params]');
const currentURL = window.location.href;
const absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
let interval;

document.addEventListener('DOMContentLoaded', function(){
    let isPlaying = false;

    buttons.forEach(function(button){
        button.addEventListener('click', function(e){
            let obj = {};
            let timer = document.getElementById('timer');
            let timeleft = parseInt(timer.innerHTML);
    
            obj['dataParams'] = button.getAttribute('data-params');
            obj['timeleft'] = timeleft;
            e.preventDefault();
    
            if(obj.dataParams != 'quit'){
                blindtestOptions(obj);
            }else{
                let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')
                if(confirmation){
                    blindtestOptions(obj);
                }
            }
        })
    })

    let h1 = document.querySelector('h1');

    h1.addEventListener('click', function(e){
        let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')

        if(confirmation){
            window.location.href = absoluteRootPath + 'homepage';
        }else{
            e.preventDefault();
        }
    })
})

function blindtestOptions(param){
    let url = absoluteRootPath + 'blindtestApi.php';
    let timer = document.getElementById('timer');

    ajaxRequest(url, 'POST', param, function(response){
        if(response.disconnected === true){
            window.location.href = absoluteRootPath + 'gameconfig';
        }
        console.log(response);
        if(response.success === true){
            switch(response.input){
                case 'start':
                    if(response.audio){
                        playAudio(response.audio);
                        console.log('test');
                    }
                    break;
                case 'play':
                    timer.innerHTML = response.timeleft;
                    startTimer();
                    break;
                case 'restart':
                    timer.innerHTML = response.timeleft;
                    pauseTimer();
                    break;
                case 'pause':
                    timer.innerHTML = response.timeleft;
                    pauseTimer();
                    break;
                case 'result':

                    break;
                case 'endtimer':
                    timer.innerHTML = response.timeleft;
                    break;
                default:
                    console.log('Wrong input');
            }
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
                    let obj = {};
                    let timer = document.getElementById('timer');
                    let timeleft = parseInt(timer.innerHTML);

                    obj['dataParams'] = 'endtimer';
                    obj['timeleft'] = timeleft;

                    blindtestOptions(obj);
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

function playAudio(param){
    let player = new Audio();
    player.volume = 0.3;
    player.addEventListener('canplaythrough', function(){
        console.log("Audio ready");
        player.play;
    })

    player.addEventListener('ended', function(){
        player.pause();
    });

    player.currentTime = param.start;
    let endPlay = param.start + param.duration;
    console.log(endPlay);
    console.log(player.currentTime);

    player.src = absoluteRootPath + param.official_link;

    player.addEventListener('timeupdate', function(){
        if(player.currentTime >= endPlay){
            player.pause();
        }
    })

    player.play();
}
var audio = document.getElementById("bismillah_audio");
// when the sound is loaded,
audio.oncanplaythrough = (event) => {
    var playedPromise = audio.play();
    if (playedPromise){
        playedPromise.catch((e) => {
            console.log("Your Browser Doesn't support the AutoPlay");
        });
    }
}
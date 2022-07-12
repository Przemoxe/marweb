export default class VideoPlayer {
    init() {
        var videoContainer = document.querySelectorAll('.wp-video>video');

        videoContainer.forEach(el => {
            el.controls = false; 

            const playOverlay = document.createElement("div");
            const button = document.createElement("div");
            playOverlay.classList.add("overlay-play");
            button.classList.add("overlay-button");

            playOverlay.appendChild(button);
            el.parentNode.appendChild(playOverlay);

            el.addEventListener('ended',isStopped,false);
            function isStopped(e) {
                button.style.display = "block";
            }

            playOverlay.onclick = function(event) {
                if (el.paused) {
                    button.style.display = "none";
                    el.play();
                  } else {
                    el.pause();
                    button.style.display = "block";
                  }
            }
        });  
    }
}
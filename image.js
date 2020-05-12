var canvas = document.getElementById('canvas');

let image = new Image();
let data;
var reader = new FileReader;

function convertAndSend(canvas) {
    /*
    function convertCanvasToImage(canvas) {
       
        image.src = canvas.toDataURL("image/png");
	return image;
    }
    convertCanvasToImage(canvas);
    */
   data = canvas.toDataURL();

    function sendData(data) {
    let req = new XMLHttpRequest();
    req.open("POST", "index.php", true);
    req.send("data="+data);
    }
    sendData(data);
}

document.getElementById("snap").addEventListener("click", convertAndSend(canvas));




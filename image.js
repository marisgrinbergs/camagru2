var canvas = document.getElementById('canvas');

var data = canvas.toDataURL();
  
    function convertCanvasToImage(canvas) {
        
        image = canvas.toDataURL("image/png");
	return image;
    }

function sendData(event) {
    let req = new XMLHttpRequest();
    req.open("POST", "checkimage.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("data="+convertCanvasToImage(canvas));
}

document.getElementById("snap").addEventListener("click", sendData);

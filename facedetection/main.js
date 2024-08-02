const cam = document.querySelector('#video')
const container = document.querySelector('.container')
const msgDisplay = document.createElement('p')
container.appendChild(msgDisplay)
msgDisplay.setAttribute('id', 'msgDisplay')


Promise.all([ // Retorna apenas uma promisse quando todas já estiverem resolvidas

    faceapi.nets.tinyFaceDetector.loadFromUri('./facedetection/models'), // É igual uma detecção facial normal, porém menor e mais rapido
    faceapi.nets.faceLandmark68Net.loadFromUri('./facedetection/models'), // Pegar os pontos de referencia do sue rosto. Ex: olhos, boca, nariz, etc...
    faceapi.nets.faceRecognitionNet.loadFromUri('./facedetection/models'), // Vai permitir a api saber onde o rosto está localizado no video
    faceapi.nets.faceExpressionNet.loadFromUri('./facedetection/models') // Vai permitir a api saber suas expressões. Ex: se esta feliz, triste, com raiva, etc...

]).then(startVideo)

    async function startVideo() {
    const constraints = { video: true };

    try {
        let stream = await navigator.mediaDevices.getUserMedia(constraints);
        cam.srcObject = stream;
        cam.onloadedmetadata = e => {
            cam.play()
            takePictureButton = createTakePictureButtonElement()
            container.appendChild(takePictureButton)
            takePictureSetEvent(takePictureButton)
        }

    } catch (err) {
        console.error(err);
    }
    }

    function createTakePictureButtonElement(){
        button = document.createElement('button')
        button.id = 'picturebutton'
        return button
    }

    function takePictureSetEvent(takePictureButton){
        takePictureButton.addEventListener('click', (e) => {
                let pictureCanvas = document.createElement('canvas')
                pictureCanvas.width = 1920
                pictureCanvas.height = 1080
    
                let ctx = pictureCanvas.getContext('2d')
                ctx.drawImage(cam, 0, 0, pictureCanvas.width, pictureCanvas.height)
    
                pictureDataURL = pictureCanvas.toDataURL('image/jpeg')
                console.log(pictureDataURL)
                sendPictureToServer(pictureDataURL)
            }
        )
    }

    function Canvas(canvas, displaySize){
        this.canvasObject = canvas
        this.displaySize = displaySize
    }

    function setDrawCanvasRelativeToVideo(canvas, displaySize){
        container.appendChild(canvas)
        faceapi.matchDimensions(canvas, displaySize)
    }

    function createVideoCanvas(){
        let canvas = faceapi.createCanvasFromMedia(video)
        container.appendChild(canvas)
        return canvas
    }

    function drawVignette(canvas){
        if(canvas.getContext){
            ctx = canvas.getContext('2d')

            ctx.beginPath();
            ctx.rect(0, 0, canvas.width, canvas.height); // Outer rectangle
            ctx.ellipse(360, 255, 140, 220, 0, 0, Math.PI * 2, true) // Hole anticlockwise
            ctx.clip();
        
            ctx.fillStyle = 'black';
            ctx.fill()
        }
    }

    function createVignetteFromCanvas(canvas){
        cnv = canvas.cloneNode(canvas)
        console.log(cnv)
        container.appendChild(cnv)
        drawVignette(cnv)
    }

    //GET POSITIONS
    async function getLeftEyePosition(){
        const landmarks = await faceapi.detectFaceLandmarks(cam)
        const leftEye = landmarks.getLeftEye()
        console.log("Left eye position ====>"+JSON.stringify(leftEye))
    }
    async function getRightEyePosition(){
        const landmarks = await faceapi.detectFaceLandmarks(cam)
        const rightEye = landmarks.getRightEye()
        console.log("Left eye position ====>"+JSON.stringify(rightEye))
    }
    async function getJawOutlinePosition(){
        const landmarks = await faceapi.detectFaceLandmarks(cam)
        const jawOutline = landmarks.getJawOutline()
        console.log(jawOutline)
        return jawOutline
    }

    async function getJawOutline(){
        const landmarks = await faceapi.detectFaceLandmarks(cam)
        const jawOutline = landmarks.getJawOutline()
        console.log(jawOutline)
    }
    
    function isFaceDetectedInCam(detections){
        if(detections.length>0){
            return true
        }
        return false
    }

    function setSystemMsgAccordingToDetection(detections, jawPositionObject){
        let systemMsg = ''
        systemMsg = (isFaceDetectedInCam(detections))?'Seu rosto foi detectado':'Não há rostos detectados'
        msgDisplay.innerHTML = systemMsg
    }

    async function isFaceInFrame(){
        jawOutline = await getJawOutlinePosition()
        x1 = jawOutline[0].x
        x2 = jawOutline[16].x
        y1 = jawOutline[0].y
        y2 = jawOutline[8].y
        console.log(x1)
        if(x1 < 360 || x2 > 500){
            //max x2 494.6474838256836
            //max x1 124.74370956420898
            return false
        }
        return true
    }

cam.addEventListener('play', () => {
    const canvas = new Canvas(createVideoCanvas(), {width: cam.getBoundingClientRect().width, height: cam.getBoundingClientRect().height})
    const canvasNode = canvas.canvasObject
    setDrawCanvasRelativeToVideo(canvasNode, canvas.displaySize)
    createVignetteFromCanvas(canvasNode)

    //SET INTERVAL FOR LANDMARKS DETECTION (pixels)
    
        setInterval(async ()=>{ // Intervalo para detectar os rostos a cada 100ms
            
            const detections = await faceapi.detectAllFaces(
            cam, // Primeiro parametro é nossa camera
            new faceapi.TinyFaceDetectorOptions() // Qual tipo de biblioteca vamos usar para detectar os rostos

            )
            .withFaceLandmarks() // Vai desenhar os pontos de marcação no rosto
            .withFaceExpressions() // Vai determinar nossas expressões
            // getLeftEyePosition()
        console.log(detections)
        setSystemMsgAccordingToDetection(detections)
        const resizedDetections = faceapi.resizeResults(detections, canvas.displaySize) // Redimensionado as detecções
        canvasNode.getContext("2d").clearRect(0, 0, canvasNode.width, canvasNode.height) // Apagando nosso canvas antes de desenhar outro
        if(isFaceDetectedInCam(detections)){
            faceapi.draw.drawDetections(canvasNode, resizedDetections) // Desenhando decções
            faceapi.draw.drawFaceLandmarks(canvasNode, resizedDetections) // Desenhando os pontos de referencia
            faceapi.draw.drawFaceExpressions(canvasNode, resizedDetections)
            // Desenhando expressões
            jaws = getJawOutlinePosition()
        }
        }, 100)
})

function sendPictureToServer(picture){
    $.ajax({
        type: 'POST',
        url: 'receivedata.php',
        data: {
            imgBase64: picture
        }
    }).done(function(){
            console.log('saved')
        })
    
    console.log(picture)
}
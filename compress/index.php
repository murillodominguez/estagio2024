<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_GET['error'])){
        switch($_GET['error']){
            case 1: echo "Formato de arquivo inválido!";
            break;
            case 2: echo "Tamanho de arquivo excedeu o limite (4MB).";
            break;
            default: "";
            break;
        }
        }?>
    <form action="upload.php" method="post" enctype="multipart/form-data" id="form">
        <input type="file" accept="image/*" id="img" name="fileToUpload" src="" alt="inserir imagem" required>
        <button type="submit" id="submit">Upload Image</button>
    </form>

    <div class="feliz"></div>
<script src="script.js" defer></script>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js" defer></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="img" name="fileToUpload" src="" alt="inserir imagem">
        <input type="submit" name="submit" value="Upload Image">
    </form>

    <div class="feliz"></div>
</body>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_GET['error'])){
        switch($_GET['error']){
            case 1: echo "Formato de arquivo inválido!";
            break;
            case 2: echo "Tamanho de arquivo excedeu o limite (4MB).";
            break;
            default: "";
            break;
        }
        }?>
    <form action="upload.php" method="post" enctype="multipart/form-data" id="form">
        <input type="file" accept="image/*" id="img" name="fileToUpload" src="" alt="inserir imagem" required>
        <button type="submit" id="submit">Upload Image</button>
    </form>
<!-- <script src="script.js" defer></script> -->
<script>//definir largura da imagem comprimida
//seleciona o input da imagem
let img_input = document.getElementById('img');
let newWidth = 800;
//executa função ao mudar o input (enviar arquivo)
img_input.addEventListener('change', (e) => {
    //arquivo enviado
    let img_file = e.target.files[0];
    console.log(img_file.size);
    //leitor de arquivo
    let reader = new FileReader;
    reader.readAsDataURL(img_file);
    //ler o arquivo ao carregar a página, e executar a função
    reader.onload = (event) => {
        //url da imagem
        let img_url = event.target.result;
        let img = new Image();
        img.src = img_url;
        let container = document.createElement('div');
        let body = document.querySelector('body');
        body.appendChild(container);
        let form = document.getElementById('form');
        //ao carregar a imagem, criar um canvas para compressão, mantendo a proporção da imagem
        img.onload = (e) =>{
          console.log('AQUI A RESOLUÇÃO DA IMAGEM '+e.target.naturalWidth+'x'+e.target.naturalHeight);
            let orgWidth = e.target.naturalWidth;
            if(orgWidth<=800){
              newWidth = orgWidth;
            }
            let canvas = document.createElement('canvas');
            let ratio = newWidth / e.target.width;
            canvas.width = newWidth;
            canvas.height = e.target.height * ratio;
            const context = canvas.getContext('2d');
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
            container.appendChild(img);
            //transforma o conteúdo do canvas em arquivo/blob
                canvas.toBlob(function createBlob(blob){
                    console.log(blob);
                    console.log(blob.size);
                    const fr = new FileReader();
                    fr.readAsDataURL(blob);
                    fr.addEventListener('load', ()=>{
                        const dataURL = fr.result;
                        console.log(dataURL);
                        let base64 = dataURL.substring(dataURL.indexOf(',')+1);
                        //salva o blob em base64 para envio ao servidor
                        let hidden = document.createElement('input');
                        hidden.type='hidden';
                        hidden.name='dataURL';
                        hidden.value=base64;
                        form.appendChild(hidden);
                        //nova imagem comprimida
                        let img2 = new Image();
                        img2.src = dataURL;
                        container.appendChild(img2);
                        img_name = img_input.files[0].name;
                        //substitui a imagem pela comprimida no input
                        let newfile = new File([blob], img_name,{
                        type:'jpeg',
                        lastModified:new Date().getTime()});
                        let containfile = new DataTransfer();
                        containfile.items.add(newfile);
                        img_input.files = containfile.files;
                    });
                    let link = document.createElement('a');
                    link.download = 'image.jpeg';
                    link.href = URL.createObjectURL(blob);
                    link.textContent += 'Download Comprimido';
                    form.appendChild(link);
                }, 'image/jpeg',1);
        }
    }
});
</script>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js" defer></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="img" name="fileToUpload" src="" alt="inserir imagem">
        <input type="submit" name="submit" value="Upload Image">
    </form>

    <div class="feliz"></div>
</body>
>>>>>>> origin/master
</html> -->
<<<<<<< HEAD
//definir largura da imagem comprimida
const WIDTH = 800;


//seleciona o input da imagem
let img_input = document.getElementById('img');

//executa função ao mudar o input (enviar arquivo)
img_input.addEventListener('change', (e) => {
    //arquivo enviado
    let img_file = e.target.files[0];
    console.log(img_file.size)

    //leitor de arquivo
    let reader = new FileReader;
    reader.readAsDataURL(img_file);

    //ler o arquivo ao carregar a página, e executar a função
    reader.onload = (event) => {
        //url da imagem
        let img_url = event.target.result;
        let img = new Image();
        img.src = img_url;
        let container = document.querySelector(".feliz");

        //ao carregar a imagem, criar um canvas para compressão, mantendo a proporção da imagem
        img.onload = (e) =>{
            let canvas = document.createElement("canvas");
            let ratio = WIDTH / e.target.width;
            canvas.width = WIDTH;
            canvas.height = e.target.height * ratio;

            const context = canvas.getContext("2d");
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
                        let hidden = document.createElement("input");
                        hidden.type="hidden";
                        hidden.name="dataURL";
                        hidden.value=base64;
                        document.getElementById('form').appendChild(hidden);

                        //nova imagem comprimida
                        let img2 = new Image();
                        img2.src = dataURL;
                        container.appendChild(img2);
                        img_name = img_input.files[0].name;
                        //substitui a imagem pela comprimida no input
                        let newfile = new File([blob], img_name,{
                        type:"jpeg",
                        lastModified:new Date().getTime()});
                        let containfile = new DataTransfer();
                        containfile.items.add(newfile);
                        img_input.files = containfile.files;
                    });
                    let link = document.createElement("a");
                    link.download = "image.jpeg";
                    link.href = URL.createObjectURL(blob);
                    link.textContent += "Download Comprimido";
                    document.getElementById('form').appendChild(link);
                }, "image/jpeg",1);
        }
    }
=======
//definir largura da imagem comprimida
const WIDTH = 800;


//seleciona o input da imagem
let img_input = document.getElementById('img');

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
        let container = document.querySelector('.feliz');

        //ao carregar a imagem, criar um canvas para compressão, mantendo a proporção da imagem
        img.onload = (e) =>{
            console.log('AQUI A IMAGEM XADAPUT '+img.width+'x'+img.height);
            let canvas = document.createElement('canvas');
            let ratio = WIDTH / e.target.width;
            canvas.width = WIDTH;
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
                        document.getElementById('form').appendChild(hidden);

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
                    document.getElementById('form').appendChild(link);
                }, 'image/jpeg',1);
        }
    }
>>>>>>> origin/master
});
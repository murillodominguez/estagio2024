const WIDTH = 800;

//seleciona o input da imagem
let img_input = document.getElementById('img');

//executa função ao mudar o input (enviar arquivo)
img_input.addEventListener('change', (e) => {
    console.log(event);
    //arquivo enviado
    let img_file = e.target.files[0];
    console.log(img_file.size)
    console.log(img_file);

    //leitor de arquivo
    let reader = new FileReader;
    reader.readAsDataURL(img_file);
    console.log(reader);

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
            console.log(context);
            container.appendChild(img);

            //transforma o conteúdo do canvas em arquivo/blob
                canvas.toBlob(function createBlob(blob){
                    console.log(blob, blob.size);
                    const fr = new FileReader();
                    fr.readAsDataURL(blob);
                    fr.addEventListener('load', ()=>{
                        const dataURL = fr.result;
                        console.log(dataURL);
                        let img2 = new Image();
                        img2.src = dataURL;
                        container.appendChild(img2);
                        img_name = img_input.files[0].name;
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
                    let new_img_blob = URL.createObjectURL(blob);
                    console.log(new_img_blob);
                    console.log(blob);
                    link.textContent += "Download Comprimido";
                    document.getElementById('form').appendChild(link);
                    console.log(link.href);
                }, "image/jpeg",1);
        }
    }
});
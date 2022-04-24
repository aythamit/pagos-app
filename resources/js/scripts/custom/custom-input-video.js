/**
 * Opciones:
 *
* */

function createHtmlCustomInputVideo(nameInput, nameVideo, nameSource, options = null){
    let html = `
        <div class="col-12">
           ${createHtmlInputVideo(nameInput)}
        </div>
        <div class="col-lg-12 col-md-6 col-12">
          ${createHtmlSourceVideo(nameVideo, nameSource)}
        </div>
    `

    return html;
}

function createHtmlCustomInputVideo(id, options = null){
    let html = `
        <div class="col-12">
           ${createHtmlInputVideo(id)}
        </div>
        <div class="col-lg-12 col-md-6 col-12">
          ${createHtmlSourceVideo(id)}
        </div>
    `

    return html;
}

function createHtmlSourceVideo(id, options = null){
    let src = '';
    let type = '';
    let textoVideo = 'Tu navegador no soporta la etiqueta video.'
    let labelVideo = 'Vídeo actual'
    return `
        <div class="form-group">
        <label for="video">${labelVideo}</label>
        <video controls id="video_video_${id}" class="w-100" playsinline>
            <source id="video_source_${id}" src="${src}" type="${type}" />
            ${textoVideo}
        </video>
      </div>
    `
}

function createHtmlInputVideo(id, options = null){

    let classLabel = `btn btn-primary`
    let textLabel = `Subir vídeo`

    let inputTextRequired = `El campo video es obligatorio.`;
    let acceptFormats = `video/mp4,video/x-m4v,video/*`;
    let maxSize = `6154427`;
    return `
       <label for="video_input_${id}" class="${classLabel}"><span class="pr-1"><i data-feather="plus"></i></span>${textLabel}</label>
        <input type="file" id="video_input_${id}" name="video_input_${id}" class="d-none" accept="${acceptFormats}" max-size="${maxSize}" data-required="${inputTextRequired}" required>
        `;
}

function initInputVideo(id){
    $(`#video_input_${id}`).on("change", function (event) {

        const videoSrc = document.querySelector(`#video_source_${id}`);
        const videoTag = document.querySelector(`#video_video_${id}`);


        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                videoSrc.src = e.target.result
                videoTag.load()
            }.bind(this)

            reader.readAsDataURL(event.target.files[0]);
        }
        console.log({videoSrc, videoTag, reader});
    });
}
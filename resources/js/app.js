import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagePosting = {}
            imagePosting.size = 1234
            imagePosting.name = document.querySelector('[name="image"]').value
            this.options.addedfile.call(this, imagePosting)
            this.options.thumbnail.call(this, imagePosting, `/uploads/${imagePosting.name}`)
            imagePosting.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
})

dropzone.on('success', function (file, response) {
    document.querySelector('[name="image"]').value = response.image
})
dropzone.on('removefile', function () {
    document.querySelector('[name="image"]').value = ''
})
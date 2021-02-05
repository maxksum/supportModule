// Prevent Dropzone from auto discovering this element:
Dropzone.options.demoUpload = false;
// This is useful when you want to create the
// Dropzone programmatically later
// I use it here just to avoid auto-init for the demo element, you don't have to use this approach in your app


Dropzone.options.myDropzone = {
    url: '/admin/tourneys/add',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 1,
    maxFiles: 1,
    maxFilesize: 3,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    filesizeBase: 1000,
    success: function(file, response){
      window.location = "/admin/tourneys/";
    },
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    },
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit-tourneys").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            if (dzClosure.files.length == 0) {
              alert("Вы не выбрали файлы");
            }
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("_token", jQuery("#add-tourney input[name=_token]").val());
            formData.append("link", jQuery("#tourney-link").val());
            formData.append("state", jQuery("#tourney-state").val());
            formData.append("sort", jQuery("#tourney-sort").val());
        });
    },
}

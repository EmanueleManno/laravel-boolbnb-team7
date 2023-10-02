const placeholder = 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=';
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

let blobUrl = null;

imageInput.addEventListener('change', () => {
    if(imageInput.files[0]){
        // Get file
        const file=imageInput.files[0];

        // Created blob url
        blobUrl=URL.createObjectURL(file);

        // Add blob url to the preview
        imagePreview.src = blobUrl;
    }else{
        imagePreview.src = placeholder;
    }
})

// Delete blob url
window.addEventListener('beforeunload', ()=>{
    if(blobUrl) URL.revokeObjectURL(blobUrl);
})
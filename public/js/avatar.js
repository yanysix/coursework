document.getElementById('avatarInput').onchange = function(evt){
    const [file] = this.files;
    if(file){
        document.getElementById('avatarPreview').src = URL.createObjectURL(file);
    }
}

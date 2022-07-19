function ValidateImagemEdit() {

    var fuData = document.getElementById('validarImagemEdit');
    var FileUploadPath = fuData.value;
    
    if (FileUploadPath == '') {
        alert("Faça o Upload da Imagem!");
    
    } else {
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
    
        if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
            if (fuData.files && fuData.files[0]) {
                var size = fuData.files[0].size;
    
                if(size > 5242880){
                    alert("Por favor selecione uma imagem menor que 5 Mb!");
                    $("#edit_paciente_btn").attr("disabled",true);
                    return;
                }else{
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                        $("#edit_paciente_btn").removeAttr("disabled");
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            }
        }else{
            alert("Formato Inválido, é aceito apenas: PNG, JPG, JPEG. ");
            $("#edit_paciente_btn").attr("disabled",true);
        }
    }
}
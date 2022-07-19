function ValidateImagemAdd() {

    var fuData = document.getElementById('validarImagemAdd');
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
                    $("#add_paciente_btn").attr("disabled",true);
                    return;
                }else{
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                        $("#add_paciente_btn").removeAttr("disabled");
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            }
        }else{
            alert("Formato Inválido, é aceito apenas: PNG, JPG, JPEG. ");
            $("#add_paciente_btn").attr("disabled",true);
        }
    }
}
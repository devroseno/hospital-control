<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Control</title>

    {{-- BOOTSTRAP --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css'/>

</head>

<!-- PACIENTE MODAL (REGISTER) -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_paciente_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="nome">Nome Completo</label>
                            <input type="text" name="nome" class="form-control" placeholder="Nome do Paciente" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="input" class="form-control" required placeholder="CPF do Paciente">
                            <span id="resposta"  style="color: Blue;"></span>
                        </div>
                        <div class="col-lg">
                            <label for="wpp">WhatsApp</label>
                            <input type="text" name="wpp" id="addWpp" class="form-control" required placeholder="(99) 9 9999-9999">
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Selecione a foto</label>
                        <input type="file" name="avatar" id="validarImagemAdd" class="form-control"  onchange="return ValidateImagemAdd()" required>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        <label>Data de Nascimento:</label> <br> <br>
                        <input type="text" class="form" name="dia" id="txtDia" size="2" maxlength="2" placeholder="Dia" required> /
                        <input type="text" class="form" name="mes" id="txtMes" size="2" maxlength="2" placeholder="Mês" required> /
                        <input type="text" class="form" name="ano" id="txtAno" size="4" maxlength="4" placeholder="Ano" required> =
                        <input readonly name="idade" type="text" id="txtIdade" size="4" maxlength="4" required> <br> <br>
                        <button type="button" class="btn btn-primary btn-sm" onclick="CalcularIdade2();">Calcular Idade</button>
                    </div>
                    <hr>

                    {{-- CHECKBOX DE SINTOMAS - ADD (INICIO) --}}
                    <div class="form-check mt-3">
                        <p>Marque os Sintomas Apresentados:</p>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Cansaco">
                                <label class="form-check-label" for="cansaco">Cansaço</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dores no Corpo">
                                <label class="form-check-label" for="dores no corpo">Dores no Corpo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Coriza">
                                <label class="form-check-label" for="coriza">Coriza</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Falta de Olfato">
                                <label class="form-check-label" for="falta de olfato">Falta de olfato</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Diarria">
                                <label class="form-check-label" for="diarreia">Diarréia</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Falta de Paladar">
                                <label class="form-check-label" for="falta de paladar">Falta de paladar</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Tosse">
                                <label class="form-check-label" for="tosse">Tosse</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Febre">
                                <label class="form-check-label" for="febre">Febre</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dificuldade de Respirar">
                                <label class="form-check-label" for="dificuldade de respirar">Dificuldade de Respirar</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Mal Estar Geral">
                                <label class="form-check-label" for="mal estar geral">Mal Estar Geral</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dor de Cabeca">
                                <label class="form-check-label" for="dor de cabeca">Dor de Cabeça</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Nariz Entupido">
                                <label class="form-check-label" for="nariz entupido">Nariz Entupido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dor de Garganta">
                                <label class="form-check-label" for="dor de garganta">Dor de Garganta</label>
                            </div>
                            <div class="col-lg-12">
                                <input type="checkbox" name="sintomas[]" value="Dificuldade de Locomocao">
                                <label class="form-check-label" for="dificuldade de locomocao">Dificuldade de Locomoção</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name='sintomas["1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1",]' value="nao atendido">
                                <label class="form-check-label" for="Não atendido" style="color: red;">NÃO ATENDIDO</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name='sintomas[]' value="sem sintomas">
                                <label class="form-check-label" for="Sem Sintomas" style="color: green;">SEM SINTOMAS</label>
                            </div>
                        </div>
                    </div>
                    {{-- CHECKBOX DE SINTOMAS - ADD (FIM) --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" id="add_paciente_btn" class="btn btn-success">Adicionar Paciente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- PACIENTE MODAL (EDIT) -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_paciente_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paciente_id" id="paciente_id">
                <input type="hidden" name="paciente_avatar" id="paciente_avatar">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="nome">Nome Completo</label>
                            <input type="text" name="nome" id="nome" class="form-control" required placeholder="Nome do Paciente">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf"  class="form-control" required placeholder="CPF do Paciente">
                            <span id="resposta2"  style="color: Blue;"></span>
                        </div>
                        <div class="col-lg">
                            <label for="wpp">WhatsApp</label><br>
                            <input type="text" name="wpp" id="wpp" class="form-control" required placeholder="(99) 9 9999-9999">
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Selecionar Foto</label>
                        <input type="file" name="avatar" id="validarImagemEdit" class="form-control" onchange="return ValidateImagemEdit()">
                    </div>
                    <div class="mt-2" id="avatar">
                        <!-- PUXA A IMAGEM DO PACIENTE DO BD -->
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        <label>Data de Nascimento:</label> <br> <br>
                        <input type="text" name="dia" class="form" id="dia" size="2" maxlength="2" placeholder="Dia" required> /
                        <input type="text" id="mes" class="form" name="mes" size="2" maxlength="2" placeholder="Mês" required> /
                        <input name="ano" type="text" class="form" id="ano" size="4" maxlength="4" placeholder="Ano" required> =
                        <input readonly name="idade" type="text" id="idade" size="4" maxlength="4"  required> <br> <br>
                        <button type="button" class="btn btn-primary btn-sm" onclick="CalcularIdade1();">Calcular Idade</button>
                    </div>
                    <hr>

                    <!-- CHECKBOX SYMPTOMS - EDIT-->
                    <div class="form-check mt-3">
                        <p>Marque os Sintomas Apresentados:</p>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Cansaco">
                                <label class="form-check-label" for="cansaco">Cansaço</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dores no Corpo">
                                <label class="form-check-label" for="dores no corpo">Dores no Corpo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Coriza">
                                <label class="form-check-label" for="coriza">Coriza</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Falta de Olfato">
                                <label class="form-check-label" for="falta de olfato">Falta de olfato</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Diarreia">
                                <label class="form-check-label" for="diarreia">Diarréia</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Falta de Paladar">
                                <label class="form-check-label" for="falta de paladar">Falta de paladar</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Tosse">
                                <label class="form-check-label" for="tosse">Tosse</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Febre">
                                <label class="form-check-label" for="febre">Febre</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dificuldade de Respirar">
                                <label class="form-check-label" for="dificuldade de respirar">Dificuldade de Respirar</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Mal Estar Geral">
                                <label class="form-check-label" for="mal estar geral">Mal Estar Geral</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dor de Cabeca">
                                <label class="form-check-label" for="dor de cabeca">Dor de Cabeça</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Nariz Entupido">
                                <label class="form-check-label" for="Nariz Entupido">Nariz Entupido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="sintomas[]" value="Dor de Garganta">
                                <label class="form-check-label" for="dor de garganta">Dor de Garganta</label>
                            </div>
                            <div class="col-lg-12">
                                <input type="checkbox" name="sintomas[]" value="Dificuldade de Locomocao">
                                <label class="form-check-label" for="dificuldade de locomocao">Dificuldade de Locomoção</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name='sintomas["1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1",]' value="nao atendido">
                                <label class="form-check-label" for="Não atendido" style="color: red;">NÃO ATENDIDO</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name='sintomas[]' value="sem sintomas">
                                <label class="form-check-label" for="Sem sintomas" style="color: green;">SEM SINTOMAS</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" id="edit_paciente_btn" class="btn btn-success">Atualizar Paciente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<body class="bg-dark">
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- BUTTOM REGISTER PATIENT -->
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal"><i class="bi-plus-circle me-2"></i>Paciente</button>
                    </div>

                    <!-- VIEW PATIENTS -->
                    <div class="card-body" id="show_all_patients">
                        <table class="table table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>FOTO</th>
                                    <th>NOME</th>
                                    <th>NASCIMENTO</th>
                                    <th>CPF</th>
                                    <th>WHATSAPP</th>
                                    <th>STATUS</th>
                                    <th>AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-patients">
                                <!-- VIEW PATIENTS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- IMASK -->
<script src="https://unpkg.com/imask"></script>

<!-- JQUERY -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<!-- BOOTSTRAP -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>

<!-- SWEET ALERT -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- MASK -->
<script src="js/masks.js"></script>

<!-- VALIDATE CPF -->
<script src="js/validarcpf_edit.js"></script>
<script src="js/validarcpf_add.js"></script>

<!-- VALIDATE IMAGE -->
<script src="js/validateImage.js"></script>

<!-- CALCULATE AGE -->
<script src="js/calcularidade_edit.js"></script>
<script src="js/calcularidade_add.js"></script>

<!-- SCRIPT PARA VALIDAÇÃO EM AJAX -->
<script>

  //AJAX FOR CRUD - START
    $(function() {

        // REGISTER AJAX - START
        $("#add_paciente_form").submit(async function(event) {
            event.preventDefault();
            const fd = new FormData(this);
            $("#add_paciente_btn").text('Cadastrando...');
            try{
                const resposta = await axios.post('{{ route("store") }}', fd);
                Swal.fire(
                        'Cadastrado!',
                        'Paciente cadastrado com sucesso!',
                        'success'
                        );
                fetchAllPacientes();
                $("#add_paciente_btn").text('Adicionar Paciente');
                $("#add_paciente_form")[0].reset();
                $("#addPatientModal").modal('hide');
            }
            catch(error){
                console.log(error);
            }
        });
        // REGISTER AJAX - END

        //EDIT - START
        $(document).on('click', '.editIcon', function(event) {
            event.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route("edit") }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#nome").val(response.nome);
                    $("#idade").val(response.idade);
                    $("#dia").val(response.dia);
                    $("#mes").val(response.mes);
                    $("#ano").val(response.ano);
                    $("#cpf").val(response.cpf);
                    $("#wpp").val(response.wpp);
                    $("#avatar").html(
                        `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
                    $("#paciente_id").val(response.id);
                    $("#paciente_avatar").val(response.avatar);
                }
            });
        });
        //EDIT - END

        // UPDATE - START
        $("#edit_paciente_form").submit( async function(event) {
            event.preventDefault();
            const fd = new FormData(this);
            $("#edit_paciente_btn").text('Atualizando...');
            try {
                const resposta = await axios.post(' {{ route("update") }} ', fd);
                Swal.fire(
                    'Atualizado!',
                    'Paciente atualizado com sucesso!',
                    'success'
                )
                document.getElementById("tbody-patients").innerHTML = null;
                fetchAllPacientes();
                $("#edit_paciente_btn").text('Atualizar Paciente');
                $("#edit_paciente_form")[0].reset();
                $("#editPatientModal").modal('hide');
            }
            catch(error){
                console.log(error);
            }
        });
        // UPDATE - END

        // DELETE AJAX - START
        $(document).on('click', '.deleteIcon', function(event) {
            event.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não será capaz de reverter isso!",
                icon: 'warning',
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                closeButtonColor: '#d33' ,
                confirmButtonText: 'Sim, exclua!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("delete") }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Deletado!',
                            'O paciente foi excluído.',
                            'success'
                        )
                        fetchAllPacientes();
                        }
                    });
                }
            })
        });
        // DELETE AJAX - END

        //DIAGNOSE PATIENT
        function diagnosePatient(sintomas){
            let status = ""

            if(sintomas <= 5){
                status = '<i class="bi bi-check-circle" style="color: green;"></i> SINTOMAS INSUFICIENTES';
            }
            else if(sintomas >= 6 && sintomas <= 7){
                status = '<i class="bi bi-bell" style="color: orange;"></i> POTENCIAL INFECTADO';
            }
            else if(sintomas >= 8 && sintomas <= 14){
                status = '<i class="bi bi-exclamation-triangle" style="color: red;"></i> POSSÍVEL INFECTADO';
            }
            else if(sintomas = 15){
                status = '<i class="bi bi-exclamation-circle" style="color: blue;"></i> NÃO ATENDIDO';
            }

            return status;
        }

        // LIST PATIENTS
        fetchAllPacientes();

        async function fetchAllPacientes() {
            const response = await axios.get('{{ route("fetchAll") }}');

            const tbody = document.getElementById("tbody-patients");
            tbody.innerHTML = null;
            response.data.pacientes.forEach(paciente => {
                const status = diagnosePatient(paciente.sintomas.length);
                tbody.innerHTML += `
                <tr>
                    <td><img src="storage/images/${paciente.avatar}" style="width: 70px; height:70px; border-radius:100%;" class="img-thumbnail rounded-circle"></td>
                    <td>${paciente.nome}</td>
                    <td>${paciente.idade}</td>
                    <td>${paciente.cpf}</td>
                    <td>${paciente.wpp}</td>
                    <td>${status}</td>
                    <td>
                        <a id="${paciente.id}" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPatientModal"><i class="bi-pencil-square h4"></i></a>
                        <a href="#" id="${paciente.id}" class="text-danger mx-1 deleteIcon"><i class="bi bi-trash-fill h4"></i></a>
                    </td>
                </tr>
                `;
            })
        }
    });
    // AJAX FOR CRUD - END

</script>

</body>
</html>

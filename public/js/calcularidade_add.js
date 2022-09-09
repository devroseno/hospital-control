function CalcularIdade2()
	{
  data = new Date();
  dia = data.getUTCDay(); if(dia < 10){dia = "0" + dia;}
  mes = data.getUTCMonth(); if(mes < 10){mes = "0" + mes;}
  ano = data.getUTCFullYear();
  
  AnoHoje = ano;
  AnodataNascimento = txtAno.value;

  Idade = parseInt(AnoHoje) - parseInt(AnodataNascimento);
  
  if(txtMes.value >= mes)
  {
  	if(txtDia.value >= dia)
  	{
    Idade--;
  	}
  }

  //alert(Idade);
  txtIdade.value = Idade + ' anos';
	}
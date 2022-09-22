function CalcularIdade1(){
  data = new Date();
  diaHoje = data.getUTCDay(); if(diaHoje < 10){diaHoje = "0" + diaHoje;}
  mesHoje = data.getUTCMonth(); if(mesHoje < 10){mesHoje = "0" + mesHoje;}
  anoHoje = data.getUTCFullYear();

  AnoHoje = anoHoje;
  AnodataNascimento = ano.value;

  Idade = parseInt(AnoHoje) - parseInt(AnodataNascimento);

  if(mes.value >= mesHoje)
  {
  	if(dia.value >= diaHoje)
  	{
    Idade--;
  	}
  }

  //alert(Idade);
  idade.value = Idade + ' anos';
}

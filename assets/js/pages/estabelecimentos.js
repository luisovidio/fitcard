$(document).ready(function(){
    $('#cnpj').mask('00.000.000/0001-00', {placeholder: "__.___.___/____-__"});
    $('#data').mask('00/00/0000', {placeholder: "__/__/____"});
    $('#telefone').mask('(00)0000-00009', {placeholder: "(__)____-____"});
    
    
    $('#categoria').change(function(){        
        if($('#categoria option:selected').text() == 'Supermercado'){
            $('#reqTel').show();
        }
        else{
            $('#reqTel').hide();
        }
    });
    
    $("#form").validate({
       rules: {
           razao: {
               required: true
           },
           cnpj : {
               required: true,
               validaCnpj: true
           },
           data: {
               validaData: true
           },
           telefone: {
               validaTel: true,
               required: function(){
                   return $('#categoria option:selected').text() == 'Supermercado';
               }
           },
           email: {
               email: true
           }
       },
       messages: {
           razao: {
               required: "Razão social é obrigatório."
           },
           cnpj: {
               required: "CNPJ é obrigatório",
               validaCnpj: "CNPJ inválido"
           },
           data: {
               validaData: "Data inválida"
           },
           telefone: {
               validaTel: "Telefone inválido",
               required: "Telefone obrigatório para supermercados"
           },
           email: {
               email: "Email inválido"
           }
       }
    });
    
    $.validator.addMethod("validaCnpj", function(cnpjM){
        var cnpj = cnpjM.replace(/[^0-9]/g, '');
        
        //CNPJ incompleto
        if(cnpj.length != 14) return false;
        
        var i;
        var soma = 0;
        var d;
        
        //Dígitos multiplicadores para conferir o dígito verificador
        var alg = [5,4,3,2,9,8,7,6,5,4,3,2];
        
        for(i = 0; i < 12; i++){
            soma += cnpj[i] * alg[i];
        }
        
        //Verifica dígito calculado
        d = (soma%11 < 2) ? 0 : 11 - (soma%11);
        if(d != cnpj[12]) return false;
        
        //Adiciona outro digito multiplicador e zera o somatorio
        alg.unshift(6);
        soma = 0;
        
        for(i = 0; i < 13; i++){
            soma += cnpj[i] * alg[i];
        }
        
        //Verifica ultimo dígito
        d = (soma%11 < 2) ? 0 : 11 - (soma%11);
        if(d != cnpj[13]) return false;
        
        //CNPJ válido
        return true;
    });
    
    $.validator.addMethod("validaData", function(dataM){
        var dataAtual = new Date();
        var data = dataM.split('/');
        var dia = parseInt(data[0]);
        var mes = parseInt(data[1]);
        var ano = parseInt(data[2]);
        
        //Verifica se o ano de criação é incorreta
        if(ano < 1900 || ano > dataAtual.getFullYear()) return false;
        
        //Verifica se o mês é válido
        if(mes < 1 || mes > 12) return false;
        
        //Verifica se o dia é válido
        if(dia < 1 || dia > 31) return false;
        
        return true;
    });
    
    $.validator.addMethod("validaTel", function(telM){
        var tel = telM.replace(/[^/d]/g, '');
        
        if(tel.length == 0) return true;
        if(tel.length < 10) return false;
        return true;
    });
});
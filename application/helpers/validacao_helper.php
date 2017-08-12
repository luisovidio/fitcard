<?php

if(!function_exists('valCnpj')){
    function valCnpj($cnpj){
        $CI =& get_instance();
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
        //CNPJ incompleto
        if(strlen($cnpj) != 14){
            $CI->form_validation->set_message('valCnpj', 'CNPJ incompleto.');
            return false;
        }
        
        $soma = 0;
        
        //Dígitos multiplicadores para conferir o dígito verificador
        $alg = array(5,4,3,2,9,8,7,6,5,4,3,2);
        
        for($i = 0; $i < 12; $i++){
            $soma += $cnpj[$i] * $alg[$i];
        }
        
        //Verifica dígito calculado
        $d = ($soma%11 < 2) ? 0 : 11 - ($soma%11);
        if($d != $cnpj[12]){
            $CI->form_validation->set_message('valCnpj', 'CNPJ inválido.');
            return false;
        }
        
        //Adiciona outro digito multiplicador e zera o somatorio
        array_unshift($alg, 6);
        $soma = 0;
        
        for($i = 0; $i < 13; $i++){
            $soma += $cnpj[$i] * $alg[$i];
        }
        
        //Verifica ultimo dígito
        $d = ($soma%11 < 2) ? 0 : 11 - ($soma%11);
        if($d != $cnpj[13]){
            $CI->form_validation->set_message('valCnpj', 'CNPJ inválido.');
            return false;
        }
        
        //CNPJ válido
        return true;
    }
}

if(!function_exists('valTelefone')){
    function valTelefone($tel){
        $CI =& get_instance();
        $tel = preg_replace('/[^0-9]/', '', $tel);
        
        if(strlen($tel) == 0) return true;
        if(strlen($tel) < 10){
            $CI->form_validation->set_message('valTelefone', 'Telefone inválido.');
            return false;
        }
        return true;
    }
}

if(!function_exists('valDominio')){
    function valDominio($email){
        $CI =& get_instance();
        $dominio = explode('@', $email);
        if(!checkdnsrr($dominio[1])){
            $CI->form_validation->set_message('valDominio', 'Domínio inválido.');
            return false;
        }
        return true;
    }
}

if(!function_exists('valData')){
    function valData($data){
        $CI =& get_instance();
        $data = explode('/', $data);
        if(checkdate($data[1], $data[0], $data[2]) && $data[2] <= date('Y')){
            return true;
        }
        $CI->form_validation->set_message('valData', 'Data inválida.');
        return false;
    }
}
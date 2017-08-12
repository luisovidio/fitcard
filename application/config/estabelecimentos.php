<?php

$config['ufs'] = array(
'AC'    => 'AC',
'AL'	=> 'AL',
'AP'	=> 'AP',
'AM'	=> 'AM',
'BA'	=> 'BA',
'CE'	=> 'CE',
'DF'	=> 'DF',
'ES'	=> 'ES',
'GO'	=> 'GO',
'MA'	=> 'MA',
'MT'    => 'MT',
'MS'	=> 'MS',
'MG'	=> 'MG',
'PA'	=> 'PA',
'PB'	=> 'PB',
'PR'	=> 'PR',
'PE'	=> 'PE',
'PI'	=> 'PI',
'RJ'	=> 'RJ',
'RN'	=> 'RN',
'RS'    => 'RS',
'RO'    => 'RO', 
'RR'    => 'RR',
'SC'    => 'SC', 
'SP'    => 'SP', 
'SE'    => 'SE',
'TO'    => 'TO',
);

$config['regras'] = array(
    array(
        'field' => 'razao',
        'label' => 'razao',
        'rules' => 'required|trim|max_length[45]'
    ),
    array(
        'field' => 'fantasia',
        'label' => 'fantasia',
        'rules' => 'trim|max_length[45]'
    ),
    array(
        'field' => 'cnpj',
        'label' => 'cnpj',
        'rules' => 'valCnpj'
    ),
    array(
        'field' => 'telefone',
        'label' => 'telefone',
        'rules' => 'valTelefone|callback_validaTel'
    ),
    array(
        'field' => 'email',
        'label' => 'email',
        'rules' => 'trim|valid_email|valDominio|max_length[45]'
    ),
    array(
        'field' => 'data',
        'label' => 'data',
        'rules' => 'valData'
    ),
    array(
        'field' => 'endereco',
        'label' => 'endereco',
        'rules' => 'trim|max_length[80]'
    ),
    array(
        'field' => 'cidade',
        'label' => 'cidade',
        'rules' => 'trim|max_length[45]'
    ),
);

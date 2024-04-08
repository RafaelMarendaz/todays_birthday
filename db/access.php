<?php

use tool_dataprivacy\form\contextlevel;

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    //Permite que o usuário adicione o bloco

    'block/todays_birthday:addinstance' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array (
            'guest' => CAP_PREVENT,         //Previne visitante
            'user' => CAP_PREVENT,          //Previne usuario autenticado
            'student' => CAP_PREVENT,       //Previne estudante
            'teacher' => CAP_PREVENT,       //Previne professor
            'editingteacher' => CAP_ALLOW,  //Permite professor editor
            'manager' => CAP_ALLOW          //Permite gerente
        ),
        'clonepermissionsfrom' => 'moodle/my:manageblocks'
    ),

    //Este permite que o usuário adicione ao seu proprio dashboard (Pagina inicial do moodle)

    'block/todays_birthday:myaddinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array (
            'guest' => CAP_PREVENT,         //Previne visitante
            'user' => CAP_PREVENT,          //Previne usuario autenticado
            'student' => CAP_PREVENT,       //Previne estudante
            'teacher' => CAP_PREVENT,       //Previne professor
            'editingteacher' => CAP_ALLOW,  //Permite professor editor
            'manager' => CAP_ALLOW          //Permite gerente
        ),
        'clonepermissionsfrom' => 'moodle/my:manageblocks'
    ),
);
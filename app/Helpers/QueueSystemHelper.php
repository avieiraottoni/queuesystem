<?php

// Se não existir a função showValidationError, ela vai ser 
// definida dentro desse método.
if(!function_exists('showValidationError')) {
    function showValidationError($fieldName, $validationErrors) {
        if($validationErrors->has($fieldName)) {
            return '<div class="text-sm italic text-red-500">' . $validationErrors->first($fieldName) .'</div>';
        }else {
            return '';
        }
    }
}

if(!function_exists('showServerError')) {
    function showServerError() {
        if(session()->has('server_error')) {
            return '<div class="text-sm italic text-red-500">' . session()->get('server_error') .'</div>';
        }else {
            return '';
        }
    }
}

if(!function_exists('getFormattedTicketNumber')) {
    function getFormattedTicketNumber($ticketNumber, $prefix = null, $totalDigits = 3) {
        $result = '';

        // prefix
        if($prefix) {
            $result = $prefix;
        }

        //numbers
        if($totalDigits > 0) {
            $result .= str_pad($ticketNumber, $totalDigits, '0', STR_PAD_LEFT);
        }

        return $result;
    }
}

if(!function_exists('getticketStateText')) {

    function getTicketStateText($state) {
        $rules = [
            'waiting'       => 'Em espera',
            'called'        => 'Atendido',
            'not_attended'  => 'Não atendido',
            'dismissed'     => 'Dispensado'
        ];

        return $rules[$state] ?? 'Desconhecido';
    }
}
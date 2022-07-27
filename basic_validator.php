<?php

// inainte sa va folositi de el incercati sa il intelegeti ;)
class Validator
{
    private $_errors = [];
    private $_accepted_rules = [
        'required', 
        'min_len', 
        'max_len', 
        'alpha_numeric', 
        'numeric', 
        'alpha', 
        'first_letter_upper_case',
        'contains_special_symbol',
        'email'
        // todo 
        // add same_as type of validation 
        // to check if password & password_confirmation match 
    ];

    public function getAcceptedRules()
    {
        return $this->_accepted_rules;
    }

    public function validate($data, $rules = []){
        foreach ($data as $item_name => $item_value) {
            if(key_exists($item_name,$rules)){
                foreach ($rules[$item_name] as $rule_name => $rule_value) {
                    if (is_int($rule_name))
                        $rule_name = $rule_value;

                    switch ($rule_name) {
                        case 'required':
                            if (empty($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' is required');
                            break;

                        case 'min_len':
                            if (strlen($item_value) < $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be minimum ' . $rule_value . ' characters');
                            break;

                        case 'max_len':
                            if (strlen($item_value) > $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be maximum ' . $rule_value . ' characters');
                            break;

                        case 'alpha_numeric':
                            if (!ctype_alnum($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be alpha numeric');
                            break;
                        case 'numeric':
                            if (!ctype_digit($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be numeric');
                            break;
                        case 'alpha':
                            if (!ctype_alpha($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be alphabetic characters');
                            break;
                        case 'first_letter_upper_case':
                            if (!ctype_upper($item_value[0]) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should have the first letter upper case');
                            break;
                        case 'contains_special_symbol':
                            $pattern = "!%&()=\[\]#@,.;+]+\.[";
                            $regex = '/^(' . $pattern . ')$/u';
                            if (!preg_match($regex, $item_value))
                                $this->addError($item_name, ucwords($item_name) . ' should have at least one special character');
                            break;
                        case 'email':
                            if (!filter_var($item_value, FILTER_VALIDATE_EMAIL))
                                $this->addError($item_name, $item_name . ' should be an email');
                            break;
                        default:
                            $this->addError($item_name,'No validation found for '.$item_name);
                    }

                }
            }
        }   
    }

    private function addError($item, $error)
    {
        $this->_errors[$item][] = $error;
    }

    public function hasErrors()
    {
        return !empty($this->_errors);
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}


// HOW TO USE
/**
 * 1. Generam un vector asociativ ce contine datele pe care dorim sa le validam
 *      OBS: 
 *          A)  Aceste date se vor lua de obicei din vectorii $_POST / $_GET 
 *              si vor veni sub forma de vectori asociativi
 *          B)  Vector asociativ nu contine indexi sub forma de int ci sub forma de string
 *              EX  [ "password" => "parolaPuternica"] 
 *              La indexul password avem valoarea parolaPuternica 
 *              Din cauza ca indexul password este string avem un vector asociativ
 * 
 * 2. Generam o matrice asociativa de reguli pentru validarea fiecarui camp
 *      OBS:
 *          A)  Pentru a nu va tot plimba prin fisiere ca sa vedeti usor ce validari
 *              aveti deja implementate puteti folosi urmatoarea sintaxa :
 *                  var_dump(new Validator()->getAcceptedRules());
 * 
 * 3.  Generam un obiect de tip validator 
 * 
 * 4.  Apelam metoda validate pe noul validator unde pasam ca parametri:
 *      Datele
 *      Regulile
 * 
 * 5.   Pentru a vedea daca avem erori folosim metoda hasErrors().
 *      Aceasta metoda intoarce TRUE sau FALSE.
 *      Deci putem verifica usor daca au aparut erori la validare
 * 
 * 6.   Pentru a vedea erorile se va apela metoda getErrors();
 *      Aceasta metoda intoarce o matrice asociativa cu erorile depistate
 *      Pentru a le afisa se va folosi var_dump($v->getErrors);
 *      Pentru a le trimite la utilizator se va parcurge matricea si se vor pune 
 *      erorile in variabila $_SESSION dar despre asta vom discuta saptamana viitoare ;)
 * 
 *      Exemplu mai jos
 */

//  $data =[
//     "user_name" => "Manu",
//     "password"  => "password123",
//     "password_confirmation" => "Password123",
//     "email" => "manuel.dorca",
//     "date_of_birth" => "",
//     "age" => "2"
// ]; 

// $rules = [
//     'user_name' => [
//         'required', 
//         'min_len' => 4, 
//         'max_len' => 8  
//     ],
//     'password' => [
//         'required', 
//         'min_len' => 8, 
//         'alpha_numeric', 
//         'first_letter_upper_case', 
//         'contains_special_symbol'
//     ],
//     'email' => [
//         'required', 
//         'email'
//     ],
//     'date_of_birth' => [
//         'required'
//     ]
// ];

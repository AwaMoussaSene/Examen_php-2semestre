<?php 
namespace Bank\Core\Validator;

class Validator{
    public array $errors = [];
    public function validate(): bool
    {
        return count($this->errors) == 0;
    }

    public function isEmpty(string $nameField, string $sms = "champ obligatoire"): bool
    {
        if (empty($_REQUEST[$nameField])) {
            $this->errors[$nameField] = $sms;
            return true;
        }
        return false;
    }

    public function isNumerique(string $nameField, string $sms = "Doit être un nombre"): bool
    {
        if (!isset($_REQUEST[$nameField]) || !is_numeric($_REQUEST[$nameField])) {
            $this->errors[$nameField] = $sms;
            return true;
        }
        return false;
    }
    public function isEmail(string $nameField, string $sms="cette valeur n'est pas un email"):bool{
        if(filter_var($_REQUEST[$nameField],FILTER_VALIDATE_EMAIL)==false){
            $this->errors[$nameField]=$sms;
         return false;
        }
        return true;
      }
     public function getErrors(): array
      {
          return $this->errors;
      }
}
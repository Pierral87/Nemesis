<?php
namespace ProjetTransfo\Classes;

class FormValidator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(): bool
    {
        if (empty($this->data['username'])) {
            $this->errors['username'] = "Le pseudo est obligatoire";
        }

        if (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email invalide";
        }

        if (strlen($this->data['password']) < 6) {
            $this->errors['password'] = "Min 6 caractères";
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

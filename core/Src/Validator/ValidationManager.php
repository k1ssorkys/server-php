<?php

namespace Src\Validator;

class ValidationManager
{
    protected array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];

        foreach ($rules as $field => $validators) {
            $value = $data[$field] ?? null;

            foreach ($validators as $validatorClass) {
                $validator = new $validatorClass($field, $value);
                $result = $validator->validate();

                if ($result !== true) {
                    $this->errors[$field][] = $result;
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}

<?php

Validator::extend('alpha_spaces', function ($attribute, $value) {
    return preg_match('/^[\pL\s]+$/u', $value);
});

Validator::extend('name', function ($attribute, $value) {
    return preg_match("/^[\pL\s']+$/u", $value);
});

Validator::extend('gender', function ($attribute, $value) {
   return in_array(strtolower($value), ['male', 'female']);
});

Validator::extend('contact', function($attribute, $value) {
    return preg_match('/^([0-9\s\-\+\(\)]*)$/', $value);
});

Validator::extend('company_name', function ($attribute, $value) {
    return preg_match("/^[a-zA-Z0-9-_\s']+$/", $value);
});
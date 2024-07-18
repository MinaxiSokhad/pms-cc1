<?php declare(strict_types= 1);
namespace App\Services;
use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    NameRule,
    PasswordRule,
    InRule,
    MobileNoRule,
    DateRule,
    HireDateRule

};
class ValidatorService{
    private Validator $validator;
    public function __construct(){
        $this->validator = new Validator();
        $this->validator->add('required',new RequiredRule());
        $this->validator->add('email',new EmailRule());
        $this->validator->add('name',new NameRule());
        $this->validator->add('password',new PasswordRule());
        $this->validator->add('in',new InRule());
        $this->validator->add('mobile',new MobileNoRule());
        $this->validator->add('date',new DateRule());
        $this->validator->add('hiredate',new HireDateRule());
    }
    public function validateRegister(array $formData){
        $this->validator->validate($formData,[
            'name'=>['required','name'],
            'email'=>['required','email'],
            'password'=>['required','password'],
            'country'=>['required','name'],
            'state'=>['required','name'],
            'city'=>['required','name'],
            'gender'=>['required','in:M,F,O'],
            'maritalStatus'=>['required','in:S,M,W,D'],
            'mobileNo'=>['required','mobile'],
            'address'=>['required'],
            'dob'=>['required','date:Y-m-d'],
            'hireDate'=>['required','hiredate:Y-m-d,'. $formData['dob']]
        ]);
    }
    public function validateLogin(array $formData){
        $this->validator->validate($formData,[
            'email'=>['required','email'],
            'password'=>['required','password']  
        ]);
    }
}

<?php declare(strict_types=1);
namespace App\Services;

use Framework\Database;
use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    NameRule,
    PasswordRule,
    InRule,
    MobileNoRule,
    DateRule,
    HireDateRule,
    UrlRule,
    DeadLineRule,
    SelectionRule

};

class ValidatorService
{
    private Validator $validator;
    public function __construct(private Database $db)
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('name', new NameRule());
        $this->validator->add('password', new PasswordRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('mobile', new MobileNoRule());
        $this->validator->add('date', new DateRule());
        $this->validator->add('hiredate', new HireDateRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('deadline', new DeadLineRule());
        $this->validator->add('selection', new SelectionRule());
    }
    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required', 'name'],
            'email' => ['required', 'email'],
            'password' => ['required'],// 'password' => ['required', 'password'],
            'country' => ['required', 'in:USA,Canada,Mexico,India,Russia'],
            'state' => ['required', 'name'],
            'city' => ['required', 'name'],
            'gender' => ['required', 'in:M,F,O'],
            'maritalStatus' => ['required', 'in:S,M,W,D'],
            'mobileNo' => ['required', 'mobile'],
            'address' => ['required'],
            'dob' => ['required', 'date:Y-m-d'],
            'hireDate' => ['required', 'hiredate:Y-m-d,' . $formData['dob']]
        ]);
    }
    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required'],
            'password' => ['required']
        ]);
    }
    public function validateProfile(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required', 'name'],
            'email' => ['required', 'email'],
            'password' => ['required'], //'password' => ['required', 'password'],
            'country' => ['required', 'in:USA,Canada,Mexico,India,Russia'],
            'state' => ['required', 'name'],
            'city' => ['required', 'name'],
            'gender' => ['required', 'in:M,F,O'],
            'maritalStatus' => ['required', 'in:S,M,W,D'],
            'mobileNo' => ['required', 'mobile'],
            'address' => ['required'],
            'dob' => ['required', 'date:Y-m-d'],
            'hireDate' => ['required', 'hiredate:Y-m-d,' . $formData['dob']]


        ]);
    }
    public function validateCustomer(array $formData)
    {
        //dd($formData);
        $this->validator->validate($formData, [
            'company' => ['required', 'name'],
            'website' => ['required', 'url'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'mobile'],
            'country' => ['required', 'in:USA,Canada,Mexico,India,Russia'],
            'address' => ['required'],
        ]);
    }
    public function validateProject(array $formData)
    {
        //dd($formData);
        $this->validator->validate($formData, [
            'name' => ['required', 'name'],
            'customer' => ['selection'],
            'tags' => ['required'],
            'start_date' => ['required'],
            'deadline' => ['deadline:Y-m-d,' . $formData['start_date']],
            'status' => ['required'],
            'members' => ['required'],
        ]);
    }
    public function validateTask(array $formData)
    {
        $this->validator->validate($formData, [
            'project' => ['selection'],
            'name' => ['required', 'name'],
            'members' => ['required'],
            'tags' => ['required'],
            'start_date' => ['required'],
            'due_date' => ['deadline:Y-m-d,' . $formData['start_date']],
            'status' => ['required'],

        ]);
    }
    public function isExists($table, $column, $value, $exclude = null)
    {
        $sql = "SELECT COUNT(*) FROM  $table  WHERE  $column  =:value " . (($exclude != null) ? " AND " . $exclude : "");
        $recordCount = $this->db->query(
            $sql,
            [
                "value" => $value
            ]
        )->fetchColumn();
        return boolval($recordCount);
    }
    // public function searchsort(string $searchTerm = '', $fields, $table, $join = null, $exclude = null, $groupby = null, string $order_by = "id", string $direction = "desc")
    // {
    //     $param = [];
    //     $param = ["search" => "%{$searchTerm}%"];
    //     $sql = "SELECT $fields FROM $table " . (($join != null) ? $join : "") .
    //         (($exclude != null) ? $exclude : "") . (($groupby != null) ? $groupby : "") . " ORDER BY " . $order_by . " " . $direction;
    //     $searchsort = $this->db->query($sql, $param)->findAll();
    //     return boolval($searchsort);

    // }
}

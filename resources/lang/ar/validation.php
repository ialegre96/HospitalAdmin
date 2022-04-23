<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول attribute:.',
    'active_url'           => ':attribute  ليست عنوان URL صالحًا.',
    'after'                => 'يجب أن تكون attribute: تاريخ بعد date: .',
    'after_or_equal'       => 'يجب أن تكون attribute: تاريخًا أو يساوي date: .',
    'alpha'                => 'قد تحتوي attribute: على أحرف فقط.',
    'alpha_dash'           => 'قد تحتوي attribute: على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'قد تحتوي attribute: على أحرف وأرقام فقط.',
    'array'                => 'يجب أن تكون attribute صفيفًا.',
    'before'               => 'يجب أن تكون attribute: تاريخ قبل date: .',
    'before_or_equal'      => ' يجب أن تكون attribute: ة تاريخ قبل أو يساوي date: .',
    'between'              => [
        'numeric' => 'يجب أن تكون attribute: بين min: و max: .',
        'file'    => 'يجب أن تكون attribute: بين: min و max kilobytes: .',
        'string'  => 'يجب أن تكون attribute: بين min: و max: حروف .',
        'array'   => 'يجب أن تكون attribute: بين min: و max items: .',
    ],
    'boolean'              => 'يجب أن يكون حقل attribute true: أو false.',
    'confirmed'            => 'لا يتطابق تأكيد attribute:.',
    'date'                 => ':attribute ليس تاريخًا صالحًا.',
    'date_equals'          => ':يجب أن تكون attribute تاريخ يساوي: date.',
    'date_format'          => ':attribute لا تتوافق مع التنسيق: التنسيق.',
    'different'            => ' يجب أن تكون attribute: و أخرى مختلفة.',
    'digits'               => 'يجب أن تكون attribute: ضغط digits:.',
    'digits_between'       => 'يجب أن تكون attribute: بين min: و max digits: .',
    'dimensions'           => ':attribute لها أبعاد صورة غير صالحة.',
    'distinct'             => 'يحتوي حقل attribute: قيمة مكررة.',
    'email'                => 'يجب أن تكون attribute: عنوان بريد إلكتروني صالح.',
    'ends_with'            => 'يجب أن تنتهي attribute: بإحدى القيم values : القيم.',
    'exists'               => ':attribute المحددة غير صالحة.',
    'file'                 => 'يجب أن تكون attribute: ملفًا.',
    'filled'               => 'يجب أن يحتوي حقل attribute: على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون attribute: أكبر من  value: .',
        'file'    => 'يجب أن تكون attribute :greater: من القيمة بالكيلوبايت.',
        'string'  => 'يجب أن تكون attribute: أكبر من value: الأحرف.',
        'array'   => 'يجب أن تحتوي attribute: على عناصر أكثر من value:.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون attribute: أكبر من أو تساوي value:.',
        'file'    => 'يجب أن تكون attribute: أكبر من أو تساوي value: كيلو بايت.',
        'string'  => 'يجب أن تكون Attribute: أكبر من أو تساوي value: الشخصيات.',
        'array'   => 'يجب أن تحتوي attribute: على عناصر أو أكثر value: .',
    ],
    'image'                => 'يجب أن تكون attribute: صورة.',
    'in'                   => ':attribute المحددة غير صالحة.',
    'in_array'             => 'حقل attribute: غير موجود في other: .',
    'integer'              => 'يجب أن تكون attribute: عددًا صحيحًا.',
    'ip'                   => 'يجب أن تكون attribute: عنوان IP صالحًا.',
    'ipv4'                 => 'يجب أن تكون attribute: عنوان IPv4 صالحًا.',
    'ipv6'                 => 'يجب أن تكون attribute: عنوان IPv6 صالحًا.',
    'json'                 => 'يجب أن تكون attribute: سلسلة JSON صالحة.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون attribute: أقل من value:.',
        'file'    => 'يجب أن تكون attribute: أقل من value: بالكيلوبايت.',
        'string'  => 'يجب أن تكون attribute: أقل من أحرف value: .',
        'array'   => 'يجب أن تحتوي attribute: على عناصر أقل من value: .',
    ],
    'lte'                  => [
        'numeric' => ':attribute يجب أن تكون أقل من أو تساوي: value.',
        'file'    => 'يجب أن تكون attribute: أقل من أو تساوي value: بالكيلوبايت.',
        'string'  => 'يجب أن تكون attribute: أقل من أو تساوي أحرف value: .',
        'array'   => 'يجب ألا تحتوي attribute: على أكثر من عناصر value: .',
    ],
    'max'                  => [
        'numeric' => 'لا يجوز أن تكون attribute: أكبر من max: .',
        'file'    => 'قد لا تكون attribute: أكبر من كيلوبايت max: أقصى.',
        'string'  => ':لا يجوز أن تكون attribute أكبر من: max الأقصى لعدد الأحرف.',
        'array'   => 'لا يجوز أن تحتوي attribute: على أكثر من max: الأقصى للعناصر.',
    ],
    'mimes'                => 'يجب أن تكون attribute: ملفًا من النوع values: .',
    'mimetypes'            => 'يجب أن تكون attribute: ملفًا من النوع values: .',
    'min'                  => [
        'numeric' => 'يجب أن تكون attribute :min: على الأقل.',
        'file'    => 'يجب أن تكون attribute :min minobobes: على الأقل.',
        'string'  => 'يجب أن تكون attribute: الأقل min:  الأحرف.',
        'array'   => 'يجب أن تحتوي attribute: على الأقل عناصر min: .',
    ],
    'not_in'               => ':attribute المحددة غير صالحة.',
    'not_regex'            => 'تنسيق attribute: غير صالح.',
    'numeric'              => 'يجب أن تكون attribute: رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب أن يكون حقل attribute: موجودًا.',
    'regex'                => 'تنسيق attribute: غير صالح.',
    'required'             => 'حقل attribute: مطلوب.',
    'required_if'          => 'حقل attribute: مطلوب عندما يكون other: يكون value: .',
    'required_unless'      => 'حقل attribute: مطلوب إلا إذا كان other: يكون value: .',
    'required_with'        => 'حقل attribute: مطلوب عند وجود القيم.',
    'required_with_all'    => 'حقل attribute: مطلوب عندما values: موجودة.',
    'required_without'     => 'حقل attribute: مطلوب عندما values: غير موجودة.',
    'required_without_all' => 'حقل attribute: مطلوب عند عدم وجود أي من values: .',
    'same'                 => 'يجب أن تتطابق attribute: و other: .',
    'size'                 => [
        'numeric' => 'يجب أن تكون attribute: سيز size: .',
        'file'    => 'يجب أن تكون attribute: بالكيلوبايت size: .',
        'string'  => 'يجب أن تكون attribute: الأحرف: size: .',
        'array'   => 'يجب أن تحتوي attribute: على size: عناصر .',
    ],
    'starts_with'          => 'يجب أن تبدأ attribute: بإحدى القيم التالية values: .',
    'string'               => 'يجب أن تكون attribute: سلسلة.',
    'timezone'             => 'يجب أن تكون attribute: منطقة صالحة.',
    'unique'               => 'يجب أن تكون attribute: منطقة صالحة.',
    'uploaded'             => 'فشل attribute: في التحميل.',
    'url'                  => 'تنسيق attribute: غير صالح.',
    'uuid'                 => 'يجب أن تكون attribute UUID: صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],

        //doctor opd charge keys
        'doctor_id'      => [
            'unique' => 'تم أخذ اسم الطبيب بالفعل.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

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

    'accepted'             => ':attribute быть принят.',
    'active_url'           => ':attribute действительным URL.',
    'after'                => ':attribute должен быть датой после :date.',
    'after_or_equal'       => ':attribute должен быть датой после или равен :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должен быть массивом.',
    'before'               => ':attribute должен быть датой до :date.',
    'before_or_equal'      => ':attribute должен быть датой до или равен :date.',
    'between'              => [
        'numeric' => ':attribute должен быть между :min и :max.',
        'file'    => ':attribute должен быть между :min и :max килобайт.',
        'string'  => ':attribute должен быть между :min и :max символами.',
        'array'   => ':attribute должен иметь значения между :min и :max items.',
    ],
    'boolean'              => 'Поле :attribute должно быть истинным или ложным.',
    'confirmed'            => 'Подтверждение :attribute не совпадает.',
    'date'                 => ':attribute не является допустимой датой.',
    'date_equals'          => ':attribute должен быть датой, равной :date.',
    'date_format'          => ':attribute не соответствует формату: формат.',
    'different'            => ':attribute и :other должны быть разными.',
    'digits'               => ':attribute должен быть: цифры цифры.',
    'digits_between'       => ':attribute должен быть между :min и :max digits.',
    'dimensions'           => ':attribute имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute имеет повторяющееся значение.',
    'email'                => ':attribute должен быть действительным адресом электронной почты.',
    'ends_with'            => ':attribute должен заканчиваться одним из следующих: :value.',
    'exists'               => 'Выбранный :attribute недействителен.',
    'file'                 => ':attribute должен быть файлом.',
    'filled'               => 'Поле :attribute должно иметь значение..',
    'gt'                   => [
        'numeric' => ':attribute должен быть больше чем :value.',
        'file'    => ':attribute должен быть больше чем: :value в килобайтах.',
        'string'  => ':attribute должен быть больше чем: :value символов.',
        'array'   => ':attribute должен иметь больше чем: :value элементов.',
    ],
    'gte'                  => [
        'numeric' => ':attribute должен быть больше или равен :value.',
        'file'    => ':attribute должен быть больше или равен :value в килобайтах.',
        'string'  => ':attribute должен быть больше или равен :value value.',
        'array'   => ':attribute должен иметь: элементы :value или более.',
    ],
    'image'                => ':attribute:должен быть изображением..',
    'in'                   => ':attribute selected: недействителен.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => ':attribute должен быть целым числом.',
    'ip'                   => ':attribute должен быть действительным IP-адресом.',
    'ipv4'                 => ':attribute должен быть действительным адресом IPv4.',
    'ipv6'                 => ':attribute должен быть действительным адресом IPv6.',
    'json'                 => ':attribute должен быть допустимой строкой JSON..',
    'lt'                   => [
        'numeric' => ':attribute должен быть меньше чем :value.',
        'file'    => ':attribute должен быть меньше чем :value в килобайтах.',
        'string'  => ':attribute должен быть меньше чем :value символов.',
        'array'   => ':attribute должен содержать меньше :value.',
    ],
    'lte'                  => [
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'file'    => ':attribute должен быть меньше или равен :value в килобайтах.',
        'string'  => ':attribute должен быть меньше или равен :value.',
        'array'   => ':attribute не должен содержать больше, чем :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute не может быть больше, чем :max.',
        'file'    => ':attribute:не может быть больше, чем :max килобайт.',
        'string'  => ':attribute не может быть больше, чем :max символов.',
        'array'   => ':attribute может содержать не более :max элементов.',
    ],
    'mimes'                => ':attribute должен быть файлом типа: :values.',
    'mimetypes'            => ':attribute должен быть файлом типа: :values.',
    'min'                  => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file'    => ':attribute должен быть не менее :min килобайт.',
        'string'  => ':attribute должен содержать не менее :min символов.',
        'array'   => ':attribute должен содержать как :min items.',
    ],
    'not_in'               => ':attribute selected: недействителен.',
    'not_regex'            => 'Неверный формат :attribute.',
    'numeric'              => ':attribute должен быть числом.',
    'password'             => 'Пароль неверный.',
    'present'              => 'Поле: :attribute должно присутствовать.',
    'regex'                => 'Неверный формат :attribute.',
    'required'             => 'Поле: :attribute обязательное.',
    'required_if'          => 'Поле: :attribute обязательное, когда :other is :value.',
    'required_unless'      => 'Поле: :attribute обязательное, если :other не находится в :values.',
    'required_with'        => 'Поле: :attribute обязательное, если присутствует :values.',
    'required_with_all'    => 'Поле: :attribute обязательное, когда :values присутствуют.',
    'required_without'     => 'Поле: :attribute обязательное, если: :values отсутствуют.',
    'required_without_all' => 'Поле: :attribute обязательное, если нет ни одного из :values.',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должен быть: size.',
        'file'    => ':attribute должен иметь размер: килобайт.',
        'string'  => ':attribute должен быть: размер символов.',
        'array'   => ':attribute должен содержать: size items.',
    ],
    'starts_with'          => ':attribute должен начинаться с одного из следующих :values.',
    'string'               => ':attribute должен быть строкой.',
    'timezone'             => ':attribute должен быть допустимой зоной.',
    'unique'               => ':attribute уже занят.',
    'uploaded'             => 'Не удалось загрузить :attribute.',
    'url'                  => 'Неверный формат :attribute.',
    'uuid'                 => ':attribute должен быть действительным UUID.',

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
            'rule-name' => 'custom-message',
        ],

        //doctor opd charge keys
        'doctor_id'      => [
            'unique' => 'Имя доктора уже занято.',
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

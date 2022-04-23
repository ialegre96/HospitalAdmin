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

    'accepted'             => ':attribute kabul edilmelidir.',
    'active_url'           => ':attribute geçerli bir URL değil.',
    'after'                => ':attribute, tarihinden sonraki bir tarih olmalıdır :date.',
    'after_or_equal'       => ':attribute , tarihten sonraki tarih veya ona eşit bir olmalıdır :tarih .',
    'alpha'                => ':attribute yalnızca harf içerebilir.',
    'alpha_dash'           => ':attribute yalnızca harf, rakam, tire ve alt çizgi içerebilir.',
    'alpha_num'            => ':attribute yalnızca harf ve rakam içerebilir.',
    'array'                => ':attribute bir dizi olmalıdır.',
    'before'               => ':attribute önce bir olmalıdır :date .',
    'before_or_equal'      => ':attribute önce veya ona eşit bir olmalıdır :date .',
    'between'              => [
        'numeric' => ':attribute:min ve:max arasında olmalıdır.',
        'file'    => ':attribute:min ve:max kilobayt arasında olmalıdır.',
        'string'  => ':attribute:min ve:max karakter arasında olmalıdır.',
        'array'   => ':attribute:min ve:max öğeler arasında olmalıdır.',
    ],
    'boolean'              => ':attribute alanı doğru veya yanlış olmalıdır.',
    'confirmed'            => ':attribute onayı eşleşmiyor.',
    'date'                 => ':attribute geçerli bir tarih değil.',
    'date_equals'          => ':attribute, eşit bir olmalıdır:tarih .',
    'date_format'          => ':attribute eşleşmiyor biçim:format.',
    'different'            => ':attribute ve:other farklı olmalıdır.',
    'digits'               => ':attribute şu olmalıdır:digits basamak.',
    'digits_between'       => ':attribute:min ve:max basamak arasında olmalıdır.',
    'dimensions'           => ':attribute resim boyutları geçersiz.',
    'distinct'             => ':attribute alanı yinelenen bir değere sahip.',
    'email'                => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with'            => ':attribute aşağıdakilerden biriyle bitmelidir:values.',
    'exists'               => 'Seçilen:attribute geçersiz.',
    'file'                 => ':attribute bir dosya olmalıdır.',
    'filled'               => ':attribute alanının bir değeri olmalıdır.',
    'gt'                   => [
        'numeric' => ':attribute değerinden büyük :value.',
        'file'    => ':attribute şu değerden büyük olmalıdır:value kilobayt.',
        'string'  => 'attribute birden fazla :value değerine sahip olmalıdır.',
        'array'   => ':attribute birden fazla :değerine sahip olmalıdır.',
    ],
    'gte'                  => [
        'numeric' => ':attribute: değerinden büyük veya eşit olmalıdır :value.',
        'file'    => ':attribute büyük veya eşit olmalıdır:value kilobayt.',
        'string'  => ':attribute, :değer karakterlerinden büyük veya eşit olmalıdır.',
        'array'   => ':attribute şunlar olmalıdır:value öğeleri veya daha fazlası.',
    ],
    'image'                => ':attribute bir resim olmalıdır.',
    'in'                   => 'Seçilen:attribute geçersiz.',
    'in_array'             => ':attribute alanı:other lerinde :bulunmaz.',
    'integer'              => ':attribute bir tamsayı olmalıdır.',
    'ip'                   => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4'                 => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6'                 => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json'                 => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'lt'                   => [
        'numeric' => ':attribute küçük olmalıdır :value.',
        'file'    => ':attribute den küçük olmalıdır:value kilobayt.',
        'string'  => ':attribute inden küçük olmalıdır:value karakterleri.',
        'array'   => ':attribute :value den az olmalıdır.',
    ],
    'lte'                  => [
        'numeric' => ':attribute:value inden küçük veya eşit olmalıdır.',
        'file'    => ':attribute eşit veya daha küçük olmalıdır:value kilobayt.',
        'string'  => ':attribute, :value karakterlerinden küçük veya eşit olmalıdır.',
        'array'   => ':attribute birden fazla :value değerine sahip olmamalıdır.',
    ],
    'max'                  => [
        'numeric' => ':attribute şu değerden büyük olamaz:max.',
        'file'    => ':attribute en fazla:max kilobayt ola   maz.',
        'string'  => ':attribute en fazla: max karakter olabilir.',
        'array'   => ':attribute en fazla :max öğe içeremez.',
    ],
    'mimes'                => ':attribute şu türden bir dosya olmalıdır::values.',
    'mimetypes'            => ':attribute şu türden bir dosya olmalıdır::values.',
    'min'                  => [
        'numeric' => ':attribute en az: min olmalıdır.',
        'file'    => ':attribute en az: min kilobayt olmalıdır.',
        'string'  => ':attribute en az: min karakter olmalıdır.',
        'array'   => ':attribute en az: min öğe olmalıdır.',
    ],
    'not_in'               => 'Seçilen:attribute geçersiz.',
    'not_regex'            => ':attribute biçimi geçersiz.',
    'numeric'              => ':attribute bir sayı olmalıdır.',
    'password'             => 'Şifre yanlış.',
    'present'              => ':attribute alanı mevcut olmalıdır.',
    'regex'                => ':attribute biçimi geçersiz.',
    'required'             => ':attribute alanı zorunludur.',
    'required_if'          => ':attribute alanı şu durumlarda gereklidir:other is:value.',
    'required_unless'      => ':attribute: değerleri olmadığı sürece: :other is:value.',
    'required_with'        => ':attribute alanı aşağıdaki durumlarda gereklidir :values mevcut.',
    'required_with_all'    => ':attribute alanı aşağıdaki durumlarda gereklidir :values mevcut.',
    'required_without'     => ':attribute alanı aşağıdaki durumlarda gereklidir :values mevcut olmayan.',
    'required_without_all' => ':attribute alanı, :values lerin hiçbiri olmadığında zorunludur.',
    'same'                 => ':attribute ve:other leriyle eşleşmelidir.',
    'size'                 => [
        'numeric' => ':attribute: size olmalıdır.',
        'file'    => ':attribute size olmalıdır:size kilobayt.',
        'string'  => ':attribute:size karakterleri olmalıdır.',
        'array'   => ':attribute şunları içermelidir:size öğeleri.',
    ],
    'starts_with'          => ':attribute aşağıdakilerden biriyle başlamalıdır::values.',
    'string'               => ':attribute bir dize olmalıdır.',
    'timezone'             => ':attribute geçerli bir bölge olmalıdır.',
    'unique'               => ':attribute zaten alınmış.',
    'uploaded'             => ':attribute yüklenemedi.',
    'url'                  => ':attribute biçimi geçersiz.',
    'uuid'                 => ':attribute geçerli bir UUID olmalıdır.',

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
            'rule-name' => 'özel mesaj',
        ],

        //doctor opd charge keys
        'doctor_id'      => [
            'unique' => 'Doktorun adı zaten alınmış.',
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

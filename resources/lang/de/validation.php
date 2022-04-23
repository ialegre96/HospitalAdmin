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

    'accepted'             => 'Das :attribute muss akzeptiert werden.',
    'active_url'           => 'Das :attribute ist keine gültige URL.',
    'after'                => 'Das :attribute muss ein Datum nach :date sein.',
    'after_or_equal'       => 'Das :attribute muss ein Datum nach oder gleich :date sein.',
    'alpha'                => 'Das :attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => 'Das :attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num'            => 'Das :attribute darf nur Buchstaben und Zahlen enthalten.',
    'array'                => 'Das :attribute muss ein Array sein.',
    'before'               => 'Das :attribute muss ein Datum vor :date sein.',
    'before_or_equal'      => 'Das :attribute muss ein Datum vor oder gleich :date sein.',
    'between'              => [
        'numeric' => 'Das :attribute muss zwischen :min und :max.',
        'file'    => 'Das :attribute muss zwischen :min und :max Kilobyte.',
        'string'  => 'Das :attribute muss zwischen den Zeichen :min und :max.',
        'array'   => 'Das :attribute muss zwischen :min und :max Elementen.',
    ],
    'boolean'              => 'Das :attribute muss wahr oder falsch sein.',
    'confirmed'            => 'Die Bestätigung des :attribute stimmt nicht überein.',
    'date'                 => 'Das :attribute ist kein gültiges Datum.',
    'date_equals'          => 'Das :attribute muss ein Datum sein, das gleich :date ist.',
    'date_format'          => 'Das :attribute stimmt nicht mit dem Format :format überein.',
    'different'            => 'Das :attribute und :other muss unterschiedlich sein.',
    'digits'               => 'Das :attribute muss sein: digits Ziffern.',
    'digits_between'       => 'Das :attribute muss zwischen den Ziffern :min und :max liegen.',
    'dimensions'           => 'Das :attribute hat ungültige Bildabmessungen.',
    'distinct'             => 'Das :attribute hat einen doppelten Wert.',
    'email'                => 'Das :attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with'            => 'Das :attribute muss mit einem der folgenden Werte enden :values.',
    'exists'               => 'Das :attribute selected ist ungültig.',
    'file'                 => 'Das :attribute muss eine Datei sein.',
    'filled'               => 'Das :attribute muss einen Wert haben.',
    'gt'                   => [
        'numeric' => 'Das :attribute muss größer als: value sein.',
        'file'    => 'Das :attribute muss größer sein als :value Kilobyte.',
        'string'  => 'Das :attribute muss größer sein als :value Zeichen.',
        'array'   => 'Das :attribute muss mehr als :value-Elemente enthalten.',
    ],
    'gte'                  => [
        'numeric' => 'Das :attribute muss größer oder gleich :value sein.',
        'file'    => 'Das :attribute muss größer oder gleich :value Kilobyte sein.',
        'string'  => 'Das :attribute muss größer oder gleich :value zeichen sein.',
        'array'   => 'Das :attribute muss mindestens :value-Elemente enthalten.',
    ],
    'image'                => 'Das :attribute muss ein Bild sein.',
    'in'                   => 'Das :attribute selected ist ungültig.',
    'in_array'             => 'Das :attribute existiert nicht in :other.',
    'integer'              => 'Das :attribute muss eine Ganzzahl sein.',
    'ip'                   => 'Das :attribute muss eine gültige IP-Adresse sein.',
    'ipv4'                 => 'Das :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6'                 => 'Das :attribute muss eine gültige IPv6-Adresse sein.',
    'json'                 => 'Das :attribute muss eine gültige JSON-Zeichenfolge sein.',
    'lt'                   => [
        'numeric' => 'Das :attribute muss kleiner als :value sein.',
        'file'    => 'Das :attribute muss kleiner als :value Kilobyte sein.',
        'string'  => 'Das :attribute muss kleiner als :value sein.',
        'array'   => 'Das :attribute muss weniger als :value-Elemente enthalten.',
    ],
    'lte'                  => [
        'numeric' => 'Das :attribute muss kleiner oder gleich :value sein.',
        'file'    => 'Das :attribute muss kleiner oder gleich :value Kilobyte sein.',
        'string'  => 'Das :attribute muss kleiner oder gleich :value zeichen sein.',
        'array'   => 'Das :attribute darf nicht mehr als :value-Elemente enthalten.',
    ],
    'max'                  => [
        'numeric' => 'Das :attribute darf nicht größer sein als :max.',
        'file'    => 'Das :attribute darf nicht größer als :max Kilobyte sein.',
        'string'  => 'Das :attribute darf nicht größer als :max Zeichen sein.',
        'array'   => 'Das :attribute darf nicht mehr als :max Elemente enthalten.',
    ],
    'mimes'                => 'Das :attribute muss eine Datei vom Typ :values sein.',
    'mimetypes'            => 'Das :attribute muss eine Datei vom Typ :values sein.',
    'min'                  => [
        'numeric' => 'Das :attribute muss mindestens :min sein.',
        'file'    => 'Das :attribute muss mindestens :min Kilobyte betragen.',
        'string'  => 'Das :attribute muss mindestens :min Zeichen enthalten.',
        'array'   => 'Das :attribute muss mindestens :min Elemente enthalten.',
    ],
    'not_in'               => 'Das :attribute selected ist ungültig.',
    'not_regex'            => 'Das :attribute ist ungültig.',
    'numeric'              => 'Das :attribute muss eine Zahl sein.',
    'password'             => 'Das Passwort ist inkorrekt.',
    'present'              => 'Das :attribute muss vorhanden sein.',
    'regex'                => 'Das :attribute ist ungültig.',
    'required'             => 'Das Feld :attribute ist erforderlich.',
    'required_if'          => 'Das Feld :attribute ist erforderlich, wenn :other :value ist.',
    'required_unless'      => 'Das :attribute ist erforderlich, es sei denn :other befindet sich in :values.',
    'required_with'        => 'Das :attribute ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all'    => 'Das :attribute ist erforderlich, wenn :value vorhanden sind.',
    'required_without'     => 'Das Feld :attribute ist erforderlich, wenn :value nicht vorhanden sind.',
    'required_without_all' => 'Das Feld :attribute ist erforderlich, wenn keiner der :value vorhanden ist.',
    'same'                 => 'Das :attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => 'Das :attribute muss: size sein.',
        'file'    => 'Das :attribute muss: size Kilobyte sein.',
        'string'  => 'Das :attribute muss Zeichen der: size sein.',
        'array'   => 'Das :attribute muss Elemente der: size enthalten.',
    ],
    'starts_with'          => 'Das :attribute muss mit einem der folgenden Werte beginnen :value.',
    'string'               => 'Das :attribute muss eine Zeichenfolge sein.',
    'timezone'             => 'Das :attribute muss eine gültige Zone sein.',
    'unique'               => 'Das :attribute wurde bereits übernommen.',
    'uploaded'             => 'Das :attribute konnte nicht hochgeladen werden.',
    'url'                  => 'Das :attribute ist ungültig.',
    'uuid'                 => 'Das :attribute muss eine gültige UUID sein.',

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
            'rule-name' => 'benutzerdefinierte Nachricht',
        ],

        //doctor opd charge keys
        'doctor_id'      => [
            'unique' => 'Der Name des Arztes wurde bereits vergeben.',
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

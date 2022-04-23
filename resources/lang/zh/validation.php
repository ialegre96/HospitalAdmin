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

    'accepted'             => '：attribute必须被接受。',
    'active_url'           => '：attribute不是有效的URL。',
    'after'                => '：attribute必须是：date之后的日期。',
    'after_or_equal'       => '：attribute必须是等于或小于：date的日期。',
    'alpha'                => '：attribute只能包含字母。',
    'alpha_dash'           => '：attribute只能包含字母，数字，破折号和下划线。',
    'alpha_num'            => '：attribute只能包含字母和数字。',
    'array'                => '：attribute必须是一个数组。',
    'before'               => '：attribute必须是：date之前的日期。',
    'before_or_equal'      => '：attribute必须是：date之前或等于的日期。',
    'between'              => [
        'numeric' => '：attribute必须介于：min和：max之间。',
        'file'    => '：attribute必须介于：min和：max千字节之间。',
        'string'  => '：attribute必须介于：min和：max之间。',
        'array'   => '：attribute必须在：min和：max之间。',
    ],
    'boolean'              => '：attribute字段必须为true或false。',
    'confirmed'            => '：attribute确认不匹配。',
    'date'                 => '：attribute不是有效日期。',
    'date_equals'          => '：attribute必须是等于：date的日期。',
    'date_format'          => '：attribute与格式：format不匹配。',
    'different'            => '：attribute和：other必须不同。',
    'digits'               => '：attribute必须为：digits位数。',
    'digits_between'       => '：attribute必须介于：min和：max数字之间。',
    'dimensions'           => '：attribute的图片尺寸无效。',
    'distinct'             => '：attribute字段具有重复值。',
    'email'                => '：attribute必须是有效的电子邮件地址。',
    'ends_with'            => '：attribute必须以下列之一结尾：: values。',
    'exists'               => '所选的：attribute无效。',
    'file'                 => '：attribute必须是一个文件。',
    'filled'               => '：attribute字段必须有一个值。',
    'gt'                   => [
        'numeric' => '：attribute必须大于：value。',
        'file'    => '：attribute必须大于：value千字节。',
        'string'  => '：attribute必须大于：value字符。',
        'array'   => '：attribute必须包含多个：value项目。',
    ],
    'gte'                  => [
        'numeric' => '：attribute必须大于或等于：value。',
        'file'    => '：attribute必须大于或等于：value千字节。',
        'string'  => '：attribute必须大于或等于：value字符。',
        'array'   => '：attribute必须具有：value项或更多。',
    ],
    'image'                => '：attribute必须是图像。',
    'in'                   => '所选的：attribute无效。',
    'in_array'             => '：attribute字段在：other中不存在。',
    'integer'              => '：attribute必须为整数。',
    'ip'                   => '：attribute必须是有效的IP地址。',
    'ipv4'                 => '：attribute必须是有效的IPv4地址。',
    'ipv6'                 => '：attribute必须是有效的IPv6地址。',
    'json'                 => '：attribute必须是有效的JSON字符串。',
    'lt'                   => [
        'numeric' => '：attribute必须小于：value。',
        'file'    => '：attribute必须小于：value千字节。',
        'string'  => '：attribute必须小于：value字符。',
        'array'   => '：attribute必须少于：value个项目。',
    ],
    'lte'                  => [
        'numeric' => '：attribute必须小于或等于：value。',
        'file'    => '：attribute必须小于或等于：value千字节。',
        'string'  => '：attribute必须小于或等于：value字符。',
        'array'   => '：attribute不得超过：value个项目。',
    ],
    'max'                  => [
        'numeric' => '：attribute不得大于：max。',
        'file'    => '：attribute不得大于：max千字节。',
        'string'  => '：attribute不得大于：max个字符。',
        'array'   => '：attribute不能超过：max个项目。',
    ],
    'mimes'                => '：attribute必须是类型：：values的文件。',
    'mimetypes'            => '：attribute必须是类型：：values的文件。',
    'min'                  => [
        'numeric' => '：attribute必须至少为：min。',
        'file'    => '：attribute必须至少为：min千字节。',
        'string'  => '：attribute必须至少为：min个字符。',
        'array'   => '：attribute必须至少包含：min个项目。',
    ],
    'not_in'               => '所选的：attribute无效。',
    'not_regex'            => '所选的：attribute无效。',
    'numeric'              => '：attribute必须为数字。',
    'password'             => '密码错误。',
    'present'              => '：attribute字段必须存在。',
    'regex'                => '：attribute格式无效。',
    'required'             => '：attribute字段是必填字段。',
    'required_if'          => '当：other是：value时，：attribute字段是必需的。',
    'required_unless'      => '除非：other位于：values中，否则：attribute字段是必填字段。',
    'required_with'        => '如果存在：values，则：attribute字段是必需的。',
    'required_with_all'    => '存在：values时，：attribute字段是必需的。',
    'required_without'     => '当：values不存在时，：attribute字段是必需的。',
    'required_without_all' => '当：values不存在时，：attribute字段是必需的。',
    'same'                 => '：attribute和：other必须匹配。',
    'size'                 => [
        'numeric' => '：attribute必须为：size。',
        'file'    => '：attribute必须为：size千字节。',
        'string'  => '：attribute必须为：size字符。',
        'array'   => '：attribute必须包含：size项。',
    ],
    'starts_with'          => '：attribute必须以下列之一开头：：values。',
    'string'               => '：attribute必须为字符串。',
    'timezone'             => '：attribute必须是有效区域。',
    'unique'               => '：attribute已经被使用。',
    'uploaded'             => '：attribute上传失败。',
    'url'                  => '：attribute格式无效。',
    'uuid'                 => '：attribute必须是有效的UUID。',

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
            'rule-name' => '自定义消息',
        ],

        //doctor opd charge keys
        'doctor_id'      => [
            'unique' => '医生的名字已经被使用。',
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

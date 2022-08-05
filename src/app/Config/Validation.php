<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\CustomRules;


class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------


    public $account = [
        'name' => [
            'label'  => '名前',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ],
        'email' => [
            'label'  => 'メールアドレス',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ],
        'password' => [
            'label'  => 'パスワード',
            'rules'  => 'trim|required|min_length[8]|passwordPolicy',
            'errors' => [
                'required'       => '{field}を入力してください',
                'min_length'     => '{field}は {param}文字以上を入力してください',
                'passwordPolicy' => '{field}英大文字・英小文字・数字・記号をそれぞれ１文字以上使用してください'
            ]
        ],
        'role' => [
            'label'  => '権限',
            'rules'  => 'trim|required|',
                'errors'   => [
                'required' => '{field}を入力してください'
            ]
        ]
    ];

    public $editAccount = [
        'name' => [
            'label'  => '名前',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ],
        'email' => [
            'label'  => 'メールアドレス',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ]
    ];

    public $editPassword = [
        'name' => [
            'label'  => '名前',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ],
        'email' => [
            'label'  => 'メールアドレス',
            'rules'  => 'trim|required|max_length[128]',
            'errors' => [
                'required'   => '{field}を入力してください'
            ]
        ],
        'password' => [
            'label'  => 'パスワード',
            'rules'  => 'trim|required|min_length[8]|passwordPolicy',
            'errors' => [
                'required'       => '{field}を入力してください',
                'min_length'     => '{field}は {param}文字以上を入力してください',
                'passwordPolicy' => '{field}英大文字・英小文字・数字・記号をそれぞれ１文字以上使用してください'
            ]
        ]
    ];

    public $loginCheck = [
        'email' => [
			'label'  => 'メールアドレス',
			'rules'  => 'trim|required',
			'errors' => [
				'required' => '{field} を入力してください'
			]
        ],
        'password' => [
            'label'  => 'パスワード',
            'rules'  => 'trim|required',
            'errors' => [
                'required'       => '{field}を入力してください'
                ]
        ]
	];

    public $questionCreate = [
        'title' => [
			'label'  => '質問タイトル',
			'rules'  => 'trim|required|max_length[128]',
			'errors' => [
				'required'   => '{field}を入力してください',
                'max_length' => '{field}は{param}文字以内で入力してください'
			]
        ],
        'text' => [
            'label'  => '質問内容',
            'rules'  => 'trim|required',
            'errors' => [
                'required'  => '{field}を入力してください'
                ]
        ]
	];

    public $answerCreate = [
        'text' => [
            'label'  => '回答内容',
            'rules'  => 'trim|required',
            'errors' => [
                'required'  => '{field}を入力してください'
                ]
        ]
	];
}

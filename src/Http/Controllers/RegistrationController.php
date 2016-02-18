<? namespace JetCMS\User\Http\Controllers;

use App;
use SEO;
use Sentinel;
use Validator;
use Request;
use Reminder;

use App\Http\Controllers\Controller;

class RegistrationController extends  Controller
{
    protected $validator = null;
    protected $redirect = null;
    protected $template = 'jetcms.user::tpl.registration';

    public function __construct(){
        if (!$this->redirect) {
            $this->redirect = config('jetcms.user::redirect.registration','/');
        }
    }

    Public function getLogin(){

        SEO::setTitle('Регистрация');
        SEO::setDescription('Регистрация на сайте');

        $this->validator = Validator::make([],[]);

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{
            $input = $this->getValue();
            return view($this->template,compact('input'));
        }
    }

    Public function postLogin(){

        SEO::setTitle('Регистрация');
        SEO::setDescription('Регистрация на сайте');

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{

            $this->validator = $this->getValidator();

            $this->validator->after(function($validator)
            {
                $credentials = [
                    'email' => Request::get('email'),
                ];

                if ($user = Sentinel::findByCredentials($credentials))
                {
                    $validator->errors()->add('email', 'Такой пользователь уже существует');
                }
            });

            if (!$this->validator->fails()) {
                $credentials = $this->getCredentials();

                if ($user = Sentinel::registerAndActivate($credentials)) {
                    Sentinel::login($user);
                    return redirect($this->redirect);
                }
            }
            $input = $this->getValue();
            return view($this->template,compact('input'));
        }
    }

    protected function getValidator(){
        return Validator::make(
            Request::all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'required' => 'требутся заполнить',
                'email' => 'не верный формат почты',
            ]
        );
    }
    protected function getCredentials(){
        return [
            'email' => Request::get('email'),
            'password' => Request::get('password'),
        ];
    }


    protected function getValue(){

        return [
            'email' => [
                'value' => old('email',Request::get('email',null)),
                'error' => $this->validator->messages()->first('email')
            ],
            'password' => [
                'value' => old('password',Request::get('password',null)),
                'error' => $this->validator->messages()->first('password')
            ]
        ];

    }
}
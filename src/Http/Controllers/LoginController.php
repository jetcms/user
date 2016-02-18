<? namespace JetCMS\User\Http\Controllers;

use App;
use SEO;
use Sentinel;
use Validator;
use Request;
use Reminder;

use App\Http\Controllers\Controller;

class LoginController extends  Controller
{
    protected $validator = null;
    protected $redirect = null;
    protected $template = 'jetcms.user::tpl.login';

    public function __construct(){
        if (!$this->redirect) {
            $this->redirect = config('jetcms.user::redirect','/');
        }
    }

    Public function getLogin(){

        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        $this->validator = Validator::make([],[]);

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{
            $input = $this->getValue();
            return view($this->template,$input);
        }
    }

    Public function postLogin(){

        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{

            $this->validator = $this->getValidator();

            if (!$this->validator->fails()) {
                $credentials = $this->getCredentials();

                if ($user = Sentinel::authenticate($credentials)) {

                    /*
                    if (Request::get('remembor',false)){

                    }
                    */

                    return redirect($this->redirect);
                }
            }

            $input = $this->getValue();
            return view($this->template,$input);
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
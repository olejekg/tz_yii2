<?php

namespace app\controllers;

use app\models\Countries;
use app\models\EditAddress;
use app\models\EditUser;
use app\models\TestAddress;
use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AddUser;
use app\models\Users;
use app\models\Addresses;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUserlist() {
        $users = Users::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $users->count()
        ]);
        $users = $users->offset($pagination->offset)
            ->limit($pagination->limit)->all();
        return $this->render('userlist', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }


    public function actionUseradd ()
    {
        $addUser = new AddUser();
        if ($addUser->load(Yii::$app->request->post()) && $addUser->validate()) {
            // данные нового пользователя:
            $login = Html::encode($addUser->login);
            $password = Html::encode($addUser->password);
            $first_name = Html::encode($addUser->first_name);
            $last_name = Html::encode($addUser->last_name);
            $sex = Html::encode($addUser->sex);
            $email = Html::encode($addUser->email);
            // так же данные адреса:
            $post_index = Html::encode($addUser->post_index);
            $country = Html::encode($addUser->country);
            $city = Html::encode($addUser->city);
            $street = Html::encode($addUser->street);
            $house_number = Html::encode($addUser->house_number);
            $apartmant_office = Html::encode($addUser->apartmant_office);
            $can_user_create = true;
        } else {
            $login = $password = $first_name = $last_name = $sex = $email = '';
            $post_index = $country = $city = $street = $house_number = $apartmant_office = '';
            $can_user_create = false;
        }
        $user_data = [
            'login' => $login,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'sex' => $sex,
            'email' => $email,
        ];
        $address_data = [
            'post_index' => $post_index,
            'country' => $country,
            'city' => $city,
            'street' => $street,
            'house_number' => $house_number,
            'apartmant_office' => $apartmant_office,
            'users_id' => null
        ];
        if ($can_user_create) {
            $new_user = $this->createUser($user_data);
            $create_user_errors = $new_user['errors'];
            if (!$create_user_errors) {
                $address_data['users_id'] = $new_user['users_id'];
                $new_address = $this->addAddressToUser($address_data);
            }
        }
        $countries = $this->getCountries();
        return $this->render('adduser', array_merge(
            ['addUser' => $addUser, 'create_user_errors'=>$create_user_errors, 'new_address'=>$new_address,
                'countries'=>$countries], $user_data, $address_data));
    }

    public function actionActions() {
        $del_obj = (isset($_POST['del_obj'])) ? $_POST['del_obj'] : null ;
        $id = (isset($_POST['id'])) ? $_POST['id'] : null ;
        if ($del_obj=='address') {
            $result = $this->deleteAddress($id);
        }
        elseif ($del_obj=='user') {
            $result = $this->deleteUser($id);
            //$result=null;
        }
        $response = ($result)?(array)$result:null;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('actions', compact('response'));
    }

    public function actionUser () {
        /** $user - данные о пользователе из базы данных
         *  $editUser - данные о пользователе в полях ввода формы
         *  $can_user_update - отправлялась ли форма
         *  $is_user_change - совпадают ли данные пользователя в полях формы с данными из базы, если в форме не менял то совпадают
         */
        $id = Yii::$app->request->get("id", "uknown user");
        $editUser = new EditUser();
        $user = Users::findOne($id);
        if ($editUser->load(Yii::$app->request->post()) && $editUser->validate()) {
            // обновленные данные пользователя:
            $login = Html::encode($editUser->login);
            $password = Html::encode($editUser->password);
            $first_name = Html::encode($editUser->first_name);
            $last_name = Html::encode($editUser->last_name);
            $sex = Html::encode($editUser->sex);
            $email = Html::encode($editUser->email);
            $can_user_update = true;
        } else {
            $login = $password = $first_name = $last_name = $sex = $email = '';
            $can_user_update = false;
        }
        $edit_user = [
            'login' => $login,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'sex' => $sex,
            'email' => $email,
        ];
        $is_user_change = !(($user->login == $edit_user['login']) && ($user->password == $edit_user['password']) &&
            ($user->first_name == $edit_user['first_name']) && ($user->last_name == $edit_user['last_name']) &&
            ($user->sex == $edit_user['sex']) && ($user->email == $edit_user['email']));
        if ($can_user_update && $is_user_change) {
            $update_user_result=$this->updateUser($id,$edit_user);
        } else $update_user_result = null;


        /** Для добавления нового адреса юзеру
         *  используем ту же форму, которая служит для добавления нового юзера с адресом
         */
        $addUser = new AddUser();
        if ($addUser->load(Yii::$app->request->post()) && $addUser->validate()) {
            $post_index = Html::encode($addUser->post_index);
            $country = Html::encode($addUser->country);
            $city = Html::encode($addUser->city);
            $street = Html::encode($addUser->street);
            $house_number = Html::encode($addUser->house_number);
            $apartmant_office = Html::encode($addUser->apartmant_office);
            $can_address_add = true;
        } else {
            $post_index = $country = $city = $street = $house_number = $apartmant_office = '';
            $can_address_add = false;
        }
        $new_address_data = [
            'post_index' => $post_index,
            'country' => $country,
            'city' => $city,
            'street' => $street,
            'house_number' => $house_number,
            'apartmant_office' => (strlen($apartmant_office))?$apartmant_office:null,
            'users_id' => $id
        ];
        if ($can_address_add) {
            $same_address = Addresses::findOne($new_address_data);
            if (null===$same_address) {
                $new_address = $this->addAddressToUser($new_address_data);
            }
            //Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());
        }

        /**
         * Одна форма для всех адресов. Используем табличный ввод
         * $addresses - адреса пользователя из базы
         * $edit_address - адреса пользователя, переданные из формы
         */
        $addresses = Addresses::find()->where(['users_id' => $id]);
        $total_addresses_count = $addresses->count();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $total_addresses_count
        ]);
        $addresses = $addresses->offset($pagination->offset)->limit($pagination->limit)->all();
        $editAddress = new EditAddress();
        $edit_address = [];
        $modelArray = [];
        $count_addresses = count($addresses);
        for ($i=0;$i<$count_addresses;$i++) {
            $modelArray[] = new EditAddress;
        }
        $update_address_result=null;
        $is_address_change = [];
        if ($editAddress->loadMultiple($modelArray, Yii::$app->request->post()) && $editAddress->validateMultiple($modelArray)) {
            for ($i=0;$i<$count_addresses;$i++) {
                $ea = (array)$modelArray[$i];
                $is_address_change[$i] = !(($addresses[$i]['post_index'] == $ea['post_index']) &&
                    ($addresses[$i]['country'] == $ea['country']) && ($addresses[$i]['city'] == $ea['city']) &&
                    ($addresses[$i]['street'] == $ea['street']) && ($addresses[$i]['house_number'] == $ea['house_number']) &&
                    ($addresses[$i]['apartmant_office'] == $ea['apartmant_office']) &&
                    ($addresses[$i]['users_id'] == $id));
                $edit_address[$i] = [
                    'id'=>$addresses[$i]['id'],
                    'post_index' => $ea['post_index'],
                    'country' => $ea['country'],
                    'city' => $ea['city'],
                    'street' => $ea['street'],
                    'house_number' => $ea['house_number'],
                    'apartmant_office' => $ea['apartmant_office'],
                    'users_id' => $id
                ];
            }
            $update_address_result = $this->updateAddress($edit_address,$is_address_change);
        }
        $countries = $this->getCountries();





        return $this->render('user', [
            'id' => $id,
            'user' => $user,
            'addresses' => $addresses,
            'pagination' => $pagination,
            'total_addresses_count' => (int)$total_addresses_count,
            'editUser' => $editUser,
            'editAddress' => $editAddress,
            'edit_user' => $edit_user,
            'update_user_result' => $update_user_result,
            'edit_address' => $edit_address,
            'update_address_result' => $update_address_result,
            'countries' => $countries,
            'is_address_change' => $is_address_change,
            'addUser' => $addUser,
            'new_address_data' => $new_address_data,
            'new_address' => $new_address,
            'same_address' => $same_address
        ]);
    }

    protected function updateAddress($address_data, $update_rows) {
        $c = count($address_data);
        $errors = [];
        $result = true;
        $updated = $notupdated = 0;
        for ($i=0;$i<$c;$i++) {
            if ($update_rows[$i]) {
                $address = Addresses::findOne($address_data[$i]['id']);
                $address->attributes = $address_data[$i];
                $address->save();
                $errors[$i] = $address->errors;
                $updated++;
            } else $errors[$i] = [];
            if ($errors[$i]) {
                $notupdated++;
                $updated--;
                $result = false;
            }
        }
        return ['errors'=>$errors, 'result' => $result, 'updated' => $updated, 'notupdated' =>$notupdated];
    }

    protected function updateUser($id, $user_data) {
        $user = Users::findOne($id);
        $user->attributes = $user_data;
        $user->save();
        $errors = $user->errors;
        $result = ($errors == []) ? true : false;
        return ['errors'=>$errors, 'result' => $result];
    }

    protected function createUser($user_data) {
        $new_user = new Users();
        $new_user->attributes = $user_data;
        $new_user->save();
        $errors=$new_user->errors;
        $users_id = ($errors) ? null : $new_user->id;
        return [
            'errors' => $errors,
            'users_id' => $users_id
        ];
    }

    protected function addAddressToUser($address_data) {
        if ($address_data['users_id']) {
            $new_address = new Addresses();
            $new_address->attributes = $address_data;
            $new_address->save();
            $errors = $new_address->errors;
            $address_id = ($errors) ? null : $new_address->id;
        } else {
            $address_id = null;
            $errors = ['users_id'=>[
                "users_id не указан при создании адреса."
            ]];
        }
        return [
            'errors' => $errors,
            'address_id' => $address_id
        ];
    }

    protected function deleteAddress($address_id) {
        $del_address = Addresses::findOne($address_id);
        if ($del_address) {
            $del_address->delete();
            if ($del_address->errors) {
                $r=false;
        } else $r=true;
        $result = ['result'=>false, 'errors'=>$del_address->errors];
        } else $result = ['result'=>false, 'errors'=>['user not found']];
        return $result;
    }

    protected function deleteUser($user_id) {
        /** Сначала удаляем все адреса пользователя, т.к. это связи и лишняя инфа в базе
         *  Потом валим самого юзера
         */
        $del_addresses = Addresses::deleteAll(['users_id'=>$user_id]);
        //if ($del_addresses)
        $del_user = Users::findOne($user_id);
        $del_user->delete();
        return ['addresses_deleted'=>$del_addresses, 'user_deleted'=>['errors'=>$del_user->errors]];
    }

    public function getCountries() {
        $countries_list = Countries::find()->all();
        $cnt = count($countries_list);
        for ($i=0;$i<$cnt;$i++) {
            $countries[$countries_list[$i]['two_letter_code']] =
                $countries_list[$i]['two_letter_code'].' '.$countries_list[$i]['country'];
        }
        return $countries;
    }
}

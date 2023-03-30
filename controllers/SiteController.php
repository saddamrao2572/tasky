<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
	public function actionBooks()
    {
		   $this->layout = '@app/views/layouts/books';
		   		   $url = "https://openlibrary.org/search.json?q=*:*&limit=100";
		    if (isset($_GET['query']))  {
			  $url = "https://openlibrary.org/search.json?q=".$_GET['query']."&limit=100";  
		   }else
		   {
			   $url = "https://openlibrary.org/search.json?q=*:*&limit=100"; 
		   }
		   
		

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			$data = json_decode($result, true);

			// foreach ($data['docs'] as $book) {
				// $title = isset($book['title']) ? $book['title'] : '';
				// $author = isset($book['author_name'][0]) ? $book['author_name'][0] : '';
				// $thumbnail = isset($book['cover_i']) ? 'https://covers.openlibrary.org/b/id/'.$book['cover_i'].'-M.jpg' : '';
				// echo "Title: $title\n";
				// echo "Author: $author\n";
				// echo "Thumbnail: $thumbnail\n\n";
			// }
			 $provider = new ArrayDataProvider([
    'allModels' => (isset($data['docs']) ? $data['docs'] : []),
    'pagination' => [
        'pageSize' => 10,
    ],
	'key' => 'title',
    'sort' => [
        'attributes' => ['title', 'author'],
    ],
]);

        $this->view->title = 'Book List';
        return $this->render('books', ['dataProvider' => $provider,'modal' => isset($data['docs']) ? $data['docs'] : []]);
    }




public function actionBooksearch()
    {
		   $this->layout = '@app/views/layouts/books';
		   
		 $success = 0;
		 $title  = ' ';
		 $thumbnail  = ' ';
		 $author  = '';
        if (\Yii::$app->request->isAjax) {
            $isbn = \Yii::$app->request->post('isbn');
          // $isbn = "0451526538"; // replace with the desired ISBN

			$url = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&jscmd=data&format=json";
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			$data = json_decode($response, true);

			$book_info = $data["ISBN:$isbn"];

			$title = isset($book_info['title']) ? $book_info['title'] : '';
			$authors = isset($book_info['author_name'][0]) ? $book_info['author_name'][0] : '';
			$thumbnail = isset($book_info['thumbnail_url']) ? $book_info['thumbnail_url'] : '';

			//echo "Title: $title\n";
			//echo "Authors: ";
			//foreach ($authors as $author) {
				//echo $author['name'] . " ";
				$success = 1;
			//}
        }
        
        
        
        return json_encode(array(
            'success' => $success,
            'title' => $title,
            'author' => $authors,
            'thumbnail' => $thumbnail,
            //'data' =>isset($data['docs'][0]) ? $data['docs'][0] : '',
        ));
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
}

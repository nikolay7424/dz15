<?php


namespace Controller;


use Core\Controller;

/**
 * Class Articles
 * @package Controller
 */
class Articles extends Controller
{
    /**
     * Show user's articles
     */
    public function index()
    {
        $articleModel = $this->model('article');
        $articles = $articleModel->getArticlesByUserId($this->userModel->getId());
        $view = $this->view();
        $view->render('Article', $articles);
    }

    /**
     * Create new article
     */
    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_POST['title']) || !empty($_POST['text']))
        {
            $articleModel = $this->model('article');
            $articleModel->insertArticle($_POST['title'], $this->userModel->getId(), $_POST['text']);
            $view = $this->view();
            $article = 'article created: title = ' . $_POST['title'] . ' text = ' . $_POST['text'];
            $view->render('Article', $article);
        }else
        {
            header('Location: index.php?route=error/bad_request');
        }
    }

    /**
     * Edit existing article
     */
    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] == 'PUT')
        {
            parse_str(file_get_contents('php://input'), $put_data);
            if(!empty($put_data['title']) || !empty($put_data['text']) || !empty($put_data['article_id']))
            {
                $articleModel = $this->model('article');
                $articleModel->updateArticle($put_data['title'],
                    $put_data['text'],
                    $put_data['article_id'],
                    $this->userModel->getId());
                $view = $this->view();
                $article = 'article updated: new title = ' . $put_data['title'] . ' new text = ' . $put_data['text'];
                $view->render('Article', $article);
            }else{
                header('Location: index.php?route=error/bad_request');
            }
        }
    }

    /**
     * Delete existing article
     */
    public function delete()
    {
        if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            parse_str(file_get_contents('php://input'), $delete_data);
            if(!empty($delete_data['article_id']))
            {
                $articleModel = $this->model('article');
                $articleModel->deleteArticle($delete_data['article_id'], $this->userModel->getId());
                $view = $this->view();
                $article = 'article with id = ' . $delete_data['article_id'] . ' has been deleted';
                $view->render('Article', $article);
            }else{
                header('Location: index.php?route=error/bad_request');
            }
        }
    }
}
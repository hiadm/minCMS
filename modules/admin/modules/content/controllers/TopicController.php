<?php
namespace app\modules\admin\modules\content\controllers;
use app\models\content\Category;
use app\models\content\SearchTopic;
use app\models\content\Topic;
use app\modules\admin\controllers\BaseController;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class TopicController extends BaseController{


    public function actions()
    {
        return [
            'upload' => [
                'class' => 'app\components\actions\UploadAction',
                //剪切尺寸
                'shearSize' => [300, 240],
                //子目录
                'subDir' => 'topic'
            ],
        ];
    }

    //列表
    public function actionIndex(){
        $searchModel = new SearchTopic();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //下拉框初始数据
        $selectArr = ['' => '搜索分类名'];
        if(isset($searchModel->category_id) && $searchModel->category_id > 0){
            $selectArr[$searchModel->category_id] = Category::find()
                ->where(['id'=>$searchModel->category_id])
                ->select('name')->scalar();
            $selectArr += ['0'=>'所有分类'];
        }


        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'selectArr' => $selectArr
        ]);
    }

    //创建
    public function actionCreate(){
        $model = new Topic();

        if(Yii::$app->request->isPost){

            if($model->load(Yii::$app->request->post()) && $model->save()){
                //创建话题成功
                Yii::$app->session->setFlash('success', '创建话题成功。');
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', '创建话题失败，请重试。');
        }

        $selectArr = ['' => '选择所属分类'];
        return $this->render('create',[
            'model' => $model,
            'selectArr' => $selectArr
        ]);
    }

    //查看
    public function actionView($id){
        $model = static::getModel($id);

        return $this->render('view',[
            'model' => $model,
        ]);
    }

    //编辑
    public function actionUpdate($id){
        $model = static::getModel($id);


        if(Yii::$app->request->isPost){
            if($model->load(Yii::$app->request->post()) && $model->updateImg() && $model->save()){
                //修改完成
                Yii::$app->session->setFlash('success', '修改话题成功。');
                return $this->redirect(['index']);
            }
            //修改失败 显示表单
        }

        //获取所属分类信息
        if($model->category_id){
            $selectArr[$model->category_id] = Category::find()
                ->where(['id'=>$model->category_id])
                ->select('name')->scalar();
        }
        return $this->render('create',[
            'model' => $model,
            'selectArr' => $selectArr
        ]);
    }

    //删除
    public function actionDelete($id){
        $model = static::getModel($id);

        if(Topic::deleteImg($model->image) && $model->delete()){
            //删除成功
            Yii::$app->session->setFlash('success', '删除话题成功。');
        }else
            //删除失败
            Yii::$app->session->setFlash('error', '删除话题失败，请重试。');

        return $this->redirect(['index']);

    }

    //批量删除
    public function actionBatchDel(){
        $topics_id = Yii::$app->request->post('topics_id');

        //检测参数
        if(empty($topics_id)){
            Yii::$app->session->setFlash('error', '请选择要删除的话题。');
            return $this->redirect(['index']);
        }

        //获取所有图片信息
        $images = Topic::getImgByIds($topics_id);

        //删除图片
        Topic::batchDeleteImg($images);

        //删除记录
        if(Topic::deleteAll(['in', 'id', $topics_id]) === false){
            Yii::$app->session->setFlash('error', '删除话题信息失败，请重试。');
        }else{
            Yii::$app->session->setFlash('success', '批量删除话题成功。');
        }
        return $this->redirect(['index']);
    }

    //获取模型
    private static function getModel($id){
        $id = (int)$id;
        if($id <= 0){
            throw new BadRequestHttpException('请求错误。');
        }

        $model = Topic::findOne($id);
        if(!$model){
            throw new NotFoundHttpException('没有相关数据。');
        }

        return $model;
    }


}
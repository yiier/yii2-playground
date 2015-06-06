<?php

namespace frontend\modules\fs\controllers;

use Yii;
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\web\UploadedFile;


class FlysystemController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fileName = 'filename.ext';

        $exists = Yii::$app->fs->has($fileName);

        if ($exists) {
            Yii::$app->fs->update($fileName, 'contents updated at  ' . Yii::$app->formatter->asDatetime(time()));
        } else {
            Yii::$app->fs->write($fileName, 'this is contents that will be store to the flyFileSystem . firstTime ');
        }
        // 也可以用put方法 其逻辑是存在即更新 不存在即创建  > Yii::$app->fs->put('filename.ext', 'contents');
        // 更多的操作参见：https://github.com/creocoder/yii2-flysystem


        $content = '';
        if ($exists) {
            // 获取文件的MIME信息
            $mimeType = Yii::$app->fs->getMimetype($fileName);

            $content .= 'MIME TYPE : '.$mimeType .' </br> ' ;

            $content  .=  Yii::$app->fs->read('filename.ext');
        } else {
            $content = '文件不存在 访问失败';
        }

        return $this->renderContent($content);

        // return $this->render('index');
    }

    /**
     * 上传示例
     *
     * @return string
     */
    public function actionUpload()
    {

        $model = new DynamicModel(['image' => '']);
        // 动态添加验证规则！

        $model->addRule(['image',], 'file', ['extensions' => 'jpeg,jpg, gif, png',]);
        //  $model->addRule(['image',], 'required', ['message' => '亲 上传一个文件呢？',]);

        // post 请求才可能上传文件
        if (Yii::$app->request->getIsPost()) {
            if ($model->validate()) {
                // 验证通过了 在上传
                /*
                 * 参考官方的解决方案
                 * @see http://flysystem.thephpleague.com/recipes/
                 *
                $file = UploadedFile::getInstanceByName($uploadname);

                if ($file->error === UPLOAD_ERR_OK) {
                    $stream = fopen($file->tempName, 'r+');
                    $filesystem->writeStream('uploads/'.$file->name, $stream);
                    fclose($stream);
                }
                */

                $file = UploadedFile::getInstance($model, 'image');
                if ($file->error === UPLOAD_ERR_OK) {
                    $stream = fopen($file->tempName, 'r+');
                    $fileName = 'files/' . time() . $file->name;

                    Yii::$app->fs->writeStream($fileName, $stream);
                    fclose($stream);

                    $result = '';
                    // 是否上传成功？
                    if (Yii::$app->fs->has($fileName)) {

                        /**
                         * $file = file_get_contents('d:/a.jpg');
                         * header('Content-type: image/jpeg');
                         * echo $file;
                         */
                        // 图片文件的内容嵌入到img 中： http://stackoverflow.com/search?q=html+image+data+base64
                        // @see http://stackoverflow.com/questions/1124149/is-embedding-background-image-data-into-css-as-base64-good-or-bad-practice
                        // TODO 这里文件的mime 可以用它文件系统组件来探测！
                        $img = Html::img('data:image/gif;base64,' . base64_encode(Yii::$app->fs->read($fileName)), ['width' => '300px']);

                        // 删除掉所上传的文件
                        // 轻轻的我走了正如我轻轻的来 挥一挥手 不留下一点垃圾！
                        Yii::$app->fs->delete($fileName);

                        $result = '上传的图片： ' . $img . '<br/>上传成功 文件已被删除了';
                    } else {
                        $result = '上传失败 ';
                    }
                    $result .= '<br/> ' . Html::a('重新上传', [''], []);
                    // 演示renderContent方法
                    return $this->renderContent($result);
                }
            }
        }

        return $this->render('upload', [
            'model' => $model,
        ]);


    }

    /**
     * @see http://stackoverflow.com/questions/8499633/how-to-display-base64-images-in-html
     *
     * @param $imageFile
     */
    protected function echoImg($imageFile)
    {
        $image = 'http://images.itracki.com/2011/06/favicon.png';
// Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: ' . mime_content_type($image) . ';base64,' . $imageData;

// Echo out a sample image
        echo '<img src="', $src, '">';
    }

}

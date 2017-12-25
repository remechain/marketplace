<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@upload-blog', dirname(dirname(__DIR__)) . '/frontend/web/upload/blog');
Yii::setAlias('@upload-blog-backend', dirname(dirname(__DIR__)) . '/backend/web/upload');

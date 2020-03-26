<?php
 //上传文件
    function upload($img){
        if(request()->file($img)->isValid()){
            $file=request()->$img;
            $store=$file->store('uploads');
            return $store;
        }
        exit('未获取到上传文件或过程错误');

    }

    //多文件上传
    function duoupload($img){
        $file=request()->$img; //接收数据
        // dd($file);
        
        foreach ($file as $k=>$v){
            // echo 123;
            if($v->isValid()){
                $store[$k]=$v->store('uploads');
                // echo 1123;
            }
        }
        return $store;
    }

    //无限极分类
    function CreateTree($data,$pid=0,$level=0){
        if(!$data){
            return;
        }
        static $newArray=[];
        foreach ($data as $v){
            if($v->pid==$pid){
                $v->level=$level;
                $newArray[]=$v;

                //在次调用自身查找符合条件的孩子
                CreateTree($data,$v->cate_id,$level+1);
            }
        }
        return $newArray;
    }
    function NewsTree($data,$pid=0,$level=0){
        if(!$data){
            return;
        }
        static $Array=[];
        foreach($data as $v){
            if($v->pid==$pid){
            $v->level=$level;
            $Array[]=$v;

            //在次调用自身查找符合条件的孩
            NewsTree($data,$v->news_id,$level+1);
        }
        }
        return $Array;
    }
    
?>

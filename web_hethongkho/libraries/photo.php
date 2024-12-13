<?php

class photo
{



    private $_d;



    private $_func;



    private $_com;



    private $_table;



    public function __construct($db, $func, $table)
    {



        $this->_d = $db;



        $this->_func = $func;



        $this->_table = $table;
    }

    public function getPhoto()
    {



        global $type, $url_path, $item, $ds_photo;



        $sql = "select * from #_{$this->_table} where type='{$type}'";



        $item = $this->_d->rawQueryOne($sql);
    }



    function saveWatermark()

    {

        global $config, $url_path, $folder, $type, $GLOBAL;



        $table = $GLOBAL[$this->_table][$type];



        if (isset($_POST['data'])) {

            parse_str(urldecode($_POST['data']), $data);



            $upload = false;



            foreach ($config['lang'] as $k => $v) {



                $file = $_FILES['file_' . $k];



                if (!empty($file)) {



                    if ($file['error'] == 0) {



                        $photo = $this->_func->uploadImg(0, "photo", "thumb", $file, _upload_temp, $this->_table, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);



                        $send['photo'] = $photo['photo'];



                        $send['thumb'] = $photo['thumb'];



                        $upload = true;



                        $path = _upload_temp . $photo;
                    }
                }
            }
        }



        echo json_encode(

            array(

                "path" => $path,

                "upload" => $upload,

                "data" => $data['data']['options']['watermark'],

                "position" => $data['data']['options']['watermark']['position'],

                "image" => "../images/preview-watermark.jpg"

            )

        );



        exit;
    }

    /* Preview watermark */

    function previewWatermark()

    {;

        $this->_func->createThumb(500, 0, 1, $_GET['img'], null, "preview", true, $_GET);
    }



    public function savePhoto()
    {



        global $config, $url_path, $folder, $type, $GLOBAL;



        $file_name = $this->_func->imagesName($_FILES['file']['name']);



        $checkRow = $this->_d->rawQuery("select * from #_{$this->_table} where type='{$type}'");



        $table = $GLOBAL[$this->_table][$type];



        $data = $_POST['data'];



        if ($_POST) {



            foreach ($data as $k => $v) {



                if (is_array($v)) {

                    foreach ($v as $k2 => $v2) $option[$k2] = $v2;



                    $send[$k] = json_encode($option);
                } else {



                    $send[$k] = htmlspecialchars($v);
                }
            }
        }



        foreach ($config['lang'] as $k => $v) {



            $file = $_FILES['file_' . $k];




            if (!empty($file)) {

                if ($file['error'] == 0) {
                    $photo = $this->_func->uploadImg(0, "photo", "thumb", $file, $folder, $this->_table, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);
                    $send['photo'] = $photo['photo'];
                    $send['thumb'] = $photo['thumb'];
                }
            }
        }


        $filephu = $_FILES['filephu'];




        if (!empty($filephu)) {


            if ($filephu['error'] == 0) {

                $photo = $this->_func->uploadImg(0, "photo2", "thumb_" . $k, $filephu, $folder, $this->_com, $table['img-width-bg'], $table['img-height-bg'], $table['img-ratio'], $table['img-b']);

                $send['photo2'] = $photo['photo2'];
            }
        }
        $send['time_out'] = (int)$_POST['time_out'];



        $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;




        if (isset($table['watermark']) && $table['watermark'] == true) {

            $this->_func->removeDir(_watermark);

            $this->_func->RemoveFilesFromDirInXSeconds(_upload_temp, 1);
        }



        if (count($checkRow) > 0) {



            $send['ngaysua'] = time();

            $this->_d->where('type', $type);



            $updateData = $this->_d->update($this->_table, $send);

            if ($updateData) {

                $response['status'] = 200;

                $response['message'] = "Cập nhật thông tin thành công";

                $message = base64_encode(json_encode($response));


                $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
            } else {

                $response['status'] = 201;

                $response['message'] = "Cập nhật thông tin không thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
            }
        } else {



            $send['ngaytao'] = time();

            $send['type'] = $type;

            $insertID = $this->_d->insert($this->_table, $send);

            if ($insertID) {

                $response['status'] = 200;

                $response['message'] = "Thêm dữ liệu thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
            } else {

                $response['status'] = 201;

                $response['message'] = "Thêm dữ liệu không thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
            }
        }
    }
}

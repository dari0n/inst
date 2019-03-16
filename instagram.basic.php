<?php


class INSTAGRAM
{
    protected $apiUrl;
    protected $token;
    protected $JSON; //объект полученный от Instagram
    protected $count = 7; //количество выводимых постов


    protected $images; //картинка !
    protected $imageResolution = 'standard_resolution'; // качество изображения
    protected $link; // ссылка на пост !
    protected $caption; // заголовок поста

    public function __construct($url,$token)
    {
        $this->token = $token;
        $this->apiUrl = $url;

        $this->decodedJSON($this->getContent());
        $this->getData();


    }


    //Получаем JSON в виде текста
    protected function getContent()
    {
        return file_get_contents($this->apiUrl . $this->token);
    }


    //Конвертируем JSON в обьект
    protected function decodedJSON($content)
    {
        $this->JSON = json_decode($content,true);

    }


    //Минидамп
    protected function DUMP($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

    //массив Изображений
    protected function getData()
    {
        //изображения
        for ($i = 0; $i<=$this->count; $i++)
        {
            $this->images[$i] = $this->JSON['data'][$i]['images'][$this->imageResolution]['url'];

        }
        //Заголовки постов
        for ($i = 0; $i<=$this->count; $i++)
        {
            $this->caption[$i] = $this->JSON['data'][$i]['caption'];

        }
        //Ссылка на пост
        for ($i = 0; $i<=$this->count; $i++)
        {
            $this->link[$i] = $this->JSON['data'][$i]['link'];

        }

    }

    public function returnImages()
    {
        return $this->images;
    }

    public function returnLinks()
    {
        return $this->link;
    }

    public function returnCaptions()
    {
        return $this->caption;
    }


}


$i = new INSTAGRAM('https://api.instagram.com/v1/users/self/media/recent/?access_token=','token');

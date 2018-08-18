<?php
class Map{
    /**
     * @param $address根据地址来获取经纬度
     * http://lbsyun.baidu.com/index.php?title=webapi
     * @return array|mixed|string
     */
    public static function getLngLatByAddress($address){
        //http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=您的ak&callback=showLocation //GET请求
        if(!$address) {
            return '';
        }
        $data = [
            'address' =>$address,
            'output' => 'json',
            'ak' => config('map.ak'),
        ];
        $url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
        $result = doCurl($url,1);
        if($result){
            return json_decode($result,true);
        }else{
            return [];
        }
    }

    /**
     * http://lbsyun.baidu.com/index.php?title=static
     * @param $center地图中心点位置，参数可以为经纬度坐标或名称。坐标格式：lng<经度>，lat<纬度>，例如116.43213,38.76623。
     * @return mixed|string
     */
    public static function getMapByLngLatOrCenter($center){
        //http://api.map.baidu.com/staticimage/v2?ak=E4805d16520de693a3fe707cdc962045&mcode=666666&center=116.403874,39.914888&width=300&height=200&zoom=11
        if(!$center) {
            return '';
        }
        $data = [
            'ak' => config('map.ak'),
            'width' => config('map.width'),
            'height' => config('map.height'),
            'center' => $center,
            'markers' => $center,

        ];
        $url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);//转化数组形式
        // file_get_contents($url);
        $result = doCurl($url,1);
        return $result;
    }
}
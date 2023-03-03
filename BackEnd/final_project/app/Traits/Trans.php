<?php

namespace App\Traits;

trait Trans {

    // Mutator (set)
    public function setNameAttribute($value) {

        // if condition just to remove null value in database when use seeder
//        if(request()->en_name && request()->ar_name) {
//            $name = [
//                'en' => request()->en_name,
//                'ar' => request()->ar_name,
//            ];
//        } else {
//            // json_decode => covert json to array
//            $value = json_decode($value, true);
//            $name = [
//                'en' => $value['en'],
//                'ar' => $value['ar'],
//            ];
//        }

        $name = [
            'en' => request()->en_name,
            'ar' => request()->ar_name,
        ];

        //  JSON_UNESCAPED_UNICODE use to save arabic name in database
        $name = json_encode($name, JSON_UNESCAPED_UNICODE);

        $this->attributes['name'] = $name;
    }

    public function setSmalldescAttribute() {
        $smalldesc = [
            'en' => request()->en_smalldesc,
            'ar' => request()->ar_smalldesc,
        ];
        //  JSON_UNESCAPED_UNICODE use to save arabic name in database
        $smalldesc = json_encode($smalldesc, JSON_UNESCAPED_UNICODE);

        $this->attributes['smalldesc'] = $smalldesc;
    }

    public function setDescAttribute() {
        $desc = [
            'en' => request()->en_desc,
            'ar' => request()->ar_desc,
        ];
        //  JSON_UNESCAPED_UNICODE use to save arabic name in database
        $desc = json_encode($desc, JSON_UNESCAPED_UNICODE);

        $this->attributes['desc'] = $desc;
    }


    //  Accessor (get)
    public function getTransNameAttribute() {
        if($this->name) {
            return json_decode($this->name, true)[app()->getLocale()];
        }
        return $this->name;
    }

    public function getEnNameAttribute() {
        if($this->name) {
            return json_decode($this->name, true)['en'];
        }
        return $this->name;
    }

    public function getArNameAttribute() {
        if($this->name) {
            return json_decode($this->name, true)['ar'];
        }
        return $this->name;
    }

    // small desc

    public function getEnSmalldescAttribute() {
        if($this->smalldesc) {
            return json_decode($this->smalldesc, true)['en'];
        }
        return $this->smalldesc;
    }

    public function getArSmalldescAttribute() {
        if($this->smalldesc) {
            return json_decode($this->smalldesc, true)['ar'];
        }
        return $this->smalldesc;
    }

    // desc

    public function getTransDescAttribute() {


        if($this->desc) {
            return json_decode($this->desc, true)[app()->getLocale()];
        }
        return $this->desc;

    }


    public function getEnDescAttribute() {
        if($this->desc) {
            return json_decode($this->desc, true)['en'];
        }
        return $this->desc;
    }

    public function getArDescAttribute() {
        if($this->desc) {
            return json_decode($this->desc, true)['ar'];
        }
        return $this->desc;
    }



}

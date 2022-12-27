foreach($regions as $region){
            $region['name_en']=$region->name_en.'('.$region->city->name_en.')';
          }
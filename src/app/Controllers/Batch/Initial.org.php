<?php

declare(strict_types=1);

namespace App\Controllers\Batch;

use CodeIgniter\Controller;

// library
use App\Libraries\API;

// model
use App\Models\AreaModel;
use App\Models\categoryModel;
use App\Models\StoreModel;
use App\Models\TerminalModel;

class Initial extends Controller
{
    private $area;
    private $category;
    private $store;
    private $terminal;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // モデルロード
        $this->area     = new AreaModel();
        $this->category = new CategoryModel();
        $this->store    = new StoreModel();
        $this->terminal = new TerminalModel();
    }

    // export CI_ENV=docker; /usr/local/bin/php /var/www/current/htdocs/index.php batch Initial initArea
    public function initArea()
    {
        $currentAt = date("Y-m-d H:i:s");

        $fp = fopen('./initial_data.csv', 'r');

        try {
            $this->area->beginTransaction();

            $areaList = [];

            while($data = fgetcsv($fp)) {
                $areaList[$data[0]] = $data[0];
            }

            $i = 1;
            foreach($areaList as $areaName) {
                $result = $this->area->create(
                    'area',
                    [
                        'id'         => $i,
                        'media_id'   => 27,
                        'name'       => $areaName,
                        'created_at' => $currentAt
                    ]
                );
                if (!$result) {
                    throw new \Exception('area create error');
                }
                $i ++;
            }

            $this->area->commit();

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $this->area->rollback();
            exit(1);
        }

        exit(0);
    }

    // export CI_ENV=docker; /usr/local/bin/php /var/www/current/htdocs/index.php batch Initial initStore
    public function initStore()
    {
        $currentAt = date("Y-m-d H:i:s");

        $fp = fopen('./initial_data.csv', 'r');

        try {
            $this->store->beginTransaction();

            $storeList = [];

            while($data = fgetcsv($fp)) {
                $storeList[$data[2]]['area_name'] = $data[0];
                $storeList[$data[2]]['name']      = $data[3];
                if(!empty($data[5])) {
                    $storeList[$data[2]]['is_liquor'] = $data[5] == '酒類有' ? 1 : 0;
                }
            }

            $i = 1;
            foreach($storeList as $storeNumber => $storeInfo) {
                $areaInfo = $this->area->getByName($storeInfo['area_name']);

                $result = $this->store->create(
                    'store',
                    [
                        'id'         => $i,
                        'media_id'   => 27,
                        'area_id'    => $areaInfo['id'],
                        'number'     => $storeNumber,
                        'name'       => $storeInfo['name'],
                        'is_liquor'  => !empty($storeInfo['is_liquor']) ? $storeInfo['is_liquor'] : 0,
                        'created_at' => $currentAt
                    ]
                );
                if (!$result) {
                    throw new \Exception('store create error');
                }
                $i ++;
            }

            $this->store->commit();

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $this->store->rollback();
            exit(1);
        }

        exit(0);
    }

    // export CI_ENV=docker; /usr/local/bin/php /var/www/current/htdocs/index.php batch Initial initCategory
    public function initCategory()
    {
        $currentAt = date("Y-m-d H:i:s");

        $fp = fopen('./initial_data.csv', 'r');

        try {
            $this->category->beginTransaction();

            $categoryList = [];

            while($data = fgetcsv($fp)) {
                $categoryList[$data[4]] = $data[4];
            }

            $i = 1;
            foreach($categoryList as $categoryName) {
                $result = $this->category->create(
                    'category',
                    [
                        'id'         => $i,
                        'media_id'   => 27,
                        'name'       => $categoryName,
                        'created_at' => $currentAt
                    ]
                );
                if (!$result) {
                    throw new \Exception('category create error');
                }
                $i ++;
            }


            $this->category->commit();

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $this->category->rollback();
            exit(1);
        }

        exit(0);
    }

    // export CI_ENV=docker; /usr/local/bin/php /var/www/current/htdocs/index.php batch Initial initTerminal
    public function initTerminal()
    {
        $currentAt = date("Y-m-d H:i:s");

        $fp = fopen('./initial_data.csv', 'r');

        try {
            $this->terminal->beginTransaction();

            while($data = fgetcsv($fp)) {
                $areaInfo     = $this->area->getByName($data[0]);
                $storeInfo    = $this->store->getByName($data[3]);
                $categoryInfo = $this->category->getByName($data[4]);

                $result = $this->terminal->create(
                    'terminal',
                    [
                        'id'          => $data[1],
                        'media_id'    => 27,
                        'name'        => $data[1] . '：' . $data[3] . '_' . $data[4],
                        'area_id'     => $areaInfo['id'],
                        'store_id'    => $storeInfo['id'],
                        'category_id' => $categoryInfo['id'],
                        'created_at'  => $currentAt,
                        'is_deleted'  => $data[6] === '設置完了' ? 0 : 1
                    ]
                );
                if (!$result) {
                    throw new \Exception('terminal create error');
                }
            }

            $this->terminal->commit();

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $this->terminal->rollback();
            exit(1);
        }

        exit(0);
    }
}

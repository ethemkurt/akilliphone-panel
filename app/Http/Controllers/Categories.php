<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Categories extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $data['categories'] = \WebService::categories($page);

        return view('Product.categories', $data);
    }


    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::categories($page);
        $dataTable->setRecordsTotal(count($response));
        $dataTable->setRecordsFiltered(count($response));
        $items = [];
        foreach($response as $row){
            $item = [];
            foreach($dataTable->cols() as $key=>$col){
                $method = '_format_'.$key;
                if(method_exists($this, $method)){
                    $value = $this->$method($row);
                } else {
                    $value = isset($row[$key])?$row[$key]:'';
                }
                $item[$key] = $value;
            }
            if(isset($item['orderNumber'])){
                $item['orderNumber'] = count($items) + $start + 1;
            }
            $items[] = $item;
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();
    }
    private function _format_image($item){

        return '<img src="'._CdnImageUrl($item["image"]).'" >';

    }
    private function _format_action($item){

        $delete = route('product.brand-delete', $item['categoryId']);
        $edit = route('popup', 'BrandSave').'?category='.$item['categoryId'];
        $html = '';
        $html .= '<a class="btn confirm-popup" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="fa fa-trash"></i></a> ';
        $html .= '<a class="btn btn-popup-form" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="fa fa-edit"></i></a>';
        return '<div class="text-end">'.$html.'</div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('categories');
        $dataTable->setUrl(route('product.categories-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra No', 'className'=>'', 'orderable'=>''],
            'categoryId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'image'=>  ['title'=>'Kategori Fotoğrafı','className'=>'','orderable'=>''],
            'name'=>['title'=>'Kategori Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'','className'=>'','orderable'=>'']
        ]);
        return $dataTable;
    }

}

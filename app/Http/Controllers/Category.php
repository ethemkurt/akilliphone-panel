<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Category extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $categoryId='parent' ){
        $data['category'] = \WebService::category($categoryId);
        $data['dataTable'] = $this->dataTableParams($categoryId);
        return view('Category.index', $data);
    }

    public function edit(Request $request, $categoryId ){
        if($categoryId){
            if($categoryId=='new'){
                $data['category'] = \Instance::loadJson('category');
            } else{
                $data['category'] = \WebService::category($categoryId);
            }
        } else{
            $data['category'] = [];
        }
        $html = view('Category.category-edit', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function dataTable(Request $request, $categoryId='parent'){
        $dataTable = $this->dataTableParams($categoryId);
        //$categoryId = $request->input('categoryId', 0);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);

        $response = \WebService::categories($categoryId);


        $dataTable->setRecordsTotal($response['totalCount']);
        $dataTable->setRecordsFiltered($response['totalCount']);
        $items = [];

        foreach($response['items'] as $row){
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
        return '<img src="'._CdnImageUrl($item["image"], 40, 40).'" >';

    }
    private function _format_action($item){

        $delete = route('category.delete', $item['categoryId']);
        $edit = route('category.edit', $item['categoryId']);
        $html = '';

        $html .= '<a class="btn waves-effect p-0 ms-1" href="'.route('category.child', $item['categoryId']).'"><i class="feather icon-git-branch"></i></a>';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="feather icon-file-text"></i></a>';
        $html .= '<a class="confirm-popup btn waves-effect p-0 ms-1" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="feather icon-trash text-danger"></i></a> ';

        return '<div class="text-end">'.$html.'</div>';
    }
    private function dataTableParams($categoryId){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('categories');
        $dataTable->setUrl(route('category.data-table', $categoryId));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra', 'className'=>'sort-order', 'orderable'=>''],
            //'categoryId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'image'=>  ['title'=>'Kategori Fotoğrafı','className'=>'','orderable'=>''],
            'name'=>['title'=>'Kategori Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'','className'=>'action-buttons','orderable'=>'']
        ]);
        return $dataTable;
    }

}

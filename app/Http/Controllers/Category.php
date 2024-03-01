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
    public function cetagorySelect(Request $request){
        $categoryId = $request->input('categoryId');
        $response = \WebService::category($categoryId);

        if(isset( $response['inverseCategoryId1Navigation'])){
            $data['categories'] = $response['inverseCategoryId1Navigation'];
        } else {
            $data['categories'] = [];
        }

        return view('Category.cetagorySelect', $data);
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
        $data['parentId'] = $request->input('parentId', null);
        $html = view('Category.category-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $categoryId ){
        $category = $request->input('category');
        if($category){
            if($imageFile = $request->input('imageFile')){
                $category['image'] = \CdnService::saveToCdn($imageFile);
            }
            if($categoryId=='new'){
                $category['parentId'] = (int)$category['parentId'];
                $category['N11Category'] = "";
                $category['MetaDescription'] = "";
                $category['TrendyolCategory'] = "";
                $category['slug'] = $category['name'];
                $response = \WebService::categoryNew($category);
            } else{
                $response = \WebService::categoryEdit($categoryId, $category);
            }
            if($response){
                if(isset($response['data']) && isset($response['data']['categoryId'])){
                    $result = 'Kategori kaydedildi';
                } else{
                    $result = 'Kategori kaydedilemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else {
            $result = 'Kategori bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }
    public function deleteForm(Request $request, $categoryId ){

        if($categoryId){
            $data['category'] = \WebService::category($categoryId);
        } else{
            $data['category'] = [];
        }
        $html = view('Category.category-delete', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function delete(Request $request, $categoryId ){
        $response = \WebService::category($categoryId);

        if($response && isset($response['categoryId'])){
            $response = \WebService::categoryDelete($categoryId);
            if($response){
                if($response['errors']){
                    return _ReturnError('1', '2', $response['errors']);
                }

                if( $response && isset($response['data'])){
                    $result = 'Kategori Silindi';
                } else{
                    $result = 'Kategori Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Kategori bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request, $categoryId='parent'){
        $dataTable = $this->dataTableParams($categoryId);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        if($categoryId=='parent'){
            $response = \WebService::categories(1);
            $dataTable->setRecordsTotal($response['totalCount']);
            $dataTable->setRecordsFiltered($response['totalCount']);
        } else {
            $response = \WebService::category($categoryId);
            $response['items'] = $response['inverseCategoryId1Navigation'];
            $dataTable->setRecordsTotal(count($response['items']));
            $dataTable->setRecordsFiltered(count($response['items']));
        }
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
    private function _format_status($row){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($row['status']).'" text-capitalized="">'.\ActivePassive::__($row['status']).'</span>';
    }
    private function _format_action($item){

        $delete = route('category.delete', $item['categoryId']);
        $edit = route('category.edit', ['categoryId'=>$item['categoryId'], 'parentId'=>$item['parentId']]);
        $html = '';
        $category = \WebService::category($item['categoryId']);

        if(isset($category['inverseCategoryId1Navigation']) && $category['inverseCategoryId1Navigation']){
            $childColor = 'success';
        } else {
            $childColor = 'secondary';
        }
        $html .= '<a class="btn waves-effect p-0 ms-1" href="'.route('category.child', $item['categoryId']).'"><i class="menu-icon tf-icons ti ti-hierarchy text-'.$childColor.'"></i></a>';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-title="'.$item['name'].' Alt Kategorisi Ekle" data-url="'.route('category.edit', ['categoryId'=>'new', 'parentId'=>$item['categoryId']]).'"><i class="menu-icon tf-icons ti ti-square-rounded-plus text-info"></i></a>';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="menu-icon tf-icons ti ti-file-text"></i></a>';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('category.delete.form', $item['categoryId']).'"><i class="menu-icon tf-icons ti ti-trash"></i></a> ';

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
            'image'=>  ['title'=>'Kategori Resmi','className'=>'','orderable'=>''],
            'name'=>['title'=>'Kategori Adı', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'','className'=>'action-buttons','orderable'=>'']
        ]);
        return $dataTable;
    }

}

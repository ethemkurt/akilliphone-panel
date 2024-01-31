<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Brand extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $brandId='parent' ){
        $data['brand'] = \WebService::brand($brandId);
        $data['dataTable'] = $this->dataTableParams($brandId);
        return view('Brand.index', $data);
    }

    public function edit(Request $request, $brandId ){
        if($brandId){
            if($brandId=='new'){
                $data['brand'] = \Instance::loadJson('brand');
            } else{
                $data['brand'] = \WebService::brand($brandId);
            }
        } else{
            $data['brand'] = [];
        }
        $data['parentId'] = $request->input('parentId', null);
        $html = view('Brand.brand-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $brandId ){
        $brand = $request->input('brand');
        if($brand){
            if($imageFile = $request->input('imageFile')){
                $brand['image'] = \CdnService::saveToCdn($imageFile);
            }
            if($brandId=='new'){
                $brand['MetaTitle'] = '';
                $brand['MetaDescription'] = '';
                $response = \WebService::brandNew($brand);
            } else{
                $response = \WebService::brandEdit($brandId, $brand);
            }
            if($response){
                if(isset($response['data']) && isset($response['data']['brandId'])){
                    $result = 'Marka kaydedildi';
                } else{
                    $result = 'Marka kaydedilemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else {
            $result = 'Marka bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }
    public function deleteForm(Request $request, $brandId ){

        if($brandId){
            $data['brand'] = \WebService::brand($brandId);
        } else{
            $data['brand'] = [];
        }
        $html = view('Brand.brand-delete', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function delete(Request $request, $brandId ){
        $response = \WebService::brand($brandId);

        if($response && isset($response['brandId'])){
            $response = \WebService::brandDelete($brandId);
            if($response){
                if($response['errors']){
                    return _ReturnError('1', '2', $response['errors']);
                }

                if( $response && isset($response['data'])){
                    $result = 'Marka Silindi';
                } else{
                    $result = 'Marka Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Marka bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);

            $response = \WebService::brands();
        $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
        $dataTable->setRecordsFiltered(isset($response['totalCount'])?$response['totalCount']:0);

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
        return '<img src="'._CdnImageUrl($item["image"], 90, 90).'" >';
    }
    private function _format_status($row){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($row['status']).'" text-capitalized="">'.\ActivePassive::__($row['status']).'</span>';
    }
    private function _format_action($item){
        $edit = route('brand.edit', ['brandId'=>$item['brandId'], 'parentId'=>$item['parentId']]);
        $html = '';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="feather icon-file-text"></i></a>';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('brand.delete.form', $item['brandId']).'"><i class="feather icon-trash text-danger"></i></a> ';
        return '<div class="text-end">'.$html.'</div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('brands');
        $dataTable->setUrl(route('brand.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra', 'className'=>'sort-order', 'orderable'=>''],
            //'brandId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'image'=>  ['title'=>'Marka Resmi','className'=>'','orderable'=>''],
            'name'=>['title'=>'Marka Adı', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'','className'=>'action-buttons','orderable'=>'']
        ]);
        return $dataTable;
    }

}

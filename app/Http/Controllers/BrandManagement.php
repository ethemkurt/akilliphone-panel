<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use App\Models;
class BrandManagement extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Product.brand-management', $data);
    }

    public function delete(Request $request, $brandId ){
        $response = \WebService::brand_delete($brandId);

        if(isset($response['errors']) && $response['errors']){
            $html = implode(', ', $response['errors']);
            $request->session()->flash('flash-error', [$html, 'Silinemedi' ]);
        } else{

            $request->session()->flash('flash-success', [ '' , 'Silindi']);
        }
        return redirect( route('product.brand-management'));
    }

    public function save(Request $request ){
        $html = '';

        if($brand = $request->input('brand')){
            $mobileImage='';
            $brandId = isset($brand['brandId'])?$brand['brandId']:false;
            if($brandId=='new'){


                try{
                    if($brand['mobileImageFile']){
                        $mobileImage = \CdnService::saveToCdn($brand['mobileImageFile'], '');
                    }
                } catch (\Exception $ex){
                    die($ex->getMessage());
                }
                $brand['image']=$mobileImage;
                $response = \WebService::brand_add($brand);





            } else {
                try{
                    if($brand['mobileImageFile']){
                        $mobileImage = \CdnService::saveToCdn($brand['mobileImageFile'], '');
                    }
                } catch (\Exception $ex){
                    die($ex->getMessage());
                }
                $response = \WebService::brand_edit($brand['brandId'],$brand);
            }
            if(isset($response['errors']) && $response['errors']){
                $html = implode(', ', $response['errors']);
                $request->session()->flash('flash-error', [$html, 'Kaydedilemedi' ]);
            } else{

                $html = '"'.$response['data']['name'].'"';
                $request->session()->flash('flash-success', [ $html , 'Kaydedildi']);
            }
        }
        return redirect( route('product.brand-management'));
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::brands($page);
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
        $delete = route('product.brand-delete', $item['brandId']);
        $edit = route('popup', 'BrandSave').'?brandId='.$item['brandId'];
        $html = '';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="feather icon-file-text"></i></a>';
        $html .= '<a class="confirm-popup btn waves-effect p-0 ms-1" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="feather icon-trash text-danger"></i></a> ';
        return $html;
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('brand-management');
        $dataTable->setUrl(route('product.brand-management-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra No', 'className'=>'sort-order', 'orderable'=>''],
            'image'=>  ['title'=>'Logo','className'=>'','orderable'=>''],
            'name'=>['title'=>'Marka Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'','className'=>'action-buttons','orderable'=>'']
        ]);
        return $dataTable;
    }

}

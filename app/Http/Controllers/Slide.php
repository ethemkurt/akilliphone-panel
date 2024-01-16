<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Slide extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Slide.index', $data);
    }
    public function edit(Request $request, $slideId){
        $oldSlide = old('slide');
        if($oldSlide){
            $data['slide'] = $oldSlide;
        }elseif($slideId=='new'){
            $data['slide'] = \Instance::Slide()->toArray();
        } else{
            $data['slide'] = \WebService::slide($slideId);
        }
        return view('Slide.edit', $data);
    }
    public function editSlide(Request $request, $slideId){
        $slide = \App\Models\Slide::find($slideId);
        if($slide){
            $images = $request->input('images', []);
            $slide->upSertImages($images);
            $request->session()->flash('flash-success', ['Slayt Kaydedildi', 'Tebrikler.']);
            return redirect(route('slide.edit', $slideId));
        }
        $request->session()->flash('flash-error', ['Slayt Kaydedilemedi', 'Üzgünüz.']);
        return redirect(route('slide.index'));
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $filter['offset'] = $request->input('length', 10);
        $filter['start'] = $request->input('start', 0);
        $filter['page'] = ceil($filter['start']/$filter['offset']);
        $response = \WebService::slides($filter);
        $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
        $dataTable->setRecordsFiltered(isset($response['totalCount'])?$response['totalCount']:0);
        $items = [];
        if($response && isset($response['items'])){
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
                    $item['orderNumber'] = count($items) + ($filter['offset']  * ($filter['page'])) + 1;
                }
                $items[] = $item;
            }
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();
    }

    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('product-list');
        $dataTable->setUrl(route('slide.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Slayt Adı', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }
    private function _format_status($item) {
        if($item->status){
            return 'Aktif';
        } else{
            return 'Pasif';
        }
    }
    private function _format_actions($item){
        $editUrl = route('slide.edit', $item['id']);
        $deleteUrl = route('popup', 'deleteSlide').'?slideId='. $item['id'];
        return '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="'.$editUrl.'">
                            <i class="feather icon-edit"></i>
                            <span>Düzenle</span>
                        </a>
                        <button class="dropdown-item btn-popup-form" data-url="'.$deleteUrl.'">
                            <i class="feather icon-trash-2"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>';
    }

}

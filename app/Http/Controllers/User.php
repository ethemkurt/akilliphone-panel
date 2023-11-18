<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class User extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Customer.index', $data);
    }
    public function detail(Request $request, $userrId ){
        $data['user'] = \WebService::user($userrId);
        return view('Customer.detail', $data);
    }
    public function new(Request $request ){
        $data = [];
        return view('Customer.new', $data);
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('user-list');
        $dataTable->setUrl(route('customer.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'firstName'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'email'=>['title'=>'Email', 'className'=>'', 'orderable'=>''],
            'phoneNumber'=>['title'=>'Telefonu', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>'']
        ]);
        return $dataTable;
    }
    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::customers($page, $offset);
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
    private function _format_action($item){
        return '<div class="dropdown">
             <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
             </button>
             <div class="dropdown-menu dropdown-menu-end" style="">
              <a class="dropdown-item" href="#">
               <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
               <span>Düzenle</span>
              </a>
              <a class="dropdown-item" href="#">
               <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
               <span>Sil</span>
              </a>
             </div>
            </div>';
    }

    private function _format_firstName($row){
        return $row['firstName'].' '.$row['lastName'];
    }
    private function _format_phoneNumber($row){
        $row['phoneNumber'] = preg_replace("/[^0-9]/", "", $row['phoneNumber']);
        $phoneNumber = intval($row['phoneNumber']);
        if($phoneNumber){
            $parts=sscanf($phoneNumber,'%3c%3c%2c%2c');
            return $parts[0]." ".$parts[1]." ".$parts[2]." ".$parts[3];
        }
        return '';
    }
    private function _format_status($row){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($row['active']).'" text-capitalized="">'.\ActivePassive::__($row['active']).'</span>';
    }
}

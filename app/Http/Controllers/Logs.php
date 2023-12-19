<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Logs extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data = [];
        return view('Logs.index', $data);
    }
    public function error(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Logs.error', $data);
    }
    public function errorView(Request $request, $errorId ){
        $data['log'] = FailedLogs::find($errorId);
        return view('Logs.error-view', $data);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $filter['offset'] = $request->input('length', 10);
        $filter['start'] = $request->input('start', 0);
        $filter['page'] = ceil($filter['start']/$filter['offset']);
        $rows = FailedLogs::orderBy('id', 'DESC')->get();

        $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
        $dataTable->setRecordsFiltered(isset($response['totalCount'])?$response['totalCount']:0);
        $items = [];
        if( !$rows->isEmpty() ){
            foreach($rows as $row){
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
        $dataTable->setTableId('logs-list');
        $dataTable->setUrl(route('logs.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'module'=>['title'=>'Kayanak', 'className'=>'', 'orderable'=>''],
            'data'=>['title'=>'Bilgiler', 'className'=>'', 'orderable'=>''],
            'created_at'=>['title'=>'Tarih', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }
    private function _format_data($row){
        $data= json_decode($row->data, 1);
        if(isset($data['ex'])) return $data['ex'];
    }
    private function _format_created_at($row){
        return _HumanDate($row->created_at, 'm.d.Y H:i');
    }
    private function _format_actions($row){
        return '<a href="'.route('logs.error.view', $row->id).'"><i class="feather icon-file-text"></i></a>';
    }
}

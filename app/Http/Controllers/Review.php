<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Review extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Review.index', $data);
    }
    public function edit(Request $request, $reviewId ){

        if($reviewId){
            $data['review'] = \WebService::review($reviewId);
        } else{
            $data['review'] = [];
        }
        $html = view('Review.review-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $reviewId ){
        $review = $request->input('review');
        if($review){
            $response = \WebService::reviewEdit($reviewId, $review);

            if($response){
                if(isset($response['data']) && isset($response['data']['reviewId'])){
                    $result = 'Yorum kaydedildi';
                } else{
                    $result = 'Yorum kaydedilemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else {
            $result = 'Yorum bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }
    public function deleteForm(Request $request, $reviewId ){

        if($reviewId){
            $data['review'] = \WebService::review($reviewId);
        } else{
            $data['review'] = [];
        }
        $html = view('Review.review-delete', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function delete(Request $request, $reviewId ){
        $response = \WebService::review($reviewId);

        if($response && isset($response['reviewId'])){
            $response = \WebService::reviewDelete($reviewId);
            if($response){
                if( $response && isset($response['data'])){
                    $result = 'Yorum Silindi';
                } else{
                    $result = 'Yorum Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Yorum bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $params = $request->input('where', []);

        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;


        $response = \WebService::reviews($page, $offset, $params);

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
                    $item['orderNumber'] = count($items) + $start + 1;
                }
                $items[] = $item;
            }
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();

    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('review-list');
        $dataTable->setUrl(route('review.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'product_image'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'product'=>['title'=>'Ürün', 'className'=>'', 'orderable'=>''],
            'customer'=>['title'=>'Müşteri', 'className'=>'', 'orderable'=>''],
            'title'=>['title'=>'Yorum', 'className'=>'', 'orderable'=>''],
            'rating'=>['title'=>'Yıldız', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'created_at'=>['title'=>'Tarih', 'className'=>'created-at', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        $dataTable->setFiters('Review.datatable-filter', \request()->all());

        return $dataTable;
    }

    private function _format_created_at($row){
        return _HumanDate($row['createdAt'], 'm.d.Y');
    }
    private function _format_product_image($row){
        $featuredImage =  '<div class="avatar me-2"><img src="'.getProductImageUrl($row['product']['featuredImage'], 60, 60).'"></div><div class="mr-1">';
        return $featuredImage;
    }
    private function _format_product($row){
        $row['product']['name'] = '<div class="d-flex flex-wrap">'.$row['product']['name'].'</div>';
        return $row['product']['name'];
    }
    private function _format_customer($row){
        return $row['customer']['firstName'].' '.$row['customer']['lastName'];
    }
    private function _format_title($row){
        return $row['title'];
    }
    private function _format_rating($row){
        return $row['rating'];
    }
    private function _format_status($row){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($row['status']).'" text-capitalized="">'.\ActivePassive::__($row['status']).'</span>';
    }

    private function _format_actions($row){
        return '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('review.edit', $row['reviewId']).'"><i class="feather icon-file-text"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('review.delete.form', $row['reviewId']).'"><i class="feather icon-trash text-danger"></i></a>';
    }
}

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
        $data['routeName'] =  $request->route()->getName();
        $data['dataTable'] = $this->dataTableParams( $data['routeName'] );
        return view('User.index', $data);
    }
    public function detail(Request $request, $userrId ){
        $data['user'] = \WebService::user($userrId);
        return view('Customer.detail', $data);
    }
    public function delete(Request $request, $userrId ){
        $response = \WebService::userDelete($userrId);
        if(isset($response['data'])){
            _ReturnSucces('', $response['message']);
        }elseif(isset($response['message'])){
            _ReturnError('', [$response['message']]);
        }
        return _ReturnError('', ['İşlem Yapılamadı']);;
    }
    public function edit(Request $request ){
        $data = [];
        return view('Customer.new', $data);
    }
    public function editUser(Request $request, $userId ){
        $user = $request->input('user');
        $role = $request->input('role');

        if($user){
            $user['hasDropshippingPermission'] =  0;
            $user['tcKimlik'] =  "11111111111";
            $user['birthDate'] =  date('Y-m-d H:i:s');
            if($user['userId']=='new'){
                $user['userId'] = null;
                $user['phoneNumber'] =  $user['telefon'];
                $user['userName'] =  $user['email'];
                $response = \WebService::userNew($user, $role);
                if($response){
                    if(isset($response['status']) && $response['status']){
                        return _ReturnSucces('', 'Kullanıcı Oluşturuldu' );
                    } elseif(isset($response['data']) && $response['data']){
                        return _ReturnSucces('', 'Kullanıcı Oluşturuldu' );
                    } else {
                        $errors = [];
                        if(isset($response['errors'])){
                            $errors = $response['errors'];
                        }
                        return _ReturnError('', '', $errors );
                    }
                }
            } else{
                $user['phoneNumber'] =  $user['telefon'];
                $user['userName'] =  $user['email'];
                $user['id'] = $user['userId'];
                if(isset($user['password']) && $user['password']=='nochange'){
                    unset($user['password']);
                }

                $response = \WebService::userEdit($user);
                if($response){
                    if(isset($response['data']) && isset($response['data']['id'])){
                        return _ReturnSucces('', 'Kullanıcı Kaydedildi' );
                    } else {
                        $errors = [];
                        if(isset($response['errors'])){
                            $errors = $response['errors'];
                        }
                        return _ReturnError('', '', $errors );
                    }
                }
            }

            if(isset($response['errors']) && $response['errors']){
                return _ReturnError('', '',$response['errors']);

            }
            return _ReturnSucces('', '**');
        }
        return _ReturnError('', '',['Kullanıcı Kaydedilemedi']);
    }
    private function dataTableParams($routeName){

        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('user-list');
        $dataTable->setUrl(route('user.data-table').'?role='.$routeName);
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'firstName'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'email'=>['title'=>'Email', 'className'=>'', 'orderable'=>''],
            'phoneNumber'=>['title'=>'Telefonu', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'Durumu', 'className'=>'action-buttons', 'orderable'=>'']
        ]);
        return $dataTable;
    }
    public function dataTable(Request $request){
        $role = $request->input('role');
        $dataTable = $this->dataTableParams($role);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $filter = [];
        if($role){

            $filter['role'] = $role;
        }
        if($where = $request->input('where')){

        }
        if($search = $request->input('search')){
            if($search['value']){
                $filter['text'] = $search['value'];
            }
        }
        $response = \WebService::users($page, $offset, $filter);
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
    private function _format_action($item){
        return '<div class="dropdown">
             <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
             </button>
             <div class="dropdown-menu dropdown-menu-end" style="">
              <a class="dropdown-item  btn-popup-form" data-url="'.route('popup', 'User').'?userId='. $item['id'].'">
              <i class="fa fa-eye"></i>
               <span>Görüntüle</span>
              </a>
<a class="dropdown-item btn-popup-form" data-url="'.route('popup', 'deleteUser').'?userId='. $item['id'].'">
                            <i class="feather icon-trash-2"></i>
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
    public function getUserData(Request $request){
        $data = \WebService::user( $request->input('userId'));
        return ['status'=>1, 'data'=>$data, 'html'=>''];
    }
    public function findUserForm(Request $request){
        $data = [];
        $html = view('User.findUserForm', $data)->render();
        return ['status'=>1, 'message'=>'m', 'html'=>$html];
    }
    public function findUserSelect2(Request $request){
        $data['results'] = [];
        $response = \WebService::users(1,25, ['text'=>$request->input('term')]);

        if($response && isset($response['items'])){
            foreach($response['items'] as $item){
                $data['results'][] = [
                    'id'=>$item['id'],
                    'text'=> $item['firstName'].' '.$item['lastName'].'('. $item['email'].')',
                    'image'=> '',
                    'variants'=>[]
                ];
            }
        }
        return $data;
    }

}

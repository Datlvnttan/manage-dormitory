<?php





use App\Http\Controllers\Api\Admin\BillApiController;
use App\Http\Controllers\Api\Admin\ChangeRoomApiController;
use App\Http\Controllers\Api\admin\ContractApiController;
use App\Http\Controllers\Api\Admin\DamageReportApiController;
use App\Http\Controllers\Api\Admin\DeviceAllocationApiController;
use App\Http\Controllers\Api\Admin\DeviceApiController;
use App\Http\Controllers\Api\Admin\InfringeAdminApiController;
use App\Http\Controllers\Api\Admin\InfringeHistoryAdminApiController;
use App\Http\Controllers\Api\Admin\NotificationAdminApiController;
use App\Http\Controllers\Api\Admin\OpenFeatureAdminApiController;
use App\Http\Controllers\Api\Admin\OpenRegisterAdminApiController;
use App\Http\Controllers\Api\Admin\RegisterApiController;
use App\Http\Controllers\Api\Admin\RoomServiceHasIndexApiController;
use App\Http\Controllers\Api\Admin\ServiceApiController;
use App\Http\Controllers\Api\Admin\ServicePersonalAdminApiController;
use App\Http\Controllers\Api\Admin\ServiceRoomHasIndexAdminApiController;
use App\Http\Controllers\Api\Admin\StaffManagerAdminApiController;
use App\Http\Controllers\Api\Admin\StudentAdminApiController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DichVuApiController;
use App\Http\Controllers\Api\KhuApiController;
use App\Http\Controllers\Api\PhongApiController;
use App\Http\Controllers\Api\SinhVienApiController;
use App\Http\Controllers\Api\TangApiController;
use App\Http\Controllers\Api\User\BillUserApiController;
use App\Http\Controllers\Api\User\DamageReportUserApiController;
use App\Http\Controllers\Api\User\DangKyNoiTruController;
use App\Http\Controllers\Api\User\InfringeUserApiController;
use App\Http\Controllers\Api\User\SinhVienConTroller as UserSinhVienConTroller;
use App\Http\Controllers\User\InfringeUserController;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EmailApiController;
use App\Http\Controllers\Api\PermissionApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\User\ContractUserApiController;
use App\Http\Controllers\Api\User\NotificationUserApiController;
use App\Http\Controllers\Api\User\ServiceUserApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post("/verify/{id}/{token}",[
    EmailApiController::class,
    "verifyEmail"
]);
Route::group(['middleware'=>['api']],function($request){
    Route::group(['prefix'=>'auth'],function(){
        route::post('/login',[
            AuthApiController::class,
            'login'
        ]);
        Route::get('logout', [
            AuthApiController::class,
            'logout'
        ]);//->name("logout");
        Route::post('refresh', [
            AuthApiController::class,
            'refresh'
        ]);
        Route::post('me', [
            AuthApiController::class,
            'me'
        ]);
       
    });
    Route::group(['prefix' => 'Authen','namespace' => 'Api/Auth'], function () {
        Route::post('/login',[
            AuthApiController::class,
            'login'
        ]);
        Route::post('register', [
            AuthApiController::class,
            'register'
        ]);
    });    

    // Route::group(['prefix'=>'personal','middleware'=>['auth:api']],function () {
    //     Route::post("resend-verify-email",[
    //         EmailApiController::class,
    //         "reSendVerifyEmail"
    //     ]);  
    // });
    // Route::controller(PremiumFeatureApiController::class)->group(function(){
    //     Route::group(["prefix"=> "premium-feature"],function(){
    //         Route::get("get-by-premium","getByPremium")->name("api.manager-premium-feature-get-by-premium");
    //     });
    // });
    Route::group(['middleware'=>['auth:user-api']],function(){                     
        Route::group(['prefix' => 'user'], function () {

            Route::get('/thong-bao',[
                NotificationUserApiController::class,
                'index'
            ]);

            Route::get('/get_infoSubscriber',[
                DangKyNoiTruController::class,
                'getInfoSubscriber'
            ]);


            Route::put('/cap-nhat-thong-tin',[
                UserSinhVienConTroller::class,
                'updateInfo'
            ]);

            Route::group(['prefix' => 'dangkynoitru'], function () {
                Route::post('/huy-dang-ky-noi-tru',[
                    DangKyNoiTruController::class,
                    'HuyDangKyNoiTru'
                ]);
                Route::delete('/huy-dang-ky-noi-tru',[
                    DangKyNoiTruController::class,
                    'deleteRegister'
                ]);
                Route::put('/dang-ky-thay-doi-phong',[
                    DangKyNoiTruController::class,
                    'changeRoom'
                ]);
            });            
            Route::controller(ContractUserApiController::class)->group(function () {
                Route::prefix('hopdong')->group(function () {                                      
                    Route::patch('gia-han-hop-dong',"extension");
                    // Route::patch('huy-gia-han-hop-dong',"cancelExtension");
                    Route::get("trang-thai","isRunningContractExtension");               
                    Route::get("","index");               
                });
            });




            Route::group(['middleware'=>"registered-resident-api"],function(){
                Route::prefix('dichvu')->group(function () {
                    Route::apiResource("su-dung-dich-vu-don",ServiceUserApiController::class)->only(["index","store","destroy"]);
                    // Route::prefix('su-dung-dich-vu-don')->group(function () {
                        
                    //     Route::get('su-dung-dich-vu-don',[
                    //         ServiceUserApiController::class,
                    //         'getUnregisteredService'
                    //     ]);
                    // });                
                });
                Route::controller(PhongApiController::class)->group(function () {
                    Route::prefix('phong')->group(function () {
                        Route::prefix('dang-ky-thay-doi-phong')->group(function () {
                            Route::post('',"registerChangeRoom");
                            Route::put('/{maDangKy}',"changeRoomUpdate");
                            Route::delete('/{maDangKy}',"changeRoomDelete");
                        });
                    });
                });
    
                Route::group(['prefix' => 'thietbi','namespace' => 'Api'], function () {               
                    Route::get('/danh-sach-thiet-bi-theo-phong',[
                        DeviceApiController::class,
                        'getDecivesOfRoom'
                    ])->name('api.decive.getDecivesOfRoom');       
                });
            
                Route::group(['prefix' => '/khaibaohuhong'], function () {
                    Route::get('/lich-su-khai-bao',[
                        DamageReportUserApiController::class,
                        'getReportHistory'
                    ]);  
                    Route::get('/tong-so-luong-yeu-cau-chua-xu-ly',[
                        DamageReportUserApiController::class,
                        'getCountRequestNoProcess'
                    ]);   
                    Route::get('/{maKhaiBao}',[
                        DamageReportUserApiController::class,
                        'show'
                    ])->where('maKhaiBao', 'KBHH[A-Za-z0-9]+');
                    Route::post('/xac-nhan-khai-bao-hu-hong',[
                        DamageReportUserApiController::class,
                        'createDamageReport'
                    ]);   
                    Route::delete('{maKhaiBao}',[
                        DamageReportUserApiController::class,
                        'delete'
                    ]);
                });
                Route::group(['prefix' => 'quanlyhoadon'], function () {        
                    Route::get("",[
                        BillUserApiController::class,
                        'getBillByRoom'
                    ]);
                    Route::get('chi-tiet-hoa-don',[
                        BillUserApiController::class,
                        'billDetail'
                    ]);   
                    Route::patch('{maHoaDon}/bao-cao-hoa-don-sai-thong-tin',[
                        BillUserApiController::class,
                        'reportBillWrongInfo'
                    ]);   
                    Route::patch('{maHoaDon}/huy-bo-bao-cao-hoa-don',[
                        BillUserApiController::class,
                        'reportBillCancel'   
                    ]);
                });
                Route::group(['prefix' => 'sinhvien','namespace' => 'Api'], function () {      
                    Route::get('danh-sach-sinh-vien-theo-phong',[
                        StudentAdminApiController::class,
                        'getStudentByRoom'
                    ]);            
                });

            });                                              
            Route::group(['prefix' => 'vipham'], function () {
                Route::get('/lich-su-vi-pham',[
                    InfringeUserApiController::class,
                    'getInfringeHistory'
                ]);  
                Route::post('/lich-su-vi-pham',[
                    InfringeUserApiController::class,
                    'create'
                ]); 
                Route::patch('/{maViPham}/{thoiGianViPham}',[
                    InfringeUserApiController::class,
                    'report'
                ]); 
                            
            });
            
        });
    });

//------------------------------------------------------------------
// không nằm trong bất kì 1 auth nào ----------------------
    Route::group(['prefix' => 'phong'], function () {
        Route::get('/danh-sach-phong-trong',[
            PhongApiController::class,
            'getEmptyRoom'
        ]);  
        Route::get('/danh-sach-phong-theo-tang/{maTang}',[
            PhongApiController::class,
            'getRoomByFloor'
        ])->name('api.room.getRoomByFloor');              
    });
    Route::group(['prefix' => 'tang','namespace' => 'Api'], function () {
        Route::get('/danh-sach-tang-theo-khu/{maKhu}',[
            TangApiController::class,
            'getFloorByArea'
        ])->name('api.floor.getFloorByArea');     
    });

    Route::group(['prefix' => 'khu','namespace' => 'Api'], function () {
        Route::get('/danh-sach-khu',[
            KhuApiController::class,
            'getAreaList'
        ])->name('api.area.getAreaList');    
    }); 
    Route::group(['prefix' => 'thietbi','namespace' => 'Api'], function () {
        Route::get('/danh-sach-thiet-bi',[
            DeviceApiController::class,
            'getDecives'
        ])->name('api.decive.getDecives');           
    });

    Route::get("vai-tro",[
        RoleApiController::class,
        "index"
    ]);
   
        
    
//------------------------------------------------------------------
//------------------------------------------------------------------
    Route::group(['middleware'=>['authorization:admin-api']],function(){
        Route::group(['prefix' => 'admin'], function () {
            

            Route::get("thong-bao",[
                NotificationAdminApiController::class,
                "index"
            ])->name('api.notification.index');

            
            Route::group(['prefix' => 'phong'], function () {
                            
                Route::get('/danh-sach-phong',[
                    PhongApiController::class,
                    'getRooms'
                ])->name('api.room.getRooms');                        

                Route::get('thong-tin-phong',[
                    PhongApiController::class,
                    'roomDetails'
                ])->name('api.room.roomDetails');
            });

            Route::group(['middleware'=>['admin.jwt:admin-api']],function(){                            
                Route::get('/danh-sach-xet-duyet',[
                    RegisterApiController::class,
                    'getReviewList'
                ])->name('api.register_residence.getReviewList');
                Route::get('/xem-thong-tin-dang-ky',[
                    RegisterApiController::class,
                    'checkRegisterInfo'
                ])->name('api.register_residence.checkRegisterInfo');
                Route::post('/huy-bo-dang-ky',[
                    RegisterApiController::class,
                    'cancelRegister'
                ])->name('api.register_residence.cancelRegister');
                Route::put('/phe-duyet-dang-ky',[
                    RegisterApiController::class,
                    'agreeRegister'
                ])->name('api.register_residence.agreeRegister');


                Route::group(['prefix' => 'quanlyhopdong'], function () {
                    Route::get('/danh-sach-hop-dong',[
                        ContractApiController::class,
                        'getContract'
                    ])->name('api.contract.getContract');
                    Route::get('chi-tiet-hop-dong',[
                        ContractApiController::class,
                        'details'
                    ])->name('api.contract.details');
                    Route::post('thanh-toan-hop-dong',[
                        ContractApiController::class,
                        'contractPayment'
                    ])->name('api.contract.contractPayment');
                });                        
                        

                
                Route::group(['prefix' => 'phong'], function () {
                    Route::apiResource('lich-su-chuyen-phong',ChangeRoomApiController::class)->only("index")->names([
                        "index"=>"api.change_room_history.index"
                    ]);


                    Route::group(['prefix' => 'lich-su-chuyen-phong'], function () {
                        Route::patch('{maDangKy}/phe-duyet-dang-ky',[
                            ChangeRoomApiController::class,
                            'agreeRegister'
                        ])->name("api.change_room_history.agreeRegister");
                        Route::patch('{maDangKy}/huy-bo-dang-ky',[
                            ChangeRoomApiController::class,
                            'cancelRegister'
                        ])->name("api.change_room_history.cancelRegister");                                  
                    });                
                });

                
                Route::apiResource('thietbi',DeviceApiController::class)->only("index")->only(["index","store","update","destroy"])->names([
                    "index"=>"api.device.index",
                    "store"=>"api.device.store",
                    "update"=>"api.device.update",
                    "destroy"=>"api.device.destroy",
                ]);
                Route::group(['prefix' => 'thietbi'], function () {
                    Route::group(['prefix' => 'phan-bo-thiet-bi'], function () {
                        Route::controller(DeviceAllocationApiController::class)->group(function () {
                            Route::get('','index')->name("api.device_allocation.index");
                            Route::get('thiet-bi-chua-phan-bo','getUnallocateDeviceByRoom')->name("api.device_allocation.getUnallocateDeviceByRoom");
                            Route::post('','store')->name("api.device_allocation.store");                    
                            Route::put('/{maThietBi}/{maPhong}','update')->name("api.device_allocation.update"); 
                            Route::delete('/{maThietBi}/{maPhong}','destroy')->name("api.device_allocation.destroy"); 
                        });                
                    });                
                });            



                Route::group(['prefix' => 'huhongsuachua'], function () {
                    Route::get('/danh-sach-thiet-bi-hu-hong',[
                        DamageReportApiController::class,
                        'damageEquimentList'
                    ])->name("api.damage_report.damageEquimentList"); 

                    Route::get('xu-ly-khai-bao-hu-hong',[
                        DamageReportApiController::class,
                        'dammageReportDetails'
                    ])->name("api.damage_report.dammageReportDetails");        
                    Route::post('xac-nhan-xu-ly-khai-bao-hu-hong',[
                        DamageReportApiController::class,
                        'dammageReportConfirmHanding'
                    ])->name("api.damage_report.dammageReportConfirmHanding");
                    Route::get('chi-tiet-xu-ly-khai-bao-hu-hong',[
                        DamageReportApiController::class,
                        'dammageReportHandingDetails'
                    ])->name("api.damage_report.dammageReportHandingDetails");        
                });


                Route::group(['prefix' => 'sinhvien','namespace' => 'Api'], function () {
                    Route::get('/',[
                        StudentAdminApiController::class,
                        'getStudents'
                    ])->name('api.student.getStudents');    
                    Route::get('danh-sach-sinh-vien-theo-phong',[
                        StudentAdminApiController::class,
                        'getStudentByRoom'
                    ])->name('api.student.getStudentByRoom');                    
                    Route::get('{maSinhVien}',[
                        StudentAdminApiController::class,
                        'show'
                    ])->name('api.student.show'); 
                }); 


                Route::group(['prefix' => 'vipham'], function () {

                    Route::controller(InfringeAdminApiController::class)->group(function () {
                        Route::get('','index')->name("api.infringe.index");
                        Route::post('','store')->name("api.infringe.store");
                        // Route::get('/{maViPham}','show')->name("api.infringe.show"); 
                        Route::put('/{maViPham}','update')->name("api.infringe.update"); 
                        Route::delete('/{maViPham}','destroy')->name("api.infringe.destroy"); 
                    }); 

                    Route::group(['prefix' => 'lich-su-vi-pham'], function () {
                        Route::controller(InfringeHistoryAdminApiController::class)->group(function () {
                            Route::get('','getInfringeHistory')->name("api.infringe_history.getInfringeHistory");
                            Route::get('/{maSV}','getInfringeHistoryById')->name("api.infringe_history.getInfringeHistoryById");
                            Route::post('','create')->name("api.infringe_history.create"); 
                            Route::patch('{maSV}/{maViPham}/{thoiGianViPham}/xac-thuc','accuracy')->name("api.infringe_history.accuracy"); 
                            Route::patch('{maSV}/{maViPham}/{thoiGianViPham}/xac-nhan','confrim')->name("api.infringe_history.confrim"); 
                        });                                         
                    });                         
                });



                Route::group(['prefix' => 'bat-tat-tinh-nang'], function () {
                    Route::get('',[
                        OpenFeatureAdminApiController::class,
                        "getStatus"
                    ])->name("api.feature.getStatus");
                    Route::group(['prefix' => 'dang-ky-noi-tru'], function () {
                        Route::controller(OpenFeatureAdminApiController::class)->group(function () {
                            Route::put('','openRegisterResidence')->name("api.feature.openRegisterResidence");                    
                            Route::delete('','closeRegisterResidence')->name("api.feature.closeRegisterResidence");       
                        });                                         
                    }); 
                    Route::group(['prefix' => 'gia-han-hop-dong'], function () {
                        Route::controller(OpenFeatureAdminApiController::class)->group(function () {
                            Route::put('','openContractExtension')->name("api.feature.openContractExtension");                  
                            Route::delete('','closeContractExtension')->name("api.feature.closeContractExtension");
                        });                                         
                    });                                                        
                });                                                                   
                            


                Route::group(['prefix' => 'quanlyhoadon'], function () {
                    Route::get('/danh-sach-hoa-don',[
                        BillApiController::class,
                        'getBills'
                    ])->name('api.bill.getBills');


                    Route::get('chi-tiet-hoa-don',[
                        BillApiController::class,
                        'billDetails'
                    ])->name('api.bill.billDetails');
                    Route::post('thanh-toan-hoa-don',[
                        BillApiController::class,
                        'billPayment'
                    ])->name('api.bill.billPayment');
                    Route::post('',[
                        BillApiController::class,
                        'billCreate'
                    ])->name('api.bill.billCreate');
                    
                    Route::put('/{maHoaDon}',[
                        BillApiController::class,
                        'billEdit'
                    ])->name('api.bill.billEdit');

                    Route::patch('{maHoaDon}/huy-bo-bao-cao-hoa-don',[
                        BillApiController::class,
                        'reportBillCancel'
                    ])->name('api.bill.reportBillCancel');

                    Route::get('chi-tiet-hoa-don-dich-vu-don',[
                        BillApiController::class,
                        'billDetailsSingleService'
                    ])->name('api.bill.billDetailsSingleService'); 

                    Route::get('chi-tiet-hoa-don-dich-vu-bat-buoc',[
                        BillApiController::class,
                        'billDetailsForceService'
                    ])->name('api.bill.billDetailsForceService');        
                    
                });
                Route::apiResource('dichvu',ServiceApiController::class)->only(["index","store","update","destroy"])->names([
                    "index"=>'api.service.index', 
                    // "show"=>'api.service.show',
                    "store"=>'api.service.store', 
                    "update"=>'api.service.update', 
                    "destroy"=>'api.service.destroy', 
                ]);
                Route::group(['prefix' => 'dichvu'], function () {
                    Route::controller(ServiceApiController::class)->group(function () {                    
                        Route::patch('/{maDichVu}/cap-nhat-dich-vu-bat-buoc','updateObligatory')->name('api.service.updateObligatory');                     
                        Route::patch('/{maDichVu}/cap-nhat-dich-vu-co-chi-so','updateHasIndex')->name('api.service.updateHasIndex');  
                    }); 
                    Route::group(['prefix' => 'dichvuphongcochiso'], function () {
                        Route::controller(RoomServiceHasIndexApiController::class)->group(function () {    
                            Route::group(['prefix' => '{maPhong}'], function () {                                        
                                Route::get('','getByRoom')->name('api.service_room_has_index.getByRoom');
                                Route::patch('{maDichVu}','resetIndex')->name('api.service_room_has_index.resetIndex');                     
                                // Route::patch('/{maDichVu}/cap-nhat-dich-vu-co-chi-so','updateHasIndex');  
                            }); 
                            
                            Route::get('','index')->name('api.service_room_has_index.index');
                        });   
                    });                 
                });

                Route::group(['prefix' => 'dich-vu-ca-nhan'], function () {
                    Route::controller(ServicePersonalAdminApiController::class)->group(function () {                    
                        Route::get('','index')->name('api.service_personal.index');                                                
                        Route::patch('/{maDichVu}/{maSV}','update')->name('api.service_personal.update');      
                        Route::delete('/{maDichVu}/{maSV}','destroy')->name('api.service_personal.destroy');      
                    });    
                });                         
                    
                Route::apiResource('nhan-vien',StaffManagerAdminApiController::class)->names([
                    "index"=>'api.staff.index', 
                    "store"=>'api.staff.store', 
                    "update"=>'api.staff.update', 
                    "destroy"=>'api.staff.destroy', 
                ]);
                Route::group(['prefix' => 'nhan-vien'], function () {
                    Route::controller(StaffManagerAdminApiController::class)->group(function () {
                        Route::patch('{id}/dat-lai-mat-khau','resetPassword')->name('api.staff.resetPassword');                         
                    });
                });   

            });

            Route::group(['prefix' => 'phong'], function () {
                            
                // Route::get('/danh-sach-phong',[
                //     PhongApiController::class,
                //     'getRooms'
                // ])->name('api.room.getRooms');                        

                // Route::get('thong-tin-phong',[
                //     PhongApiController::class,
                //     'roomDetails'
                // ])->name('api.room.roomDetails');

                

                Route::post('doi-truong-phong',[
                    PhongApiController::class,
                    'changeManager'
                ])->name('api.room.changeManager');
                Route::put('/{maPhong}',[
                    PhongApiController::class,
                    'update'
                ])->name('api.room.update');
                Route::post('',[
                    PhongApiController::class,
                    'create'
                ])->name('api.room.create');
                Route::delete('/{maPhong}',[
                    PhongApiController::class,
                    'delete'
                ])->name('api.room.delete');            
            });                               

            Route::group(['prefix' => 'dichvu','namespace' => 'Api'], function () {
                Route::get('/danh-sach-dich-vu-bat-buoc',[
                    DichVuApiController::class,
                    'getServiceMandatoryList'
                ])->name('api.service.getServiceMandatoryList'); 
                Route::get('/thong-ke-dich-vu-don-theo-phong',[
                    DichVuApiController::class,
                    'statisticsIndividualServiceByRoom'
                ])->name('api.service.statisticsIndividualServiceByRoom'); 
                Route::get('/thong-ke-dich-vu-co-chi-so-theo-phong',[
                    DichVuApiController::class,
                    'statisticsOfServiceWithIndexByRoom'
                ])->name('api.service.statisticsOfServiceWithIndexByRoom');        
            });
        });
        



        


        // Route::resource('role', RoleApiController::class)->name("index","api.role_get");        
        // Route::group(['prefix'=>'manager'],function(){
                            
        //         Route::apiResource("role",RoleApiController::class)->names([
        //             "index"=>"api.manager-role-index",
        //             "update"=>"api.manager-role-update",
        //             "destroy"=>"api.manager-role-delete"
        //         ]);  

        //         Route::group(['prefix'=>'permission'],function(){              
        //             route::get("get-by-role",
        //             [
        //                 PermissionApiController::class,
        //                 'getDataByRole'
        //             ]
        //             )->name("api.manager-permission-get-by-role"); 
        //             route::put("update-status",
        //                 [
        //                     PermissionApiController::class,
        //                     'updateStatus'
        //                 ]
        //             )->name("api.manager-permission-update-status");  
        //         });  


       
           
        //     });   
    });

});
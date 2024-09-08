<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\View\PermissionController;
use App\Http\Controllers\View\RoleController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController ;
use App\Http\Controllers\Admin\ChangeRoomController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DamageReportController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\InfringeController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Api\Admin\ChangeRoomApiController;
use App\Http\Controllers\Api\StaffManagerAdminController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\User\BillUserController;
use App\Http\Controllers\User\ContractUserController;
use App\Http\Controllers\User\DamageReportUserController;
use App\Http\Controllers\User\DangKyNoiTruController;
use App\Http\Controllers\User\InfringeUserController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\RoomUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/',[
    HomeController::class,
    'index'
])->name('home');


Route::get('/sinhvien',[
    SinhVienController::class,
    'details'
]);

Route::group(['prefix'=>'auth'],function(){
    Route::get('/login',[
        HomeController::class,
        'login'
    ])->name('login');
    Route::get("/register",[
        HomeController::class,
        "register"
    ]);
    Route::get('/logout',[
        HomeController::class,
        'logout'
    ])->name('logout');
});


// Route::middleware(["auth","authorization"])->group(function(){
//     Route::group(['prefix'=>'manager'],function(){

   
        
//         Route::get('role',[
//             RoleController::class,
//             "index"
//         ])->name("web.manager-role-index");
        


//         Route::group(['prefix'=>'permission'], function(){
//             Route::get("/grant",[
//                 PermissionController::class,
//                 "grant"
//             ])->name("web.manager-permission-grant");
//         });

 

//     });
//     Route::group(['prefix'=>'personal'],function(){

        
//     });
    
// });


Route::middleware(["auth"])->group(function(){
    Route::group(['prefix' => 'user'], function () {
        Route::get('thong-bao/{id}',[
            NotificationController::class,
            'getUserNotification'
        ]); 
        Route::get('chua-la-thanh-vien-cua-ky-tuc-xa',function(){
            return view("error.chua-la-thanh-vien-cua-ky-tuc-xa");
        })->name('chua-la-thanh-vien-cua-ky-tuc-xa'); 
        Route::get('/',[
            UserController::class,
            'index'
        ])->name('TrangChu');    
        Route::get('/ho-so-sinh-vien',[
            UserController::class,
            'information'
        ])->name('HoSoSinhVien');
        Route::group(['prefix' => 'dangkynoitru'], function () {
            Route::get('/dang-ky-noi-tru',[
                DangKyNoiTruController::class,
                'index'
            ])->name('DangKyNoiTru');
            Route::get('/xac-nhan-dang-ky',[
                DangKyNoiTruController::class,
                'xacNhanDangKy'
            ]);
            Route::post('/xac-nhan-dang-ky',[
                DangKyNoiTruController::class,
                'dangKyNoiTru'
            ])->name('dangKyNoiTruPost');
            Route::get('/dang-ky-thanh-cong',[
                DangKyNoiTruController::class,
                'dangKyThanhCong'
            ]);
        });

        Route::group(['prefix' => 'hopdong'], function () {
            Route::get('/',[
                ContractUserController::class,
                'index'
            ])->name('user_mycontract');
        });
        
        Route::middleware("registered-resident")->group(function(){
            Route::group(['prefix' => 'khaibaohuhong'],function(){
                Route::get('/',[
                    DamageReportUserController::class,
                    'reportHistory'
                ])->name('user_khaiBaoHuHong');
                Route::get('/{maKhaiBao}',[
                    DamageReportUserController::class,
                    'show'
                ])->where('maKhaiBao', 'KBHH[A-Za-z0-9]+');
                Route::get('/tao-khai-bao',[
                    DamageReportUserController::class,
                    'reportCreate'
                ])->name('user_taoKhaiBaoMoi');
            });  
            Route::group(['prefix' => '/quanlyhoadon'], function () {
                Route::get('/',[
                    BillUserController::class,
                    'billHistory'
                ])->name('user_quanLyHoaDon');             
                Route::get('/{MaHoaDon}',[
                    BillUserController::class,
                    'billDetail'
                ])->name('user_quanLyHoaDon_details'); 
            });
            Route::group(['prefix' => '/quanlyphong'], function () {
                Route::get('/thay-doi-phong',[
                    RoomUserController::class,
                    'changeRoom'
                ])->name('user_thayDoiPhong');             
            });

        });

        
        Route::group(['prefix' => '/vipham'], function () {
            Route::get('/lich-su-vi-pham',[
                InfringeUserController::class,
                'infringeHistory'
        ])->name('user_viPham');        
        });        
    });
});


Route::middleware(["admin-ui"])->group(function(){
    Route::group(['prefix' => 'quanlyphong'],function(){
        Route::get('/',[
            RoomController::class,
            'showRoomList'
        ])->name('web.room.showRoomList');
        Route::get('/{MaPhong}',[
            RoomController::class,
            'roomDetails'
        ])->name('web.room.roomDetails');
        // Route::get('/{MaSV}',[
        //     RegisterController::class,
        //     'checkRegistrationInformation'
        // ]);
    });   

    Route::group(['prefix' => 'admin'],function(){
        Route::middleware(["admin"])->group(function(){
        
            Route::get('/',[
                AdminController::class,
                'index'
            ])->name('web.index');
            Route::group(['prefix' => 'quanlyxetduyet'],function(){
                Route::get('/',[
                    RegisterController::class,
                    'registrationReview'
                ])->name('web.register_residence.registrationReview');
                Route::get('/{MaSV}',[
                    RegisterController::class,
                    'checkRegistrationInformation'
                ])->name('web.register_residence.checkRegistrationInformation');
            }); 


            Route::group(['prefix' => 'quanlyhopdong'],function(){
                Route::get('/',[
                    ContractController::class,
                    'contractList'
                ])->name('web.contract.contractList');
                Route::get('/{MaHopDong}',[
                    ContractController::class,
                    'contractInfo'
                ])->name('web.contract.contractInfo');
                // Route::get('/{MaSV}',[
                //     RegisterController::class,
                //     'checkRegistrationInformation'
                // ]);
            }); 
                        

            Route::get('/lich-su-chuyen-phong',[
                ChangeRoomController::class,
                'index'
            ])->name('web.change_room_history.index'); 


            
            Route::group(['prefix' => 'thietbi'],function(){
                Route::get('/',[
                    DeviceController::class,
                    'index'
                ])->name('web.device.index');
                Route::get('phan-bo-thiet-bi',[
                    DeviceController::class,
                    'deviceAllocation'
                ])->name('web.device_allocation.deviceAllocation');                                
            });        



            
            Route::group(['prefix' => 'huhongsuachua'],function(){
                Route::get('/',[
                    DamageReportController::class,
                    'damageEquipmentList'
                ])->name('web.damage_report.damageEquipmentList');
                Route::get('/xu-ly-khai-bao-hu-hong/{MaKhaiBao}',[
                    DamageReportController::class,
                    'roomReportHanding'
                ])->name('web.damage_report.roomReportHanding');                        
            });
                
            

            Route::group(['prefix' => 'quanlysinhvien'],function(){
                Route::get('/',[
                    StudentController::class,
                    'studentList'
                ])->name('web.student.studentList');        
            });

            Route::group(['prefix' => 'quanlyvipham'],function(){
                Route::get('/',[
                    InfringeController::class,
                    'index'
                ])->name('web.infringe.index');
                Route::get('/lich-su-vi-pham',[
                    InfringeController::class,
                    'InfringeHistory'
                ])->name('web.infringe_history.InfringeHistory');
                Route::get('/khai-bao-vi-pham',[
                    InfringeController::class,
                    'infringeHistoryCreate'
                ])->name('web.infringe_history.infringeHistoryCreate');
                // Route::get('/{MaSV}',[
                //     RegisterController::class,
                //     'checkRegistrationInformation'
                // ]);
            });                        



            Route::group(['prefix' => 'quanlyhoadon'],function(){
                Route::get('/',[
                    BillController::class,
                    'showBillList'
                ])->name('web.bill.showBillList');
                Route::get('/{MaHoaDon}',[
                    BillController::class,
                    'billDetails'
                ])->where('MaHoaDon', 'HD[A-Za-z0-9]+')->name('web.bill.billDetails');
                Route::get('chinh-sua-hoa-don/{MaHoaDon}',[
                    BillController::class,
                    'billEdit'
                ])->where('MaHoaDon', 'HD[A-Za-z0-9]+')->name('web.bill.billEdit');
                Route::get('/tao-hoa-don',[
                    BillController::class,
                    'billCreate'
                ])->name('web.bill.billCreate');
            });   
            Route::group(['prefix' => 'dichvu'],function(){
                Route::get('', [
                    ServiceController::class,
                    "index"
                ])->name("web.service.index");    
                Route::get('/dich-vu-ca-nhan', [
                    ServiceController::class,
                    "servicePersonal"
                ])->name("web.service_personal.servicePersonal");

                
                Route::get('dich-vu-phong-co-chi-so', [
                    ServiceController::class,
                    "serviceRoom"
                ])->name("web.service_room.serviceRoom");
            });         


            Route::group(['prefix' => 'quanlynhanvien'],function(){
                Route::get('/',[
                    StaffManagerAdminController::class,
                    'index'
                ])->name('web.staff.index');        
            });
                
            
        });    
    });
});






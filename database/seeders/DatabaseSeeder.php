<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feature;
use App\Models\GroupRoute;
use App\Models\NhanVien;
use App\Models\Permission;
use App\Models\Premium;
use App\Models\PremiumFeature;
use App\Models\Role;
use App\Models\Route;
use App\Models\RouteListGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          
        // DB::table("migrations")
        //     ->where("migration","2023_10_17_153438_create_routes_table")
        //     ->delete();
        // DB::table("migrations")
        //     ->where("migration","2023_10_27_104759_create_permission_table")
        //     ->delete();
        // Artisan::call("migrate");
        Permission::query()->delete();
        // Role::query()->delete();
        Route::query()->delete();

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.index",
            'menu_title'=>"Trang chủ",     
            "index_location"=>1,
            "icon"=>"house",            
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.register_residence.registrationReview",
            'menu_title'=>"Xét duyệt - kiểm tra", 
            "index_location"=>2,
            "icon"=>"check-to-slot"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.register_residence.checkRegistrationInformation",                  
        ]);  
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.register_residence.getReviewList",                  
        ]);  
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.register_residence.checkRegisterInfo",                  
        ]);

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.register_residence.cancelRegister",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.register_residence.agreeRegister",                  
        ]);

               

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.contract.contractList",
            'menu_title'=>"Hợp đồng", 
            "index_location"=>3,
            "icon"=>"file-contract"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.contract.contractInfo",
        ]);  

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.contract.getContract",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.contract.details",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.contract.contractPayment",                  
        ]);
        
       

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.room.showRoomList",
            'menu_title'=>"Phòng", 
            "index_location"=>4,
            "icon"=>"building"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.room.roomDetails",
        ]);        

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.getRooms",                  
        ]);

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.roomDetails",                  
        ]);

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.changeManager",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.update",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.create",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.room.delete",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.change_room_history.index",
            'menu_title'=>"Lịch sử chuyển phòng", 
            "index_location"=>5,
            "icon"=>"person-booth"        
        ]);   
        
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.change_room_history.index",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.change_room_history.agreeRegister",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.change_room_history.cancelRegister",                  
        ]);


        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.device.index",
            'menu_title'=>"Thiết bị", 
            "index_location"=>6,
            "icon"=>"toolbox"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device.index",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device.store",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device.update",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device.destroy",                  
        ]);
        

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.device_allocation.deviceAllocation",
            'menu_title'=>"Phân bổ thiết bị", 
            "index_location"=>7,
            "icon"=>"laptop-medical"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device_allocation.index",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device_allocation.getUnallocateDeviceByRoom",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device_allocation.store",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device_allocation.update",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.device_allocation.destroy",                  
        ]);



        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.damage_report.damageEquipmentList",
            'menu_title'=>"Hư hỏng - sửa chửa", 
            "index_location"=>8,
            "icon"=>"house-chimney-crack"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.damage_report.roomReportHanding",
        ]);


        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.damage_report.damageEquimentList",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.damage_report.dammageReportDetails",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.damage_report.dammageReportConfirmHanding",                  
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.damage_report.dammageReportHandingDetails",                  
        ]);        


        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.student.studentList",
            'menu_title'=>"Sinh viên",
            "index_location"=>9, 
            "icon"=>"chalkboard-user"        
        ]);

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.student.getStudents",                  
        ]);  
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.student.getStudentByRoom",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.student.show",                  
        ]); 


        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.infringe.index",
            'menu_title'=>"Vi phạm", 
            "index_location"=>10,
            "icon"=>"scale-balanced"        
        ]);

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe.index",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe.store",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe.show",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe.update",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe.destroy",                  
        ]); 

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.infringe_history.InfringeHistory",
            'menu_title'=>"Lịch sử vi phạm", 
            "index_location"=>11,
            "icon"=>"gavel"        
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe_history.getInfringeHistory",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe_history.getInfringeHistoryById",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe_history.create",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe_history.accuracy",                  
        ]); 
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.infringe_history.confrim",                  
        ]); 

        Route::create([
            "key"=>"student-manager",
            'route_name'=>"web.infringe_history.infringeHistoryCreate",                   
        ]);


        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.feature.getStatus",                   
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.feature.openRegisterResidence",                   
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.feature.closeRegisterResidence",                   
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.feature.openContractExtension",                   
        ]);
        Route::create([
            "key"=>"student-manager",
            'route_name'=>"api.feature.closeContractExtension",                   
        ]);



            






        //bên quản lý dịch vụ
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.bill.showBillList",
            'menu_title'=>"Hóa đơn", 
            "index_location"=>12,
            "icon"=>"file-invoice"        
        ]);         
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.bill.billDetails",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.bill.billEdit",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.bill.billCreate",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.getBills",
        ]);

        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billDetails",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billPayment",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billCreate",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billEdit",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.reportBillCancel",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billDetailsSingleService",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.bill.billDetailsForceService",
        ]);

        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.service.index",
            'menu_title'=>"Dịch vụ", 
            "index_location"=>13,
            "icon"=>"shekel-sign"        
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.index",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.show",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.store",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.update",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.destroy",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.updateObligatory",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.updateHasIndex",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.service_personal.servicePersonal",
            'menu_title'=>"Dịch vụ cá nhân", 
            "index_location"=>14,
            "icon"=>"street-view"        
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_room_has_index.getByRoom",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_room_has_index.resetIndex",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_personal.index",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_personal.update",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_personal.destroy",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"web.service_room.serviceRoom",
            'menu_title'=>"Dịch vụ có chỉ số", 
            "index_location"=>15,
            "icon"=>"indent"        
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service_room_has_index.index",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.getServiceMandatoryList",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.statisticsIndividualServiceByRoom",
        ]);
        Route::create([
            "key"=>"service-manager",
            'route_name'=>"api.service.statisticsOfServiceWithIndexByRoom",
        ]);


        // bên giám đốc
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"web.staff.index",
            'menu_title'=>"Nhân viên", 
            "index_location"=>16,
            "icon"=>"clipboard-user"        
        ]);
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"api.staff.index",
        ]);
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"api.staff.store",
        ]);
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"api.staff.update",
        ]);
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"api.staff.destroy",
        ]);
        Route::create([
            "key"=>"staff-manager",
            'route_name'=>"api.staff.resetPassword",
        ]);   
        
        
        // Route::create([
        //     "key"=>"notification",
        //     'route_name'=>"api.notification.index",
        // ]);



         // Role::create([
        //     'role_name'=>"Giám đốc",
        //     'role_manager'=>true,
        //     'priority'=>1,
        //     'lock'=>true            
        // ]);
        // Role::create([
        //     'role_name'=>"Cán bộ quản lý sinh viên",
        //     'role_manager'=>true,
        //     'priority'=>2,  
        //     'lock'=>true            
        // ]);
        // Role::create([
        //     'role_name'=>"Cán bộ quản lý dịch vụ",            
        //     'priority'=>2, 
        //     'lock'=>true                          
        // ]);

       

        $role_id = Role::where("role_name","Cán bộ quản lý sinh viên")->first()->id;
        $routes = Route::where("key","student-manager")->orWhere('route_name',"web.index")->get();
        foreach ($routes as $route) {
            Permission::create([
                'role_id' => $role_id,
                'route_id' => $route->id,
                'status' => true,
                'lock'=> true,
            ]);
        }
        $role_id = Role::where("role_name","Cán bộ quản lý dịch vụ")->first()->id;
        $routes = Route::where("key","service-manager")->orWhere('route_name',"web.index")
                    ->orWhere('route_name',"web.room.showRoomList")->get();
        foreach ($routes as $route) {
            Permission::create([
                'role_id' => $role_id,
                'route_id' => $route->id,
                'status' => true,
                'lock'=> true,
            ]);
        }
        
        
        $role_id = Role::where("role_name","Giám đốc")->first()->id;
        $routes = Route::all();
        foreach ($routes as $route) {
            Permission::create([
                'role_id' => $role_id,
                'route_id' => $route->id,
                'status' => true,
                'lock'=> true,
            ]);
        }

        // NhanVien::create([
        //     'TenDangNhap'=>"master",
        //     'Ho'=>"Lê Phát",
        //     'Ten'=>"Đạt",
        //     'SoDienThoai'=>"0387079343",
        //     'role_id'=>$role_id,    
        //     'MatKhau'=>"123",    
        //     'password'=>"123", 
        // ]);

    }
}
